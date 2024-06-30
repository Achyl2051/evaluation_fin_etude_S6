@extends('./layouts/app')

@section('page-content')

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 align-items-center justify-content-center" style="margin-top: 50px;">

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-3">
                                <h5 class="card-title text-center pb-0 fs-4">Modification de travaux</h5>
                            </div>

                            <form class="forms-sample" action="{{ route('devisBTP.doUpdateTravaux')  }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <input type="hidden" name="idtravaux" value="{{ $travaux->idtravaux }}">
                                <div class="row mb-3">
                                    <label >Type de maison</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" name="idmaison">
                                            @foreach ($maison as $m)
                                                <option value="{{ $m->idmaison}}" @if($m->idmaison==$travaux->idmaison) selected @endif>{{ $m->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label >Unite</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" name="idunite">
                                            @foreach ($unite as $u)
                                                <option value="{{ $u->idunite}}" @if($u->idunite==$travaux->idunite) selected @endif>{{ $u->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText">Code travaux</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="code" value="{{ $travaux->code }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText">Désignation</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="designation" value="{{ $travaux->designation }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber">Quantité</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="quantite" value="{{ $travaux->quantite }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber">Prix Unitaire</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="prix_unitaire" value="{{ $travaux->prix_unitaire }}">
                                    </div>
                                </div>

                                <div style="display: flex;justify-content: space-around">
                                    <div class="col-6">
                                        <button class="btn btn-secondary w-100" type="reset">Annuler</button>
                                    </div>

                                    <div class="col-6">
                                        <button class="btn btn-primary w-100 " type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                            @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session()->get('error') }}</div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>


@endsection
