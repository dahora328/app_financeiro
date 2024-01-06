<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method find(Lancamento $id)
 */
class Lancamento extends Model
{
    use HasFactory;
    protected $fillable = ['descricao','valor', 'data', 'user_id', 'categoria_id'];

    public function rules()
    {
        return [
            'descricao' => 'required|min:3',
            'valor' => 'required',
            'data' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'descricao.min' => 'A descrição deve ter no mínimo 3 caracteres'
        ];
    }
}
