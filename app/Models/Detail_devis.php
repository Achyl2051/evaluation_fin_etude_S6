<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_devis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'detail_devis';
    protected $primaryKey = 'iddetaildevis';
    protected $fillable=[
        'iddevis',
        'designation',
        'unite',
        'quantite',
        'prix_unitaire',
        'total'
    ];
}
