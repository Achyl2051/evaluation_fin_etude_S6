@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">
            <div class="container">
                    <div class="row justify-content-center" >
                            <div class="col-lg-8" style="margin-top: 100px;">
                                    <div class="card mb-3">
                                            <div class="card-body">
                                             <h5 class="card-title">Liste des permissions du rôle "{{ $role->name }}"</h5>
                                                <table class="table">
                                                    <tr>
                                                            <th>Id</th>
                                                            <th>Nom</th>
                                                            <th>Supprimer</th>
                                                    </tr>
                                                    @forelse ($permissions as $permission)
                                                    <tr>
                                                            <td>{{ $permission->permission->id }}</td>
                                                            <td>{{ $permission->permission->name }}</td>
                                                            <td>
                                                            <form id="login" class="row g-3 needs-validation" method="post" action="{{ route('role.supprimerPermission', ['idRole' => $role->id,'idPermission' => $permission->permission->id]) }}" novalidate>
                                                                @method('delete')
                                                                @csrf 
                                                                <div class="icon">
                                                                     <button type="submit" class="btn btn-danger">
                                                                         <i class="bi bi-trash-fill"> </i>
                                                                     </button>
                                                                </div>
                                                            </form>
                                                            </td>
                                                    </tr>
                                                    @empty
                                                    <p>aucuns details</p>
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
