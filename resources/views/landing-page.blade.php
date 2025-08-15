<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-PKL - BBPOM Bandar Lampung</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-50">
    <!-- Header Navigation -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                        <img src="{{ asset('img/bpom-logo-500x500.png') }}" alt="Logo BBPOM">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary">SIP-PKL</h1>
                        <p class="text-xs text-gray-600">BBPOM Bandar Lampung</p>
                    </div>
                </div>
                
                <nav class="hidden md:flex space-x-6">
                    <a href="#beranda" class="text-gray-700 hover:text-primary transition">Beranda</a>
                    <a href="#formasi" class="text-gray-700 hover:text-primary transition">Formasi</a>
                    <a href="#profil" class="text-gray-700 hover:text-primary transition">Profil</a>
                    <a href="#manfaat" class="text-gray-700 hover:text-primary transition">Manfaat</a>
                    <a href="#kontak" class="text-gray-700 hover:text-primary transition">Kontak</a>
                </nav>
                
                <div class="flex items-center space-x-3">
                    <button onclick="window.location.href='/dashboard'" class="bg-primary hover:bg-purple-800 text-white px-4 py-2 rounded-lg transition cursor-pointer">
                        Dashboard
                    </button>
                    <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-2 space-y-2">
                <a href="#beranda" class="block text-gray-700 hover:text-primary py-2">Beranda</a>
                <a href="#formasi" class="block text-gray-700 hover:text-primary py-2">Formasi</a>
                <a href="#profil" class="block text-gray-700 hover:text-primary py-2">Profil</a>
                <a href="#manfaat" class="block text-gray-700 hover:text-primary py-2">Manfaat</a>
                <a href="#kontak" class="block text-gray-700 hover:text-primary py-2">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Sistem Informasi Pengajuan<br>
                    <span class="text-yellow-300">Praktik Kerja Lapangan</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    Balai Besar Pengawas Obat dan Makanan di Bandar Lampung
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="window.location.href='/dashboard'" class="bg-secondary hover:bg-green-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition transform hover:scale-105 cursor-pointer">
                        Daftar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Data PKL Stats -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-primary text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold counter" data-target="{{ $totalPeserta }}">0</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Total Peserta PKL</h3>
                    <p class="text-gray-600">Mahasiswa yang telah mengikuti program</p>
                </div>
                <div class="text-center">
                    <div class="bg-secondary text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold counter" data-target="{{ $sedangPkl }}">0</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Sedang PKL</h3>
                    <p class="text-gray-600">Mahasiswa yang sedang menjalankan PKL</p>
                </div>
                <div class="text-center">
                    <div class="bg-yellow-500 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold counter" data-target="{{ $lowonganTersedia }}">0</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Lowongan Tersedia</h3>
                    <p class="text-gray-600">Posisi PKL yang masih tersedia</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Formasi Section -->
    <section id="formasi" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Formasi Yang Tersedia</h2>
                <p class="text-xl text-gray-600">Pilih posisi PKL yang sesuai dengan minat dan keahlian Anda</p>
            </div>
            
            <div id="formasi-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Cards will be populated by JavaScript -->
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center">
                <div id="pagination" class="flex space-x-2">
                    <!-- Pagination buttons will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Section -->
