<?php

namespace App\Http\Controllers;

use App\Models\Carros;
use Illuminate\Http\Request;

class CarrosController extends Controller
{
    protected $carro;



    public function __construct(
        Carros $carro
    ) {
        $this->carro = $carro;
    }


    /**
     * Cria um novo Carro
     *
     * @param  string  $marca
     * @param  string  $modelo
     * @param  int  $ano
     * @param  string  $fabricacao
     * @param  string  $placa
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $marca = $request->input('marca');
        $modelo = $request->input('modelo');
        $ano = $request->input('ano');
        $fabricacao = $request->input('fabricacao');
        $placa = $request->input('placa');

        $carro = $this->carro->create([
            'marca' =>  $marca,
            'modelo' => $modelo,
            'ano' => $ano,
            'fabricacao' => $fabricacao,
            'placa' => $placa,
        ]);
        if ($carro) {
            return $this->retornoJson(201, "Salvo com sucesso", $carro->toArray());
        }
        return  $this->retornoJson(304, "Erro ao salvar");
    }


    /**
     * Editar Carro
     *
     * @param  int  $id
     * @param  string  $marca
     * @param  string  $modelo
     * @param  int  $ano
     * @param  string  $fabricacao
     * @param  string  $placa
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $marca = $request->input('marca');
        $modelo = $request->input('modelo');
        $ano = $request->input('ano');
        $fabricacao = $request->input('fabricacao');
        $placa = $request->input('placa');

        $carro = Carros::where('id', '=', $id)->update([
            'marca' =>  $marca,
            'modelo' => $modelo,
            'ano' => $ano,
            'fabricacao' => $fabricacao,
            'placa' => $placa,
        ]);
        if ($carro) {
            return $this->retornoJson(201, "Atualizado com sucesso");
        }
        return  $this->retornoJson(304, "Erro ao salvar");
    }
}