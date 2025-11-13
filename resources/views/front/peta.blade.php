@extends('front.layouts.app')
@section('title', 'Peta - Peta Jagung')
@section('content')
    <x-nav />

    <!-- Modern Hero Section -->
    <section class="peta-hero-modern">
        <div class="peta-hero-overlay"></div>
        <div class="peta-hero-content">
            <div class="peta-hero-text scroll-animate fade-only">
                <h1 class="peta-hero-title">
                    Peta <span class="text-gradient">Lahan</span>
                </h1>
                <p class="peta-hero-description">
                    Tampilan penyebaran lahan jagung di sekitar Kabupaten Merauke yang telah terdata.
                </p>
            </div>
        </div>
    </section>

    <!-- Peta Section -->
    <section class="peta-modern">
        <div class="container">
            <!-- Filter Distrik -->
            <div class="peta-controls scroll-animate fade-in-up delay-100">
                <form action="{{ route('front.peta') }}" method="GET" class="filter-peta-modern">
                    <div class="filter-wrapper">
                        <i data-feather="filter"></i>
                        <select name="distrik" onchange="this.form.submit()" class="select-peta-modern">
                            <option value="">Semua Distrik</option>
                            @foreach ($distriks as $distrik)
                                <option value="{{ $distrik->id }}"
                                    {{ request('distrik') == $distrik->id ? 'selected' : '' }}>
                                    {{ $distrik->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <!-- Map Container -->
            <div class="map-container-modern scroll-animate fade-in-up delay-200">
                <div id="map" class="map-modern"></div>
                <div class="map-info scroll-animate fade-in-left delay-300">
                    <div class="map-info-card">
                        <i data-feather="info"></i>
                        <div>
                            <h4>Informasi Peta</h4>
                            <p>Klik pada marker untuk melihat detail lahan jagung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer />
@endsection

@push('after-styles')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5rem;
        }

        /* Modern Peta Hero Section */
        .peta-hero-modern {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            background-image: url("{{ asset('img/header-bg-2.jpg') }}");
            background-size: cover;
            background-position: center;
            overflow: hidden;
            box-sizing: border-box;
        }

        /* Padding top untuk mengkompensasi navbar fixed - hanya untuk layar < 1920px */
        @media (max-width: 1919px) {
            .peta-hero-modern {
                padding-top: 70px;
                min-height: calc(40vh + 70px);
                margin-top: 0;
            }
        }

        /* Tidak ada padding top pada layar >= 1920px */
        @media (min-width: 1920px) {
            .peta-hero-modern {
                padding-top: 0;
                min-height: 40vh;
                margin-top: 0;
            }
        }

        .peta-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.9) 0%, rgba(45, 90, 45, 0.8) 100%);
            z-index: 1;
        }

        .peta-hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            width: 100%;
            padding: 4rem 2rem;
            text-align: center;
        }

        /* Kurangi padding top saat window mengecil */
        @media (max-width: 1919px) {
            .peta-hero-content {
                padding-top: 1rem;
                padding-bottom: 2rem;
            }
        }

        @media (max-width: 768px) {
            .peta-hero-content {
                padding-top: 0.5rem;
                padding-bottom: 1.5rem;
            }
        }

        .peta-hero-title {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .peta-hero-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.95);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Peta Section */
        .peta-modern {
            padding: 4rem 2rem;
            background: #f8fafc;
            min-height: 70vh;
        }

        /* Controls */
        .peta-controls {
            margin-bottom: 2rem;
        }

        .filter-peta-modern {
            display: inline-block;
        }

        .filter-wrapper {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            gap: 0.75rem;
        }

        .filter-wrapper i {
            color: #228b22;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .select-peta-modern {
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
            min-width: 200px;
        }

        /* Map Container */
        .map-container-modern {
            position: relative;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .map-modern {
            width: 100%;
            height: 600px;
            border-radius: 20px;
        }

        .map-info {
            position: absolute;
            top: 4rem;
            right: 0.5rem;
            z-index: 10;
        }

        .map-info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1rem 1.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 300px;
        }

        .map-info-card i {
            width: 24px;
            height: 24px;
            color: #228b22;
            flex-shrink: 0;
        }

        .map-info-card h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 0.25rem 0;
        }

        .map-info-card p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
            line-height: 1.4;
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

        /* Utility Classes */
        .text-gradient {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .peta-hero-title {
                font-size: 2rem;
            }

            .peta-hero-description {
                font-size: 1rem;
            }

            .map-modern {
                height: 500px;
            }

            .map-info {
                position: relative;
                top: 0;
                right: 0;
                margin-bottom: 1rem;
            }

            .map-info-card {
                max-width: 100%;
            }
        }

        /* Scroll Animation Styles */
        .scroll-animate {
            opacity: 0;
            transition: all 0.8s ease-out;
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
        function initMap() {
            var mapOptions = {
                zoom: 12,
                center: {
                    lat: -8.4975434,
                    lng: 140.3882068
                },
                styles: [{
                    featureType: "poi",
                    elementType: "labels",
                    stylers: [{
                        visibility: "off"
                    }]
                }]
            };

            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            var activeInfoWindow = null;

            var locations = @json($lahans);

            locations.forEach(function(lahan) {
                var position = new google.maps.LatLng(lahan.latitude, lahan.longitude);

                var contentString =
                    '<div class="card-google-map">' +
                    '<h5 class="card-title-google-map">' + lahan.name + '</h5>' +
                    '<p class="card-text-google-map">' + lahan.alamat + '</p>' +
                    '<a href="/data/detail-lahan/' + lahan.slug +
                    '" class="card-button-google-map">Lihat Detail</a>' +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: lahan.name,
                    icon: {
                        url: "{{ asset('img/corn-cob.png') }}",
                        scaledSize: new google.maps.Size(40, 40),
                    }
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
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
    </script>

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