<section id="profil" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-primary mb-4">Profil BBPOM</h2>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div>
                <h3 class="text-2xl font-bold text-primary mb-4">Tentang Kami</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    BBPOM di Bandar Lampung merupakan Unit Pelaksana Teknis di bawah Badan Pengawas Obat dan Makanan Republik Indonesia
                    yang sesuai Peraturan Presiden No. 80 Tahun 2017 tentang Badan Pengawas Obat dan Makanan dan Peraturan Badan POM No. 22 Tahun 2020
                    tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis di Lingkungan Badan Pengawas Obat dan Makanan.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Sistem pengawasan Obat dan Makanan yang diselenggarakan oleh BPOM merupakan suatu proses yang komprehensif, mencakup pengawasan
                    pre-market dan post-market.
                </p>

                <div class="mb-8">
                    <h4 class="text-xl font-semibold text-secondary mb-3">Wilayah Kerja</h4>
                    <p class="text-gray-600 mb-2">Wilayah kerja BBPOM di Bandar Lampung meliputi 10 kabupaten/kota di Provinsi Lampung:</p>
                    <ul class="list-disc list-inside text-gray-600 mb-4">
                        <li>Kota Bandar Lampung</li>
                        <li>Kota Metro</li>
                        <li>Kabupaten Pesawaran</li>
                        <li>Kabupaten Pringsewu</li>
                        <li>Kabupaten Tanggamus</li>
                        <li>Kabupaten Pesisir Barat</li>
                        <li>Kabupaten Lampung Selatan</li>
                        <li>Kabupaten Lampung Timur</li>
                        <li>Kabupaten Lampung Barat</li>
                        <li>Kabupaten Lampung Tengah</li>
                    </ul>
                    <p class="text-gray-600 mb-2">Wilayah kerja Loka POM di Tulang Bawang meliputi 5 kabupaten:</p>
                    <ul class="list-disc list-inside text-gray-600">
                        <li>Kabupaten Tulang Bawang</li>
                        <li>Kabupaten Tulang Bawang Barat</li>
                        <li>Kabupaten Mesuji</li>
                        <li>Kabupaten Lampung Utara</li>
                        <li>Kabupaten Way Kanan</li>
                    </ul>
                </div>

                <div class="mb-8">
                    <h4 class="text-xl font-semibold text-secondary mb-3">Visi</h4>
                    <p class="text-gray-600 mb-4">
                        Obat dan Makanan aman, bermutu, dan berdaya saing untuk mewujudkan Indonesia maju yang berdaulat,
                        mandiri, dan berkepribadian berlandaskan gotong royong.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-xl font-semibold text-secondary mb-3">Misi</h4>
                    <ul class="list-disc list-inside text-gray-600 space-y-2">
                        <li>Membangun SDM unggul terkait Obat dan Makanan dengan mengembangkan kemitraan bersama seluruh komponen bangsa.</li>
                        <li>Memfasilitasi percepatan pengembangan dunia usaha Obat dan Makanan dengan keberpihakan terhadap UMKM.</li>
                        <li>Meningkatkan efektivitas pengawasan dan penindakan kejahatan Obat dan Makanan melalui sinergi pemerintah pusat dan daerah.</li>
                        <li>Pengelolaan pemerintahan yang bersih, efektif, dan terpercaya di bidang Obat dan Makanan.</li>
                    </ul>
                </div>
            </div>
            
            <div class="bg-gray-100 p-8 rounded-2xl">
                <h4 class="text-xl font-semibold text-primary mb-4">Tugas & Fungsi</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li>Penyusunan rencana, program, dan anggaran di bidang pengawasan Obat dan Makanan.</li>
                    <li>Pelaksanaan pemeriksaan fasilitas produksi dan distribusi Obat dan Makanan serta fasilitas pelayanan kefarmasian.</li>
                    <li>Pelaksanaan sertifikasi produk dan fasilitas produksi/distribusi Obat dan Makanan.</li>
                    <li>Pelaksanaan sampling, pengujian rutin, dan pengujian investigasi Obat dan Makanan.</li>
                    <li>Pelaksanaan pemantauan label, iklan, dan peredaran Obat dan Makanan melalui siber.</li>
                    <li>Pelaksanaan cegah tangkal, intelijen, dan penyidikan pelanggaran ketentuan peraturan perundangan.</li>
                    <li>Pengelolaan komunikasi, informasi, edukasi, dan pengaduan masyarakat.</li>
                    <li>Pelaksanaan kerja sama, pemantauan, evaluasi, dan pelaporan di bidang pengawasan Obat dan Makanan.</li>
                    <li>Pelaksanaan urusan tata usaha dan rumah tangga.</li>
                </ul>
            </div>
        </div>
    </div>
