@extends('layouts.app')

@section('title', 'Profil Sekolah')

@section('content')

<section class="page-hero">
    <h1>Profil Sekolah</h1>
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fa-solid fa-angle-right"></i>
        <span>Profile</span>
    </nav>
</section>

<div class="page-bg">
    <div class="container profile-body">

        {{-- SAMBUTAN KEPALA SEKOLAH --}}
        <article class="sambutan-card">
            <img src="{{ asset('images/kepala-sekolah.jpg') }}" alt="Drs. Budi Santoso, Kepala Sekolah">
            <div class="sambutan-text">
                <h2>Sambutan Kepala Sekolah</h2>
                <blockquote>"Selamat datang di website resmi SMK Negeri 4 Bogor. Kami berharap website ini dapat menjadi sarana informasi dan komunikasi yang baik antara sekolah, siswa, orang tua, dan masyarakat luas guna mendukung ekosistem pendidikan yang transparan."</blockquote>
                <div class="nama">Drs. Budi Santoso</div>
                <div class="jabatan">Kepala Sekolah SMK Negeri 4 Bogor</div>
            </div>
        </article>

        {{-- SEJARAH --}}
        <section class="sejarah">
            <div>
                <span class="eyebrow-line">Identity &amp; Heritage</span>
                <h2>Sejarah Sekolah</h2>
                <p>SMK Negeri 4 Bogor merupakan lembaga pendidikan kejuruan negeri terakreditasi A yang berfokus pada bidang teknologi informasi, rekayasa, pengelasan, dan otomotif. Berdiri sejak tahun 2008, sekolah ini berkomitmen mencetak lulusan siap kerja yang santun, mandiri, kreatif, dan kompetitif di era digital.</p>
                <p>Sekolah ini memiliki lingkungan belajar yang luas dan kondusif, didukung oleh fasilitas praktik modern untuk menunjang kompetensi siswa di setiap bidang keahlian. Melalui sinergi erat bersama berbagai Industri dan Dunia Kerja (IDUKA), SMK Negeri 4 Bogor memastikan kurikulum pembelajaran selalu relevan dengan kebutuhan industri masa kini.</p>
            </div>
            <div class="sejarah-img">
                <img src="{{ asset('images/lapangan1.jpeg') }}" alt="Lapangan SMKN 4 Bogor dilihat dari atas">
            </div>
        </section>

        {{-- VISI & MISI --}}
        <section class="visi-misi">
            <div class="vm-card visi">
                <div class="vm-icon"><i class="fa-regular fa-eye"></i></div>
                <h3>Visi</h3>
                <p>“Terwujudnya sekolah yang tangguh dalam imtaq, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan”</p>
            </div>
            <div class="vm-card misi">
                <div class="vm-icon"><i class="fa-regular fa-clipboard"></i></div>
                <h3>Misi</h3>
                <p>pengembangan karakter berbasis imtaq, peningkatan keterampilan kompetensi, kemandirian usaha, optimalisasi TIK dalam pembelajaran, serta perwujudan sekolah berwawasan lingkungan.</p>
            </div>
        </section>

    </div>
</div>

@endsection