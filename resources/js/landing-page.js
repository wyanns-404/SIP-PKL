// Sample formasi data
const formasiData = [
    {
        nama: "Analis Laboratorium Mikrobiologi",
        deskripsi:
            "Melakukan analisis mikrobiologi terhadap sampel makanan dan obat-obatan untuk memastikan keamanan dan kualitas produk.",
        posisi: "Laboratory Analyst",
        lokasi: "Laboratorium BBPOM Bandar Lampung",
        periode: "3 Bulan (Januari - Maret 2025)",
        batas: "15 Desember 2024",
        jenjang: "S1",
        jurusan: "Biologi, Mikrobiologi, Farmasi",
        kuota: 2,
    },
    {
        nama: "Analis Laboratorium Kimia",
        deskripsi:
            "Menganalisis kandungan kimia dalam produk makanan dan obat menggunakan instrumen analitik modern.",
        posisi: "Chemical Analyst",
        lokasi: "Laboratorium BBPOM Bandar Lampung",
        periode: "3 Bulan (Februari - April 2025)",
        batas: "20 Januari 2025",
        jenjang: "S1",
        jurusan: "Kimia, Farmasi, Teknologi Pangan",
        kuota: 3,
    },
    {
        nama: "Inspektur Sarana Produksi",
        deskripsi:
            "Melakukan inspeksi terhadap fasilitas produksi makanan dan obat untuk memastikan compliance terhadap regulasi.",
        posisi: "Production Inspector",
        lokasi: "Wilayah Kerja Lampung",
        periode: "2 Bulan (Maret - April 2025)",
        batas: "28 Februari 2025",
        jenjang: "S1",
        jurusan: "Farmasi, Teknologi Pangan, Teknik Industri",
        kuota: 2,
    },
    {
        nama: "Admin Sistem Informasi",
        deskripsi:
            "Membantu pengelolaan sistem informasi dan database untuk mendukung operasional BBPOM.",
        posisi: "IT Support",
        lokasi: "Kantor BBPOM Bandar Lampung",
        periode: "2 Bulan (April - Mei 2025)",
        batas: "15 Maret 2025",
        jenjang: "D3/S1",
        jurusan: "Teknik Informatika, Sistem Informasi",
        kuota: 1,
    },
    {
        nama: "Analis Keamanan Pangan",
        deskripsi:
            "Melakukan evaluasi keamanan pangan dan risk assessment terhadap produk makanan beredar.",
        posisi: "Food Safety Analyst",
        lokasi: "Laboratorium & Lapangan",
        periode: "3 Bulan (Mei - Juli 2025)",
        batas: "10 April 2025",
        jenjang: "S1",
        jurusan: "Teknologi Pangan, Gizi, Kesehatan Masyarakat",
        kuota: 2,
    },
    {
        nama: "Surveyor Pasar",
        deskripsi:
            "Melakukan survey dan sampling produk di pasar tradisional dan modern untuk pengawasan post market.",
        posisi: "Market Surveyor",
        lokasi: "Pasar & Retail Lampung",
        periode: "2 Bulan (Juni - Juli 2025)",
        batas: "25 Mei 2025",
        jenjang: "D3/S1",
        jurusan: "Farmasi, Kesehatan Masyarakat",
        kuota: 3,
    },
    {
        nama: "Research Assistant",
        deskripsi:
            "Membantu kegiatan penelitian dan pengembangan metode analisis di laboratorium BBPOM.",
        posisi: "Research Support",
        lokasi: "Laboratorium Penelitian",
        periode: "4 Bulan (Juli - Oktober 2025)",
        batas: "15 Juni 2025",
        jenjang: "S1",
        jurusan: "Kimia, Biologi, Farmasi",
        kuota: 1,
    },
    {
        nama: "Public Relations Assistant",
        deskripsi:
            "Membantu kegiatan komunikasi publik dan edukasi masyarakat tentang keamanan obat dan makanan.",
        posisi: "PR Support",
        lokasi: "Divisi Humas BBPOM",
        periode: "2 Bulan (Agustus - September 2025)",
        batas: "20 Juli 2025",
        jenjang: "S1",
        jurusan: "Komunikasi, Jurnalistik, Public Relations",
        kuota: 1,
    },
];