</section>


    <!-- Manfaat Section -->
    <section id="manfaat" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Manfaat PKL</h2>
                <p class="text-xl text-gray-600">Keuntungan yang akan Anda dapatkan selama program PKL</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengetahuan</h3>
                    <p class="text-gray-600">Mahasiswa akan diberikan pengetahuan yang baru dan akan bermanfaat untuk Mahasiswa kedepannya.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengalaman</h3>
                    <p class="text-gray-600">Suatu kesempatan yang bagus untuk menambah pengalaman yang sangat berguna dikemudian hari.</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Sertifikat</h3>
                    <p class="text-gray-600">Mahasiswa akan mendapatkan sertifikat resmi dan bisa digunakan untuk menambah portfolio Mahasiswa.</p>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Peraturan Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Peraturan PKL</h2>
                <p class="text-xl text-gray-600">Ketentuan yang harus dipahami dan dipatuhi peserta PKL</p>
            </div>
            
                <div class="max-w-4xl mx-auto">
                <div class="bg-gray-50 p-8 rounded-2xl">
                    <ul class="space-y-6 text-gray-700">
                        
                        <!-- Tata Tertib -->
                        <li>
                            <h3 class="text-xl font-semibold text-primary mb-2">Tata Tertib</h3>
                            <p>Mematuhi hari dan jam kerja:</p>
                            <ul class="list-disc list-inside ml-4">
                                <li>Senin–Kamis: 08.00 – 16.30 (Istirahat 12.00 – 12.45 WIB)</li>
                                <li>Jumat: 08.00 – 16.00 (Istirahat 12.00 – 13.15 WIB)</li>
                            </ul>
                        </li>

                        <!-- Kehadiran -->
                        <li>
                            <h3 class="text-xl font-semibold text-primary mb-2">Kehadiran</h3>
                            <p>Wajib mengisi daftar hadir dan tidak terlambat. Memberitahu apabila berhalangan hadir dikarenakan terlambat, izin, sakit, atau pulang sebelum waktunya kepada Penyelia/PJ PKL.</p>
                        </li>

                        <!-- Kegiatan -->
                        <li>
                            <h3 class="text-xl font-semibold text-primary mb-2">Kegiatan</h3>
                            <p>Wajib mengikuti kegiatan di lingkungan Balai Besar POM di Bandar Lampung seperti Upacara/Apel pada hari besar nasional, Senam, Perayaan, dan kegiatan lainnya jika diperlukan.</p>
                        </li>

                        <!-- Komitmen -->
                        <li>
                            <h3 class="text-xl font-semibold text-primary mb-2">Komitmen</h3>
                            <p>Tidak sedang mengikuti program lain di luar PKL yang dapat mengganggu konsentrasi.</p>
                        </li>

                        <!-- Pakaian -->
                        <li>
                            <h3 class="text-xl font-semibold text-primary mb-2">Pakaian</h3>
                            <p>Berpakaian rapi dan formal, tidak memakai kaos dan celana jeans. Wajib memakai jas lab ketika praktikum dan sepatu selama berada di lingkungan kantor.</p>
                        </li>

                        <!-- Kerahasiaan Informasi -->
                        <li>
                            <h3 class="text-xl font-semibold text-primary mb-2">Kerahasian Informasi</h3>
                            <p>Tidak mengambil foto, gambar, atau video yang berkaitan dengan kegiatan laboratorium/kantor tanpa seizin BBPOM di Bandar Lampung dan menyebarkannya di karya tulis atau media sosial apapun.</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>


    <!-- Team Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Tim SIP-PKL</h2>
                <p class="text-xl text-gray-600">Para ahli yang akan membimbing perjalanan PKL Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-1.jpeg') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tuti Nurhayati, S.Si Apt.</h3>
                    <p class="text-gray-600 text-sm">Penanggung Jawab</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-secondary rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-2.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Sofia Masroh, S.Farm, Apt. M.Si</h3>
                    <p class="text-gray-600 text-sm">MT Laboratorium</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-yellow-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-3.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Asih Sukowati, STP.</h3>
                    <p class="text-gray-600 text-sm">Penyelia Lab. Kimia Pangan</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-4.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Pricellya, S.Farm, Apt.</h3>
                    <p class="text-gray-600 text-sm">Penyelia Lab. Kimia Obat</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-5.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Nurul Ilmiyati, S.Farm, Apt.,M.Sc</h3>
                    <p class="text-gray-600 text-sm">Penyelia Lab. Kimia Kosmetik</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-6.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Ega Syifania Fattonah, S.Farm, Apt.</h3>
                    <p class="text-gray-600 text-sm">Penyelia Lab. Kimia OT-SK</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-7.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Titian Suryawati Agustina, S.Si., M.Sc</h3>
                    <p class="text-gray-600 text-sm">Penyelia Lab. Mikrobiologi Obat dan Pangan</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-8.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Asih Ratna Utami, S.TP</h3>
                    <p class="text-gray-600 text-sm">Penyelia Lab. Mikrobiologi Kosmetik, OT-SK dan Obat Kuasi</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-9.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Bambang Supriyadi, S.Si, M.Eng</h3>
                    <p class="text-gray-600 text-sm">Tim IT/Admin 1</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('img/tim/tim-10.png') }}" alt="tim-1" class="rounded-full h-full w-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tri Setiawan, S.Kom</h3>
                    <p class="text-gray-600 text-sm">Tim IT/Admin 2</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dokumentasi Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Dokumentasi Kegiatan PKL</h2>
                <p class="text-xl text-gray-600">Momen-momen berharga selama program PKL</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-1.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-2.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-3.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-4.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-5.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-6.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-7.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <img src="{{ asset('img/dokumentasi/dokumentasi-8.jpeg') }}" alt="dokumentasi-1" class="w-full h-full object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Frequently Asked Questions</h2>
                <p class="text-xl text-gray-600">Jawaban untuk pertanyaan yang sering diajukan</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="space-y-4">
                    <div class="bg-white rounded-lg shadow-md">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center faq-btn">
                            <span class="font-semibold text-gray-800">Berapa lama durasi program PKL?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="px-6 pb-4 hidden faq-content">
                            <p class="text-gray-600">Program PKL di BBPOM Bandar Lampung berlangsung selama 2-3 bulan, disesuaikan dengan kurikulum universitas masing-masing peserta.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center faq-btn">
                            <span class="font-semibold text-gray-800">Apakah tersedia tempat tinggal untuk peserta PKL?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="px-6 pb-4 hidden faq-content">
                            <p class="text-gray-600">BBPOM tidak menyediakan asrama. Peserta diharapkan mencari tempat tinggal sendiri atau kami dapat membantu memberikan informasi kost/kontrakan terdekat.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center faq-btn">
                            <span class="font-semibold text-gray-800">Kapan periode pendaftaran dibuka?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="px-6 pb-4 hidden faq-content">
                            <p class="text-gray-600">Pendaftaran dibuka 3 kali dalam setahun: Januari-Februari, Mei-Juni, dan September-Oktober. Informasi lengkap akan diumumkan melalui website resmi.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center faq-btn">
                            <span class="font-semibold text-gray-800">Apakah ada biaya untuk mengikuti program PKL?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="px-6 pb-4 hidden faq-content">
                            <p class="text-gray-600">Program PKL di BBPOM Bandar Lampung tidak dikenakan biaya. Namun, peserta menanggung biaya transportasi, akomodasi, dan kebutuhan pribadi selama PKL.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md">
                        <button class="w-full px-6 py-4 text-left flex justify-between items-center faq-btn">
                            <span class="font-semibold text-gray-800">Jurusan apa saja yang dapat mengikuti PKL?</span>
                            <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="px-6 pb-4 hidden faq-content">
                            <p class="text-gray-600">Jurusan yang dapat mengikuti PKL antara lain: Farmasi, Teknologi Pangan, Kimia, Biologi, Gizi, dan jurusan terkait lainnya sesuai dengan kebutuhan divisi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Hubungi Kami</h2>
                <p class="text-xl text-gray-600">Siap membantu Anda dalam proses pendaftaran PKL</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Alamat</h3>
                                <p class="text-gray-600">Jl. Dr. Susilo No. 105, Pahoman, Bandar Lampung</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Telepon</h3>
                                <p class="text-gray-600">+62 821-8080-6008</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Email</h3>
                                <p class="text-gray-600">bpomlampung@gmail.com</p>
                                <p class="text-gray-600">lampung@pom.go.id</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Website</h3>
                                <p class="text-gray-600">www.lampung.pom.go.id</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-2xl">
                    <h3 class="text-2xl font-bold text-primary mb-6">Kirim Pesan</h3>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                            <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-primary hover:bg-purple-800 text-white py-3 rounded-lg font-semibold transition">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <img src="{{ asset('img/bpom-logo-500x500.png') }}" alt="Logo BBPOM" class="h-full w-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">SIP-PKL</h3>
                            <p class="text-sm opacity-80">BBPOM Bandar Lampung</p>
                        </div>
                    </div>
                    <p class="text-sm opacity-80 leading-relaxed">
                        Sistem informasi modern untuk memudahkan proses pengajuan dan pengelolaan Praktik Kerja Lapangan di BBPOM Bandar Lampung.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="#beranda" class="hover:opacity-100 transition">Beranda</a></li>
                        <li><a href="#formasi" class="hover:opacity-100 transition">Formasi PKL</a></li>
                        <li><a href="#profil" class="hover:opacity-100 transition">Profil</a></li>
                        <li><a href="#manfaat" class="hover:opacity-100 transition">Manfaat</a></li>
                        <li><a href="#kontak" class="hover:opacity-100 transition">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Website Kami</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="https://lampung.pom.go.id/" class="hover:opacity-100 transition" target="_blank">Subsite BBPOM Lampung</a></li>
                        <li><a href="https://bpomlampung.net/sipelanal/" class="hover:opacity-100 transition" target="_blank">Sipelanal</a></li>
                        <li><a href="https://bpomlampung.net/sikam/" class="hover:opacity-100 transition" target="_blank">SIKAM</a></li>
                        <li><a href="https://bit.ly/SurveiKepuasanBPOM" class="hover:opacity-100 transition" target="_blank">Data Layanan Terintegrasi</a></li>
                        <li><a href="https://bit.ly/SurveiKepuasanBPOM" class="hover:opacity-100 transition" target="_blank">SKM</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <div class="space-y-3 text-sm opacity-80">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Bandar Lampung, Lampung</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            <span>+62 821-8080-6008</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span>bpomlampung@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white border-opacity-20 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-sm">
                            © 2025 <span class="font-semibold">BBPOM Bandar Lampung</span> 

                        </p>
                        <p class="text-sm">
                            Developed by 
                            <a href="https://github.com/wyanns-404" 
                            class="text-white font-bold hover:underline hover:text-purple-400 decoration-transparent transition">
                            @wyanns
                            </a>
                        </p>

                    <p class="text-sm opacity-80 mb-0 mt-4 md:mb-0">
                        
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
</body>
</html>