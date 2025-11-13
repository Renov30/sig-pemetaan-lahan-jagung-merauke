@extends('front.layouts.app')
@section('title', 'Data')
@section('content')
    <x-nav />

    <!-- Modern Hero Section -->
    <section class="data-hero-modern">
        <div class="data-hero-overlay"></div>
        <div class="data-hero-content">
            <div class="data-hero-text scroll-animate fade-in-up">
                <h1 class="data-hero-title">
                    Data Lahan <span class="text-gradient">Jagung</span>
                </h1>
                <p class="data-hero-description">
                    Kumpulan data lahan jagung di sekitar Kabupaten Merauke yang telah terdata.
                </p>
            </div>
        </div>
    </section>

    <!-- Data Section -->
    <section class="data-modern">
        <div class="container">
            <!-- Search and Filter Bar -->
            <div class="data-controls scroll-animate fade-in-up delay-100">
                <form action="{{ route('front.data') }}" method="GET" class="search-modern">
                    <div class="search-wrapper">
                        <i data-feather="search"></i>
                        <input type="text" placeholder="Cari lahan jagung..." name="search"
                            value="{{ request('search') }}" />
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </form>

                <div class="filter-controls">
                    <form action="{{ route('front.data') }}" method="GET" class="filter-modern">
                        <select name="distrik" onchange="this.form.submit()" class="select-modern">
                            <option value="">Semua Distrik</option>
                            @foreach ($distriks as $distrik)
                                <option value="{{ $distrik->id }}"
                                    {{ request('distrik') == $distrik->id ? 'selected' : '' }}>
                                    {{ $distrik->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <!-- Toggle View Buttons -->
                    <div class="toggle-view-group">
                        <button class="toggle-view-btn" id="toggleCardView" title="Tampilan Card" data-view="card">
                            <i data-feather="grid"></i>
                            <span>Card</span>
                        </button>
                        <button class="toggle-view-btn" id="toggleTableView" title="Tampilan Tabel" data-view="table">
                            <i data-feather="list"></i>
                            <span>Tabel</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card View -->
            <div class="data-grid-modern" id="cardView">
                @forelse ($semua as $lahan)
                    <x-data-card :data="$lahan" />
                @empty
                    <div class="empty-state">
                        <i data-feather="inbox"></i>
                        <h3>Tidak ada data lahan</h3>
                        <p>Belum ada data lahan jagung yang tersedia.</p>
                    </div>
                @endforelse
            </div>

            <!-- Table View -->
            <div class="hidden" id="tableView">
                @if ($semua->count() > 0)
                    <div class="table-wrapper-modern">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Lahan</th>
                                    <th>Nama Petani</th>
                                    <th>Distrik</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua as $lahan)
                                    <x-data-table :data="$lahan" />
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i data-feather="inbox"></i>
                        <h3>Tidak ada data lahan</h3>
                        <p>Belum ada data lahan jagung yang tersedia.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination Card View -->
            @if ($semua->hasPages())
                <div class="pagination-modern-wrapper" id="paginationCardView">
                    <div class="pagination-modern">
                        {{ $semua->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

            <!-- Pagination Table View -->
            @if ($semua->hasPages())
                <div class="pagination-modern-wrapper hidden" id="paginationTableView">
                    <div class="pagination-modern">
                        {{ $semua->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <x-footer />
@endsection

@push('after-styles')
    <style>
        /* Modern Data Hero Section */
        .data-hero-modern {
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
            .data-hero-modern {
                padding-top: 70px;
                min-height: calc(40vh + 70px);
                margin-top: 0;
            }
        }

        /* Tidak ada padding top pada layar >= 1920px */
        @media (min-width: 1920px) {
            .data-hero-modern {
                padding-top: 0;
                min-height: 40vh;
                margin-top: 0;
            }
        }

        .data-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.9) 0%, rgba(45, 90, 45, 0.8) 100%);
            z-index: 1;
        }

        .data-hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            width: 100%;
            padding: 4rem 2rem;
            text-align: center;
        }

        /* Kurangi padding top saat window mengecil */
        @media (max-width: 1919px) {
            .data-hero-content {
                padding-top: 1rem;
                padding-bottom: 2rem;
            }
        }

        @media (max-width: 768px) {
            .data-hero-content {
                padding-top: 0.5rem;
                padding-bottom: 1.5rem;
            }
        }

        .data-hero-title {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .data-hero-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.95);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Data Section */
        .data-modern {
            padding: 4rem 2rem;
            background: #f8fafc;
            min-height: 60vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5rem;
        }

        /* Controls */
        .data-controls {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-modern {
            flex: 1;
            min-width: 300px;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            gap: 0.5rem;
        }

        .search-wrapper i {
            color: #64748b;
            width: 20px;
            height: 20px;
        }

        .search-wrapper input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 1rem;
            color: #1a1a1a;
            padding: 0.5rem;
        }

        .search-wrapper input::placeholder {
            color: #94a3b8;
        }

        .search-btn {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 139, 34, 0.3);
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-modern {
            display: flex;
        }

        .select-modern {
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            padding: 0.7rem 1.5rem;
            font-size: 1rem;
            color: #1a1a1a;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23228b22' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 3rem;
        }

        .select-modern:hover {
            border-color: #228b22;
        }

        .select-modern:focus {
            border-color: #228b22;
            box-shadow: 0 0 0 3px rgba(34, 139, 34, 0.1);
        }

        .toggle-view-group {
            display: flex;
            gap: 0.5rem;
            background: #fff;
            padding: 0.25rem;
            border-radius: 50px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 2px solid #e2e8f0;
        }

        .toggle-view-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: transparent;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #64748b;
            font-weight: 500;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .toggle-view-btn i {
            width: 18px;
            height: 18px;
        }

        .toggle-view-btn span {
            display: none;
        }

        .toggle-view-btn:hover {
            color: #228b22;
            background: rgba(34, 139, 34, 0.1);
        }

        .toggle-view-btn.active {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(34, 139, 34, 0.3);
        }

        .toggle-view-btn.active:hover {
            background: linear-gradient(135deg, #1a7a1a 0%, #255025 100%);
        }

        /* Show text on larger screens */
        @media (min-width: 640px) {
            .toggle-view-btn span {
                display: inline;
            }

            .toggle-view-btn {
                padding: 0.6rem 1.5rem;
            }
        }

        /* Responsive toggle buttons */
        @media (max-width: 639px) {
            .toggle-view-group {
                gap: 0.25rem;
                padding: 0.2rem;
            }

            .toggle-view-btn {
                padding: 0.5rem 0.75rem;
                min-width: 44px;
            }

            .toggle-view-btn i {
                width: 16px;
                height: 16px;
            }
        }

        /* Grid */
        .data-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Modern Card */
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

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .empty-state i {
            width: 80px;
            height: 80px;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #64748b;
        }

        /* Table View */
        .table-wrapper-modern {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 3rem;
            overflow-x: auto;
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table-modern th {
            padding: 1.2rem 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .table-modern th:first-child {
            padding-left: 1.5rem;
        }

        .table-modern th:last-child {
            padding-right: 1.5rem;
            text-align: center;
        }

        .table-modern tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.01);
        }

        .table-modern tbody tr:last-child {
            border-bottom: none;
        }

        .table-modern td {
            padding: 1.2rem 1rem;
            color: #1a1a1a;
            vertical-align: middle;
        }

        .table-modern td:first-child {
            padding-left: 1.5rem;
        }

        .table-modern td:last-child {
            padding-right: 1.5rem;
            text-align: center;
        }

        .table-modern td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table-modern td strong {
            color: #1a1a1a;
            font-weight: 600;
        }

        .table-modern .text-center {
            text-align: center;
            color: #64748b;
            padding: 3rem;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .table-wrapper-modern {
                border-radius: 15px;
                margin-bottom: 2rem;
            }

            .table-modern {
                min-width: 600px;
            }

            .table-modern th,
            .table-modern td {
                padding: 0.8rem 0.75rem;
                font-size: 0.875rem;
            }

            .table-modern td img {
                width: 50px;
                height: 50px;
            }
        }

        .table-action-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .table-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 139, 34, 0.3);
        }

        /* Pagination */
        .pagination-modern-wrapper {
            /* margin-top: 3rem; */
            /* padding: 2rem 0; */
            width: 100%;
        }

        .pagination-modern {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Reset semua style default dari Laravel pagination */
        .pagination-modern nav {
            display: block;
            width: 100%;
        }

        .pagination-modern nav>div,
        .pagination-modern nav>ul {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .pagination-modern nav ul {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .pagination-modern nav li {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Style untuk semua link dan span di pagination */
        .pagination-modern nav a,
        .pagination-modern nav span:not([aria-disabled="true"]) {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background: #fff;
            color: #228b22;
            border: 2px solid #e2e8f0;
            cursor: pointer;
        }

        /* Link pagination (halaman yang bisa diklik) */
        .pagination-modern nav a:hover {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff !important;
            border-color: #228b22;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 139, 34, 0.2);
        }

        /* Halaman aktif */
        .pagination-modern nav span[aria-current="page"],
        .pagination-modern nav .active span {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%) !important;
            color: #fff !important;
            border-color: #228b22 !important;
            cursor: default;
        }

        /* Disabled state (Previous/Next yang disabled) */
        .pagination-modern nav span[aria-disabled="true"] {
            background: #f1f5f9 !important;
            color: #94a3b8 !important;
            border: 2px solid #e2e8f0 !important;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Style untuk teks "Previous" dan "Next" */
        .pagination-modern nav a[rel="prev"],
        .pagination-modern nav a[rel="next"],
        .pagination-modern nav span[aria-label*="Previous"],
        .pagination-modern nav span[aria-label*="Next"] {
            font-weight: 600;
        }

        /* Info text jika ada */
        .pagination-modern nav>div>div:first-child {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            text-align: center;
            width: 100%;
        }

        /* Responsive pagination */
        @media (max-width: 640px) {

            .pagination-modern nav a,
            .pagination-modern nav span {
                min-width: 35px;
                height: 35px;
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }

            .pagination-modern nav>div,
            .pagination-modern nav>ul {
                gap: 0.25rem;
            }
        }

        /* Utility Classes */
        .hidden {
            display: none !important;
        }

        .text-gradient {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .data-hero-title {
                font-size: 2rem;
            }

            .data-hero-description {
                font-size: 1rem;
            }

            .data-controls {
                flex-direction: column;
            }

            .search-modern {
                width: 100%;
            }

            .data-grid-modern {
                grid-template-columns: 1fr;
            }

            .table-wrapper-modern {
                overflow-x: auto;
            }

            .table-modern {
                min-width: 600px;
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
        document.addEventListener('DOMContentLoaded', function() {
            const toggleCardView = document.getElementById('toggleCardView');
            const toggleTableView = document.getElementById('toggleTableView');
            const cardView = document.getElementById('cardView');
            const tableView = document.getElementById('tableView');
            const paginationCardView = document.getElementById('paginationCardView');
            const paginationTableView = document.getElementById('paginationTableView');

            // Load saved view preference from localStorage
            const savedView = localStorage.getItem('dataViewPreference') || 'card';

            // Function to switch view
            function switchView(view) {
                if (view === 'card') {
                    // Show card view
                    cardView.classList.remove('hidden');
                    tableView.classList.add('hidden');
                    if (paginationCardView) paginationCardView.classList.remove('hidden');
                    if (paginationTableView) paginationTableView.classList.add('hidden');

                    // Update button states
                    toggleCardView.classList.add('active');
                    toggleTableView.classList.remove('active');
                } else {
                    // Show table view
                    cardView.classList.add('hidden');
                    tableView.classList.remove('hidden');
                    if (paginationCardView) paginationCardView.classList.add('hidden');
                    if (paginationTableView) paginationTableView.classList.remove('hidden');

                    // Update button states
                    toggleCardView.classList.remove('active');
                    toggleTableView.classList.add('active');
                }

                // Save preference to localStorage
                localStorage.setItem('dataViewPreference', view);

                // Replace feather icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }

            // Set initial view based on saved preference
            switchView(savedView);

            // Add event listeners
            if (toggleCardView) {
                toggleCardView.addEventListener('click', function() {
                    switchView('card');
                });
            }

            if (toggleTableView) {
                toggleTableView.addEventListener('click', function() {
                    switchView('table');
                });
            }
        });

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
