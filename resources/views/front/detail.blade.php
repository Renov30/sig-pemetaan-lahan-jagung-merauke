@extends('front.layouts.app')
@section('title', 'Detail')
@section('content')
    <body>
        <x-nav/>
        <!-- content section start -->
        <section class="detail">
            <h2>Detail Lahan</h2>
            <div class="row">
                <div id="map"></div>
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

                        var lokasi = { lat: lahan.latitude, lng: lahan.longitude };

                        var map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 15,
                            center: lokasi,
                        });

                        var marker = new google.maps.Marker({
                            position: lokasi,
                            map: map,
                            title: lahan.name,
                            icon: {
                                url: "{{ asset('img/corn-cob.png') }}", 
                                scaledSize: new google.maps.Size(30, 30),
                            } 
                        });

                        
                        var contentString =
                            '<div>' +
                                '<h5>' + lahan.name + '</h5>' +
                                '<p>' + lahan.alamat + '</p>' +
                                '<a href="https://www.google.com/maps?q=' + lahan.latitude + ',' + lahan.longitude + '" target="_blank">Lihat di Google Maps</a>' +
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

                </script>

                <div class="teks">
                    <table>
                        <tr>
                            <td>Nama Lahan</td>
                            <td>:</td>
                            <td>{{$lahan->name}}</td>
                        </tr>
                        <tr>
                            <td>Nama Petani</td>
                            <td>:</td>
                            <td>{{$lahan->name}}</td>
                        </tr>
                        <tr>
                            <td>Hasil Produksi</td>
                            <td>:</td>
                            <td>{{$lahan->hasil_produksi}}</td>
                        </tr>
                        <tr>
                            <td>Luas Lahan</td>
                            <td>:</td>
                            <td>{{$lahan->luas_lahan}}</td>
                        </tr>
                        <tr>
                            <td>Distrik</td>
                            <td>:</td>
                            <td>{{$lahan->distrik->name}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{$lahan->alamat}}</td>
                        </tr>
                        <tr>
                            <td>No. Hp</td>
                            <td>:</td>
                            <td>{{$lahan->no_hp}}</td>
                        </tr>
                        <tr>
                            <td>Latitude</td>
                            <td>:</td>
                            <td>{{$lahan->latitude}}</td>
                        </tr>
                        <tr>
                            <td>Longitude</td>
                            <td>:</td>
                            <td>{{$lahan->longitude}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
        <!-- content section end -->
        <!-- gallery section start -->
        <section class="photos">
            <h3>Foto Lahan</h3>
            <div class="gallery" id="gallery">
                @forelse ($lahan->galeri as $foto)
                <x-galeri-card :data="$foto"/>
              @empty
                <p>Belum ada foto lahan</p>
              @endforelse
            </div>
            @if ($lahan->galeri->count() > 4)
                <div class="show-more" onclick="toggleGallery()">Show More</div>
            @endif
        </section>
        <!-- lightbox start -->
        <div class="lightbox" id="lightbox">
            <span onclick="closeLightbox()">×</span>
            <img id="lightbox-img" alt="Enlarged view of the selected image" />
        </div>
        <!-- lightbox end -->

        <!-- gallery section end -->
        <!-- other content start -->
        <section class="other">
            <h3>Lahan Lainnya</h3>
            <!-- card view -->
            <div class="grid" id="cardView">
            @forelse ($semua as $lahan)
                <x-data-card :data="$lahan"/>
            @empty
                <p>Belum ada data lahan</p>
            @endforelse
            </div>
        </section>
        <!-- other content end -->
       <x-footer/>
@endsection
@push('after-styles')
    <link rel="stylesheet" href="{{ asset('css/filament/lightbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/filament/other.css') }}" />
@endpush
@push('after-scripts')
    <script
        async
        defer
        src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap"
    ></script>
@endpush
