<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use App\Models\CategoryProduct;

class ProductController extends Controller
{
    private $product;
    private $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = '';
        $select = '';

        if(isset($request->search) && !isset($request->category) )
        {
            $search = $request->search;
            $products = $this->product->where('title','LIKE','%'.$search.'%')->get();

        } else if (!isset($request->search) && isset($request->category)){
            $select = $request->category;
 
            $products = $this->product->join('category_product','products.id','=','category_product.product_id')
                          ->where('category_product.category_id', '=', $select)
                          ->select('products.*')
                          ->orderBy('products.id','DESC')
                          ->get();

        } else if (isset($request->search) && isset($request->category)){
            $search = $request->search;
            $select = $request->category;

            $products = $this->product->join('category_product','products.id', '=', 'category_product.product_id')
            ->where('title','LIKE','%'.$search.'%')
            ->orWhere('category_product.category_id', '=', $select)
            ->select('products.*')
            ->orderBy('products.id','DESC')
            ->get();

        } else {
            $products = $this->product->orderBy('id','DESC')->paginate(6);
        }

        $categories = $this->category->all();

        return view('products.index',[
            'products' => $products, 
            'categories' => $categories, 
            'search' => $search,
            'select' => $select
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('products.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Validator::make($data, [
            'title' => 'required|string|min:20|max:200',
            'description' => 'required|string',
            'price' => 'required|string|max:9',
        ])->validate();
        
        $data['slug'] = Str::of($request->title)->slug('-');

        $product = $this->product->create($data);
        if($product):

            if($request->hasFile('photos')){
                $images = $this->imageUpload($request,'image');
                $product->photos()->createMany($images);
            }

            $product->categories()->sync($data['categories']); // adiciona as categorias do produto no relacionamento

            return redirect('product/create')->with('alert', 'Registro adicionado com sucesso!');
        else:
            return redirect('product/create')->with('alert', 'Erro ao inserir o registro!');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->category->all();

        $product = $this->product->find($id);
        if($product){
            return view('products.edit',['product' => $product, 'categories' => $categories]);
        } else {
            return redirect('products')->with('alert', 'Não encontramos o produto!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = $this->product->find($id);

        Validator::make($data, [
            'title' => 'required|string|min:20|max:200',
            'description' => 'required|string',
            'price' => 'required|string|max:9',
        ])->validate();

        $data['slug'] = Str::of($request->title)->slug('-');

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request,'image');
            // inserção desta imagem/referencia na base
            $product->photos()->createMany($images);
        }
        
        if($product->update($data)):

            $product->categories()->sync($data['categories']); //adiciona as caterias do produto no relacionamento
            
            return redirect('products')->with('alert', 'Registro alterado com sucesso!');
        else:
            return redirect('products')->with('alert', 'Erro alterar o registro!');
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->product->find($id);

        foreach($record->photos as $foto)
        {
            $photo = $foto->image;

            if(Storage::disk('public')->exists($photo)){
                Storage::disk('public')->delete($photo);
            }
    
            $removePhoto = ProductPhoto::where('image', $photo);
            $removePhoto->delete();
            
        }

        $record->categoryProduct->delete();

        if($record->delete()){
            return redirect('products')->with('alert', 'Registro excluído com sucesso!');
        } else {
            return redirect('products')->with('alert', 'Erro ao excluir o registro!');
        }
    }

    // realiza o upload da imagem do produto
    private function imageUpload(Request $request, $imageColumn)
    {
        $images = $request->file('photos');
        $uploadedImage = [];
        foreach($images as $image){
            $uploadedImage[] = [$imageColumn => $image->store('products','public')];
        }
        return $uploadedImage;
    }

    // remove a imagem do produto
    public function remove(Request $request)
    {
        $photo = $request->get('photo');

        if(Storage::disk('public')->exists($photo)){
            Storage::disk('public')->delete($photo);
        }

        $removePhoto = ProductPhoto::where('image', $photo);
        $product_id = $removePhoto->first()->product_id;

        $removePhoto->delete();

        return redirect()->route('product.edit',['id' => $product_id]);   
    }
}
