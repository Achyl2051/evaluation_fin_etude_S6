@extends('./layouts/app')

@section('page-content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 align-items-center justify-content-center" style="margin-top: 50px;">

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-3">
                                <h5 class="card-title text-center pb-0 fs-4">Importation de Donne</h5>
                            </div>

                            <form class="row g-3 needs-validation" method="post" action="{{ route('csv.traitement_importationTravauxMaison')  }}" enctype="multipart/form-data" novalidate>
                            @method('post')
                            @csrf
                                <div class="icon">
                                    <label >Maison et Travaux</label>
                                    <input class="form-control" type="file" name="csv_maison_travaux" required>
                                    <br>
                                    <label >Devis</label>
                                    <input class="form-control" type="file" name="csv_devis" required>
                                    </br>
                                    <button type="submit" class="btn btn-success col-md-12">
                                        Import CSV
                                    </button>
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
