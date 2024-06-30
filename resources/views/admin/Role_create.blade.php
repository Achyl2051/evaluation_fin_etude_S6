@extends('./layouts/app')

@section('page-content')
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="card mb-3" style="margin-top: 50px;">

              <div class="card-body">

                <div class="pt-4 pb-3">
                  <h5 class="card-title text-center pb-0 fs-4">Creation de role et permission</h5>
                  <p class="text-center small">ROLE
                  </p>
                </div>
        <form class="row g-3 needs-validation" action="{{ route('role.create')  }} " method="post" novalidate>
          @csrf
          @method('post')

          <div class="row mb-3">
              <label for="name" class="col-sm-3 col-form-label">Role</label>
              <div class="col-sm-9">
                <input type="text" name="role" value="{{ old('role')}}" class="form-control" id="name" placeholder="Nom" required>
              <div class="invalid-feedback">Please enter the name!</div>
            </div>
          </div>
                <div class="col-6">
                  <button class="btn btn-secondary w-100" type="reset">Annuler</button>
                </div>
          <div class="col-6">
            <button class="btn btn-primary w-100 " type="submit">Save</button>
          </div>
        </form>
                <div class="pt-4 pb-3">
                  <p class="text-center small">PERMISSION
                  </p>
                </div>
          <form class="row g-3 needs-validation" action="{{ route('permission.create')  }} " method="post" novalidate>
            @csrf
            @method('post')
            
          <div class="row mb-3">
              <label for="permission" class="col-sm-3 col-form-label">Permission</label>
              <div class="col-sm-9">
                <input type="text" name="permission" value="{{ old('permission')}}" class="form-control" id="permission" placeholder="Nom" required>
              <div class="invalid-feedback">Please enter the name!</div>
            </div>
          </div>
                <div class="col-6">
                  <button class="btn btn-secondary w-100" type="reset">Annuler</button>
                </div>
          <div class="col-6">
            <button class="btn btn-primary w-100 " type="submit">Save</button>
          </div>
          </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</main>
@endsection
