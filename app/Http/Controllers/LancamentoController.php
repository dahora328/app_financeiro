<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;
use App\Repositories\LancamentoRepository;

class LancamentoController extends Controller
{


    protected $lancamento;
    public function __construct(Lancamento $lancamento){
        $this->lancamento = $lancamento;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $lancamentoRepository = new LancamentoRepository($this->lancamento);

        $lancamentos = array();

        if ($request->has('filtro')){
            $lancamentoRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $lancamentoRepository->selectAtributos($request->atributos);
        }


        return response()->json($lancamentoRepository->getResultadoPaginado(3), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate($this->lancamento->rules(), $this->lancamento->feedback());

        $lancamento = $this->lancamento->create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data' => $request->data
        ]);

        return response()->json($lancamento, 201);
        //return 'cheguei até aqui';
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lancamento = $this->lancamento->find($id);
        if($lancamento == null){
            return response()->json(['erro' => 'Recurso pesquisando não existe'], 404);
        }
        return response()->json($lancamento, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lancamento $lancamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $lancamento = $this->lancamento->find($id);

        if($lancamento === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {


            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($this->lancamento->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);

        } else {
            $request->validate($this->lancamento->rules(), $this->lancamento->feedback());
        }

        $lancamento->fill($request->all());
        $lancamento->save();

        return response()->json($lancamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lancamento = $this->lancamento->find($id);

        if ($lancamento == null){
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }
        $lancamento->delete();
        return response()->json(['msg' => 'O lancamento foi removido com sucesso!'], 200);
    }
}
