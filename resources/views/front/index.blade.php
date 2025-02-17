<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <!-- my icons (feather icons) -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- my font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- my style -->
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}"/>
    <!-- my script -->
  </head>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Peta<span>Jagung.</span></a>
      <div class="navbar-nav">
        <a href="index.html">Home</a>
        <a href="index.html#about">Tentang</a>
        <a href="data.html">Data</a>
        <a href="peta.html">Peta</a>
      </div>
      <div class="navbar-extra">
        <a href="#" class="login">Masuk</a>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- navbar end -->
    <!-- hero section start -->
    <section class="hero" id="home">
      <main class="content">
        <h1>
          Selamat Datang di Aplikasi <span class="green">Peta </span>
          <span>Jagung</span>
        </h1>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores,
          reprehenderit!
        </p>
        <a href="data.html" class="cta">Lihat Data</a>
      </main>
    </section>
    <!-- hero section end -->
    <!-- about section start -->
    <section class="about" id="about">
      <h2><span>Tentang</span> Kami</h2>

      <div class="row">
        <div class="about-img">
          <img src="img/tentang-kami.jpg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Dinas Tanaman & Holtikultura</h3>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa
            molestias ipsam temporibus nesciunt nisi exercitationem.
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus,
            atque! Atque quisquam culpa laboriosam numquam alias minus pariatur,
            ad temporibus.
          </p>
        </div>
      </div>
    </section>
    <!-- about section end -->

    <!-- menu section start -->
    <!-- <section id="menu" class="menu">
      <h2><span>Menu</span> Kami</h2>
      <p>
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe
        repudiandae libero laudantium. Voluptatem, voluptas.
      </p>

      <div class="row">
        <div class="menu-card">
          <img src="img/menu/1.jpg" alt="Jagung Campur" class="menu-card-img" />
          <h3 class="menu-card-title">- Jagung Campur</h3>
          <p class="">IDR 15k</p>
        </div>
        <div class="menu-card">
          <img src="img/menu/1.jpg" alt="Jagung Campur" class="menu-card-img" />
          <h3 class="menu-card-title">- Jagung Campur</h3>
          <p class="">IDR 15k</p>
        </div>
        <div class="menu-card">
          <img src="img/menu/1.jpg" alt="Jagung Campur" class="menu-card-img" />
          <h3 class="menu-card-title">- Jagung Campur</h3>
          <p class="">IDR 15k</p>
        </div>
        <div class="menu-card">
          <img src="img/menu/1.jpg" alt="Jagung Campur" class="menu-card-img" />
          <h3 class="menu-card-title">- Jagung Campur</h3>
          <p class="">IDR 15k</p>
        </div>
        <div class="menu-card">
          <img src="img/menu/1.jpg" alt="Jagung Campur" class="menu-card-img" />
          <h3 class="menu-card-title">- Jagung Campur</h3>
          <p class="">IDR 15k</p>
        </div>
      </div>
    </section> -->
    <!-- menu section end -->
    <!-- visi mis section start -->
    <section class="visi-misi">
      <h2><span>Visi</span> & Misi</h2>
      <div class="row">
        <div class="visi">
          <h3>Visi</h3>
          <p>
            Terwujudnya kabupaten merauke sebagai kawasan pertumbuhan ekonomi
            perbatasan yang strategis dengan mengoptimalkan sumber daya manusia
            dan sumber daya alam lokal melalui pertanian sebagai sektor utama.
          </p>
        </div>
        <div class="misi-isi">
          <h3>Misi</h3>
          <div class="misi">
            <div class="misi-img">
              <img src="img/profil-kepala.jpg" alt="Kepala Dinas" />
            </div>
            <div class="content">
              <ol>
                <li>
                  Peningkatan stabilitas wilayah dan peran sebagai daerah
                  perbatasan
                </li>
                <li>
                  Peningkatan kapasitas kelembagaan pemerintahan dan wilayah
                  pengembangan pada tingkat kampung, distrik dan kabupaten.
                </li>
                <li>Pembentukan kota madya dan provinsi papua selatan</li>
                <li>
                  Pembangunan pertanian yang berorientasi pada perwujudan
                  lumbung pangan untuk ketahanan pangan di tingkat nasional
                  maupun internasional
                </li>
                <li>Penguatan ekonomi daerah dan peluang investasi</li>
                <li>
                  Peningkatan kualitas sumber daya manusia sesuai pengembangan
                  potensi daerah
                </li>
                <li>
                  Peningkatan kualitas pelayanan kesehatan sampai ke tingkat
                  kampung
                </li>
                <li>Penguatan identitas budaya dan kearifan lokal.</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- visi mis section end -->
    <!-- contact section start -->
    <section id="contact" class="contact">
      <h2><span>Kontak</span> Kami</h2>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit,
        culpa.
      </p>

      <div class="row">
        <iframe
          class="map"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17241.878200672378!2d140.39961238389768!3d-8.511549945196895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x69b5158da996ad45%3A0x9a12acf62d5af96d!2sDinas%20Tanaman%20Pangan%20Kabupaten%20Merauke!5e0!3m2!1sen!2sid!4v1738501342731!5m2!1sen!2sid"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>

        <form action="">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" placeholder="nama" />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="text" placeholder="email" />
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" placeholder="no.hp" />
          </div>
          <button type="submit" class="kirim">Kirim Pesan</button>
        </form>
      </div>
    </section>
    <!-- contact section end -->

    <!-- footer start -->
    <footer>
      <div class="socials">
        <a href="#"><i data-feather="instagram"></i></a>
        <a href="#"><i data-feather="twitter"></i></a>
        <a href="#"><i data-feather="facebook"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang</a>
        <a href="#home">Menu</a>
        <a href="#home">Contact</a>
      </div>
      <div class="credit">
        <p>Created by <a href="#">Novgeny R. Ermiawan</a> | &copy; 2025</p>
      </div>
    </footer>
    <!-- footer end -->
    <!-- javascript -->
    <!-- my javascript -->
    <script src="js/script.js"></script>
    <!-- feather icons -->
    <script>
      feather.replace();
    </script>
  </body>
</html>
