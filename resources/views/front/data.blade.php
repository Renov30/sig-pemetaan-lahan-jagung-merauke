@extends('front.layouts.app')
@section('title', 'Data')
@section('content')
    <x-nav/>
    
    <!-- Modern Hero Section -->
    <section class="data-hero-modern">
        <div class="data-hero-overlay"></div>
        <div class="data-hero-content">
            <div class="data-hero-text">
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
            <div class="data-controls">
                <form action="{{ route('front.data') }}" method="GET" class="search-modern">
                    <div class="search-wrapper">
                        <i data-feather="search"></i>
                        <input type="text" placeholder="Cari lahan jagung..." name="search" value="{{ request('search') }}" />
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </form>
                
                <div class="filter-controls">
                    <form action="{{ route('front.data') }}" method="GET" class="filter-modern">
                        <select name="distrik" onchange="this.form.submit()" class="select-modern">
                            <option value="">Semua Distrik</option>
                            @foreach($distriks as $distrik)
                            <option value="{{ $distrik->id }}" {{ request('distrik') == $distrik->id ? 'selected' : '' }}>
                                {{ $distrik->name }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                    
                    <!-- Toggle View Button -->
                    <button class="toggle-view-btn" id="toggleViewBtn" title="Toggle View">
                        <i data-feather="grid"></i>
                    </button>
                </div>
            </div>

            <!-- Card View -->
            <div class="data-grid-modern" id="cardView">
                @forelse ($semua as $lahan)
                    <x-data-card :data="$lahan"/>
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
                            @forelse ($semua as $lahan)
                                <x-data-table :data="$lahan"/>              
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data lahan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($semua->hasPages())
            <div class="pagination-modern">
                {{ $semua->links() }}
            </div>
            @endif
        </div>
    </section>
    
    <x-footer/>
@endsection

@push('after-styles')
    <style>
        /* Modern Data Hero Section */
        .data-hero-modern {
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

        .toggle-view-btn {
            width: 50px;
            height: 50px;
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #228b22;
        }

        .toggle-view-btn:hover {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border-color: #228b22;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 139, 34, 0.3);
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
        }

        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
        }

        .table-modern th {
            padding: 1.2rem 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table-modern tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
        }

        .table-modern tbody tr:last-child {
            border-bottom: none;
        }

        .table-modern td {
            padding: 1.2rem 1rem;
            color: #1a1a1a;
        }

        .table-modern td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
        }

        .table-modern .text-center {
            text-align: center;
            color: #64748b;
            padding: 3rem;
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
        .pagination-modern {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination-modern nav {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-modern nav a,
        .pagination-modern nav span {
            padding: 0.7rem 1.2rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination-modern nav a {
            background: #fff;
            color: #228b22;
            border: 2px solid #e2e8f0;
        }

        .pagination-modern nav a:hover {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border-color: #228b22;
            transform: translateY(-2px);
        }

        .pagination-modern nav span {
            background: linear-gradient(135deg, #228b22 0%, #2d5a2d 100%);
            color: #fff;
            border: 2px solid #228b22;
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
    </style>
@endpush

@push('after-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleViewBtn');
            const cardView = document.getElementById('cardView');
            const tableView = document.getElementById('tableView');
            
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    if (cardView.classList.contains('hidden')) {
                        cardView.classList.remove('hidden');
                        tableView.classList.add('hidden');
                        toggleBtn.querySelector('i').setAttribute('data-feather', 'grid');
                    } else {
                        cardView.classList.add('hidden');
                        tableView.classList.remove('hidden');
                        toggleBtn.querySelector('i').setAttribute('data-feather', 'list');
                    }
                    if (typeof feather !== 'undefined') {
                        feather.replace();
                    }
                });
            }
        });
    </script>
@endpush
