@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">      
        <div class="container">
            <div style="margin-top: 100px;padding-left:2%">
                <div class="col-lg-12" >
                    <div class="card mb-3">
                        <div class="card-body">
                            <br>
    
                            <div class="table-responsive">
                                 <table class="table"> 
                                    <thead>
                                    <tr>
                                        <th>Type Maison</th>
                                        <th>Type Finition</th>
                                        <th>Date debut</th>
                                        <th>Date fin</th>
                                        <th>Paiement effectué</th>
                                        <th>%</th>
                                        <th>Reste a payé</th>
                                        <th>Montant total</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($devis as $d)
                                        <tr @if($pourcentage_payer[$d->iddevis]<50) style="background-color:red" @elseif($pourcentage_payer[$d->iddevis]>50) style="background-color:green" @endif>
                                            <td>{{ $d->maison->designation }}</td>
                                            <td>{{ $d->finition->designation }}</td>
                                            <td>{{ $d->date_debut_travaux }}</td>
                                            <td>{{ $d->date_fin_travaux }}</td>
                                            <td>{{ number_format($montant_payer[$d->iddevis], 2, '.', ' ') }}</td>
                                            <td>{{ number_format($pourcentage_payer[$d->iddevis], 2, '.', ' ') }}</td>
                                            <td>{{ number_format($reste[$d->iddevis], 2, '.', ' ') }}</td>
                                            <td>{{ number_format($d->montant_total, 2, '.', ' ') }}</td>
                                            <td>
                                                <form class="row g-3 needs-validation" method="get" action="{{ route('devisBTP.detailDevisEnCours') }}">
                                                    @method('get')
                                                    @csrf 
                                                    <div class="icon">
                                                        <input type="hidden" name="iddevis" value="{{ $d->iddevis }}">
                                                        <button type="submit" class="btn btn-primary">
                                                            Show
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
                                        {{ $devis->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</main>
@endsection
