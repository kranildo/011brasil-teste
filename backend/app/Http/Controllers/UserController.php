<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;



    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return
            User::findOrFail($id);
    }

    /**
     * Cria um novo usuario
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $assignRole = $request->input('assignRole');

        $user = $this->user->create([
            'name' =>  $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        $user->assignRole($assignRole);
        if ($user) {
            return $this->retornoJson(201, "Salvo com sucesso", $user->toArray());
        }
        return  $this->retornoJson(304, "Erro ao salvar");
    }


    /**
     * Editar Usuario
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $me = auth('api')->user();
        if ($me->id != $id) {
            if (!$me->hasRole('Super Admin')) {
                return $this->retornoJson(403, "Sem permissão");
            }
        }
        $name = $request->input('name');
        $email = $request->input('email');

        $user = User::where('id', '=', $id)->update([
            'name' =>  $name,
            'email' => $email,
        ]);
        if ($user) {
            return $this->retornoJson(201, "Atualizado com sucesso");
        }
        return  $this->retornoJson(304, "Erro ao salvar");
    }

    /**
     * Atualizar Permissao Usuario
     *
     * @param  int  $id
     * @param  string  $assignRole
     * @return \Illuminate\View\View
     */
    public function assignRole($id, Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasRole('Super Admin')) {
            return $this->retornoJson(403, "Sem permissão");
        }
        $assignRole = $request->input('assignRole');
        if (!empty($assignRole)) {
            $user = User::where('id', '=', $id);
            $user->assignRole($assignRole);
            if ($user) {
                return $this->retornoJson(201, "Atualizado com sucesso");
            }
        }
        return  $this->retornoJson(304, "Erro ao salvar");
    }
}