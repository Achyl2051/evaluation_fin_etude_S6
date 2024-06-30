@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">
            <div class="container">
                    <div class="row justify-content-center" >
                            <div class="col-lg-8" style="margin-top: 100px;">
                                    <div class="card mb-3">
                                            <div class="card-body">
                                             <h5 class="card-title">Liste des rôles</h5>
                                                <table class="table">
                                                    <tr>
                                                            <th>Id</th>
                                                            <th>Nom</th>
                                                            <th>Permissions</th>
                                                    </tr>
                                                    @forelse ($roles as $role)
                                                    <tr>
                                                            <td>{{ $role->id }}</td>
                                                            <td>{{ $role->name }}</td>
                                                            <td> 
                                                            <form id="login" class="row g-3 needs-validation" method="get" action="{{ route('role.rolePermissions', ['idRole' => $role->id]) }}" novalidate>
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
                                                    <p>aucuns roles</p>
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
