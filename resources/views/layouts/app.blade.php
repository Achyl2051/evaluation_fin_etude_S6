<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Eval</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/construction.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">


    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }} ">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }} ">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }} ">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }} ">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }} ">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }} ">
    <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }} ">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
* Template Name: NiceAdmin - v2.2.0
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{ asset('img/construction.png') }}" alt="">
            <span class="d-none d-lg-block">
                <h4 style="margin-left: 10px; padding-top: 10px;">Construction</h4>
            </span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                   data-bs-toggle="dropdown">
                    <img src="{{ asset('img/itu.jpg') }}" alt="Profil"
                         class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                            </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    <li>
                        @if(session()->has('numLog'))
                            <a class="dropdown-item d-flex align-items-center" href="/logoutClient">
                        @else
                            <li class="dropdown-header">
                                <span>Admin</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <a class="dropdown-item d-flex align-items-center" href="/logout">
                        @endif
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Deconnexion</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
        @if(session()->has('numLog'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('devis.listeDevis') }}">
                <i class="bi bi-card-list"></i>
                <span>Liste devis</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('devis.creationDevis') }}">
                <i class="bi bi-journal-plus"></i>
                <span>Creation devis</span>
            </a>
        </li>
        @endif
        
        @role('BTP')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dashboard') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('devisBTP.listeDevisBTP') }}">
                <i class="bi bi-card-list"></i>
                <span>Liste devis</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('pageDeleteBase') }}">
            <i class="bi bi-dash-circle"></i>
            <span>Suppression base</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#importCSV" data-bs-toggle="collapse" href="#">
                <i class="bi bi-clipboard-plus"></i><span>Import CSV</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="importCSV" class="nav-content collapse " data-bs-parent="#sidebar-nav">   <li class="nav-item">
                <li>    
                <a class="nav-link collapsed"  href="{{ route('csv.importDonne') }}">
                    <i class="bi bi-circle"></i><span>Maison , Travaux et Devis</span>
                </a>
                </li>
                <li>    
                <a class="nav-link collapsed"  href="{{ route('csv.importPaiement') }}">
                    <i class="bi bi-circle"></i><span>Paiement</span>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#listeUpdate" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journals"></i><span>Liste et modification</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="listeUpdate" class="nav-content collapse " data-bs-parent="#sidebar-nav">   <li class="nav-item">
                <li>    
                <a class="nav-link collapsed"  href="{{ route('devisBTP.listeTravaux') }}">
                    <i class="bi bi-circle"></i><span>Travaux</span>
                </a>
                </li>
                <li>    
                <a class="nav-link collapsed"  href="{{ route('devisBTP.listeFinition') }}">
                    <i class="bi bi-circle"></i><span>Finitions</span>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">Admin</li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#roleetpermissions" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-plus"></i><span>Roles et permission</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="roleetpermissions" class="nav-content collapse " data-bs-parent="#sidebar-nav">   <li class="nav-item">
                <li>    
                <a class="nav-link collapsed"  href="{{ route('role.new') }}">
                    <i class="bi bi-circle"></i><span>Insertion role</span>
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed"  href="{{ route('role.attributPermissionToRole') }}">
                        <i class="bi bi-circle"></i><span>Attribution permission</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed"  href="{{ route('role.attributRoleUser') }}">
                        <i class="bi bi-circle"></i><span>Attribution Rôle aux User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed"  href="{{ route('role.roleLists') }}">
                        <i class="bi bi-circle"></i><span>Liste rôles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed"  href="{{ route('role.roleUsers') }}">
                        <i class="bi bi-circle"></i><span>Rôles utilisateur</span>
                    </a>
                </li>
            </ul>
        </li>
        @endrole
        
    </ul>

</aside><!-- End Sidebar-->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            
            @yield('page-content')

        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function(){
            var dataURL = reader.result;
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = dataURL;
            imagePreview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>

<!-- Template Main JS File -->
<script src="{{ asset('js/main.js') }}"></script>

</body>
<footer class="footer">
    <div class="credits"><strong><span>ETU002051 : </span></strong>RASOLOARISON Tahiry Johary</div>
</footer>
</html>
