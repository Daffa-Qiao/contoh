@extends('layouts.app')
@section('title', 'Syarat & Ketentuan')
@section('content')
<main class="main-content mt-0">
    <!-- Home Button -->
    <div class="position-fixed" style="top: 20px; left: 20px; z-index: 1000;">
        <a href="/" class="btn btn-primary rounded-circle shadow-sm" style="background-color:green;" title="Kembali ke Beranda">
            <i class="fas fa-home"></i>
        </a>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-gradient text-center" style="background-color: #2E7D32;">
                        <h3 class="mb-0 text-white">Syarat & Ketentuan Sehat Rasa</h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Pendahuluan -->
                        <section class="mb-5">
                            <h4 class="text-success mb-3">1. Pendahuluan</h4>
                            <p>Selamat datang di Sehat Rasa. Dengan mendaftar atau menggunakan layanan kami, Anda menyetujui syarat dan ketentuan berikut:</p>
                        </section>

                        <!-- Pendaftaran dan Akun -->
                        <section class="mb-5">
                            <h4 class="text-success mb-3">2. Pendaftaran dan Akun</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">✓ Anda harus berusia minimal 15 tahun untuk mendaftar</li>
                                <li class="mb-3">✓ Informasi yang diberikan harus akurat dan lengkap</li>
                                <li class="mb-3">✓ Anda bertanggung jawab atas keamanan akun Anda</li>
                                <li class="mb-3">✓ Satu email hanya untuk satu akun</li>
                            </ul>
                        </section>

                        <!-- Layanan -->
                        <section class="mb-5">
                            <h4 class="text-success mb-3">3. Layanan</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">✓ Konsultasi online dengan dokter terpercaya</li>
                                <li class="mb-3">✓ Kalkulator kalori dan BMI</li>
                                <li class="mb-3">✓ Informasi menu sehat</li>
                                <li class="mb-3">✓ Rekomendasi program kesehatan</li>
                            </ul>
                        </section>

                        <!-- Privasi dan Data -->
                        <section class="mb-5">
                            <h4 class="text-success mb-3">4. Privasi dan Data</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">✓ Data pribadi Anda akan dilindungi</li>
                                <li class="mb-3">✓ Informasi medis bersifat rahasia</li>
                                <li class="mb-3">✓ Data hanya digunakan untuk layanan Sehat Rasa</li>
                                <li class="mb-3">✓ Anda dapat meminta penghapusan data</li>
                            </ul>
                        </section>

                        <!-- Pembatasan -->
                        <section class="mb-5">
                            <h4 class="text-success mb-3">5. Pembatasan</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">✓ Dilarang memberikan informasi palsu</li>
                                <li class="mb-3">✓ Dilarang menyalahgunakan layanan</li>
                                <li class="mb-3">✓ Dilarang melakukan tindakan ilegal</li>
                                <li class="mb-3">✓ Pelanggaran dapat berakibat penutupan akun</li>
                            </ul>
                        </section>

                        <!-- Perubahan Ketentuan -->
                        <section class="mb-5">
                            <h4 class="text-success mb-3">6. Perubahan Ketentuan</h4>
                            <p>Sehat Rasa berhak mengubah syarat dan ketentuan sewaktu-waktu. Perubahan akan diberitahukan melalui email atau notifikasi di aplikasi.</p>
                        </section>

                        <!-- Kontak -->
                        <section class="mb-4">
                            <h4 class="text-success mb-3">7. Kontak</h4>
                            <p>Untuk pertanyaan tentang syarat dan ketentuan ini, silakan hubungi:</p>
                            <ul class="list-unstyled">
                                <li>Email: support@sehatrasa.com</li>
                                <li>Telepon: (021) 1234567</li>
                                <li>Alamat: Jl. Kesehatan No. 123, Surabaya</li>
                            </ul>
                        </section>

                        <!-- Tombol Setuju -->
                        <div class="text-center mt-5">
                            <a href="{{ route('user.register') }}" class="btn btn-success btn-lg px-5">
                                Saya Setuju & Lanjutkan Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('css')
<style>
.card {
    border: none;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    background: #ffffff;
}

.card-header {
    border-radius: 20px 20px 0 0 !important;
    padding: 1.5rem;
}

.card-body {
    padding: 2rem;
}

section {
    position: relative;
    padding-left: 20px;
}

section::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(to bottom, #2E7D32, transparent);
    border-radius: 3px;
}

.list-unstyled li {
    position: relative;
    padding-left: 10px;
    line-height: 1.6;
}

.btn-success {
    background-color: #2E7D32;
    border: none;
    border-radius: 10px;
    padding: 15px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background-color: #1B5E20;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
}

/* Animations */
.card {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .btn-success {
        padding: 12px 24px;
    }
}
</style>
@endpush
@endsection
