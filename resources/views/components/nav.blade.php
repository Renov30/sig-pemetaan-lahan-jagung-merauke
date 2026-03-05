    <!-- navbar start -->
    <nav class="navbar" id="nav">
        <div class="navbar-brand">
            <a href="{{ route('front.index') }}" class="navbar-brand-logo">
                <img src="{{ asset('img/logo-dppkp-land.png') }}" alt="Logo DPPKP">
            </a>
            <div class="navbar-brand-text">
                <a href="{{ route('front.index') }}" class="navbar-logo">Peta<span>Jagung.</span></a>
                <p class="navbar-subtitle">Dinas Tanaman Pangan dan Holtikultura Papua Selatan</p>
            </div>
        </div>
        <div class="navbar-nav">
            <a href="{{ route('front.index') }}">Home</a>
            <a href="{{ route('front.index') }}#about">Tentang</a>
            <a href="{{ route('front.data') }}">Data</a>
            <a href="{{ route('front.peta') }}">Peta</a>
        </div>
        <div class="navbar-extra">
            <a href="{{ route('filament.admin.auth.login') }}" class="login" target="blank">Masuk</a>
            <a href="{{ route('front.data') }}" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- navbar end -->
