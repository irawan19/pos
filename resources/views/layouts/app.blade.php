@php($lihat_konfigurasi_aplikasi = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)->first())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{$lihat_konfigurasi_aplikasi->icon_konfigurasi_aplikasis}}">
    <link rel="icon" type="image/png" href="{{$lihat_konfigurasi_aplikasi->icon_konfigurasi_aplikasis}}">
    <title>{{$lihat_konfigurasi_aplikasi->nama_konfigurasi_aplikasis}}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{URL::asset('template/back/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('template/back/css/nucleo-svg.css')}}" rel="stylesheet" />
    <script src="{{URL::asset('template/back/js/42d5adcbca.js')}}" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{URL::asset('template/back/css/soft-ui-dashboard.css?v=1.0.6')}}" rel="stylesheet" />
    <style>
        .text-red-600{
            color:red;
        }
    </style>
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{URL('/')}}">
                            <img src="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasi->logo_text_konfigurasi_aplikasis)}}" width="250">
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                                <li class="nav-item">&nbsp;</li>
                            </ul>
                            <ul class="navbar-nav d-lg-block d-none">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Point Of Sales</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">{{General::greeting()}}</h3>
                                    <p class="mb-0">Masukkan data anda untuk login</p>
                                </div>
                                <div class="card-body">
                                    {{$slot}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{URL::asset('template/back/img/curved-images/curved8.jpg')}}')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                    <b class="jam">{{General::ubahDBKeTanggal(date('Y-m-d'))}}, <onload="timeJavascript()" id="output"></b>
                </div>
            </div>
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> {{$lihat_konfigurasi_aplikasi->nama_konfigurasi_aplikasis}}
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{URL::asset('template/back/js/core/popper.min.js')}}"></script>
    <script src="{{URL::asset('template/back/js/core/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('template/back/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{URL::asset('template/back/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script type="text/javascript">
        window.setTimeout("timeJavascript()",1000);
        function timeJavascript()
        {     
            var dateNow = new Date().toLocaleTimeString("en-US",{timeZone: "Asia/Jakarta", hour12: false});
            setTimeout("timeJavascript()",1000);
            document.getElementById("output").innerHTML = dateNow;
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>