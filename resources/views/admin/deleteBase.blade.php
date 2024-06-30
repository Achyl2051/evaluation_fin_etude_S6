@extends('./layouts/app')

@section('page-content')
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">


                <div class="pt-4 pb-3">
                    <form id="login" class="row g-3 needs-validation" method="post" action="{{ route('deleteBase') }}" novalidate>
                        @method('delete')
                        @csrf 
                        <button type="submit" class="btn btn-danger">
                            Réinitialiser la base de donnée
                        </button>
                    </form>

            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</main>
@endsection

