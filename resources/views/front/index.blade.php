@extends('front.layouts.app')
@section('title', 'Home - Peta Jagung')
@section('content')
    <x-nav />

    <!-- Hero Section -->
    <section class="hero-modern" id="home">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-text scroll-animate fade-only">
                <h1 class="hero-title">
                    Selamat Datang di <span class="text-gradient">Peta Jagung</span>
                </h1>
                <p class="hero-description">
                    Sistem Informasi Geografis lahan jagung yang disediakan oleh Dinas Tanaman Pangan, Hortikultura dan
                    Perkebunan Kabupaten Merauke untuk memberikan kemudahan akses informasi lahan jagung.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('front.data') }}" class="btn btn-primary">
                        <i data-feather="database"></i>
                        Lihat Data
                    </a>
                    <a href="{{ route('front.peta') }}" class="btn btn-outline">
                        <i data-feather="map"></i>
                        Lihat Peta
                    </a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i data-feather="map"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $jumlahDistrik }}</h3>
                        <p>Distrik</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i data-feather="map-pin"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $jumlahLahan }}</h3>
                        <p>Lahan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i data-feather="layers"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $jumlahLuas }}</h3>
                        <p>Luas (hektar)</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i data-feather="trending-up"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $jumlahProduksi }}</h3>
                        <p>Produksi (ton)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll">
            <i data-feather="chevron-down"></i>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-modern" id="about">
        <div class="container">
            <div class="section-header scroll-animate fade-in-up">
                <span class="section-tag">Tentang Aplikasi</span>
                <h2 class="section-title">Peta <span class="text-gradient">Jagung</span></h2>
                <p class="section-description">
                    Platform digital untuk memetakan dan mengelola data lahan jagung di Kabupaten Merauke
                </p>
            </div>

            <div class="about-grid">
                <div class="about-content">
                    <div class="content-card scroll-animate fade-in-left delay-100">
                        <div class="card-icon">
                            <i data-feather="info"></i>
                        </div>
                        <h3>Aplikasi Peta Jagung</h3>
                        <p>
                            Aplikasi berbasis website yang menyediakan informasi lahan jagung di sekitar wilayah Kabupaten
                            Merauke dengan teknologi Geographic Information System (GIS).
                        </p>
                    </div>

                    <div class="content-card scroll-animate fade-in-left delay-200">
                        <div class="card-icon">
                            <i data-feather="target"></i>
                        </div>
                        <h3>Tujuan Aplikasi</h3>
                        <p>
                            Memberikan kemudahan kepada Dinas Tanaman Pangan, Hortikultura dan Perkebunan Kabupaten Merauke
                            dalam memberikan informasi mengenai lahan jagung yang ada di Merauke kepada investor dan
                            masyarakat.
                        </p>
                    </div>
                </div>

                <div class="about-image scroll-animate fade-in-right delay-300">
                    <div class="image-wrapper">
                        <img src="{{ asset('img/tentang-kami.jpg') }}" alt="Tentang Kami" />
                        <div class="image-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="visi-misi-modern">
        <div class="container">
            <div class="section-header scroll-animate fade-only">
                <span class="section-tag">Tentang Kami</span>
                <h2 class="section-title">Visi & <span class="text-gradient">Misi</span></h2>
            </div>

            <div class="visi-card">
                <div class="visi-header">
                    <div class="visi-icon">
                        <i data-feather="eye"></i>
                    </div>
                    <h3>Visi</h3>
                </div>
                <p class="visi-text">
                    "Terwujudnya kabupaten Merauke sebagai kawasan pertumbuhan ekonomi perbatasan yang strategis dengan
                    mengoptimalkan sumber daya manusia dan sumber daya alam lokal melalui pertanian sebagai sektor utama"
                </p>
            </div>

            <div class="misi-grid">
                <div class="misi-image">
                    <div class="image-wrapper">
                        <img src="{{ asset('img/profil-kepala.jpg') }}" alt="Profil Kepala" />
                        <div class="image-overlay"></div>
                    </div>
                </div>

                <div class="misi-content">
                    <div class="misi-header">
                        <div class="misi-icon">
                            <i data-feather="compass"></i>
                        </div>
                        <h3>Misi</h3>
                    </div>
                    <div class="misi-list">
                        <div class="misi-item">
                            <div class="misi-number">1</div>
                            <p>Peningkatan stabilitas wilayah dan peran sebagai daerah perbatasan</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">2</div>
                            <p>Peningkatan kapasitas kelembagaan pemerintahan dan wilayah pengembangan pada tingkat kampung,
                                distrik dan kabupaten</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">3</div>
                            <p>Pembentukan kota madya dan provinsi Papua Selatan</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">4</div>
                            <p>Pembangunan pertanian yang berorientasi pada perwujudan lumbung pangan untuk ketahanan pangan
                                di tingkat nasional maupun internasional</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">5</div>
                            <p>Penguatan ekonomi daerah dan peluang investasi</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">6</div>
                            <p>Peningkatan kualitas sumber daya manusia sesuai pengembangan potensi daerah</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">7</div>
                            <p>Peningkatan kualitas pelayanan kesehatan sampai ke tingkat kampung</p>
                        </div>
                        <div class="misi-item">
                            <div class="misi-number">8</div>
                            <p>Penguatan identitas budaya dan kearifan lokal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-modern" id="contact">
        <div class="container">
            <div class="section-header scroll-animate fade-in-up">
                <span class="section-tag">Informasi Terkini</span>
                <h2 class="section-title">Data <span class="text-gradient">Statistik</span></h2>
                <p class="section-description">
                    Dengan adanya Peta Jagung, data lahan jagung yang dikumpulkan oleh gapoktan dapat ditampilkan untuk
                    diketahui semua orang.
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-modern-card scroll-animate fade-in-up delay-100">
                    <div class="stat-modern-icon">
                        <i data-feather="map"></i>
                    </div>
                    <div class="stat-modern-content">
                        <h3>{{ $jumlahDistrik }}</h3>
                        <p>Jumlah Distrik</p>
                    </div>
                    <div class="stat-modern-wave"></div>
                </div>

                <div class="stat-modern-card scroll-animate fade-in-up delay-200">
                    <div class="stat-modern-icon">
                        <i data-feather="map-pin"></i>
                    </div>
                    <div class="stat-modern-content">
                        <h3>{{ $jumlahLahan }}</h3>
                        <p>Jumlah Lahan</p>
                    </div>
                    <div class="stat-modern-wave"></div>
                </div>

                <div class="stat-modern-card scroll-animate fade-in-up delay-300">
                    <div class="stat-modern-icon">
                        <i data-feather="layers"></i>
                    </div>
                    <div class="stat-modern-content">
                        <h3>{{ $jumlahLuas }}</h3>
                        <p>Luas Lahan (hektar)</p>
                    </div>
                    <div class="stat-modern-wave"></div>
                </div>

                <div class="stat-modern-card scroll-animate fade-in-up delay-400">
                    <div class="stat-modern-icon">
                        <i data-feather="trending-up"></i>
                    </div>
                    <div class="stat-modern-content">
                        <h3>{{ $jumlahProduksi }}</h3>
                        <p>Jumlah Produksi (ton)</p>
                    </div>
                    <div class="stat-modern-wave"></div>
                </div>
            </div>
        </div>
    </section>

    <x-footer />
