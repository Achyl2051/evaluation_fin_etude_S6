<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unite;
use App\Models\Maison;

class Travaux extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'travaux';
    protected $primaryKey = 'idtravaux';
    protected $fillable=[
        'idmaison',
        'idunite',
        'designation',
        'quantite',
        'prix_unitaire',
        'code'
    ];
    public function maison()
    {
        return $this->belongsTo(Maison::class, 'idmaison');
    }
    public function unite()
    {
        return $this->belongsTo(Unite::class, 'idunite');
    }
}
