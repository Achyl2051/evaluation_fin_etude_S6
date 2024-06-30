@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">      
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8" style="margin-top: 100px;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>DESIGNATION</th>
                                                <th>UNITE</th>
                                                <th>QUANTITE</th>
                                                <th>PRIX UNITAIRE</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($detailDevis as $d)
                                                <tr>
                                                    <td>{{ $d->designation }}</td>
                                                    <td>{{ $d->unite }}</td>
                                                    <td>{{ number_format($d->quantite, 2, '.', ' ') }}</td>
                                                    <td>{{ number_format($d->prix_unitaire, 2, '.', ' ') }}</td>
                                                    <td>{{ number_format($d->total, 2, '.', ' ') }}</td>
                                                </tr>
                                            @empty
                                                <p>Aucun devis</p>
                                            @endforelse
                                                <tr>
                                                    <td COLSPAN="4">finition</td>
                                                    <td>{{ number_format($finition, 2, '.', ' ') }}</td>
                                                </tr>
                                                <tr>
                                                    <td COLSPAN="4">TOTAL</td>
                                                    <td>{{ number_format($devis->montant_total, 2, '.', ' ') }}</td>
                                                </tr>
                                                <tr>
                                                    <td COLSPAN="4">Déjà payé</td>
                                                    <td>{{ number_format($total_payer, 2, '.', ' ') }}</td>
                                                </tr>
                                                <tr>
                                                    <td COLSPAN="4">Reste a payé</td>
                                                    <td>{{ number_format($reste_payer, 2, '.', ' ') }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pt-4 pb-3">
                                <h5 class="card-title text-center pb-0 fs-4">Paiement</h5>
                                <p class="text-center small">Entrez les informations sur votre paiement.
                                </p>
                            </div>
                            <div id="message"></div>
                            <form class="forms-sample" id="formPaiement" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="iddevis" id="iddevis" value="{{ $devis->iddevis }}">
                                <input type="hidden" name="reste" id="reste" value="{{ $reste_payer }}">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-form-label">Montant</label>
                                    <div class="col-sm-9 input-group has-validation">
                                        <input type="number" class="form-control" name="montant" id="montant">
                                        <div id="montantError" class="text-danger"></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText">Référence paiement</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="ref_paiement" id="ref_paiement">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate">Date de paiement</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="date" class="form-control" id="date_paiement">
                                    </div>
                                </div>

                                <div style="display: flex;justify-content: space-around">
                                    <div class="col-6">
                                        <button class="btn btn-secondary w-100" type="reset">Annuler</button>
                                    </div>

                                    <div class="col-6">
                                        <button class="btn btn-primary w-100 " id="submitForm" type="button">Payer</button>
                                    </div>
                                </div>
                            </form>

                            <!-- @if (session()->has('error'))
                                <div class="alert alert-danger">{{ session()->get('error') }}</div>
                            @endif
                            @if (session()->has('succes'))
                                <div class="alert alert-success alert-dismissible fade show">{{ session()->get('succes') }}</div>
                            @endif
                            <form class="forms-sample" action="{{ route('devis.mandoaVola')  }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <input type="hidden" name="iddevis" value="{{ $devis->iddevis }}">
                                <input type="hidden" name="reste" value="{{ $reste_payer }}">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-form-label">Montant</label>
                                    <div class="col-sm-9 input-group has-validation">
                                        <input type="number" class="form-control" name="montant">
                                        @error('montant')
                                        <hr>
                                        <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText">Référence paiement</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="ref_paiement">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" >Date de paiement</label>
                                    <div class="col-sm-12">
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                </div>

                                <div style="display: flex;justify-content: space-around">
                                    <div class="col-6">
                                        <button class="btn btn-secondary w-100" type="reset">Annuler</button>
                                    </div>

                                    <div class="col-6">
                                        <button class="btn btn-primary w-100 " type="submit">Payer</button>
                                    </div>
                                </div>
                            </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('submitForm').addEventListener('click', function() {
            var montant = parseFloat(document.getElementById('montant').value);
            var reste = parseFloat(document.getElementById('reste').value);
            var iddevis = document.getElementById('iddevis').value;
            var ref_paiement = document.getElementById('ref_paiement').value;
            var date_paiement = document.getElementById('date_paiement').value;

            var xhr = new XMLHttpRequest();
            var url = "{{ route('devis.mandoaVola') }}";
            var params = "_token={{ csrf_token() }}" +
                         "&iddevis=" + iddevis +
                         "&reste=" + reste +
                         "&montant=" + montant +
                         "&ref_paiement=" + ref_paiement +
                         "&date=" + date_paiement;

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            document.getElementById('message').innerHTML = '<div class="alert alert-danger">' + response.error + '</div>';
                        } else {
                            document.getElementById('message').innerHTML = '<div class="alert alert-success">' + response.success + '</div>';
                            // location.reload();
                        }
                    } else {
                        console.error(xhr.statusText);
                    }
                }
            };

            xhr.send(params);
        });
    });
</script>
@endsection
