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
    
                            <h4 class="card-title">Liste des devis de {{ session('numLog') }}:</h4>
    
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Type Maison</th>
                                        <th>Type Finition</th>
                                        <th>Date debut</th>
                                        <th>Date fin</th>
                                        <th>Montant total</th>
                                        <th>Paiement</th>
                                        <th>PDF</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($devis as $d)
                                        <tr>
                                            <td>{{ $d->maison->designation }}</td>
                                            <td>{{ $d->finition->designation }}</td>
                                            <td>{{ $d->date_debut_travaux }}</td>
                                            <td>{{ $d->date_fin_travaux }}</td>
                                            <td>{{ number_format($d->montant_total, 2, '.', ' ') }}</td>
                                            <td>
                                                <form class="row g-3 needs-validation" method="get" action="{{ route('devis.showDetails') }}">
                                                    @method('get')
                                                    @csrf 
                                                    <div class="icon">
                                                        <input type="hidden" name="iddevis" value="{{ $d->iddevis }}">
                                                        <button type="submit" class="btn btn-primary">
                                                            Détails 
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="row g-3 needs-validation" method="get" action="{{ route('devis.generatePDF') }}">
                                                    @method('get')
                                                    @csrf 
                                                    <div class="icon">
                                                        <input type="hidden" name="iddevis" value="{{ $d->iddevis }}">
                                                        <button type="submit" class="btn btn-primary">
                                                            PDF 
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Aucun devis</p>
                                    @endforelse
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
