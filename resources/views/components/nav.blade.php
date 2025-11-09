    <!-- navbar start -->
    <nav class="navbar" id="nav">
        <a href="{{ route('front.index') }}" class="navbar-logo">Peta<span>Jagung.</span></a>
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
