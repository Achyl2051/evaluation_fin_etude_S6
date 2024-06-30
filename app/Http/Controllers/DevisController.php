<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Maison;
use App\Models\Finition;
use App\Models\Travaux;
use App\Models\Devis;
use App\Models\Unite;
use App\Models\Detail_devis;
use App\Models\Paiement;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DevisController extends Controller
{
    public function listeDevis()
    {
        $Devis =  Devis::where('numero', session()->get('numLog'))->with('maison')->with('finition')->get();
        return view('client.listeDevis', [
            'devis' => $Devis
        ]);
    }

    public function creationDevis()
    {
        $Maisons =  Maison::all();
        $Finitions= Finition::all();
        return view('client.creationDevis', [
            'maisons' => $Maisons,
            'finitions' => $Finitions
        ]);
    }

    public function ajoutDevis(Request $request)
    {
        $ref_devis=$request->ref_devis;
        $date_devis=$request->date_devis;
        $lieu=$request->lieu;
        $idMaison=$request->maison;
        $idFinition=$request->finition;
        $date_debut_travaux=$request->date;
        $numero=session()->get('numLog');
        $finition=Finition::find($idFinition);
        $maison=Maison::find($idMaison);
        $date_fin_travaux=Carbon::parse($date_debut_travaux);
        $date_fin_travaux->addDays(floatval($maison->dure_construction));
        $pourcentage=$finition->pourcentage;
        $travaux=Travaux::where('idmaison', $idMaison)->with('unite')->get();

        $montant_total=0;
        foreach($travaux as $t)
        {
            $montant_total=$montant_total+($t->prix_unitaire*$t->quantite);
        }

        $devis=Devis::create([
            'idmaison' => $idMaison,
            'idfinition' => $idFinition,
            'pourcentage' => $pourcentage,
            'date_debut_travaux' => $date_debut_travaux,
            'date_fin_travaux' => $date_fin_travaux,
            'numero' => $numero,
            'montant_total' => $montant_total+(($montant_total*$pourcentage)/100),
            'ref_devis' => $ref_devis,
            'date_devis' => $date_devis,
            'lieu' => $lieu
        ]);

        foreach($travaux as $t)
        {
            Detail_devis::create([
                'iddevis' => $devis->iddevis,
                'designation' => $t->designation,
                'unite' => $t->unite->designation,
                'quantite' => $t->quantite,
                'prix_unitaire' => $t->prix_unitaire,
                'total' => $t->quantite*$t->prix_unitaire
            ]);
        }

        return redirect()->back()->with('success', 'tafiditra ary tsy nisy olana');
    }

    public function generatePDF(Request $request)
    {
        $devis=Devis::with('paiement')->find($request->iddevis);
        $somme_payer=0;
        foreach($devis->paiement as $d)
        {
            $somme_payer=$somme_payer+$d->montant;
        }
        $detailDevis =  Detail_devis::orderBy('iddetaildevis', 'asc')->where('iddevis',$request->iddevis)->get();
        $finition=($devis->montant_total*$devis->pourcentage)/(100+$devis->pourcentage);
        $html = view('client.listeDevisPDF', compact('detailDevis','devis','finition','somme_payer'))->render();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $filename = 'liste_devis.pdf';
        return $dompdf->stream($filename);
    }

    public function showDetails(Request $request)
    {
        $devis=Devis::find($request->iddevis);
        $detailDevis =  Detail_devis::orderBy('iddetaildevis', 'asc')->where('iddevis',$request->iddevis)->get();
        $finition=($devis->montant_total*$devis->pourcentage)/(100+$devis->pourcentage);
        $paiement=Paiement::where('iddevis',$request->iddevis)->get();
        $total_payer=0;
        foreach($paiement as $p)
        {
            $total_payer=$total_payer+($p->montant);
        }
        $reste_payer=$devis->montant_total-$total_payer;
        return view('client.paiement', [
            'devis' => $devis,
            'finition' => $finition,
            'total_payer' => $total_payer,
            'reste_payer' => $reste_payer,
            'detailDevis' => $detailDevis
        ]);
    }

    // public function mandoaVola(Request $request)
    // {
        
    //     $ref_paiement=$request->ref_paiement;
    //     $reste=$request->reste;
    //     $montant=$request->montant;
    //     $date=$request->date;
    //     $iddevis=$request->iddevis;
    //     if($montant>$reste)
    //     {
    //         return redirect()->back()->with('error', "trop d'argent");
    //     }
    //     Paiement::create([
    //         'iddevis' => $iddevis,
    //         'montant' => $montant,
    //         'date_paiement' => $date,
    //         'ref_paiement' => $ref_paiement
    //     ]);
    //     return redirect()->back()->with('succes', 'paiement réussi');
    // }

    public function mandoaVola(Request $request)
    {
        $ref_paiement = $request->ref_paiement;
        $reste = $request->reste;
        $montant = $request->montant;
        $date = $request->date;
        $iddevis = $request->iddevis;

        if ($montant > $reste) {
            return response()->json(['error' => "Trop d'argent"]);
        }
        if ($montant <0)
        {
            return response()->json(['error' => "Montant negatif"]);
        } 

        Paiement::create([
            'iddevis' => $iddevis,
            'montant' => $montant,
            'date_paiement' => $date,
            'ref_paiement' => $ref_paiement
        ]);

        return response()->json(['success' => 'Paiement réussi']);
    }


    public function listeDevisBTP()
    {
        $Devis =  Devis::with('maison')->with('finition')->with('paiement')->paginate(5);
        $reste=[];
        $montant_payer=[];
        $pourcentage_payer=[];
        foreach($Devis as $d)
        {
            $montant_temp=0;
            foreach($d->paiement as $p)
            {
                $montant_temp=$montant_temp+$p->montant;
            }
            $montant_payer[$d->iddevis]=$montant_temp;
            $reste[$d->iddevis]=$d->montant_total-$montant_temp;
            $pourcentage_payer[$d->iddevis]=($montant_payer[$d->iddevis]*100)/$d->montant_total;
        }
        return view('btp.devisEnCours', [
            'devis' => $Devis,
            'reste' => $reste,
            'pourcentage_payer' => $pourcentage_payer,
            'montant_payer' => $montant_payer
        ]);
    }

    public function detailDevisEnCours(Request $request)
    {
        $devis=Devis::find($request->iddevis);
        $detailDevis =  Detail_devis::orderBy('iddetaildevis', 'asc')->where('iddevis',$request->iddevis)->get();
        $finition=($devis->montant_total*$devis->pourcentage)/(100+$devis->pourcentage);
        $paiement=Paiement::where('iddevis',$request->iddevis)->get();
        return view('btp.detailsDevis', [
            'devis' => $devis,
            'finition' => $finition,
            'detailDevis' => $detailDevis
        ]);
    }

    public function dashboard(Request $request)
    {
        $devis=Devis::with('paiement')->get();
        $devis_total=0;
        $paiement_effectue=0;
        foreach($devis as $d)
        {
            $devis_total=$devis_total+$d->montant_total;
            foreach($d->paiement as $p)
            {
                $paiement_effectue=$paiement_effectue+$p->montant;
            }
        }

        $annees = Devis::select(DB::raw('DISTINCT EXTRACT(YEAR FROM date_devis) as annee'))
        ->orderBy('annee')
        ->pluck('annee');

        $querryDevisParMois = Devis::query();

        if(request()->has('annee'))
        {
            $querryDevisParMois->whereYear('date_devis', $request->annee);
        }
        
        $sommeMontantTotalParMois =$querryDevisParMois->select(DB::raw('SUM(montant_total) as total_montant'), DB::raw('EXTRACT(MONTH FROM date_devis) as mois'))
        ->groupBy(DB::raw('EXTRACT(MONTH FROM date_devis)'))
        ->orderBy(DB::raw('EXTRACT(MONTH FROM date_devis)'))
        ->get();
    
        $montantsParMois = [
            '1' => '0',
            '2' => '0',
            '3' => '0',
            '4' => '0',
            '5' => '0',
            '6' => '0',
            '7' => '0',
            '8' => '0',
            '9' => '0',
            '10' => '0',
            '11' => '0',
            '12' => '0'
        ];
        foreach($sommeMontantTotalParMois as $montant) {
            $montantsParMois[floatval($montant->mois)] = $montant->total_montant;
        }   
        if(request()->has('annee'))
        {
            return view('btp.dashboard', [
                'annee_selected' =>   $request->annee,
                'devis_total' => $devis_total,
                'annees' => $annees,
                'montantsParMois' => $montantsParMois,
                'paiement_effectue' => $paiement_effectue
            ]);
        }
        return view('btp.dashboard', [
            'devis_total' => $devis_total,
            'annees' => $annees,
            'montantsParMois' => $montantsParMois,
            'paiement_effectue' => $paiement_effectue
        ]);
    }

    public function listeTravaux()
    {
        $travaux =  Travaux::with('maison')->with('unite')->get();
        return view('btp.listeTravaux', [
            'travaux' => $travaux
        ]);
    }

    public function updateTravaux(Request $request)
    {
        $travaux=Travaux::find($request->idtravaux);
        $maison=Maison::all();
        $unite=Unite::all();
        return view('btp.updateTravaux', [
            'travaux' => $travaux,
            'maison' => $maison,
            'unite' => $unite
        ]);
    }

    public function doUpdateTravaux(Request $request)
    {
        $travaux = Travaux::find($request->idtravaux);
        $travaux->update([
            'idmaison' => $request->idmaison,
            'idunite' => $request->idunite,
            'designation' => $request->designation,
            'quantite' => $request->quantite,
            'prix_unitaire' => $request->prix_unitaire,
            'code' => $request->code
        ]);
        return redirect()->route('devisBTP.listeTravaux');
    }

    public function listeFinition()
    {
        $finition =  Finition::all();
        return view('btp.listeFinition', [
            'finition' => $finition
        ]);
    }

    public function updateFinition(Request $request)
    {
        $finition=Finition::find($request->idfinition);
        return view('btp.updateFinition', [
            'finition' => $finition
        ]);
    }
    public function doUpdateFinition(Request $request)
    {
        $finition=Finition::find($request->idfinition);
        $finition->update([
            'pourcentage' => $request->pourcentage
        ]);
        return redirect()->route('devisBTP.listeFinition');
    }
}
