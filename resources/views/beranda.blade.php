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
  </head>
  <body>
    <header id="header">
      <div class="container">
        <h1>
          <a href="index.html">{{$lihat_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}</a>
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
              <a class="nav-link" href="{{URL('/login')}}">Login</a>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <div class="social-links">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </header>
    <section id="kontakkami" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Kontak</h2>
          <p>Kontak Kami</p>
        </div>
        <div class="row mt-2">
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Alamat</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 mt-md-0 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-share-alt"></i>
              <h3>Social Profiles</h3>
              <div class="social-links">
                <a href="#" class="twitter">
                  <i class="bi bi-twitter"></i>
                </a>
                <a href="#" class="facebook">
                  <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="instagram">
                  <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="google-plus">
                  <i class="bi bi-skype"></i>
                </a>
                <a href="#" class="linkedin">
                  <i class="bi bi-linkedin"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-4 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
              <h3>Email Me</h3>
              <p>contact@example.com</p>
            </div>
          </div>
          <div class="col-md-6 mt-4 d-flex align-items-stretch">
            <div class="info-box">
              <i class="bx bx-phone-call"></i>
              <h3>Call Me</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div>
        </div>
        <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center">
            <button type="submit">Send Message</button>
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
    <script src="{{URL::asset('template/front/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{URL::asset('template/front/js/main.js')}}"></script>
  </body>
</html>