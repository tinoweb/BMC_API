<?php

namespace BMC_API;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
 	protected $table = 'produtos';
 	protected $fillable = ['nome', 'descricao', 'valordecompra', 'valordevenda', 'imagem', 'ativo']; 

}
