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
                                        <th>Désignation</th>
                                        <th>Taux finition</th>
                                        <th>Modifier</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($finition as $f)
                                        <tr>
                                            <td>{{ $f->designation }}</td>
                                            <td>{{ $f->pourcentage }}</td>
                                            <td>
                                                <form class="row g-3 needs-validation" method="get" action="{{ route('devisBTP.updateFinition') }}">
                                                    @method('get')
                                                    @csrf 
                                                    <div class="icon">
                                                        <input type="hidden" name="idfinition" value="{{ $f->idfinition }}">
                                                        <button type="submit" class="btn btn-primary btn-icon"><i class="bi bi-pencil-square"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Aucune finition</p>
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
