<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'finitions';
    protected $primaryKey = 'idfinition';
    protected $fillable=[
        'designation',
        'pourcentage'
    ];
}
