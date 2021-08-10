<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaProduto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome'];
//    protected $table = 'categoria_produtos';
//    protected $primaryKey = 'id';




    public function produto(){
        return $this->hasOne('App\Models\Produto');
    }



}
