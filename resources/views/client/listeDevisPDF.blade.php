<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Devis pour {{ $devis->numero }}</h2>
    <h3>Avec un apport de {{ $devis->pourcentage }}% pour la finition</h3>
    <h3>Référence : {{ $devis->ref_devis }}</h3>
    <h3>Lieu : {{ $devis->lieu }}</h3>
    <table>
        <thead>
            <tr>
                <th>DESIGNATION</th>
                <th>UNITE</th>
                <th>QUANTITE</th>
                <th>PRIX UNITAIRE</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($detailDevis as $d)
            <tr>
                <td>{{ $d->designation }}</td>
                <td>{{ $d->unite }}</td>
                <td>{{ number_format($d->quantite, 2, '.', ' ') }}</td>
                <td>{{ number_format($d->prix_unitaire, 2, '.', ' ') }}</td>
                <td>{{ number_format($d->total, 2, '.', ' ') }}</td>
            </tr>
        @endforeach
        <tr>
            <td COLSPAN="4">finition</td>
            <td>{{ number_format($finition, 2, '.', ' ') }}</td>
        </tr>
        <tr>
            <td COLSPAN="4">TOTAL</td>
            <td>{{ number_format($devis->montant_total, 2, '.', ' ') }}</td>
        </tr>
        </tbody>
    </table>
    <h2>Liste des paiements associés:</h2>
    <table>
        <thead>
            <tr>
                <th>Montant</th>
                <th>Date de paiement</th>
                <th>Reference</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($devis->paiement as $p)
            <tr>
                <td>{{ $p->montant }}</td>
                <td>{{ $p->date_paiement }}</td>
                <td>{{ $p->ref_paiement }}</td>
            </tr>
        @endforeach
        <tr>
            <td COLSPAN="5">TOTAL : {{ number_format($somme_payer, 2, '.', ' ') }}</td>
        </tr>
        </tbody>
    </table>
</body>
</html>
