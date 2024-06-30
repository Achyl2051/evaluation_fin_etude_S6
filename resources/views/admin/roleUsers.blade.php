@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">
            <div class="container">
                    <div class="row justify-content-center">
                            <div class="col-lg-8" style="margin-top: 100px;">
                                    <div class="card mb-3">
                                            <div class="card-body">
                                             <h5 class="card-title">Liste des rôles utilisateur</h5>
                                                <table class="table">
                                                    <tr>
                                                            <th>Id</th>
                                                            <th>Nom</th>
                                                            <th>Rôles</th>
                                                    </tr>
                                                    @forelse ($users as $user)
                                                    <tr>
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td> 
                                                            <form id="login" class="row g-3 needs-validation" method="get" action="{{ route('role.userRoles', ['idUser' => $user->id]) }}" novalidate>
                                                                @method('get')
                                                                @csrf 
                                                                <div class="icon">
                                                                     <button type="submit" class="btn btn-primary">
                                                                         Detail
                                                                     </button>
                                                                </div>
                                                            </form>
                                                            </td>
                                                    </tr>
                                                    @empty
                                                    <p>aucuns utilisateurs</p>
                                                    @endforelse
                                                </table>
                                            </div>
                                    </div> 
                            </div>
                    </div>
            </div>
    </section>
</main>    
@endsection
