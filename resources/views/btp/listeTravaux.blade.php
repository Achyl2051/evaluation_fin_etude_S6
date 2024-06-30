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
                                        <th>Code Travaux</th>
                                        <th>Unite</th>
                                        <th>Designation</th>
                                        <th>Quantité</th>
                                        <th>Prix Unitaire</th>
                                        <th>Modifier</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($travaux as $t)
                                        <tr>
                                            <td>{{ $t->maison->designation }}</td>
                                            <td>{{ $t->code }}</td>
                                            <td>{{ $t->unite->designation }}</td>
                                            <td>{{ $t->designation }}</td>
                                            <td>{{ number_format($t->quantite, 2, '.', ' ') }}</td>
                                            <td>{{ number_format($t->prix_unitaire, 2, '.', ' ') }}</td>
                                            <td>
                                                <form class="row g-3 needs-validation" method="get" action="{{ route('devisBTP.updateTravaux') }}">
                                                    @method('get')
                                                    @csrf 
                                                    <div class="icon">
                                                        <input type="hidden" name="idtravaux" value="{{ $t->idtravaux }}">
                                                        <button type="submit" class="btn btn-primary btn-icon"><i class="bi bi-pencil-square"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Aucun travaux</p>
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
