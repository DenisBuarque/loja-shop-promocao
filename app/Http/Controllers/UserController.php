<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->orderBy('id','DESC')->paginate(5);
        return view('users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users|max:50',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();

        $data['password'] =  bcrypt($request->password);

        if($this->user->create($data)):
            return redirect('user/create')->with('alert', 'Registro adicionado com sucesso!');
        else:
            return redirect('user/create')->with('alert', 'Erro ao inserir o registro!');
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
        $user = $this->user->find($id);
        if($user){
            return view('users.edit',['user' => $user]);
        } else {
            return redirect('users')->with('alert', 'Não encontramos o usuário!');
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
        $record = $this->user->find($id);

        if(!$data['password']):
            unset($data['password']);
        endif;

        Validator::make($data, [
            'name' => 'required|string|max:50',
            'email' => ['required','string','email','max:50',Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|required|string|min:6|confirmed',
        ])->validate();

        if($request->password){
            $data['password'] =  bcrypt($request->password);
        }

        if($record->update($data)):
            return redirect('users')->with('alert', 'Registro alterado com sucesso!');
        else:
            return redirect('users')->with('alert', 'Erro alterar o registro!');
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
        $record = $this->user->find($id);
        if($record->delete()){
            return redirect('users')->with('alert', 'Registro excluído com sucesso!');
        } else {
            return redirect('users')->with('alert', 'Erro ao excluir o registro!');
        }
    }
}