let currentPage = 1;
const itemsPerPage = 6;

function renderFormasi() {
    const grid = document.getElementById("formasi-grid");
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentItems = formasiData.slice(startIndex, endIndex);

    if (formasiData.length === 0) {
        grid.innerHTML = `
            <div class="col-span-full flex justify-center py-16">
                <div class="bg-white rounded-xl shadow-lg p-10 max-w-md w-full text-center border border-gray-100">
                    <!-- Icon -->
                    <div class="bg-blue-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-6h13M9 5v.01M15 19l-7-7 7-7" />
                        </svg>
                    </div>

                    <!-- Judul -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        Belum Ada Formasi PKL
                    </h2>

                    <!-- Deskripsi -->
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Saat ini belum ada formasi PKL yang tersedia.<br>
                        Silakan cek kembali di lain waktu atau hubungi pihak admin untuk informasi lebih lanjut.
                    </p>

                    <!-- Tombol Aksi -->
                    <div class="flex gap-3 justify-center">
                        <button onclick="location.reload()" 
                            class="px-4 py-2 bg-blue-500 text-white text-sm rounded-lg shadow hover:bg-blue-600 transition">
                            🔄 Muat Ulang
                        </button>
                        <a href="mailto:admin@example.com" 
                            class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg shadow hover:bg-gray-200 transition">
                            📩 Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        `;
        document.getElementById("pagination").innerHTML = ""; // kosongkan pagination
        return;
    }

    grid.innerHTML = currentItems
        .map(
            (formasi) => `
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
            `
        )
        .join("");
}

function renderPagination() {
    const pagination = document.getElementById("pagination");
    const totalPages = Math.ceil(formasiData.length / itemsPerPage);

    let paginationHTML = "";

    // Previous button
    if (currentPage > 1) {
        paginationHTML += `
                    <button onclick="changePage(${
                        currentPage - 1
                    })" class="px-3 py-2 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
                        Prev
                    </button>
                `;
    }

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        paginationHTML += `
                    <button onclick="changePage(${i})" class="px-3 py-2 ${
            i === currentPage
                ? "bg-primary text-white"
                : "text-primary border border-primary hover:bg-primary hover:text-white"
        } rounded-lg transition">
                        ${i}
                    </button>
                `;
    }

    // Next button
    if (currentPage < totalPages) {
        paginationHTML += `
                    <button onclick="changePage(${
                        currentPage + 1
                    })" class="px-3 py-2 text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition">
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
    document.getElementById("formasi").scrollIntoView({ behavior: "smooth" });
}

// FAQ functionality
document.addEventListener("DOMContentLoaded", function () {
    renderFormasi();
    renderPagination();

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    mobileMenuBtn.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });

    // FAQ toggle
    const faqBtns = document.querySelectorAll(".faq-btn");
    faqBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            const content = this.parentNode.querySelector(".faq-content");
            const arrow = this.querySelector("svg");

            content.classList.toggle("hidden");
            arrow.classList.toggle("rotate-180");

            // Close other FAQs
            faqBtns.forEach((otherBtn) => {
                if (otherBtn !== btn) {
                    const otherContent =
                        otherBtn.parentNode.querySelector(".faq-content");
                    const otherArrow = otherBtn.querySelector("svg");
                    otherContent.classList.add("hidden");
                    otherArrow.classList.remove("rotate-180");
                }
            });
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Close mobile menu when clicking on links
    document.querySelectorAll("#mobile-menu a").forEach((link) => {
        link.addEventListener("click", function () {
            mobileMenu.classList.add("hidden");
        });
    });
});
