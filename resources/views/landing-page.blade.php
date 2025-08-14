<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-PKL - BBPOM Bandar Lampung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script>
        if (typeof tailwind !== 'undefined') {
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#28166F',
                            secondary: '#00923F',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Reset dan base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f9fafb;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom colors */
        .gradient-bg {
            background: linear-gradient(135deg, #28166F 0%, #00923F 100%);
        }
        
        .text-primary { color: #28166F !important; }
        .bg-primary { background-color: #28166F !important; }
        .border-primary { border-color: #28166F !important; }
        .text-secondary { color: #00923F !important; }
        .bg-secondary { background-color: #00923F !important; }
        
        /* Hover states */
        .hover\:bg-primary:hover { background-color: #1e0d4f !important; }
        .hover\:text-primary:hover { color: #28166F !important; }
        .hover\:bg-purple-800:hover { background-color: #1e0d4f !important; }
        .hover\:bg-green-600:hover { background-color: #047857 !important; }
        
        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Utility classes backup */
        .container { max-width: 1200px; margin: 0 auto; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }
        .py-12 { padding-top: 3rem; padding-bottom: 3rem; }
        .py-16 { padding-top: 4rem; padding-bottom: 4rem; }
        .py-20 { padding-top: 5rem; padding-bottom: 5rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .px-8 { padding-left: 2rem; padding-right: 2rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mb-12 { margin-bottom: 3rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-4 { margin-top: 1rem; }
        
        .text-center { text-align: center; }
        .text-left { text-left: left; }
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }
        
        .text-sm { font-size: 0.875rem; }
        .text-lg { font-size: 1.125rem; }
        .text-xl { font-size: 1.25rem; }
        .text-2xl { font-size: 1.5rem; }
        .text-3xl { font-size: 1.875rem; }
        .text-4xl { font-size: 2.25rem; }
        .text-6xl { font-size: 3.75rem; }
        
        .text-white { color: #ffffff; }
        .text-gray-600 { color: #6b7280; }
        .text-gray-700 { color: #4b5563; }
        .text-gray-800 { color: #1f2937; }
        .text-gray-500 { color: #9ca3af; }
        .text-red-600 { color: #dc2626; }
        .text-yellow-300 { color: #fcd34d; }
        
        .bg-white { background-color: #ffffff; }
        .bg-gray-50 { background-color: #f9fafb; }
        .bg-gray-100 { background-color: #f3f4f6; }
        .bg-gray-200 { background-color: #e5e7eb; }
        .bg-yellow-500 { background-color: #eab308; }
        .bg-purple-500 { background-color: #8b5cf6; }
        .bg-indigo-500 { background-color: #6366f1; }
        .bg-pink-500 { background-color: #ec4899; }
        
        .rounded { border-radius: 0.25rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-2xl { border-radius: 1rem; }
        .rounded-full { border-radius: 9999px; }
        
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        
        .flex { display: flex; }
        .grid { display: grid; }
        .hidden { display: none; }
        .block { display: block; }
        .inline-block { display: inline-block; }
        
        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        
        .space-x-2 > * + * { margin-left: 0.5rem; }
        .space-x-3 > * + * { margin-left: 0.75rem; }
        .space-x-4 > * + * { margin-left: 1rem; }
        .space-x-6 > * + * { margin-left: 1.5rem; }
        .space-y-2 > * + * { margin-top: 0.5rem; }
        .space-y-3 > * + * { margin-top: 0.75rem; }
        .space-y-4 > * + * { margin-top: 1rem; }
        .space-y-8 > * + * { margin-top: 2rem; }
        
        .w-full { width: 100%; }
        .w-6 { width: 1.5rem; }
        .w-8 { width: 2rem; }
        .w-10 { width: 2.5rem; }
        .w-12 { width: 3rem; }
        .w-20 { width: 5rem; }
        .w-24 { width: 6rem; }
        .h-6 { height: 1.5rem; }
        .h-8 { height: 2rem; }
        .h-10 { height: 2.5rem; }
        .h-12 { height: 3rem; }
        .h-20 { height: 5rem; }
        .h-24 { height: 6rem; }
        .h-48 { height: 12rem; }
        
        .border { border-width: 1px; }
        .border-t { border-top-width: 1px; }
        .border-2 { border-width: 2px; }
        .border-gray-200 { border-color: #e5e7eb; }
        .border-gray-300 { border-color: #d1d5db; }
        .border-white { border-color: #ffffff; }
        
        .sticky { position: sticky; }
        .top-0 { top: 0; }
        .relative { position: relative; }
        .absolute { position: absolute; }
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .z-10 { z-index: 10; }
        .z-50 { z-index: 50; }
        
        .overflow-hidden { overflow: hidden; }
        .cursor-pointer { cursor: pointer; }
        .leading-tight { line-height: 1.25; }
        .leading-relaxed { line-height: 1.625; }
        
        .opacity-10 { opacity: 0.1; }
        .opacity-80 { opacity: 0.8; }
        .opacity-90 { opacity: 0.9; }
        
        .transition { transition: all 0.15s ease-in-out; }
        .transform { transform: none; }
        .hover\:scale-105:hover { transform: scale(1.05); }
        .hover\:opacity-100:hover { opacity: 1; }
        .rotate-180 { transform: rotate(180deg); }
        
        /* Grid responsive */
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }
        .gap-8 { gap: 2rem; }
        .gap-12 { gap: 3rem; }
        
        .max-w-4xl { max-width: 56rem; }
        .max-w-6xl { max-width: 72rem; }
        
        /* Focus states */
        .focus\:ring-2:focus { box-shadow: 0 0 0 2px #28166F; }
        .focus\:border-transparent:focus { border-color: transparent; }
        
        /* Media queries for responsive */
        @media (min-width: 768px) {
            .md\:flex { display: flex; }
            .md\:hidden { display: none; }
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            .md\:text-2xl { font-size: 1.5rem; }
            .md\:text-6xl { font-size: 3.75rem; }
            .md\:mb-0 { margin-bottom: 0; }
            .md\:flex-row { flex-direction: row; }
        }
        
        @media (min-width: 1024px) {
            .lg\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }
        
        /* Flex direction */
        .flex-col { flex-direction: column; }
        .flex-row { flex-direction: row; }
        
        @media (min-width: 640px) {
            .sm\:flex-row { flex-direction: row; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Navigation -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
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
                    <button class="bg-primary hover:bg-purple-800 text-white px-4 py-2 rounded-lg transition">
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
                    BBPOM Bandar Lampung - Wujudkan Pengalaman Kerja Terbaik Anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-secondary hover:bg-green-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition transform hover:scale-105">
                        Daftar Sekarang
                    </button>
                    <button class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-lg text-lg font-semibold transition">
                        Pelajari Lebih Lanjut
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
                        <span class="text-3xl font-bold">127</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Total Peserta PKL</h3>
                    <p class="text-gray-600">Mahasiswa yang telah mengikuti program</p>
                </div>
                <div class="text-center">
                    <div class="bg-secondary text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold">24</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Sedang PKL</h3>
                    <p class="text-gray-600">Mahasiswa yang sedang menjalankan PKL</p>
                </div>
                <div class="text-center">
                    <div class="bg-yellow-500 text-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl font-bold">12</span>
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
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-bold text-primary mb-4">Tentang Kami</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Balai Besar Pengawas Obat dan Makanan (BBPOM) di Bandar Lampung merupakan Unit Pelaksana Teknis dari Badan Pengawas Obat dan Makanan yang bertugas melaksanakan kebijakan di bidang pengawasan obat dan makanan.
                    </p>
                    
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold text-secondary mb-3">Visi</h4>
                        <p class="text-gray-600 mb-4">
                            Obat dan Makanan aman, bermutu, dan bermanfaat bagi kesehatan masyarakat.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="text-xl font-semibold text-secondary mb-3">Misi</h4>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Meningkatkan perlindungan masyarakat dari risiko obat dan makanan yang tidak memenuhi syarat</li>
                            <li>• Meningkatkan daya saing obat dan makanan Indonesia</li>
                            <li>• Meningkatkan kapabilitas dan kredibilitas pengawasan obat dan makanan</li>
                        </ul>
                    </div>
                </div>
                
                <div class="bg-gray-100 p-8 rounded-2xl">
                    <h4 class="text-xl font-semibold text-primary mb-4">Tugas & Fungsi</h4>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                            <p class="text-gray-600">Pengawasan produk obat dan makanan</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                            <p class="text-gray-600">Sertifikasi dan registrasi produk</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                            <p class="text-gray-600">Pembinaan dan penyuluhan kepada masyarakat</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                            <p class="text-gray-600">Penegakan hukum di bidang obat dan makanan</p>
                        </div>
                    </div>
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
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengalaman Praktis</h3>
                    <p class="text-gray-600">Mendapatkan pengalaman kerja langsung di bidang pengawasan obat dan makanan</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Networking</h3>
                    <p class="text-gray-600">Membangun jaringan profesional dengan para ahli di bidang farmasi dan pangan</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Sertifikat</h3>
                    <p class="text-gray-600">Memperoleh sertifikat resmi yang dapat menunjang karir profesional</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Skill Development</h3>
                    <p class="text-gray-600">Mengembangkan kemampuan analisis, penelitian, dan pengawasan kualitas</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengenalan Sistem</h3>
                    <p class="text-gray-600">Memahami sistem pengawasan dan regulasi obat dan makanan di Indonesia</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-pink-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Bimbingan Ahli</h3>
                    <p class="text-gray-600">Mendapat bimbingan langsung dari praktisi berpengalaman</p>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold text-primary mb-4">Persyaratan Umum</h3>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>Mahasiswa aktif minimal semester 5</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>IPK minimal 3.0</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>Surat pengantar dari universitas</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>CV dan transkrip nilai</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-semibold text-primary mb-4">Kewajiban Peserta</h3>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>Mematuhi jam kerja yang ditetapkan</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>Menggunakan seragam yang telah ditentukan</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>Membuat laporan kegiatan harian</span>
                                </li>
                                <li class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-secondary rounded-full mt-2"></div>
                                    <span>Menjaga kerahasiaan informasi</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-primary mb-4">Tim Pembimbing</h2>
                <p class="text-xl text-gray-600">Para ahli yang akan membimbing perjalanan PKL Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">DR</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Dr. Siti Aminah</h3>
                    <p class="text-secondary font-medium mb-2">Kepala BBPOM</p>
                    <p class="text-gray-600 text-sm">Spesialis Farmasi Klinik</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-secondary rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">AP</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Apt. Budi Santoso</h3>
                    <p class="text-secondary font-medium mb-2">Koordinator PKL</p>
                    <p class="text-gray-600 text-sm">Apoteker Senior</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-yellow-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">MS</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">M.Si. Rina Wati</h3>
                    <p class="text-secondary font-medium mb-2">Supervisor Laboratorium</p>
                    <p class="text-gray-600 text-sm">Analis Pangan</p>
                </div>
                
                <div class="bg-white p-6 rounded-xl text-center card-hover">
                    <div class="w-24 h-24 bg-purple-500 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">ST</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">S.T. Ahmad Fadli</h3>
                    <p class="text-secondary font-medium mb-2">Pembimbing Teknis</p>
                    <p class="text-gray-600 text-sm">Teknologi Pangan</p>
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
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Laboratorium Analisis</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Kegiatan Seminar</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Field Trip</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Presentasi Hasil</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Workshop</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Pelatihan</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Sertifikasi</p>
                    </div>
                </div>
                
                <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center card-hover cursor-pointer">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-sm">Acara Penutupan</p>
                    </div>
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
                                <p class="text-gray-600">Jl. Soekarno Hatta No.10, Rajabasa Bandar Lampung, Lampung 35144</p>
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
                                <p class="text-gray-600">(0721) 787738</p>
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
                                <p class="text-gray-600">pkl@pom.go.id</p>
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
                                <p class="text-gray-600">www.pom.go.id</p>
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Universitas</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
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
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
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
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="#" class="hover:opacity-100 transition">Panduan Pendaftaran</a></li>
                        <li><a href="#" class="hover:opacity-100 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:opacity-100 transition">FAQ</a></li>
                        <li><a href="#kontak" class="hover:opacity-100 transition">Kontak</a></li>
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
                            <span>(0721) 787738</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <span>pkl@pom.go.id</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white border-opacity-20 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm opacity-80 mb-4 md:mb-0">
                        © 2025 BBPOM Bandar Lampung. All rights reserved.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-white hover:text-yellow-300 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-yellow-300 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-yellow-300 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.89 2.75.097.118.112.222.083.343-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-yellow-300 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Sample formasi data
        const formasiData = [
            {
                nama: "Analis Laboratorium Mikrobiologi",
                deskripsi: "Melakukan analisis mikrobiologi terhadap sampel makanan dan obat-obatan untuk memastikan keamanan dan kualitas produk.",
                posisi: "Laboratory Analyst",
                lokasi: "Laboratorium BBPOM Bandar Lampung",
                periode: "3 Bulan (Januari - Maret 2025)",
                batas: "15 Desember 2024",
                jenjang: "S1",
                jurusan: "Biologi, Mikrobiologi, Farmasi",
                kuota: 2
            },
            {
                nama: "Analis Laboratorium Kimia",
                deskripsi: "Menganalisis kandungan kimia dalam produk makanan dan obat menggunakan instrumen analitik modern.",
                posisi: "Chemical Analyst",
                lokasi: "Laboratorium BBPOM Bandar Lampung",
                periode: "3 Bulan (Februari - April 2025)",
                batas: "20 Januari 2025",
                jenjang: "S1",
                jurusan: "Kimia, Farmasi, Teknologi Pangan",
                kuota: 3
            },
            {
                nama: "Inspektur Sarana Produksi",
                deskripsi: "Melakukan inspeksi terhadap fasilitas produksi makanan dan obat untuk memastikan compliance terhadap regulasi.",
                posisi: "Production Inspector",
                lokasi: "Wilayah Kerja Lampung",
                periode: "2 Bulan (Maret - April 2025)",
                batas: "28 Februari 2025",
                jenjang: "S1",
                jurusan: "Farmasi, Teknologi Pangan, Teknik Industri",
                kuota: 2
            },
            {
                nama: "Admin Sistem Informasi",
                deskripsi: "Membantu pengelolaan sistem informasi dan database untuk mendukung operasional BBPOM.",
                posisi: "IT Support",
                lokasi: "Kantor BBPOM Bandar Lampung",
                periode: "2 Bulan (April - Mei 2025)",
                batas: "15 Maret 2025",
                jenjang: "D3/S1",
                jurusan: "Teknik Informatika, Sistem Informasi",
                kuota: 1
            },
            {
                nama: "Analis Keamanan Pangan",
                deskripsi: "Melakukan evaluasi keamanan pangan dan risk assessment terhadap produk makanan beredar.",
                posisi: "Food Safety Analyst",
                lokasi: "Laboratorium & Lapangan",
                periode: "3 Bulan (Mei - Juli 2025)",
                batas: "10 April 2025",
                jenjang: "S1",
                jurusan: "Teknologi Pangan, Gizi, Kesehatan Masyarakat",
                kuota: 2
            },
            {
                nama: "Surveyor Pasar",
                deskripsi: "Melakukan survey dan sampling produk di pasar tradisional dan modern untuk pengawasan post market.",
                posisi: "Market Surveyor",
                lokasi: "Pasar & Retail Lampung",
                periode: "2 Bulan (Juni - Juli 2025)",
                batas: "25 Mei 2025",
                jenjang: "D3/S1",
                jurusan: "Farmasi, Kesehatan Masyarakat",
                kuota: 3
            },
            {
                nama: "Research Assistant",
                deskripsi: "Membantu kegiatan penelitian dan pengembangan metode analisis di laboratorium BBPOM.",
                posisi: "Research Support",
                lokasi: "Laboratorium Penelitian",
                periode: "4 Bulan (Juli - Oktober 2025)",
                batas: "15 Juni 2025",
                jenjang: "S1",
                jurusan: "Kimia, Biologi, Farmasi",
                kuota: 1
            },
            {
                nama: "Public Relations Assistant",
                deskripsi: "Membantu kegiatan komunikasi publik dan edukasi masyarakat tentang keamanan obat dan makanan.",
                posisi: "PR Support",
                lokasi: "Divisi Humas BBPOM",
                periode: "2 Bulan (Agustus - September 2025)",
                batas: "20 Juli 2025",
                jenjang: "S1",
                jurusan: "Komunikasi, Jurnalistik, Public Relations",
                kuota: 1
            }
        ];

        let currentPage = 1;
        const itemsPerPage = 6;

        function renderFormasi() {
            const grid = document.getElementById('formasi-grid');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentItems = formasiData.slice(startIndex, endIndex);

            grid.innerHTML = currentItems.map(formasi => `
                <div class="bg-white p-6 rounded-xl shadow-lg card-hover">
                    <div class="mb-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-semibold text-primary">${formasi.nama}</h3>
                            <span class="bg-secondary text-white text-xs px-2 py-1 rounded-full">${formasi.kuota} slot</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3">${formasi.deskripsi}</p>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span>${formasi.posisi}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>${formasi.lokasi}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>${formasi.periode}</span>
                        </div>
                        <div class="flex items-center text-red-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Batas: ${formasi.batas}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center text-sm">
                            <div>
                                <span class="text-gray-500">Jenjang:</span>
                                <span class="font-medium text-primary">${formasi.jenjang}</span>
                            </div>
                            <button class="bg-primary hover:bg-purple-800 text-white px-4 py-2 rounded-lg transition text-sm">
                                Daftar
                            </button>
                        </div>
                        <div class="mt-2">
                            <span class="text-gray-500 text-xs">Jurusan:</span>
                            <p class="text-xs text-gray-600">${formasi.jurusan}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function renderPagination() {
            const pagination = document.getElementById('pagination');
            const totalPages = Math.ceil(formasiData.length / itemsPerPage);

            let paginationHTML = '';

            // Previous button
            if (currentPage > 1) {
                paginationHTML += `
                    <button onclick="changePage(${currentPage - 1})" class="px-3 py-2 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
                        Prev
                    </button>
                `;
            }

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
                    <button onclick="changePage(${i})" class="px-3 py-2 ${i === currentPage ? 'bg-primary text-white' : 'text-primary border border-primary hover:bg-primary hover:text-white'} rounded-lg transition">
                        ${i}
                    </button>
                `;
            }

            // Next button
            if (currentPage < totalPages) {
                paginationHTML += `
                    <button onclick="changePage(${currentPage + 1})" class="px-3 py-2 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
                        Next
                    </button>
                `;
            }

            pagination.innerHTML = paginationHTML;
        }

        function changePage(page) {
            currentPage = page;
            renderFormasi();
            renderPagination();
            document.getElementById('formasi').scrollIntoView({ behavior: 'smooth' });
        }

        // FAQ functionality
        document.addEventListener('DOMContentLoaded', function() {
            renderFormasi();
            renderPagination();

            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // FAQ toggle
            const faqBtns = document.querySelectorAll('.faq-btn');
            faqBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const content = this.parentNode.querySelector('.faq-content');
                    const arrow = this.querySelector('svg');
                    
                    content.classList.toggle('hidden');
                    arrow.classList.toggle('rotate-180');
                    
                    // Close other FAQs
                    faqBtns.forEach(otherBtn => {
                        if (otherBtn !== btn) {
                            const otherContent = otherBtn.parentNode.querySelector('.faq-content');
                            const otherArrow = otherBtn.querySelector('svg');
                            otherContent.classList.add('hidden');
                            otherArrow.classList.remove('rotate-180');
                        }
                    });
                });
            });

            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Close mobile menu when clicking on links
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>