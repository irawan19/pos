<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}</title>
		<meta name="keywords" content="{{$lihat_konfigurasi_aplikasis->keyword_konfigurasi_aplikasis}}">
		<meta name="description" content="{{$lihat_konfigurasi_aplikasis->deskripsi_konfigurasi_aplikasis}}">
		<meta name="author" content="{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
		<meta property="og:title" content="{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
		<meta name="twitter:title" content="{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
		<meta property="og:description" content="{{$lihat_konfigurasi_aplikasis->deskripsi_konfigurasi_aplikasis}}">
		<meta name="twitter:description" content="{{$lihat_konfigurasi_aplikasis->deskripsi_konfigurasi_aplikasis}}">
		<meta property="og:image" content="{{$lihat_konfigurasi_aplikasis->logo_konfigurasi_aplikasis}}">
		<meta name="twitter:image" content="{{$lihat_konfigurasi_aplikasis->logo_konfigurasi_aplikasis}}">
		<meta property="og:url" content="{{URL('/')}}">
		<meta property="og:site_name" content="{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
		<meta name="twitter:image:alt" content="{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
		<link rel="shortcut icon" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->icon_konfigurasi_aplikasis)}}" type="image/x-icon">
		<link rel="apple-touch-icon" href="{{URL::asset('storage/'.$lihat_konfigurasi_aplikasis->icon_konfigurasi_aplikasis)}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{URL::asset('template/front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('template/front/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{URL::asset('template/front/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('template/front/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('template/front/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{URL::asset('template/front/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('template/front/css/style.css')}}" rel="stylesheet">
    <style type="text/css">
      body::before {
        content: "";
        position: fixed;
        background: #040404 url('{{"storage/".$lihat_konfigurasi_aplikasis->background_website_konfigurasi_aplikasis}}') top right no-repeat;
        background-size: cover;
        left: 0;
        right: 0;
        top: 0;
        height: 100vh;
        z-index: -1;
      }
      .errorform{
        color:#f57a7a;
        font-size:13px;
      }
      .alert-success{
        background-color:#18d26e;
        color:white;
      }
    </style>
  </head>
  <body>
    <header id="header">
      <div class="container">
        <h1>
          <a href="{{URL('/')}}">{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}</a>
        </h1>
        <h2>Point Of Sales Application</h2>
        <nav id="navbar" class="navbar">
          <ul>
            <li>
              <a class="nav-link active" href="#header">Beranda</a>
            </li>
            <li>
              <a class="nav-link" href="#kontakkami">Kontak Kami</a>
            </li>
            <li>
              <a class="nav-link" href="{{URL('/login')}}">Dashboard</a>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <div class="social-links">
          @if($lihat_konfigurasi_aplikasis->twitter_konfigurasi_aplikasis != '')
            <a target="_blank" href="{{$lihat_konfigurasi_aplikasis->twitter_konfigurasi_aplikasis}}" class="twitter"><i class="bi bi-twitter"></i></a>
          @endif
          @if($lihat_konfigurasi_aplikasis->facebook_konfigurasi_aplikasis != '')
            <a target="_blank" href="{{$lihat_konfigurasi_aplikasis->facebook_konfigurasi_aplikasis}}" class="facebook"><i class="bi bi-facebook"></i></a>
          @endif
          @if($lihat_konfigurasi_aplikasis->instagram_konfigurasi_aplikasis != '')
            <a target="_blank" href="{{$lihat_konfigurasi_aplikasis->instagram_konfigurasi_aplikasis}}" class="instagram"><i class="bi bi-instagram"></i></a>
          @endif
        </div>
      </div>
    </header>
    <section id="kontakkami" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Kontak</h2>
          <p>Hubungi Kami</p>
        </div>
        <div class="row mt-2">
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Alamat</h3>
              <p>{!! nl2br($lihat_konfigurasi_aplikasis->alamat_konfigurasi_aplikasis) !!}</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-share-alt"></i>
              <h3>Sosial Media</h3>
              <div class="social-links">
                @if($lihat_konfigurasi_aplikasis->twitter_konfigurasi_aplikasis != '')
                  <a target="_blank" href="{{$lihat_konfigurasi_aplikasis->twitter_konfigurasi_aplikasis}}" class="twitter">
                    <i class="bi bi-twitter"></i>
                  </a>
                @endif
                @if($lihat_konfigurasi_aplikasis->facebook_konfigurasi_aplikasis != '')
                  <a target="_blank" href="{{$lihat_konfigurasi_aplikasis->facebook_konfigurasi_aplikasis}}" class="facebook">
                    <i class="bi bi-facebook"></i>
                  </a>
                @endif
                @if($lihat_konfigurasi_aplikasis->instagram_konfigurasi_aplikasis != '')
                  <a target="_blank" href="{{$lihat_konfigurasi_aplikasis->instagram_konfigurasi_aplikasis}}" class="instagram">
                    <i class="bi bi-instagram"></i>
                  </a>
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-4 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:{{$lihat_konfigurasi_aplikasis->email_konfigurasi_aplikasis}}">{{$lihat_konfigurasi_aplikasis->email_konfigurasi_aplikasis}}</a></p>
            </div>
          </div>
          <div class="col-md-6 mt-4 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-phone-call"></i>
              <h3>Telepon</h3>
              <p><a href="tel:{{$lihat_konfigurasi_aplikasis->telepon_konfigurasi_aplikasis}}">{{$lihat_konfigurasi_aplikasis->telepon_konfigurasi_aplikasis}}</a></p>
            </div>
          </div>
        </div>
        <form action="{{URL('/kirimpesan')}}" method="post" class="php-email-form mt-4">
          @csrf
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="nama_pesans" class="form-control" id="nama_pesans" placeholder="Nama" required>
              @if(!empty($errors->first('nama_pesans')))
                <div class="errorform">{{$errors->first('nama_pesans')}}</div>
              @endif
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email_pesans" id="email_pesans" placeholder="Email" required>
              @if(!empty($errors->first('email')))
                <div class="errorform">{{$errors->first('email_pesans')}}</div>
              @endif
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="number" class="form-control" name="telepon_pesans" id="telepon_pesans" placeholder="Telepon" required>
                @if(!empty($errors->first('telepon_pesans')))
                  <div class="errorform">{{$errors->first('telepon_pesans')}}</div>
                @endif
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="konten_pesans" rows="5" placeholder="Pesan" required></textarea>
                @if(!empty($errors->first('konten_pesans')))
                  <div class="errorform">{{$errors->first('konten_pesans')}}</div>
                @endif
          </div>
          <div class="my-3">
						@if (Session::get('setelah_simpan.alert') == 'sukses')
              <div class="alert alert-success" role="alert">{{Session::get('setelah_simpan.text')}}</div>
					  @endif
          </div>
          <div class="text-center">
            <button type="submit">Kirim Pesan</button>
          </div>
        </form>
      </div>
    </section>
    <div class="credits">
      © {{date("Y")}}, <a href="{{URL('/')}}">{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}</a>
    </div>
    <script src="{{URL::asset('template/front/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{URL::asset('template/front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('template/front/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{URL::asset('template/front/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{URL::asset('template/front/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{URL::asset('template/front/vendor/waypoints/noframework.waypoints.js')}}"></script>
    <script src="{{URL::asset('template/front/js/main.js')}}"></script>
  </body>
</html>