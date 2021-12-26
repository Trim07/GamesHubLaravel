<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class Games extends Model
{
    protected $fillable = ['capa', 'titulo', 'ano_publicacao', 'estilo', 'desenvolvedora', 'avaliacao', 'times_rated'];

    use HasFactory;

}
