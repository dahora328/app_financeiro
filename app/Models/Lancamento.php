<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;
    protected $fillable = ['descricao','valor', 'data'];

    public function rules()
    {
        return [
            'descricao' => 'required'|'min:3',
            'valor' => 'required',
            'data' => 'required'
        ];
    }
}