@endsection

@push('after-styles')
    <style>
        /* Modern Hero Section */
        .hero-modern {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            background-image: url("{{ asset('img/header-bg-2.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.9) 0%, rgba(45, 90, 45, 0.8) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            width: 100%;
            padding: 2rem;
            margin-top: 80px;
        }

        .hero-text {
            text-align: center;
            margin-bottom: 4rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .text-gradient {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.95);
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: #fff;
            color: #228b22 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: #fff !important;
            ;
            border: 2px solid #fff;
        }

        .btn-outline:hover {
            background: #fff;
            color: #228b22 !important;
            transform: translateY(-3px);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.25);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .stat-info h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .stat-info p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 0.9rem;
        }

        .hero-scroll {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            animation: bounce 2s infinite;
            z-index: 2;
        }

        /* About Section */
        .about-modern {
            padding: 6rem 2rem;
            background: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-tag {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: rgba(34, 139, 34, 0.1);
            color: #228b22;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 1.1rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .content-card {
            background: #fff;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .content-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .content-card p {
            color: #64748b;
            line-height: 1.8;
            font-size: 1rem;
        }

        .about-image {
            position: relative;
        }

        .image-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.1) 0%, rgba(45, 90, 45, 0.1) 100%);
        }

        /* Visi Misi Section */
        .visi-misi-modern {
            padding: 6rem 2rem;
            background: #fff;
        }

        .visi-card {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            border-radius: 30px;
            padding: 3rem;
            margin-bottom: 4rem;
            color: #fff;
            box-shadow: 0 20px 60px rgba(34, 139, 34, 0.2);
        }

        .visi-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .visi-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visi-header h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .visi-text {
            font-size: 1.2rem;
            line-height: 1.8;
            margin: 0;
            font-style: italic;
        }

        .misi-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 4rem;
            align-items: start;
        }

        .misi-image {
            position: sticky;
            top: 100px;
        }

        .misi-content {
            background: #f8fafc;
            padding: 3rem;
            border-radius: 30px;
        }

        .misi-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .misi-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .misi-header h3 {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .misi-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .misi-item {
            display: flex;
            gap: 1.5rem;
            align-items: start;
            background: #fff;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .misi-item:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .misi-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .misi-item p {
            color: #64748b;
            line-height: 1.8;
            margin: 0;
        }

        /* Stats Section */
        .stats-modern {
            padding: 6rem 2rem;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .stat-modern-card {
            background: #fff;
            border-radius: 25px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .stat-modern-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(34, 139, 34, 0.2);
        }

        .stat-modern-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .stat-modern-content h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .stat-modern-content p {
            color: #64748b;
            font-size: 1rem;
            margin: 0;
        }

        .stat-modern-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #228b22 0%, #2d5a2d 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stat-modern-card:hover .stat-modern-wave {
            transform: scaleX(1);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        /* Responsive untuk Laptop (1024px - 1919px) */
        @media (min-width: 1024px) and (max-width: 1919px) {
            .navbar .navbar-logo {
                font-size: 1.3rem;
            }

            .navbar .navbar-nav a {
                font-size: 0.9rem;
            }

            .navbar .navbar-extra .login {
                font-size: 0.85rem;
                padding: 0.7rem 1.8rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .hero-description {
                font-size: 1.05rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .section-description {
                font-size: 0.95rem;
            }

            .about-card h3 {
                font-size: 1.35rem;
            }

            .about-card p {
                font-size: 0.9rem;
            }

            .visi-text {
                font-size: 0.95rem;
            }

            .misi-header h3 {
                font-size: 1.75rem;
            }

            .misi-item p {
                font-size: 0.9rem;
            }

            .stat-modern-content h3 {
                font-size: 2.2rem;
            }

            .stat-modern-content p {
                font-size: 0.95rem;
            }

            .stat-info h3 {
                font-size: 1.75rem;
            }

            .stat-info p {
                font-size: 0.85rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 0.9rem 1.8rem;
            }

            .section-tag {
                font-size: 0.85rem;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .about-grid,
            .misi-grid {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .misi-image {
                position: relative;
                top: 0;
            }
        }

        /* Scroll Animation Styles */
        .scroll-animate {
            opacity: 0;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            will-change: opacity, transform;
        }

        .scroll-animate.fade-in {
            opacity: 0;
            transform: translateY(30px);
        }

        .scroll-animate.fade-in-up {
            opacity: 0;
            transform: translateY(50px);
        }

        .scroll-animate.fade-in-down {
            opacity: 0;
            transform: translateY(-50px);
        }

        .scroll-animate.fade-in-left {
            opacity: 0;
            transform: translateX(-50px);
        }

        .scroll-animate.fade-in-right {
            opacity: 0;
            transform: translateX(50px);
        }

        .scroll-animate.scale-in {
            opacity: 0;
            transform: scale(0.8);
        }

        .scroll-animate.animated {
            opacity: 1;
            transform: translate(0, 0) scale(1);
            will-change: auto;
        }

        /* Fade-only animation (tanpa transform) */
        .scroll-animate.fade-only {
            opacity: 0;
            transform: none;
            transition: opacity 0.6s ease-out;
        }

        .scroll-animate.fade-only.animated {
            opacity: 1;
            transform: none;
        }

        /* Delay classes untuk staggered animation */
        .scroll-animate.delay-100 {
            transition-delay: 0.1s;
        }

        .scroll-animate.delay-200 {
            transition-delay: 0.2s;
        }

        .scroll-animate.delay-300 {
            transition-delay: 0.3s;
        }

        .scroll-animate.delay-400 {
            transition-delay: 0.4s;
        }

        .scroll-animate.delay-500 {
            transition-delay: 0.5s;
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        // Scroll Animation dengan Intersection Observer
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.scroll-animate');

            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            animatedElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
@endpush
