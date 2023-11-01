<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    protected $lancamento;
    public function __construct(Lancamento $lancamento){
        $this->lancamento = $lancamento;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lancamento');
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
        /*$request->validate($this->lancamento->rules());

        $lancamento = $this->lancamento->create([
            'descricao' => $request->lancamento,
            'valor' => $request->valor,
            'data' => $request->data
        ]);
        return response()->json($this->lancamento, 201);*/
        return 'cheguei';
    }

    /**
     * Display the specified resource.
     */
    public function show(Lancamento $id)
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
    public function update(Request $request, Lancamento $lancamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lancamento $lancamento)
    {
        //
    }
}
