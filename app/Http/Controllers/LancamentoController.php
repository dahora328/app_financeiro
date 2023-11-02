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
        $lancamento = Lancamento::all();
        return $lancamento;
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
