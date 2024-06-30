@extends('./layouts/app')
@section('page-content')
<main>
    <section class="section">
        <div class="container">
            <div style="margin-top: 100px;padding-left:2%">

            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                        <h5 class="card-title">Devis <span>| tous les devis</span></h5>

                        <div class="d-flex align-items-center">

                            <div class="ps-3">
                            <h4>{{ number_format($devis_total, 2, '.', ' ') }} Ariary</h4>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
    
                        <div class="card-body">
                        <h5 class="card-title">Paiement effectué <span>| montant total</span></h5>
    
                        <div class="d-flex align-items-center">
    
                            <div class="ps-3">
                            <h4>{{ number_format($paiement_effectue, 2, '.', ' ') }} Ariary</h4>
                            </div>
                        </div>
                        </div>
    
                    </div>
                </div>
            </div>


            <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Devis par mois <span>/année</span></h5>

                    <form action="{{ route('dashboard') }}" method="get" class="form-inline">
                        <div class="form-row align-items-center" style="display: flex;justify-content: space-around">
                            <div class="col-10">
                                <select name="annee" class="form-control">
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee }}" @if(isset($annee_selected) && $annee == $annee_selected) selected @endif >{{ $annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Selectionner</button>
                            </div>
                        </div>
                    </form>

                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new Chart(document.querySelector('#barChart'), {
                            type: 'bar',
                            data: {
                            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Déccembre'],
                            datasets: [{
                                label: 'Devis',
                                data: [
                                    @for ($i = 1; $i <= 12; $i++)
                                        @php
                                            echo($montantsParMois[$i].",")
                                        @endphp
                                    @endfor
                                ],
                                backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                            }]
                            },
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            }
                        });
                        });
                    </script>

                </div>

              </div>
            </div>
        </div>
    </section>
</main>
@endsection
