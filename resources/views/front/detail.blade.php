@extends('front.layouts.app')
@section('title', 'Detail Lahan')
@section('content')
    <x-nav />

    <!-- Modern Hero Section -->
    <section class="detail-hero-modern">
        <div class="detail-hero-overlay"></div>
        <div class="detail-hero-content">
            <div class="detail-hero-text">
                <h1 class="detail-hero-title">
                    Detail <span class="text-gradient">Lahan</span>
                </h1>
                <p class="detail-hero-description">
                    Informasi lengkap mengenai lahan jagung di Kabupaten Merauke
                </p>
            </div>
        </div>
    </section>

    <!-- Detail Section -->
    <section class="detail-modern">
        <div class="container">
            <!-- Main Content Grid -->
            <div class="detail-grid">
                <!-- Left Column: Map -->
                <div class="detail-map-section">
                    <div class="detail-card-modern">
                        <div class="detail-card-header">
                            <h3>
                                <i data-feather="map"></i>
                                Lokasi Lahan
                            </h3>
                        </div>
                        <div class="map-container-detail">
                            <div id="map" class="map-detail"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Info -->
                <div class="detail-info-section">
                    <div class="detail-card-modern">
                        <div class="detail-card-header">
                            <h3>
                                <i data-feather="info"></i>
                                Informasi Lahan
                            </h3>
                        </div>
                        <div class="detail-info-grid">
                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="map-pin"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Nama Lahan</span>
                                    <span class="info-value">{{ $lahan->name }}</span>
                                </div>
                            </div>

                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="user"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Nama Petani</span>
                                    <span class="info-value">{{ $lahan->nama_petani }}</span>
                                </div>
                            </div>

                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="layers"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Luas Lahan</span>
                                    <span class="info-value">{{ $lahan->luas_lahan }} hektar</span>
                                </div>
                            </div>

                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="navigation"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Distrik</span>
                                    <span class="info-value">{{ $lahan->distrik->name }}</span>
                                </div>
                            </div>

                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="map-pin"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Alamat</span>
                                    <span class="info-value">{{ $lahan->alamat }}</span>
                                </div>
                            </div>

                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="phone"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">No. HP</span>
                                    <span class="info-value">{{ $lahan->no_hp ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="info-item-modern">
                                <div class="info-icon">
                                    <i data-feather="compass"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Koordinat</span>
                                    <span class="info-value">{{ $lahan->latitude }}, {{ $lahan->longitude }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Produksi Section -->
            <div class="detail-card-modern production-section">
                <div class="production-header">
                    <div class="production-title">
                        <i data-feather="trending-up"></i>
                        <h3>Data Produksi</h3>
                    </div>
                    <form method="GET" action="" class="filter-year-modern">
                        <div class="filter-year-wrapper">
                            <i data-feather="calendar"></i>
                            <select name="tahun" id="tahun" onchange="this.form.submit()" class="select-year-modern">
                                <option value="">Semua Tahun</option>
                                @foreach ($tahunProduksi as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>

                @if ($produksi->count() > 0)
                    <div class="table-wrapper-production">
                        <table class="table-production-modern">
                            <thead>
                                <tr>
                                    <th>Tanggal Produksi</th>
                                    <th>Hasil Produksi (Ton)</th>
                                    <th>Kuartal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produksi as $item)
                                    @php
                                        $bulan = \Carbon\Carbon::parse($item->tanggal_produksi)->month;
                                        $kuartal = ceil($bulan / 3);
                                    @endphp
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_produksi)->translatedFormat('d F Y') }}
                                        </td>
                                        <td><strong>{{ number_format($item->hasil_produksi, 2) }}</strong></td>
                                        <td><span class="badge-kuartal">Kuartal {{ $kuartal }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><strong>Total Hasil Produksi</strong></td>
                                    <td><strong class="total-production">{{ number_format($totalProduksi, 2) }}
                                            Ton</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="empty-production">
                        <i data-feather="inbox"></i>
                        <p>Belum ada data produksi untuk tahun yang dipilih</p>
                    </div>
                @endif
            </div>

            <!-- Gallery Section -->
            @if ($lahan->galeri->count() > 0)
                <div class="detail-card-modern gallery-section">
                    <div class="detail-card-header">
                        <h3>
                            <i data-feather="image"></i>
                            Foto Lahan
                        </h3>
                    </div>
                    <div class="gallery-modern" id="gallery">
                        @foreach ($lahan->galeri as $foto)
                            <x-galeri-card :data="$foto" />
                        @endforeach
                    </div>
                    @if ($lahan->galeri->count() > 6)
                        <div class="gallery-toggle">
                            <button class="btn-show-more" onclick="toggleGallery()" id="galleryToggle">
                                <span id="galleryToggleText">Lihat Lebih Banyak</span>
                                <i data-feather="chevron-down" id="galleryToggleIcon"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Lahan Lainnya Section -->
    <section class="other-lahan-modern">
        <div class="container">
            <div class="section-header-modern">
                <h2>Lahan <span class="text-gradient">Lainnya</span></h2>
                <p>Jelajahi lahan jagung lainnya di Kabupaten Merauke</p>
            </div>
            @if ($semua->count() > 0)
                <div class="data-grid-modern">
                    @foreach ($semua->take(4) as $lahanItem)
                        <x-data-card :data="$lahanItem" />
                    @endforeach
                </div>
                @if ($semua->count() > 4)
                    <div class="view-more-wrapper">
                        <a href="{{ route('front.data') }}" class="btn-view-more">
                            Lihat Semua Lahan
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                @endif
            @else
                <div class="empty-state-lahan">
                    <i data-feather="inbox"></i>
                    <h3>Tidak ada lahan lainnya</h3>
                    <p>Belum ada lahan jagung lainnya yang tersedia.</p>
                    <div style="margin-top: 1.5rem;">
                        <a href="{{ route('front.data') }}" class="btn-view-more">
                            Lihat Semua Lahan
                            <i data-feather="arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <span onclick="closeLightbox()" class="lightbox-close">×</span>
        <img id="lightbox-img" alt="Enlarged view of the selected image" />
    </div>

    <x-footer />
@endsection

@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/lightbox.css') }}" />
    <style>
        /* Modern Detail Hero Section */
        .detail-hero-modern {
            min-height: 40vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            background-image: url("{{ asset('img/header-bg-2.jpg') }}");
            background-size: cover;
            background-position: center;
            overflow: hidden;
            margin-top: 80px;
        }

        .detail-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.9) 0%, rgba(45, 90, 45, 0.8) 100%);
            z-index: 1;
        }

        .detail-hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            width: 100%;
            padding: 4rem 2rem;
            text-align: center;
        }

        .detail-hero-title {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .detail-hero-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.95);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Detail Section */
        .detail-modern {
            padding: 4rem 2rem;
            background: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5rem;
        }

        /* Responsive container untuk layar besar */
        @media (min-width: 1440px) {
            .container {
                max-width: 1400px;
            }
        }

        @media (min-width: 1920px) {
            .container {
                max-width: 1600px;
            }
        }

        @media (min-width: 2560px) {
            .container {
                max-width: 2000px;
            }
        }

        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        /* Detail Card */
        .detail-card-modern {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .detail-card-modern:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .detail-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .detail-card-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .detail-card-header i {
            width: 24px;
            height: 24px;
            color: #228b22;
        }

        /* Map Section */
        .map-container-detail {
            border-radius: 15px;
            overflow: hidden;
        }

        .map-detail {
            width: 100%;
            height: 400px;
            border-radius: 15px;
        }

        /* Info Grid */
        .detail-info-grid {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-item-modern {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item-modern:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            flex-shrink: 0;
        }

        .info-icon i {
            width: 20px;
            height: 20px;
        }

        .info-content {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            flex: 1;
        }

        .info-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            color: #1a1a1a;
            font-weight: 600;
        }

        /* Production Section */
        .production-section {
            margin-bottom: 2rem;
        }

        .production-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .production-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .production-title h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .production-title i {
            width: 24px;
            height: 24px;
            color: #228b22;
        }

        .filter-year-modern {
            display: flex;
        }

        .filter-year-wrapper {
            display: flex;
            align-items: center;
            background: #f8fafc;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            gap: 0.75rem;
            border: 2px solid #e2e8f0;
        }

        .filter-year-wrapper i {
            width: 18px;
            height: 18px;
            color: #228b22;
        }

        .select-year-modern {
            background: transparent;
            border: none;
            font-size: 1rem;
            color: #1a1a1a;
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23228b22' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
            padding-right: 2rem;
        }

        /* Production Table */
        .table-wrapper-production {
            overflow-x: auto;
        }

        .table-production-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-production-modern thead {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
        }

        .table-production-modern th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table-production-modern tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .table-production-modern tbody tr:hover {
            background: #f8fafc;
        }

        .table-production-modern td {
            padding: 1rem;
            color: #1a1a1a;
        }

        .badge-kuartal {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(34, 139, 34, 0.1);
            color: #228b22;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .table-production-modern tfoot {
            background: #f8fafc;
            font-weight: 600;
        }

        .table-production-modern tfoot td {
            padding: 1.25rem 1rem;
        }

        .total-production {
            color: #228b22;
            font-size: 1.1rem;
        }

        .empty-production {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .empty-production i {
            width: 60px;
            height: 60px;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        /* Gallery Section */
        .gallery-section {
            margin-bottom: 2rem;
        }

        .gallery-modern {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .gallery-modern img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .gallery-modern img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery-modern.hidden-items img:nth-child(n+7) {
            display: none;
        }

        .gallery-toggle {
            text-align: center;
            margin-top: 1.5rem;
        }

        .btn-show-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-show-more:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 139, 34, 0.3);
        }

        .btn-show-more i {
            width: 18px;
            height: 18px;
            transition: transform 0.3s ease;
        }

        .btn-show-more.expanded i {
            transform: rotate(180deg);
        }

        /* Other Lahan Section */
        .other-lahan-modern {
            padding: 4rem 2rem;
            background: #f8fafc;
            width: 100%;
        }

        .section-header-modern {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header-modern h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .section-header-modern p {
            font-size: 1.1rem;
            color: #64748b;
        }

        /* Responsive untuk layar besar */
        @media (min-width: 1200px) {
            .other-lahan-modern {
                padding: 5rem 3rem;
            }

            .section-header-modern h2 {
                font-size: 2.75rem;
            }

            .section-header-modern p {
                font-size: 1.15rem;
            }
        }

        @media (min-width: 1440px) {
            .other-lahan-modern {
                padding: 6rem 4rem;
            }

            .section-header-modern {
                margin-bottom: 4rem;
            }

            .section-header-modern h2 {
                font-size: 2.5rem;
            }
        }

        @media (min-width: 1920px) {
            .other-lahan-modern {
                padding: 7rem 5rem;
            }

            .section-header-modern h2 {
                font-size: 2.5rem;
            }

            .section-header-modern p {
                font-size: 1.25rem;
            }
        }

        /* Empty State untuk Lahan Lainnya */
        .empty-state-lahan {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: 0 auto;
        }

        .empty-state-lahan i {
            width: 80px;
            height: 80px;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state-lahan h3 {
            font-size: 1.5rem;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .empty-state-lahan p {
            color: #64748b;
        }

        /* Responsive empty state untuk layar besar */
        @media (min-width: 1440px) {
            .empty-state-lahan {
                padding: 5rem 3rem;
            }

            .empty-state-lahan i {
                width: 100px;
                height: 100px;
            }

            .empty-state-lahan h3 {
                font-size: 1.75rem;
            }

            .empty-state-lahan p {
                font-size: 1.1rem;
            }
        }

        @media (min-width: 1920px) {
            .empty-state-lahan {
                padding: 6rem 4rem;
            }

            .empty-state-lahan h3 {
                font-size: 2rem;
            }

            .empty-state-lahan p {
                font-size: 1.15rem;
            }
        }

        .data-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
            width: 100%;
        }

        /* Responsive grid untuk layar besar */
        @media (min-width: 1200px) {
            .data-grid-modern {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 2.5rem;
            }
        }

        @media (min-width: 1440px) {
            .data-grid-modern {
                grid-template-columns: repeat(4, 1fr);
                gap: 2.5rem;
            }
        }

        @media (min-width: 1920px) {
            .data-grid-modern {
                grid-template-columns: repeat(5, 1fr);
                gap: 3rem;
                max-width: 1600px;
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (min-width: 2560px) {
            .data-grid-modern {
                grid-template-columns: repeat(6, 1fr);
                gap: 3rem;
                max-width: 2000px;
            }
        }

        /* Modern Card untuk Lahan Lainnya */
        .card-link-modern {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .card-modern {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-modern:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(34, 139, 34, 0.15);
        }

        .card-image-wrapper {
            position: relative;
            width: 100%;
            height: 220px;
            overflow: hidden;
        }

        /* Responsive card image untuk layar besar */
        @media (min-width: 1200px) {
            .card-image-wrapper {
                height: 240px;
            }
        }

        @media (min-width: 1440px) {
            .card-image-wrapper {
                height: 260px;
            }
        }

        @media (min-width: 1920px) {
            .card-image-wrapper {
                height: 280px;
            }

            .card-content-modern {
                padding: 2rem;
            }

            .card-title-modern {
                font-size: 1.35rem;
            }

            .card-info-item {
                font-size: 0.95rem;
            }
        }

        .card-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card-modern:hover .card-image-wrapper img {
            transform: scale(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(34, 139, 34, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card-modern:hover .card-overlay {
            opacity: 1;
        }

        .card-content-modern {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title-modern {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .card-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .card-info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .card-info-item i {
            width: 18px;
            height: 18px;
            color: #228b22;
            flex-shrink: 0;
        }

        .card-info-item span {
            line-height: 1.5;
        }

        .card-action {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #228b22;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .card-action i {
            width: 16px;
            height: 16px;
            transition: transform 0.3s ease;
        }

        .card-modern:hover .card-action {
            color: #2d5a2d;
        }

        .card-modern:hover .card-action i {
            transform: translateX(5px);
        }

        .view-more-wrapper {
            text-align: center;
            margin-top: 3rem;
        }

        .btn-view-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff !important;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-view-more:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(34, 139, 34, 0.3);
        }

        .btn-view-more i {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .btn-view-more:hover i {
            transform: translateX(5px);
        }

        /* Responsive button untuk layar besar */
        @media (min-width: 1440px) {
            .btn-view-more {
                padding: 1.2rem 2.5rem;
                font-size: 1.1rem;
            }

            .btn-view-more i {
                width: 22px;
                height: 22px;
            }
        }

        @media (min-width: 1920px) {
            .btn-view-more {
                padding: 1.5rem 3rem;
                font-size: 1.15rem;
            }

            .view-more-wrapper {
                margin-top: 3rem;
            }
        }

        /* Google Map Info Window Styling */
        .card-google-map {
            padding: 1rem;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            max-width: 250px;
        }

        .card-title-google-map {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .card-text-google-map {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }

        .card-button-google-map {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            font-size: 0.875rem;
            font-weight: 600;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .card-button-google-map:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 139, 34, 0.3);
        }

        /* Lightbox Updates */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .lightbox-close {
            position: absolute;
            top: 2rem;
            right: 2rem;
            color: #fff;
            font-size: 3rem;
            cursor: pointer;
            z-index: 1001;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .lightbox-close:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: rotate(90deg);
        }

        /* Utility Classes */
        .text-gradient {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive - Tablet dan Mobile */
        @media (max-width: 968px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .map-detail {
                height: 300px;
            }
        }

        @media (max-width: 768px) {
            .detail-hero-title {
                font-size: 2rem;
            }

            .detail-hero-description {
                font-size: 1rem;
            }

            .production-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .gallery-modern {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .data-grid-modern {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .section-header-modern h2 {
                font-size: 2rem;
            }

            .section-header-modern p {
                font-size: 1rem;
            }

            .other-lahan-modern {
                padding: 3rem 1.5rem;
            }

            .card-image-wrapper {
                height: 200px;
            }
        }

        /* Responsive - Tablet Landscape */
        @media (min-width: 769px) and (max-width: 1024px) {
            .data-grid-modern {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }

        /* Responsive - Desktop Small */
        @media (min-width: 1025px) and (max-width: 1199px) {
            .data-grid-modern {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }
    </style>
@endpush

@push('after-scripts')
    <script>
        var activeInfoWindow = null;

        function initMap() {
            var lahan = {
                name: "{{ $lahan->name }}",
                alamat: "{{ $lahan->alamat }}",
                slug: "{{ $lahan->slug }}",
                latitude: {{ $lahan->latitude }},
                longitude: {{ $lahan->longitude }}
            };

            var lokasi = {
                lat: lahan.latitude,
                lng: lahan.longitude
            };

            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: lokasi,
                styles: [{
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                }]
            });

            var marker = new google.maps.Marker({
                position: lokasi,
                map: map,
                title: lahan.name,
                icon: {
                    url: "{{ asset('img/corn-cob.png') }}",
                    scaledSize: new google.maps.Size(40, 40),
                }
            });

            var contentString =
                '<div class="card-google-map">' +
                '<h5 class="card-title-google-map">' + lahan.name + '</h5>' +
                '<p class="card-text-google-map">' + lahan.alamat + '</p>' +
                '<a href="https://www.google.com/maps?q=' + lahan.latitude + ',' + lahan.longitude +
                '" target="_blank" class="card-button-google-map">Lihat di Google Maps</a>' +
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                if (activeInfoWindow) {
                    activeInfoWindow.close();
                }
                infowindow.open(map, marker);
                activeInfoWindow = infowindow;
            });

            google.maps.event.addListener(map, 'click', function() {
                if (activeInfoWindow) {
                    activeInfoWindow.close();
                    activeInfoWindow = null;
                }
            });
        }

        function toggleGallery() {
            const gallery = document.getElementById('gallery');
            const toggleBtn = document.getElementById('galleryToggle');
            const toggleText = document.getElementById('galleryToggleText');
            const toggleIcon = document.getElementById('galleryToggleIcon');

            if (gallery.classList.contains('hidden-items')) {
                gallery.classList.remove('hidden-items');
                toggleText.textContent = 'Lihat Lebih Sedikit';
                toggleBtn.classList.add('expanded');
            } else {
                gallery.classList.add('hidden-items');
                toggleText.textContent = 'Lihat Lebih Banyak';
                toggleBtn.classList.remove('expanded');
            }

            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        // Initialize gallery state
        document.addEventListener('DOMContentLoaded', function() {
            const gallery = document.getElementById('gallery');
            const galleryCount = {{ $lahan->galeri->count() ?? 0 }};
            if (gallery && galleryCount > 6) {
                gallery.classList.add('hidden-items');
            }
        });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endpush
