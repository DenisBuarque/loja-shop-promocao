<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\CategoryProduct;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
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
        if(isset($request->search)){
            $search = $request->search;
            $categories = $this->category->where('name','LIKE','%'.$search.'%')->get();
        } else {
            $categories = $this->category->orderBy('id','DESC')->paginate(5);
        }
        return view('categories.index',['categories' => $categories, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|string|max:50|unique:categories',
        ])->validate();

        $data['slug'] = Str::of($request->name)->slug('-');

        if($this->category->create($data)):
            return redirect('category/create')->with('alert', 'Registro adicionado com sucesso!');
        else:
            return redirect('category/create')->with('alert', 'Erro ao inserir o registro!');
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
        $category = $this->category->find($id);
        if($category){
            return view('categories.edit',['category' => $category]);
        } else {
            return redirect('categories')->with('alert', 'Não encontramos a categoria!');
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
        $record = $this->category->find($id);

        Validator::make($data, [
            'name' => ['required','string','max:50',Rule::unique('categories')->ignore($id)],
        ])->validate();
        
        $data['slug'] = Str::of($request->name)->slug('-');

        if($record->update($data)):
            return redirect('categories')->with('alert', 'Registro alterado com sucesso!');
        else:
            return redirect('categories')->with('alert', 'Erro alterar o registro!');
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
        $record = $this->category->find($id);
        if($record->delete()){
            return redirect('categories')->with('alert', 'Registro excluído com sucesso!');
        } else {
            return redirect('categories')->with('alert', 'Erro ao excluir o registro!');
        }
    }
}
