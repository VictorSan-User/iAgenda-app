<?php

namespace App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    // Exibe o formulário de registro de usuário
    public function create()
    {
        return view('auth.register');
    }

    // Armazena um novo usuário no banco de dados
    public function store(Request $request)
    {
        // Validacao de dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Caso validação falhar
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redireciona pro login com uma mensagem de sucesso
        return redirect()->route('login')->with('success', 'Novo usuário Cadastrado!');
    }
}
