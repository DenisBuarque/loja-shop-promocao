<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class SiteController extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function site()
    {
        $categories = $this->category->all();
        $products = $this->product->all();
        return view('site',['categories' => $categories, 'products' => $products]);
    }

    public function detail($slug)
    {
        $categories = $this->category->all();
        $product = $this->product->where('slug',$slug)->first();
        if(!$product){
            $products = $this->product->all();
            return redirect('/')->with('alert', 'Opsss! Produto não encontrado.');
        }

        return view('product',['product' => $product, 'categories' => $categories]);
        
    }

    public function category($slug)
    {
        $query = $this->category->where('slug',$slug)->first();
        if($query)
        {
            $category = $this->category->find($query->id);

            if($category){
                $products = $this->product->join('category_product','products.id','=','category_product.product_id')
                                ->where('category_product.category_id', '=', $query->id)
                                ->select('products.*')
                                ->orderBy('products.id','DESC')
                                ->get();
            }
        } else {
            $products = $this->product->all();
            return redirect('/')->with('alert', 'Opsss! Desculpe, não encontramos a categoria que procura, enquanto isso veja outros produtos. Boa compra!');
        }
        
        $categories = $this->category->all();
        return view('site',['categories' => $categories, 'products' => $products]);
    }

    public function search(Request $request)
    {
        if(isset($request->search))
        {
            $search = $request->search;
            $products = $this->product->where('title','LIKE','%'.$search.'%')->get();
        } else {
            $products = $this->product->all();
            return redirect('/')->with('alert', 'Opsss! Produto não encontrado.');
        }

        $categories = $this->category->all();
        return view('site',['categories' => $categories, 'products' => $products]);
    }

    public function politics()
    {
        return view('/politics');
    }
}
