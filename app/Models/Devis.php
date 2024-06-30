<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maison;
use App\Models\Finition;
use App\Models\Paiement;

class Devis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'devis';
    protected $primaryKey = 'iddevis';
    protected $fillable=[
        'idmaison',
        'idfinition',
        'pourcentage',
        'date_debut_travaux',
        'date_fin_travaux',
        'numero',
        'montant_total',
        'ref_devis',
        'date_devis',
        'lieu'
    ];
    public function maison()
    {
        return $this->belongsTo(Maison::class, 'idmaison');
    }
    public function finition()
    {
        return $this->belongsTo(Finition::class, 'idfinition');
    }
    public function paiement()
    {
        return $this->hasMany(Paiement::class, 'iddevis', 'iddevis');
    }
}
