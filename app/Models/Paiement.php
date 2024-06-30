<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'paiement';
    protected $primaryKey = 'idpaiement';
    protected $fillable=[
        'iddevis',
        'montant',
        'date_paiement',
        'ref_paiement'
    ];
}
