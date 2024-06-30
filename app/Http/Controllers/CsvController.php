<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function importDonne()
    {
        return view('csv.importDonne');
    }
    public function importPaiement()
    {
        return view('csv.importPaiement');
    }

    public function traitement_importationTravauxMaison(Request $request){
        if ($request->hasFile('csv_maison_travaux')) {
            try {
            $path = $request->file('csv_maison_travaux')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            array_shift($data);
            foreach ($data as $row) {
                DB::table('csv_maisontravaux')->insert([
                    'type_maison' => $row[0],
                    'description' => (string)$row[1],
                    'surface' =>(double)str_replace(',', '.', $row[2]),
                    'code_travaux' => $row[3],
                    'type_travaux' => $row[4],
                    'unite' => $row[5],
                    'prix_unitaire' => (double)str_replace(',', '.', $row[6]),
                    'quantite' => (double)str_replace(',', '.', $row[7]),
                    'duree_travaux' => (double)str_replace(',', '.', $row[8])
                ]);
            }
        DB::insert('insert into maisons(designation,description,dure_construction,surface) select type_maison,description,duree_travaux,surface from csv_maisontravaux group by type_maison,description,duree_travaux,surface');
        DB::insert('insert into unites(designation) select unite from csv_maisontravaux group by unite');
        DB::insert('insert into travaux(code,designation,idmaison,prix_unitaire,quantite,idunite) select code_travaux,type_travaux,idmaison,prix_unitaire,quantite,idunite from csv_maisontravaux join unites on csv_maisontravaux.unite=unites.designation join maisons on maisons.designation=csv_maisonTravaux.type_maison ');
        $path1 = $request->file('csv_devis')->getRealPath();
        $data1 = array_map('str_getcsv', file($path1));
        array_shift($data1);
        foreach ($data1 as $row) {
            DB::table('csv_devis')->insert([
                'client' => (string)$row[0],
                'ref_devis' => $row[1],
                'type_maison' => $row[2],
                'finition' => $row[3],
                'taux_finition' => $row[4],
                'date_devis' => $row[5],
                'date_debut' => $row[6],
                'lieu' => $row[7]
            ]);
        }
        DB::insert("insert into finitions(designation,pourcentage) select finition,CAST(REPLACE(REPLACE(taux_finition, '%', ''), ',', '.') AS DOUBLE PRECISION) from csv_devis group by finition,taux_finition");
        DB::insert("insert into devis(numero,idfinition,idmaison,date_debut_travaux,date_devis,ref_devis,lieu,date_fin_travaux,montant_total,pourcentage)
        SELECT
            client,
            idfinition,
            idmaison,
            date_debut,
            date_devis,
            ref_devis,
            lieu,
            date_debut + m.dure_construction * INTERVAL '1 day' AS date_fin,
            (SELECT SUM(t.prix_unitaire * t.quantite)
            FROM travaux t
            WHERE t.idmaison = m.idmaison) +
            (SELECT SUM(t.prix_unitaire * t.quantite) * f.pourcentage / 100
            FROM travaux t
            WHERE t.idmaison = m.idmaison) AS totalDevis,
            f.pourcentage
        FROM
            csv_devis cd
        JOIN
            maisons m ON cd.type_maison = m.designation
        JOIN
            finitions f ON cd.finition = f.designation;
        ");
        DB::insert('INSERT INTO detail_devis (iddevis, designation, unite, quantite, prix_unitaire, total)
        SELECT
            d.iddevis,
            t.designation,
            u.designation,
            t.quantite,
            t.prix_unitaire,
            t.quantite * t.prix_unitaire as total
        FROM devis d
        JOIN maisons m ON d.idMaison = m.idMaison
        JOIN finitions f ON d.idFinition = f.idFinition
        JOIN travaux t ON m.idmaison = t.idmaison
        JOIN unites u ON t.idUnite = u.idUnite;
        ');
            return redirect()->back();
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        }
    }

    public function traitement_importationPaiement(Request $request){
        try{
        $path = $request->file('csv_paiement')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        array_shift($data);
        foreach ($data as $row) {
            $exists = DB::table('csv_paiement')
                        ->where('ref_paiement', $row[1])
                        ->exists();
                        $co = 0;
            foreach(DB::select('select ref_paiement from paiement') as $p){
                if($row[1] == $p->ref_paiement){
                    $co++;
                }
            }
            if($co > 0)continue;
            if (!$exists) {
                DB::table('csv_paiement')->insert([
                    'ref_devis' => $row[0],
                    'ref_paiement' => $row[1],
                    'date_paiement' => $row[2],
                    'montant' => $row[3],
                ]);
            }
        }
        DB::insert('insert into paiement(idDevis,date_paiement,montant,ref_paiement) select iddevis,date_paiement,montant,ref_paiement from csv_paiement join devis on devis.ref_devis=csv_paiement.ref_devis');
        return redirect()->back();
    }
    catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }
}
