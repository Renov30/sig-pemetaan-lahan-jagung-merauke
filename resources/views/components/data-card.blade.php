<a href="{{route('front.detail', $data->slug)}}" class="card-link-modern">
    <div class="card-modern">
        <div class="card-image-wrapper">
            <img src="{{Storage::url($data->thumbnail)}}" alt="{{$data->name}}" />
            <div class="card-overlay"></div>
        </div>
        <div class="card-content-modern">
            <h3 class="card-title-modern">{{$data->name}}</h3>
            <div class="card-info">
                <div class="card-info-item">
                    <i data-feather="user"></i>
                    <span>{{$data->nama_petani}}</span>
                </div>
                <div class="card-info-item">
                    <i data-feather="map-pin"></i>
                    <span>{{$data->distrik->name}}</span>
                </div>
                <div class="card-info-item">
                    <i data-feather="navigation"></i>
                    <span>{{ Str::limit($data->alamat, 40) }}</span>
                </div>
            </div>
            <div class="card-action">
                <span>Lihat Detail <i data-feather="arrow-right"></i></span>
            </div>
        </div>
    </div>
</a>