<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maison extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'maisons';
    protected $primaryKey = 'idmaison';
    protected $fillable=[
        'designation',
        'description',
        'dure_construction',
        'surface'
    ];
}
