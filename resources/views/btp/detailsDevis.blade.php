@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">      
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8" style="margin-top: 100px;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <br>
                                <div class="table-responsive">
                                    <table class="table">
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
                                            @forelse ($detailDevis as $d)
                                                <tr>
                                                    <td>{{ $d->designation }}</td>
                                                    <td>{{ $d->unite }}</td>
                                                    <td>{{ $d->quantite }}</td>
                                                    <td>{{ number_format($d->prix_unitaire, 2, '.', ' ') }}</td>
                                                    <td>{{ number_format($d->total, 2, '.', ' ') }}</td>
                                                </tr>
                                            @empty
                                                <p>Aucun devis</p>
                                            @endforelse
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
@endsection
