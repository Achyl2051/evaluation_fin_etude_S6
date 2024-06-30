@extends('./layouts/app')

@section('page-content')
    <style>
        .scroller {
        width: 500px;
        height: 350px;
        overflow-x: auto;
        overflow-y: hidden;
        scrollbar-color: rebeccapurple;
        scrollbar-width: thin;
        }
    </style>


    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 align-items-center justify-content-center" style="margin-top: 50px;">

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-3">
                                <h5 class="card-title text-center pb-0 fs-4">Création de devis</h5>
                                <p class="text-center small">Entrez les informations concerant le devis.
                                </p>
                            </div>

                            <form class="forms-sample" action="{{ route('devis.ajoutDevis')  }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <fieldset class="row mb-3">
                                    <label >Type de maison</label>
                                    <div class="col-sm-12">
                                        <center>
                                            <div class="scroller">
                                                <div class="row">
                                                    @foreach ($maisons as $maison)
                                                        <div class="col-md-4">
                                                            <div class="card mt-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{ $maison->designation }}</h5>
                                                                    <p class="card-text"><b>{{ $maison->dure_construction }} jours</b></p>
                                                                    <p class="card-text">{{ $maison->description }}</p>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="maison" value="{{ $maison->idmaison}}">
                                                                        <label class="form-check-label">
                                                                            Choix
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </fieldset>
                            <!-- 
                                <fieldset class="row mb-3">
                                    <label >Type de maison</label>
                                    <div class="scroller">
                                    @foreach ($maisons as $maison)
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $maison->designation}}</h5>
                                                <b>{{ $maison->dure_construction}} jours</b>
                                                <p>{{ $maison->description}}</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="maison" value="{{ $maison->idmaison}}">
                                                    <label class="form-check-label">
                                                        Choix
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </fieldset> -->

                                <div class="row mb-3">
                                    <label >Type de finition</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" name="finition">
                                            @foreach ($finitions as $finition)
                                                <option value="{{ $finition->idfinition}}">{{ $finition->designation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText">Référence</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="ref_devis">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText">Lieu</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="lieu">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" >Date de devis</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="date_devis" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" >Date début travaux</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                </div>

                                <div style="display: flex;justify-content: space-around">
                                    <div class="col-6">
                                        <button class="btn btn-secondary w-100" type="reset">Annuler</button>
                                    </div>

                                    <div class="col-6">
                                        <button class="btn btn-primary w-100 " type="submit">Save</button>
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
