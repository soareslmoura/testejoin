<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'data_cadastro', 'valor', 'categoria_produto_id', 'imagem'];


    public function categoria(){
        return $this->belongsTo('App\Models\CategoriaProduto','categoria_produto_id','id');
    }


}
