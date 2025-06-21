@extends('layouts.app')
@section('title', 'Menu Makanan Sehat')
@section('content')
<!-- Home Button -->
<div class="position-fixed" style="top: 20px; left: 20px; z-index: 1000;">
    <a href="/" class="btn btn-primary rounded-circle shadow-sm" style="background-color:green;" title="Kembali ke Beranda">
        <i class="fas fa-home"></i>
    </a>
</div>

<div class="container py-5" style="background-color: white;">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="text-center" style="color: green;">Menu Makanan Sehat</h2>
            <p class="text-center text-muted">Pilihan makanan sehat untuk pola hidup lebih baik</p>
        </div>
    </div>

    <!-- Kategori Sarapan -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4" style="color: green;">Sarapan Sehat</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/oatmeal.jpeg') }}" class="card-img-top" alt="Oatmeal">
                        <div class="card-body">
                            <h5 class="card-title">Oatmeal Quaker</h5>
                            <p class="card-text">
                                - Kaya akan serat<br>
                                - Mengenyangkan<br>
                                - 150 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=quaker%20oatmeal" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/granola.jpeg') }}" class="card-img-top" alt="Granola">
                        <div class="card-body">
                            <h5 class="card-title">Granola Mix</h5>
                            <p class="card-text">
                                - Tinggi protein<br>
                                - Kaya nutrisi<br>
                                - 200 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=granola" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/yogurt.jpeg') }}" class="card-img-top" alt="Greek Yogurt">
                        <div class="card-body">
                            <h5 class="card-title">Greek Yogurt</h5>
                            <p class="card-text">
                                - Tinggi protein<br>
                                - Baik untuk pencernaan<br>
                                - 100 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=greek%20yogurt" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Makan Siang -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4" style="color: green;">Makan Siang Sehat</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/quinoa.jpg') }}" class="card-img-top"alt="Quinoa">
                        <div class="card-body">
                            <h5 class="card-title">Quinoa Organik</h5>
                            <p class="card-text">
                                - Kaya protein nabati<br>
                                - Bebas gluten<br>
                                - 120 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=quinoa" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/chia.webp') }}" class="card-img-top" alt="Chia Seeds">
                        <div class="card-body">
                            <h5 class="card-title">Chia Seeds</h5>
                            <p class="card-text">
                                - Kaya omega 3<br>
                                - Tinggi serat<br>
                                - 70 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=chia%20seeds" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/edamame.jpg') }}" class="card-img-top" alt="Edamame">
                        <div class="card-body">
                            <h5 class="card-title">Edamame</h5>
                            <p class="card-text">
                                - Tinggi protein<br>
                                - Rendah kalori<br>
                                - 90 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=edamame" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Camilan -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4" style="color: green;">Camilan Sehat</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/almond.jpg') }}" class="card-img-top" alt="Almond">
                        <div class="card-body">
                            <h5 class="card-title">Almond Mentah</h5>
                            <p class="card-text">
                                - Kaya vitamin E<br>
                                - Baik untuk jantung<br>
                                - 160 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=raw%20almond" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/protein-bar.jpg') }}" class="card-img-top" alt="Protein Bar">
                        <div class="card-body">
                            <h5 class="card-title">Protein Bar</h5>
                            <p class="card-text">
                                - Tinggi protein<br>
                                - Praktis dibawa<br>
                                - 180 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=protein%20bar" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('img/trail-mix.jpg') }}" class="card-img-top" alt="Trail Mix">
                        <div class="card-body">
                            <h5 class="card-title">Trail Mix</h5>
                            <p class="card-text">
                                - Campuran kacang & buah kering<br>
                                - Kaya nutrisi<br>
                                - 140 kalori per sajian
                            </p>
                            <a href="https://shopee.co.id/search?keyword=trail%20mix" class="btn btn-success" target="_blank">
                                Beli di Shopee <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-left: 5px solid green;">
                <div class="card-body">
                    <h4 style="color: green;">Tips Memilih Makanan Sehat:</h4>
                    <ul class="mb-0">
                        <li>Perhatikan kandungan nutrisi pada label makanan</li>
                        <li>Pilih makanan dengan bahan-bahan alami</li>
                        <li>Hindari makanan dengan pengawet berlebihan</li>
                        <li>Perhatikan tanggal kadaluarsa</li>
                        <li>Pilih penjual dengan rating dan ulasan yang baik di Shopee</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .btn-success {
        background-color: green;
        border-color: green;
    }
    .btn-success:hover {
        background-color: darkgreen;
        border-color: darkgreen;
    }
</style>
@endpush
@endsection





