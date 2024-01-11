<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{
    public function __construct(Model $model)
    {
        $this->model =  $model;

        $user = auth('api')->user();
        if ($user){
            // Se um usuário estiver autenticado, adicione a condição na query
            $this->model = $this->model->where('user_id', $user->id);
        }
    }

    public function filtro($filtros)
    {
        $filtros = explode(';', $filtros);

        foreach ($filtros as $key => $condicao){
            $condicoes = explode(':', $condicao);
            $this->model = $this->model->where($condicoes[0], $condicoes[1], $condicoes[2]);
        }
    }

    public function selectAtributos($atributos)
    {
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultado()
    {
        return $this->model->get(); //retorna o estado atual da query
    }

    public function getResultadoPaginado($registroPorPagina)
    {
        return $this->model->paginate($registroPorPagina); //retorna o estado atual da query
    }
}

