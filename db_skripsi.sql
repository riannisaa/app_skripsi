-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 08:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas_sidang_proposals`
--

CREATE TABLE `berkas_sidang_proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengajuan_dospem` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(25) NOT NULL,
  `jenis_sidang` varchar(35) NOT NULL,
  `buku_bimbingan` text NOT NULL,
  `khs` text NOT NULL,
  `kst` text NOT NULL,
  `video` text NOT NULL,
  `file_dokumen` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_sidang_skripsis`
--

CREATE TABLE `berkas_sidang_skripsis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengajuan_dospem` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(25) NOT NULL,
  `ktp_kk_akta` text NOT NULL,
  `pas_foto` text NOT NULL,
  `ijazah` text NOT NULL,
  `buku_bimbingan` text NOT NULL,
  `turnitin` text NOT NULL,
  `khs` text NOT NULL,
  `kst` text NOT NULL,
  `ukt` text NOT NULL,
  `file_dokumen` text NOT NULL,
  `video` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_topik`
--

CREATE TABLE `data_topik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `peminatan` varchar(255) NOT NULL,
  `topik` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `kapasitas` int(11) NOT NULL DEFAULT 5,
  `peserta` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_topik`
--

INSERT INTO `data_topik` (`id`, `jurusan`, `peminatan`, `topik`, `ket`, `kapasitas`, `peserta`, `created_at`, `updated_at`) VALUES
(1, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Aplikasi Manajemen Data Mahasiswa', 'Buat aplikasi yang membantu universitas atau perguruan tinggi dalam manajemen data mahasiswa, termasuk informasi pendaftaran, perkembangan akademis, dan administrasi.', 5, 0, NULL, NULL),
(2, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Sistem Manajemen Inventaris', 'Teliti tentang cara mengembangkan perangkat lunak yang dapat membantu perusahaan dalam manajemen inventaris mereka dengan lebih efektif dan efisien.', 5, 0, NULL, NULL),
(3, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Aplikasi Kesehatan', 'Buat aplikasi yang berkaitan dengan sektor kesehatan, seperti pelacakan kesehatan pribadi, manajemen janji dokter, atau sistem informasi rumah sakit.', 5, 0, NULL, NULL),
(4, 'S1 Sistem Informasi', 'Software Developer', 'Keamanan Sistem Informasi', 'Fokus pada pengembangan sistem untuk keamanan data dan informasi dari serangan siber.', 5, 0, NULL, NULL),
(5, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Aplikasi Keuangan', 'Buat aplikasi yang membantu pengguna dalam manajemen keuangan pribadi atau bisnis, termasuk pelacakan pengeluaran, anggaran, dan pelaporan keuangan', 5, 0, NULL, NULL),
(6, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Chatbot untuk Dukungan Pelanggan', 'Teliti tentang penggunaan chatbot dalam memberikan dukungan pelanggan yang lebih baik dan efisien.', 5, 0, NULL, NULL),
(7, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Sistem Informasi Geografis (GIS)', 'Buat aplikasi atau sistem yang memanfaatkan data geospasial untuk pemetaan, pemantauan, atau analisis wilayah tertentu.', 5, 0, NULL, NULL),
(8, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Aplikasi Bisnis Berbasis Cloud', 'Teliti tentang pengembangan perangkat lunak berbasis cloud untuk membantu bisnis mengelola proses bisnis mereka secara lebih efisien.', 5, 0, NULL, NULL),
(9, 'S1 Sistem Informasi', 'Software Developer', 'Analisis dan Visualisasi Data untuk Pengambilan Keputusan', 'Fokus pada pengembangan perangkat lunak yang mampu menganalisis dan menghasilkan visualisasi data yang memudahkan pengambilan keputusan.', 5, 0, NULL, NULL),
(10, 'S1 Sistem Informasi', 'Software Developer', 'Pengembangan Aplikasi e-Commerce', 'Buat platform e-commerce atau toko online yang menggabungkan fitur-fitur inovatif seperti personalisasi, sistem rekomendasi, atau integrasi pembayaran yang aman.', 5, 0, NULL, NULL),
(11, 'S1 Sistem Informasi', 'Software Developer', 'Sistem Manajemen Proyek Agile', 'Teliti tentang praktik pengembangan perangkat lunak berbasis Agile, seperti Scrum atau Kanban, dan bagaimana menerapkannya dalam proyek-proyek TI.', 5, 0, NULL, NULL),
(12, 'S1 Sistem Informasi', 'Software Developer', 'SCM', 'teliti tentang pendekatan strategis dalam mengelola aliran barang, layanan, informasi, dan dana dalam rantai pasokan dari pemasok hingga pelanggan akhir. Ini adalah elemen penting dalam operasi bisnis yang efisien dan terpadu. Pada penelitian ini di mulai dari proses perencanaan, pelaksanaan, dan pengendalian aliran barang, layanan, informasi, dan dana sepanjang rantai pasokan, dengan tujuan untuk mencapai efisiensi operasional, kepuasan pelanggan, dan keuntungan bisnis yang maksimal.', 5, 0, NULL, NULL),
(13, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Bisnis untuk Pengambilan Keputusan', 'Teliti tentang bagaimana data bisnis dapat digunakan untuk mendukung pengambilan keputusan strategis dalam sebuah organisasi.', 5, 0, NULL, NULL),
(14, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Keuangan', 'Buat analisis data dalam konteks keuangan, termasuk prediksi pasar saham, analisis risiko, atau pengelolaan portofolio investasi.', 5, 0, NULL, NULL),
(15, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Lingkungan', 'Fokus pada analisis data terkait lingkungan, seperti perubahan iklim, keanekaragaman hayati, atau penggunaan sumber daya alam.', 5, 0, NULL, NULL),
(16, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Log Aplikasi', 'Teliti tentang analisis data log aplikasi untuk memahami penggunaan pengguna, masalah kinerja, atau perbaikan produk.', 5, 0, NULL, NULL),
(17, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Pemasaran Digital', 'Buat studi tentang analisis data yang berhubungan dengan kampanye pemasaran digital dan strategi iklan online', 5, 0, NULL, NULL),
(18, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data dalam E-Commerce', 'Teliti tentang cara data dapat digunakan untuk meningkatkan pengalaman pelanggan dan mengoptimalkan operasi dalam bisnis e-commerce.', 5, 0, NULL, NULL),
(19, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Kesehatan', 'Buat penelitian tentang penggunaan data kesehatan elektronik untuk mengidentifikasi tren kesehatan masyarakat atau meningkatkan perawatan pasien.', 5, 0, NULL, NULL),
(20, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Data Keamanan Cyber', 'Fokus pada analisis data terkait keamanan siber dan pelacakan serangan siber dalam jaringan atau sistem.', 5, 0, NULL, NULL),
(21, 'S1 Sistem Informasi', 'Data Analyst', 'Analisis Sentimen Media Sosial', 'Teliti bagaimana analisis sentimen dapat digunakan untuk memahami pandangan dan opini publik melalui media sosial.', 5, 0, NULL, NULL),
(22, 'S1 Sistem Informasi', 'Data Analyst', 'Penggunaan Machine Learning dalam Analisis Data', 'Pelajari penerapan teknik machine learning untuk memprediksi tren atau mengidentifikasi pola dalam data bisnis atau industri tertentu', 5, 0, NULL, NULL),
(23, 'S1 Sistem Informasi', 'Data Analyst', 'Pengembangan Sistem Analisis Data Real-Time', 'Buat sistem yang mampu menganalisis data secara real-time untuk mendeteksi tren dan perubahan yang cepat dalam data.', 5, 0, NULL, NULL),
(24, 'S1 Sistem Informasi', 'IT Konsultan', 'Analisis Keamanan Informasi dan Manajemen Risiko', 'Teliti tentang praktik keamanan informasi yang efektif dan metode manajemen risiko dalam konteks perusahaan. Fokus pada identifikasi potensi risiko keamanan dan strategi mitigasi yang sesuai.', 5, 0, NULL, NULL),
(25, 'S1 Sistem Informasi', 'IT Konsultan', 'Penggunaan Keamanan Siber dalam Bisnis', 'Buat penelitian tentang kebijakan dan teknologi keamanan siber yang digunakan oleh organisasi dalam melindungi aset dan data sensitif mereka.', 5, 0, NULL, NULL),
(26, 'S1 Sistem Informasi', 'IT Konsultan', 'Manajemen Layanan TI (IT Service Management)', 'Teliti tentang praktik terbaik dalam manajemen layanan TI dan implementasinya dalam perusahaan untuk memastikan dukungan dan layanan TI yang lebih baik.', 5, 0, NULL, NULL),
(27, 'S1 Sistem Informasi', 'IT Konsultan', 'Pengembangan Aplikasi Mobile untuk Bisnis', 'Fokus pada pengembangan aplikasi mobile yang dapat membantu perusahaan meningkatkan keterlibatan pelanggan, layanan pelanggan, atau efisiensi internal', 5, 0, NULL, NULL),
(28, 'S1 Sistem Informasi', 'IT Konsultan', 'Implementasi Sistem CRM (Customer Relationship Management)', 'Buat penelitian tentang penggunaan sistem CRM dalam meningkatkan interaksi dengan pelanggan, retensi pelanggan, dan peningkatan kepuasan pelanggan', 5, 0, NULL, NULL),
(29, 'S1 Sistem Informasi', 'IT Konsultan', 'Analisis Big Data dan Bisnis Intelijen (Business Intelligence)', 'Teliti tentang penggunaan big data dan alat bisnis intelijen untuk menghasilkan wawasan yang lebih dalam dan mendukung pengambilan keputusan', 5, 0, NULL, NULL),
(30, 'S1 Sistem Informasi', 'IT Konsultan', 'Manajemen Proyek TI', 'Fokus pada metodologi dan praktik terbaik dalam manajemen proyek TI, seperti metode Agile, Scrum, atau Prince2, dan aplikasinya dalam proyek-proyek dunia nyata.', 5, 0, NULL, NULL),
(31, 'S1 Sistem Informasi', 'IT Konsultan', 'Pengembangan Solusi Bisnis Berbasis Cloud', 'Teliti tentang strategi migrasi ke lingkungan cloud, pengembangan aplikasi berbasis cloud, atau penggunaan layanan cloud dalam meningkatkan efisiensi operasional perusahaan.', 5, 0, NULL, NULL),
(32, 'S1 Sistem Informasi', 'IT Konsultan', 'Audit TI dan Kepatuhan Peraturan', 'Buat studi tentang proses audit TI dan bagaimana organisasi mematuhi peraturan dan standar keamanan informasi seperti GDPR (General Data Protection Regulation) atau HIPAA (Health Insurance Portability and Accountability Act).', 5, 0, NULL, NULL),
(33, 'S1 Sistem Informasi', 'IT Konsultan', 'Implementasi Sistem ERP (Enterprise Resource Planning)', 'Teliti tentang implementasi sistem ERP dalam organisasi tertentu dan evaluasi dampaknya terhadap proses bisnis, efisiensi, dan pengambilan keputusan.', 5, 0, NULL, NULL),
(34, 'S1 Informatika', 'Software Engineer', 'Pengembangan Framework atau Library', 'Buat sebuah framework atau library yang dapat digunakan oleh pengembang perangkat lunak untuk mempercepat pengembangan aplikasi tertentu atau untuk memecahkan masalah umum.', 5, -1, NULL, '2024-11-23 16:54:37'),
(35, 'S1 Informatika', 'Software Engineer', 'Pengembangan Permainan (Game) Digital', 'Buat permainan digital yang kompleks dengan fokus pada aspek teknis seperti grafik 3D, animasi, fisika, atau kecerdasan buatan dalam permainan.', 5, 0, NULL, NULL),
(36, 'S1 Informatika', 'Software Engineer', 'Manajemen Proyek Perangkat Lunak', 'Fokus pada praktik terbaik dalam manajemen proyek perangkat lunak, seperti metodologi Agile, Scrum, atau DevOps, dan aplikasinya dalam proyek-proyek nyata.', 5, 0, NULL, NULL),
(37, 'S1 Informatika', 'Software Engineer', 'Analisis Sentimen dalam Data Pengguna', 'Teliti tentang penggunaan analisis sentimen dalam data pengguna untuk memahami pandangan pengguna atau kualitas layanan.', 5, 0, NULL, NULL),
(38, 'S1 Informatika', 'Software Engineer', 'Penggunaan Kecerdasan Buatan dalam Pengembangan Perangkat Lunak', 'Buat aplikasi atau sistem yang menggunakan kecerdasan buatan untuk meningkatkan fungsionalitas atau analisis data dalam perangkat lunak.', 5, 0, NULL, NULL),
(39, 'S1 Informatika', 'Software Engineer', 'Pengembangan Perangkat Lunak Terdistribusi', 'Teliti tentang pengembangan perangkat lunak yang beroperasi pada sistem terdistribusi, termasuk desain arsitektur dan pengelolaan komunikasi antar-node.', 5, 0, NULL, NULL),
(40, 'S1 Informatika', 'Software Engineer', 'Pengembangan Aplikasi Web Lanjutan', 'Fokus pada pengembangan aplikasi web yang melibatkan teknologi lanjutan seperti Progressive Web Apps (PWA), Single Page Applications (SPA), atau arsitektur mikrojasa.', 5, 0, NULL, NULL),
(41, 'S1 Informatika', 'Software Engineer', 'Pengembangan Aplikasi Mobile Cross-Platform', 'Teliti tentang penggunaan alat dan teknologi cross-platform seperti React Native atau Flutter untuk mengembangkan aplikasi mobile.', 5, 0, NULL, NULL),
(42, 'S1 Informatika', 'Software Engineer', 'Keamanan Perangkat Lunak', 'Fokus pada pengembangan perangkat lunak yang aman dan analisis keamanan perangkat lunak, termasuk identifikasi kerentanan dan mitigasi risiko.', 5, 0, NULL, NULL),
(43, 'S1 Informatika', 'Software Engineer', 'Optimasi Kinerja Aplikasi', 'Buat penelitian tentang cara mengoptimalkan kinerja perangkat lunak, termasuk pemecahan masalah kinerja, pemantauan performa, dan perbaikan.', 5, 0, NULL, NULL),
(44, 'S1 Informatika', 'Software Engineer', 'Pengujian Perangkat Lunak dan Otomasi Pengujian', 'Teliti tentang strategi pengujian perangkat lunak, termasuk otomatisasi pengujian, pengujian uji beban, atau pengujian keamanan.', 5, 0, NULL, NULL),
(45, 'S1 Informatika', 'Software Engineer', 'Penggunaan Kecerdasan Buatan dalam Pengembangan Aplikasi', 'Mengintegrasikan teknik kecerdasan buatan, seperti pengenalan wajah atau pemrosesan bahasa alami, dalam pengembangan aplikasi berbasis data.', 5, 0, NULL, NULL),
(46, 'S1 Informatika', 'Cloud Fullstack Operator', 'Optimisasi Biaya Infrastruktur Cloud', 'Teliti tentang strategi dan praktik terbaik untuk mengoptimalkan biaya penggunaan sumber daya cloud, termasuk pemilihan jenis sumber daya yang tepat, penjadwalan otomatis, dan penyiapan peringatan biaya.', 5, 0, NULL, NULL),
(47, 'S1 Informatika', 'Cloud Fullstack Operator', 'Penggunaan Kecerdasan Buatan dalam Otomatisasi Cloud', 'Mempelajari bagaimana teknik kecerdasan buatan seperti machine learning dapat digunakan untuk mengoptimalkan operasi cloud dan otomatisasi', 5, 0, NULL, NULL),
(48, 'S1 Informatika', 'Cloud Fullstack Operator', 'Pemulihan Bencana dan Manajemen Kontinuitas Bisnis', 'Mengembangkan dan menguji rencana pemulihan bencana dan manajemen kontinuitas bisnis untuk aplikasi dan infrastruktur di cloud.', 5, 0, NULL, NULL),
(49, 'S1 Informatika', 'Cloud Fullstack Operator', 'Analisis Data Penggunaan Cloud', 'Menganalisis data penggunaan cloud untuk melacak dan mengidentifikasi tren penggunaan sumber daya serta rekomendasi pengoptimalan.', 5, 0, NULL, NULL),
(50, 'S1 Informatika', 'Cloud Fullstack Operator', 'Migrasi Aplikasi ke Cloud', 'Memeriksa proses migrasi aplikasi ke lingkungan cloud, termasuk strategi migrasi, uji coba, dan pemecahan masalah yang terkait.', 5, 0, NULL, NULL),
(51, 'S1 Informatika', 'Cloud Fullstack Operator', 'Penggunaan Layanan Komputasi Serverless', 'Teliti tentang penggunaan layanan komputasi serverless seperti AWS Lambda atau Azure Functions dalam pengembangan dan operasi aplikasi', 5, 0, NULL, NULL),
(52, 'S1 Informatika', 'Cloud Fullstack Operator', 'Pengembangan Aplikasi Berbasis Mikroservis', 'Membangun dan mengelola aplikasi berbasis mikroservis di lingkungan cloud, dengan fokus pada skalabilitas, kinerja, dan pemantauan', 5, 0, NULL, NULL),
(53, 'S1 Informatika', 'Cloud Fullstack Operator', 'Penggunaan Alat Orkestrasi Cloud', 'Teliti tentang penggunaan alat orkestrasi seperti Docker, Kubernetes, atau Terraform dalam mengelola infrastruktur dan aplikasi cloud.', 5, 0, NULL, NULL),
(54, 'S1 Informatika', 'Cloud Fullstack Operator', 'Manajemen Infrastruktur sebagai Kode (IaC)', 'Menganalisis dan mengimplementasikan konsep Infrastruktur sebagai Kode (IaC) untuk otomatisasi penyiapan dan konfigurasi infrastruktur cloud.', 5, 0, NULL, NULL),
(55, 'S1 Informatika', 'Cloud Fullstack Operator', 'Pengelolaan Keamanan Cloud', 'Teliti tentang tindakan pengamanan dan kepatuhan yang diperlukan untuk menjaga keamanan infrastruktur dan data dalam lingkungan cloud, termasuk implementasi firewall, deteksi ancaman, dan manajemen kunci', 5, 0, NULL, NULL),
(56, 'S1 Informatika', 'Cloud Fullstack Operator', 'Pemantauan dan Analisis Kinerja Aplikasi Cloud', 'Buat sistem pemantauan kinerja aplikasi yang berjalan di lingkungan cloud, serta lakukan analisis kinerja untuk mengidentifikasi dan mengatasi bottleneck atau masalah performa.', 5, 0, NULL, NULL),
(57, 'S1 Informatika', 'AI Engineering', 'Optimisasi Infrastruktur AI', 'Teliti tentang cara mengoptimalkan infrastruktur perangkat keras dan perangkat lunak yang digunakan untuk pelatihan dan pengevaluasian model AI, termasuk pemilihan sumber daya yang tepat dan strategi penjadwalan.', 5, 0, NULL, NULL),
(58, 'S1 Informatika', 'AI Engineering', 'Penggunaan AI untuk Optimisasi Infrastruktur', 'Teliti tentang cara menggunakan teknik kecerdasan buatan untuk mengoptimalkan infrastruktur IT secara otomatis, seperti manajemen sumber daya cloud.', 5, 0, NULL, NULL),
(59, 'S1 Informatika', 'AI Engineering', 'Pemantauan Perilaku Model AI', 'Kembangkan alat untuk memantau perilaku model AI secara real-time, termasuk pemantauan prediksi dan perbandingan performa model', 5, 0, NULL, NULL),
(60, 'S1 Informatika', 'AI Engineering', 'Penerapan AI dalam Analisis Data', 'Teliti tentang bagaimana teknik kecerdasan buatan dapat diterapkan dalam analisis data untuk mengidentifikasi pola, tren, atau wawasan bisnis.', 5, 0, NULL, NULL),
(61, 'S1 Informatika', 'AI Engineering', 'Implementasi Kecerdasan Buatan Berbasis Kantor', 'Buat sistem kecerdasan buatan yang dapat digunakan dalam lingkungan kantor, seperti chatbot perusahaan atau alat otomatisasi proses bisnis', 5, 0, NULL, NULL),
(62, 'S1 Informatika', 'AI Engineering', 'Skalabilitas Model AI', 'Mempelajari teknik untuk mengoptimalkan skalabilitas model AI, termasuk pelatihan distribusi dan pengiriman model ke berbagai platform', 5, 0, NULL, NULL),
(63, 'S1 Informatika', 'AI Engineering', 'Pengamanan Model AI', 'Teliti tentang praktik terbaik dalam mengamankan model AI dan melindungi mereka dari serangan seperti pertambangan model atau serangan berbasis model.', 5, 0, NULL, NULL),
(64, 'S1 Informatika', 'AI Engineering', 'Pengelolaan Infrastruktur Komputasi untuk AI', 'Menganalisis metode pengelolaan infrastruktur komputasi yang diperlukan untuk mendukung pelatihan model AI yang besar dan kompleks, termasuk perangkat keras GPU/TPU', 5, 0, NULL, NULL),
(65, 'S1 Informatika', 'AI Engineering', 'Penyaringan Data untuk Model AI', 'Teliti tentang penggunaan teknik pemrosesan data untuk membersihkan, merapikan, dan mempersiapkan data pelatihan yang akan digunakan dalam model AI.', 5, 0, NULL, NULL),
(66, 'S1 Informatika', 'AI Engineering', 'Pemantauan dan Diagnostik AI', 'Kembangkan alat pemantauan yang dapat mendeteksi anomali atau perubahan dalam perilaku model AI dan memberikan wawasan tentang kinerjanya.', 5, 0, NULL, NULL),
(67, 'S1 Informatika', 'AI Engineering', 'Manajemen Siklus Hidup Model AI', 'Buat sistem untuk mengelola siklus hidup model AI, termasuk pelatihan, pengetesan, distribusi, dan pembaruan model dengan efisien.', 5, 0, NULL, NULL),
(68, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Aplikasi Web Berbasis E-commerce', 'Fokus pada pengembangan aplikasi e-commerce yang mencakup fitur-fitur seperti manajemen produk, keranjang belanja, proses checkout, dan integrasi pembayaran.', 5, 0, NULL, NULL),
(69, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Aplikasi Web untuk Manajemen Data', 'Membuat aplikasi web yang memungkinkan pengguna untuk mengelola dan mengakses data secara efisien, seperti manajemen inventaris, manajemen pelanggan, atau manajemen proyek', 5, 0, NULL, NULL),
(70, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Aplikasi Web dengan Pemrosesan Data Real-time', 'Fokus pada pengembangan aplikasi web yang melibatkan pemrosesan data real-time, seperti aplikasi obrolan atau aplikasi permainan online.', 5, 0, NULL, NULL),
(71, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Aplikasi Web Berbasis CMS', 'Teliti tentang pengembangan atau konfigurasi sistem manajemen konten (CMS) seperti WordPress, Joomla, atau Drupal untuk keperluan klien atau proyek.', 5, 0, NULL, NULL),
(72, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Situs Web dengan Fokus Responsif', 'Membangun situs web yang responsif, yang berarti situs dapat diakses dengan baik pada berbagai perangkat, termasuk desktop, tablet, dan ponsel.', 5, 0, NULL, NULL),
(73, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Aplikasi Berbasis API', 'Mempelajari pengembangan aplikasi yang berkomunikasi dengan berbagai API eksternal, termasuk integrasi dengan layanan pihak ketiga seperti media sosial atau penyedia pembayaran.', 5, 0, NULL, NULL),
(74, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Aplikasi Web Berbasis Sumber Terbuka (Open Source)', 'Teliti tentang pengembangan atau kontribusi ke proyek sumber terbuka yang ada, seperti CMS (Content Management System) atau framework web.', 5, 0, NULL, NULL),
(75, 'D3 Sistem Informasi', 'Web Developer', 'Pengembangan Situs Web Perusahaan', 'Buat situs web perusahaan yang mencakup informasi tentang perusahaan, produk dan layanan, kontak, dan mungkin juga berita atau blog.', 5, 0, NULL, NULL),
(76, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Mobile Berbasis Android atau iOS', 'Fokus pada pengembangan aplikasi mobile untuk salah satu platform, seperti Android (menggunakan bahasa Kotlin atau Java) atau iOS (menggunakan bahasa Swift).', 5, 0, NULL, NULL),
(77, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Mobile Berbasis Pembayaran atau E-commerce', 'Fokus pada pengembangan aplikasi mobile yang melibatkan transaksi keuangan, pembayaran online, atau integrasi dengan platform e-commerce.', 5, 0, NULL, NULL),
(78, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Mobile Berbasis Kesehatan', 'Teliti tentang penggunaan aplikasi mobile dalam konteks kesehatan, termasuk pelacakan kebugaran, manajemen jadwal obat, atau konsultasi medis online.', 5, 0, NULL, NULL),
(79, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Mobile untuk Edukasi', 'Fokus pada pengembangan aplikasi mobile yang mendukung pembelajaran dan pendidikan, seperti aplikasi e-learning atau aplikasi buku teks digital', 5, 0, NULL, NULL),
(80, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Mobile untuk Manajemen Data', 'Membangun aplikasi mobile yang memungkinkan pengguna untuk mengakses, mengelola, dan memanipulasi data dengan mudah, seperti manajemen inventaris atau manajemen tugas.', 5, 0, NULL, NULL),
(81, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Mobile Berbasis Geolokasi', 'Buat aplikasi yang memanfaatkan fitur geolokasi ponsel untuk memberikan layanan seperti pelacakan lokasi, navigasi, atau peta interaktif.', 5, 0, NULL, NULL),
(82, 'D3 Sistem Informasi', 'Mobile Developer', 'Pengembangan Aplikasi Cross-Platform', 'Teliti tentang penggunaan teknologi cross-platform seperti React Native, Flutter, atau Xamarin untuk mengembangkan aplikasi mobile yang dapat berjalan di berbagai platform.', 5, 0, NULL, NULL),
(83, 'D3 Sistem Informasi', 'BI Developer', 'Pengembangan Dashboard BI', 'Fokus pada pengembangan dashboard interaktif yang menggabungkan berbagai sumber data bisnis dan menyediakan visualisasi data yang informatif untuk pengambilan keputusan.', 5, 0, NULL, NULL),
(84, 'D3 Sistem Informasi', 'BI Developer', 'Visualisasi Data Interaktif', 'Membangun visualisasi data yang interaktif untuk membantu pengguna memahami data lebih baik, termasuk grafik, peta, dan diagram.', 5, 0, NULL, NULL),
(85, 'D3 Sistem Informasi', 'BI Developer', 'Analisis Data dan Penemuan Wawasan Bisnis', 'Mempelajari teknik analisis data untuk mengidentifikasi tren bisnis, pola pelanggan, atau peluang pasar yang dapat digunakan oleh perusahaan.', 5, 0, NULL, NULL),
(86, 'D3 Sistem Informasi', 'BI Developer', 'Integrasi Data dari Sumber Berbeda', 'Teliti tentang bagaimana menggabungkan data dari berbagai sumber, termasuk basis data internal, sistem eksternal, dan layanan web, untuk analisis yang lebih komprehensif.', 5, 0, NULL, NULL),
(87, 'D3 Sistem Informasi', 'BI Developer', 'Pengembangan Aplikasi Pelaporan Bisnis', 'Buat aplikasi pelaporan bisnis yang memungkinkan pengguna untuk membuat laporan kustom, mengakses data secara real-time, dan memahami tren bisnis.', 5, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `keahlian` text DEFAULT NULL,
  `kapasitas_dp1` int(11) NOT NULL,
  `peserta_dp1` int(11) NOT NULL,
  `kapasitas_dp2` int(11) NOT NULL,
  `peserta_dp2` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan_fungsional` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `user_id`, `nama_dosen`, `nip`, `keahlian`, `kapasitas_dp1`, `peserta_dp1`, `kapasitas_dp2`, `peserta_dp2`, `created_at`, `updated_at`, `jabatan_fungsional`) VALUES
(1, 386, 'Andhika Octa Indarso', '18099009', 'e-business, Teknologi Pembelajaran, Business Intelligence', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 200'),
(2, 387, 'Anita Muliawati', '97120469', 'Tatakelola Sistem Informasi, Perancangan dan Pengembangan Sistem Informasi', 5, 0, 5, 0, NULL, '2024-11-07 13:54:22', 'Lektor 300'),
(3, 389, 'Ati Zaidiah', '97120520', 'Desain Aplikasi Web, Sistem Penunjang Keputusan, Basis Data', 5, 0, 5, 0, NULL, '2024-11-23 18:15:34', 'Lektor 200'),
(4, 390, 'Bambang Saras Yulistiawan', '220112081', 'IT Governance, Machine Learning, Data Analytics', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 200'),
(5, 361, 'Bambang Triwahyono', '204250758', 'Logika fuzzy, Kecerdasan buatan', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(6, 362, 'Bayu Hananto', '2010896', 'Kriptografi, Jaringan', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 200'),
(7, 391, 'Catur Nugrahaeni P. D.', '211250935', 'Rekayasa Perangkat Lunak, Tatakelola Sistem Informasi, Perancangan dan Pengembangan Sistem Informasi', 5, 0, 5, 0, NULL, NULL, 'Lektor 300'),
(8, 363, 'Desta Sandya Prasvita', '303128702', 'Pengolahan Citra Digital\r\nMachine Learning', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(9, 364, 'Didit Widiyanto', '94120221', 'Machine Learning, Artificial Intelligence, Robotika', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(10, 407, 'Erly Krisnanik', '98120581', 'Sistem Informasi, Audit Sistem Informasi, Sistem Penunjang Keputusan, Sistem Pakar, Basis Data', 5, 0, 5, 0, NULL, '2024-11-24 11:48:01', 'Lektor 300'),
(11, 365, 'Hamonangan Kinantan P.', '2088502', 'information network security, virtual server', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(12, 408, 'Helena Nurramdhani Irmanda', '218111371', 'Text Processing, Data Science, Sistem Informasi', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(13, 366, 'Henki Bayu Seta', '206250806', 'Keamanan Informasi, e-Learning', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(14, 369, 'I Wayan Rangga Pinastawa', '22089026', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(15, 393, 'I Wayan Widi Pradnyana', '25068104', 'Cloud computing, Big data, Business Process Management, Information Security, Mobile Computing', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(16, 367, 'Ichsan Mardani', '17049002', 'Kriptografi, Jaringan', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(17, 409, 'Iin Ernawati', '204250759', 'Data mining, Sistem Informasi', 5, 0, 5, 0, NULL, '2024-10-14 15:28:03', 'Lektor 300'),
(18, 392, 'Ika Nurlaili Isnainiyah', '17019015', 'Human Computer Interaction, Data analysis, Data visualization, Sensor technology', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(19, 368, 'Indra Permana Solihin', '209250865', 'Image Processing, Security system, Networking, Computer system, Artificial Intelligence, e government.', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 200'),
(20, 410, 'Intan Hesti Indriana', '2096210', 'Manejemen', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor Kepala'),
(21, 370, 'Jayanta', '87110103', 'Pengolahan Suara dan Citra digital,', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(22, 371, 'Kharisma Wiati Gusti', '22089025', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(23, 394, 'Kraugusteeliana', '322087501', 'Implementasi Sistem Informasi,  E-government / Tata Kelola, Audit Sistem Informasi', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(24, 411, 'Lomo Mula Tua', '8065806', 'Manajemen', 5, 0, 5, 0, NULL, NULL, NULL),
(25, 373, 'M. Octaviano Pratama', '2008066763', 'Machine Learning, Deep Learning, Image Processing, Information Retrieval, Information System', 5, 0, 5, 0, NULL, NULL, NULL),
(26, 372, 'Mayanda Mega Santoni', '17089002', 'Computer vision, Image processing, Machine learning ', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(27, 412, 'Mohamad Bayu Wibisono', '204120756', 'Sistem informasi', 5, 0, 5, 0, NULL, NULL, 'Asisten Ahli 150'),
(28, 374, 'Muhammad Adrezo', '200120707', 'Data mining, Image Processing dan machine learning', 5, 0, 5, 2, NULL, '2024-11-24 19:31:30', 'Asisten Ahli 150'),
(29, 375, 'Muhammad Panji M.', '22089033', '', 5, 0, 5, 0, NULL, NULL, NULL),
(30, 376, 'Musthofa Galih Pradana', '22089027', '', 5, 0, 5, 0, NULL, '2024-11-07 14:03:15', 'Asisten Ahli 150'),
(31, 377, 'Neny Rosmawarni', '22089028', '', 5, 0, 5, 0, NULL, '2024-11-24 19:30:07', 'Lektor 300'),
(32, 395, 'Nindy Irzavika', '22089029', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(33, 378, 'Noor Falih', '218111369', 'Rekayasa Perangkat Lunak, Pengujian Perangkat Lunak, Kualitas Perangkat Lunak, Kebutuhan Perangkat Lunak, Web App', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 200'),
(34, 379, 'Novi Trisman Hadi', '22089034', '', 5, 0, 5, 0, NULL, '2024-11-24 11:49:40', 'Asisten Ahli 150'),
(35, 413, 'Nur Hafifah Matondang', '211255077', 'Sistem Informasi, Audit Sistem Informasi, Machine Learning', 5, 0, 5, 0, NULL, '2024-11-07 13:55:06', 'Lektor 200'),
(36, 380, 'Nurhuda Maulana', '22089030', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(37, 381, 'Nurul Afifah Arifuddin', '22089035', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(38, 382, 'Nurul Chamidah', '215121177', 'Machine learning, Data mining, Text mining', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(39, 396, 'Radinal Setyadinsa', '22089036', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(40, 397, 'Ria Astriratma', '218111375', 'Sistem Penunjang Keputusan, Sistem Informasi, Pengembangan Perangkat Lunak', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(41, 383, 'Rido Zulfahmi', '8847270018', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Tenaga Pengajar'),
(42, 384, 'Ridwan Raafi\'udin', '209250881', '', 5, 0, 5, 0, NULL, NULL, 'Lektor 200'),
(43, 398, 'Rifka Dwi Amalia', '22089037', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(44, 399, 'Rio Wirawan', '420018601', 'Sistem Informasi, Website, data mining, statistik riset', 5, 0, 5, 0, NULL, '2024-11-24 19:10:00', 'Lektor 300'),
(45, 400, 'Rudhy Ho Purabaya', '84110055', ' Audit IT, Proses Bisnis', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(46, 414, 'Ruth Mariana Bunga Wadu', '218111374', 'Proses Bisnis, Analisis Proses Sistem, Sistem Penunjang Keputusan, Business Intelligence', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 200'),
(47, 401, 'Sarika', '218111372', 'e-government, KMS, RPL, User experience', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Asisten Ahli 150'),
(48, 415, 'Theresia Wati', '206250807', 'Audit Sistem Informasi, E-learning, Sistem informasi', 5, 0, 5, 0, NULL, '2024-10-28 07:46:02', 'Lektor 300'),
(49, 402, 'Tjahjanto', '200120691', 'Software Engineering', 5, 0, 5, 0, NULL, '2024-11-24 20:11:30', 'Lektor 300'),
(50, 416, 'Tri Rahayu', '204250757', 'Pemrograman web, analisa & perancangan sistem, sistem informasi manajemen', 5, 0, 5, 0, NULL, '2024-11-23 22:25:30', 'Lektor 300'),
(51, 403, 'Triando Damiri Burlian', '22089031', '', 5, 0, 5, 0, NULL, NULL, NULL),
(52, 404, 'Widya Cholil', '221112080', 'IT Governance, Data Mining, Artificial Intelligent', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300'),
(53, 405, 'Yulnelly', '89110054', ' Sistem Informasi Perpustakaan', 5, 0, 5, 0, NULL, NULL, NULL),
(54, 385, 'Yuni Widiastiwi', '200120670', 'Artificial Intelligence, Rekayasa Perangkat Lunak', 5, 0, 5, 0, NULL, NULL, NULL),
(55, 406, 'Zatin Niqotaini', '22089032', '', 5, 0, 5, 0, NULL, '2024-09-25 16:55:36', 'Lektor 300');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` varchar(255) NOT NULL,
  `accepting_responses` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form_id`, `accepting_responses`, `created_at`, `updated_at`) VALUES
(1, 'rekom', 1, NULL, NULL),
(2, 'topik', 1, NULL, NULL),
(3, 'dospem', 1, NULL, '2024-09-21 07:54:46'),
(4, 'proposal', 1, NULL, '2024-09-23 14:49:48'),
(5, 'skripsi', 1, NULL, '2024-09-25 09:39:14'),
(6, 'nilai_proposal', 1, NULL, '2024-09-21 08:13:32'),
(7, 'nilai_skripsi', 1, NULL, '2024-09-21 08:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_proposals`
--

CREATE TABLE `hasil_proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_dosen` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal_proposal` bigint(20) UNSIGNED NOT NULL,
  `kesesuaian` double UNSIGNED NOT NULL,
  `kedalaman` double UNSIGNED NOT NULL,
  `rumusan` double UNSIGNED NOT NULL,
  `penguasaan` double UNSIGNED NOT NULL,
  `metode` double UNSIGNED NOT NULL,
  `saran` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_skripsi_pembimbings`
--

CREATE TABLE `hasil_skripsi_pembimbings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_dosen` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal_skripsi` bigint(20) UNSIGNED NOT NULL,
  `kedisiplinan` double UNSIGNED NOT NULL,
  `kemauan` double UNSIGNED NOT NULL,
  `kemandirian` double UNSIGNED NOT NULL,
  `standarisasi` double UNSIGNED NOT NULL,
  `keutuhan` double UNSIGNED NOT NULL,
  `kerapihan` double UNSIGNED NOT NULL,
  `analisis` double UNSIGNED NOT NULL,
  `solusi` double UNSIGNED NOT NULL,
  `kajian` double UNSIGNED NOT NULL,
  `penguasaan` double UNSIGNED NOT NULL,
  `pertanyaan_pokok` text DEFAULT NULL,
  `kesimpulan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_skripsi_pengujis`
--

CREATE TABLE `hasil_skripsi_pengujis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_dosen` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal_skripsi` bigint(20) UNSIGNED NOT NULL,
  `sarana` double UNSIGNED NOT NULL,
  `menjelaskan` double UNSIGNED NOT NULL,
  `standarisasi` double UNSIGNED NOT NULL,
  `keutuhan` double UNSIGNED NOT NULL,
  `kerapihan` double UNSIGNED NOT NULL,
  `pemahaman` double UNSIGNED NOT NULL,
  `pendekatan` double UNSIGNED NOT NULL,
  `menjawab` double UNSIGNED NOT NULL,
  `pertanyaan_pokok` text DEFAULT NULL,
  `kesimpulan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_proposals`
--

CREATE TABLE `jadwal_proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_berkas_proposal` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidangs`
--

CREATE TABLE `jadwal_sidangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penguji_1` bigint(20) UNSIGNED NOT NULL,
  `id_penguji_2` bigint(20) UNSIGNED NOT NULL,
  `id_pembimbing` bigint(20) UNSIGNED NOT NULL,
  `id_plot_jadwal` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(15) NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_skripsis`
--

CREATE TABLE `jadwal_skripsis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_berkas_skripsi` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `file_revisi` text DEFAULT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  `status_revisi` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_pengesahan` text DEFAULT NULL,
  `file_skripsi` text DEFAULT NULL,
  `acc_pembimbing_1` tinyint(1) DEFAULT NULL,
  `acc_pembimbing_2` tinyint(1) DEFAULT NULL,
  `acc_penguji_1` tinyint(1) DEFAULT NULL,
  `acc_penguji_2` tinyint(1) DEFAULT NULL,
  `acc_kaprodi` tinyint(1) DEFAULT NULL,
  `bebas_pustaka` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ketersediaan_dosens`
--

CREATE TABLE `ketersediaan_dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_plot_jadwal` bigint(20) UNSIGNED NOT NULL,
  `id_dosen` bigint(20) UNSIGNED NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dosenpa_id` bigint(20) UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `peminatan` varchar(255) DEFAULT NULL,
  `status_mhs` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `dosenpa_id`, `nama_mahasiswa`, `nim`, `prodi`, `peminatan`, `status_mhs`, `created_at`, `updated_at`) VALUES
(1, 1, 21, 'Salsabila Oktafani', '2010511001', 'S1 Informatika', 'Software Engineer', 0, NULL, '2024-11-08 08:34:31'),
(2, 2, 21, 'Muhamad Ronald Lullah', '2010511002', 'S1 Informatika', NULL, 0, NULL, NULL),
(3, 4, 21, 'Enno Tegar Dwi Saputra', '2010511004', 'S1 Informatika', NULL, 0, NULL, NULL),
(4, 5, 21, 'Muhammad Fadhillah Akbar', '2010511005', 'S1 Informatika', NULL, 0, NULL, NULL),
(5, 8, 21, 'Bagus Sajiwo Utomo', '2010511008', 'S1 Informatika', NULL, 0, NULL, NULL),
(6, 9, 21, 'Muhammad Fhandika Rafif', '2010511009', 'S1 Informatika', NULL, 0, NULL, NULL),
(7, 10, 21, 'Endow Bonapen', '2010511010', 'S1 Informatika', NULL, 0, NULL, NULL),
(8, 11, 21, 'Alvin Putra Perdana', '2010511011', 'S1 Informatika', NULL, 0, NULL, NULL),
(9, 12, 21, 'Febriani Jati Nawangsih', '2010511012', 'S1 Informatika', NULL, 0, NULL, NULL),
(10, 13, 21, 'Jihan Kamilah', '2010511013', 'S1 Informatika', NULL, 0, NULL, NULL),
(11, 14, 21, 'Rivardi', '2010511014', 'S1 Informatika', NULL, 0, NULL, NULL),
(12, 15, 21, 'Marella Azaria Putri', '2010511015', 'S1 Informatika', NULL, 0, NULL, '2024-10-14 15:18:58'),
(13, 17, 21, 'Arya Nur Hidayat', '2010511017', 'S1 Informatika', NULL, 0, NULL, NULL),
(14, 18, 21, 'Rafi Ramdhani', '2010511018', 'S1 Informatika', NULL, 0, NULL, NULL),
(15, 19, 21, 'Byqo Syach Mahendra', '2010511019', 'S1 Informatika', NULL, 0, NULL, NULL),
(16, 20, 21, 'Rizky Firmansyah', '2010511020', 'S1 Informatika', NULL, 0, NULL, NULL),
(17, 21, 21, 'Ardella Malinda Sarastri', '2010511021', 'S1 Informatika', NULL, 0, NULL, NULL),
(18, 23, 21, 'FIQRI FADILLAH', '2010511023', 'S1 Informatika', NULL, 0, NULL, NULL),
(19, 24, 21, 'Rizki Firmansyah', '2010511024', 'S1 Informatika', NULL, 0, NULL, NULL),
(20, 25, 21, 'Muhammad Thoriq Al-Fatih', '2010511025', 'S1 Informatika', NULL, 0, NULL, NULL),
(21, 26, 21, 'Nurhikmah Mawaddah Solin', '2010511026', 'S1 Informatika', NULL, 0, NULL, NULL),
(22, 27, 21, 'Vionita Oktaviani', '2010511027', 'S1 Informatika', NULL, 0, NULL, NULL),
(23, 28, 21, 'Mochammad Adhi Buchori', '2010511028', 'S1 Informatika', NULL, 0, NULL, NULL),
(24, 29, 21, 'Luthfiani Bahrain', '2010511029', 'S1 Informatika', NULL, 0, NULL, NULL),
(25, 30, 21, 'Jozka Roihutan Siregar', '2010511030', 'S1 Informatika', NULL, 0, NULL, NULL),
(26, 31, 21, 'Rashif Candra Zirnikh', '2010511031', 'S1 Informatika', NULL, 0, NULL, NULL),
(27, 32, 21, 'Alif Faqiih', '2010511032', 'S1 Informatika', NULL, 0, NULL, NULL),
(28, 33, 21, 'Guntur Laksono Putra', '2010511033', 'S1 Informatika', NULL, 0, NULL, NULL),
(29, 35, 21, 'Muhammad Ferdiansyah', '2010511035', 'S1 Informatika', NULL, 0, NULL, NULL),
(30, 36, 21, 'Rangga Saputra', '2010511036', 'S1 Informatika', NULL, 0, NULL, NULL),
(31, 37, 21, 'Adrian Triputra', '2010511037', 'S1 Informatika', NULL, 0, NULL, NULL),
(32, 38, 21, 'Iftah Ridhatama', '2010511038', 'S1 Informatika', NULL, 0, NULL, NULL),
(33, 39, 21, 'Rafiqi Yahya', '2010511039', 'S1 Informatika', NULL, 0, NULL, NULL),
(34, 40, 28, 'Muhammad Akbar Pratama Putra', '2010511040', 'S1 Informatika', NULL, 0, NULL, NULL),
(35, 41, 28, 'Wibisana Sudarto', '2010511041', 'S1 Informatika', NULL, 0, NULL, NULL),
(36, 42, 28, 'Abednego Christianyoel Rumagit', '2010511042', 'S1 Informatika', NULL, 0, NULL, NULL),
(37, 43, 28, 'Faris Primahadi Putera Lesilolo', '2010511043', 'S1 Informatika', NULL, 0, NULL, NULL),
(38, 45, 28, 'Melvin Marcello', '2010511045', 'S1 Informatika', NULL, 0, NULL, NULL),
(39, 46, 28, 'Fadia Alissafitri', '2010511046', 'S1 Informatika', NULL, 0, NULL, NULL),
(40, 47, 28, 'Muhammad Shidqi Wirawan', '2010511047', 'S1 Informatika', NULL, 0, NULL, NULL),
(41, 48, 28, 'RAFLI DIKA PRAMUDYA', '2010511048', 'S1 Informatika', NULL, 0, NULL, NULL),
(42, 49, 28, 'Adam Fauzan', '2010511049', 'S1 Informatika', NULL, 0, NULL, NULL),
(43, 50, 28, 'Quini Suci Ambarwati', '2010511050', 'S1 Informatika', NULL, 0, NULL, NULL),
(44, 51, 28, 'Riandra Putra Pratama', '2010511051', 'S1 Informatika', NULL, 0, NULL, NULL),
(45, 52, 28, 'Zainatul Sirti', '2010511052', 'S1 Informatika', NULL, 0, NULL, NULL),
(46, 53, 28, 'Ibra Hasan Suraya', '2010511053', 'S1 Informatika', NULL, 0, NULL, NULL),
(47, 54, 28, 'Muhammad Fari Abiyyudhiya', '2010511054', 'S1 Informatika', NULL, 0, NULL, NULL),
(48, 55, 28, 'Rizky Jemal Safryan', '2010511055', 'S1 Informatika', NULL, 0, NULL, NULL),
(49, 56, 28, 'BAYU ERIK WIBISONO', '2010511056', 'S1 Informatika', NULL, 0, NULL, NULL),
(50, 57, 28, 'IRFAN MAULANA', '2010511057', 'S1 Informatika', NULL, 0, NULL, NULL),
(51, 58, 28, 'Muhamad Erlan Ardiansyah', '2010511058', 'S1 Informatika', NULL, 0, NULL, NULL),
(52, 59, 28, 'Ridwan Raditya', '2010511059', 'S1 Informatika', NULL, 0, NULL, NULL),
(53, 60, 28, 'Febby Milani', '2010511060', 'S1 Informatika', NULL, 0, NULL, NULL),
(54, 61, 28, 'Arief Nur Zaid', '2010511061', 'S1 Informatika', NULL, 0, NULL, NULL),
(55, 62, 28, 'Eric Fernando', '2010511062', 'S1 Informatika', NULL, 0, NULL, NULL),
(56, 63, 28, 'Muhammad Fauzan Mufti Dhana', '2010511063', 'S1 Informatika', NULL, 0, NULL, NULL),
(57, 64, 28, 'Annisa Nur Iksan', '2010511064', 'S1 Informatika', NULL, 0, NULL, NULL),
(58, 65, 28, 'Kevin Gustian The', '2010511065', 'S1 Informatika', NULL, 0, NULL, NULL),
(59, 66, 28, 'Nisa Silaen', '2010511066', 'S1 Informatika', NULL, 0, NULL, NULL),
(60, 67, 28, 'Rahman Duwi Santoso', '2010511067', 'S1 Informatika', NULL, 0, NULL, NULL),
(61, 68, 28, 'Yudha Haryoputranto', '2010511068', 'S1 Informatika', NULL, 0, NULL, NULL),
(62, 69, 28, 'Ivanka Larasati Kusumadewi', '2010511069', 'S1 Informatika', NULL, 0, NULL, NULL),
(63, 71, 28, 'Muhammad Alfaiz Surya', '2010511071', 'S1 Informatika', NULL, 0, NULL, NULL),
(64, 72, 28, 'Marwahal Hagai Excellent', '2010511072', 'S1 Informatika', NULL, 0, NULL, NULL),
(65, 74, 28, 'Muhammad Iqbal Saputra', '2010511074', 'S1 Informatika', NULL, 0, NULL, NULL),
(66, 75, 28, 'Dhea Syahira Julianti', '2010511075', 'S1 Informatika', NULL, 0, NULL, NULL),
(67, 77, 28, 'Kurniawan Danil', '2010511077', 'S1 Informatika', NULL, 0, NULL, NULL),
(68, 78, 28, 'Muhamad Al Faza Atariq', '2010511078', 'S1 Informatika', NULL, 0, NULL, NULL),
(69, 79, 28, 'Nafi Dhimas Elandyaksa', '2010511079', 'S1 Informatika', NULL, 0, NULL, NULL),
(70, 81, 37, 'Kukuh Fadlillah Nurendra Putra', '2010511081', 'S1 Informatika', NULL, 0, NULL, NULL),
(71, 82, 37, 'Chordan Aksa Priandoyo', '2010511082', 'S1 Informatika', NULL, 0, NULL, NULL),
(72, 83, 37, 'Benny Daniel Bahari', '2010511083', 'S1 Informatika', NULL, 0, NULL, NULL),
(73, 84, 37, 'Irfan Muhammad Guvian', '2010511084', 'S1 Informatika', NULL, 0, NULL, NULL),
(74, 85, 37, 'Nur Afiifah Az-Zahra', '2010511085', 'S1 Informatika', NULL, 0, NULL, NULL),
(75, 86, 37, 'Daffa Rasyid Naufan', '2010511086', 'S1 Informatika', NULL, 0, NULL, NULL),
(76, 88, 37, 'Bara Rifqi Ath Thoriq', '2010511088', 'S1 Informatika', NULL, 0, NULL, NULL),
(77, 89, 37, 'Fernanda Andyka Putra', '2010511089', 'S1 Informatika', NULL, 0, NULL, NULL),
(78, 90, 37, 'Nauval Laudza Munadjat Pattinggi', '2010511090', 'S1 Informatika', NULL, 0, NULL, NULL),
(79, 91, 37, 'Yaasintha La Jopin Arisca Corpputy', '2010511091', 'S1 Informatika', NULL, 0, NULL, NULL),
(80, 92, 55, 'Muhammad Ghozi Attamimi', '2010511092', 'S1 Informatika', NULL, 0, NULL, NULL),
(81, 93, 55, 'Gani Eka Santoso Wijaya', '2010511093', 'S1 Informatika', NULL, 0, NULL, NULL),
(82, 94, 55, 'Ken Ksatria Bahari', '2010511094', 'S1 Informatika', NULL, 0, NULL, NULL),
(83, 95, 55, 'Harianto Billy Tandias', '2010511095', 'S1 Informatika', NULL, 0, NULL, NULL),
(84, 96, 55, 'Rafi Musthafa Rustianto', '2010511096', 'S1 Informatika', NULL, 0, NULL, NULL),
(85, 97, 55, 'Pranarendra Dwikurnia', '2010511097', 'S1 Informatika', NULL, 0, NULL, NULL),
(86, 98, 55, 'Amalia Hasanah', '2010511098', 'S1 Informatika', NULL, 0, NULL, NULL),
(87, 99, 55, 'Annisa Refalinanda Putri', '2010511099', 'S1 Informatika', NULL, 0, NULL, NULL),
(88, 100, 55, 'Givery Maradillah Yutarsyah', '2010511100', 'S1 Informatika', NULL, 0, NULL, NULL),
(89, 102, 30, 'Al-Aqsa Krisnaya Abidin', '2010511102', 'S1 Informatika', NULL, 0, NULL, NULL),
(90, 103, 30, 'Aldi Rusdi', '2010511103', 'S1 Informatika', NULL, 0, NULL, NULL),
(91, 104, 30, 'Fairuz Elqi Mochammad', '2010511104', 'S1 Informatika', NULL, 0, NULL, NULL),
(92, 105, 30, 'Haykal Gibran Hakim', '2010511105', 'S1 Informatika', NULL, 0, NULL, NULL),
(93, 106, 30, 'Johanes Gerald', '2010511106', 'S1 Informatika', NULL, 0, NULL, NULL),
(94, 107, 30, 'Annisa Fitriatuzzahra', '2010511107', 'S1 Informatika', NULL, 0, NULL, NULL),
(95, 108, 30, 'Wiaji Robian Dwi Cahya', '2010511108', 'S1 Informatika', NULL, 0, NULL, NULL),
(96, 109, 30, 'Muhammad Tsany Nur Iman Kurbiana', '2010511109', 'S1 Informatika', NULL, 0, NULL, NULL),
(97, 110, 30, 'Muhamad Wildan Akasyah', '2010511110', 'S1 Informatika', NULL, 0, NULL, NULL),
(98, 111, 30, 'Muhammad Helmi Azhar', '2010511111', 'S1 Informatika', NULL, 0, NULL, NULL),
(99, 112, 31, 'Rahul Eky Saputra', '2010511112', 'S1 Informatika', NULL, 0, NULL, NULL),
(100, 113, 31, 'Ahmad rizki hardiansyah', '2010511113', 'S1 Informatika', NULL, 0, NULL, NULL),
(101, 114, 31, 'Ardimas Dwi Suprayogi', '2010511114', 'S1 Informatika', NULL, 0, NULL, NULL),
(102, 116, 31, 'Muhammad Ihsanuddin Romdloni', '2010511116', 'S1 Informatika', NULL, 0, NULL, NULL),
(103, 117, 31, 'M. Ilham Robbani', '2010511117', 'S1 Informatika', NULL, 0, NULL, NULL),
(104, 118, 31, 'Alysha Zahira Farras Ihsani', '2010511118', 'S1 Informatika', NULL, 0, NULL, NULL),
(105, 119, 31, 'Abyakta Wibisono', '2010511119', 'S1 Informatika', NULL, 0, NULL, NULL),
(106, 120, 31, 'Muhammad Faturrahman', '2010511120', 'S1 Informatika', NULL, 0, NULL, NULL),
(107, 122, 37, 'Dika Rahman Maulana', '2010511122', 'S1 Informatika', NULL, 0, NULL, NULL),
(108, 123, 37, 'Muhammad Fadhlan Wijaya', '2010511123', 'S1 Informatika', NULL, 0, NULL, NULL),
(109, 126, 37, 'Muhammad Mitchell Tri Octaviano Syaifullah', '2010511126', 'S1 Informatika', NULL, 0, NULL, NULL),
(110, 129, 37, 'Daffa Rabbani', '2010511129', 'S1 Informatika', NULL, 0, NULL, NULL),
(111, 130, 37, 'Tedja Diah Rani Octavia', '2010511130', 'S1 Informatika', NULL, 0, NULL, NULL),
(112, 132, 37, 'Lail Akbar Nugraha', '2010511132', 'S1 Informatika', NULL, 0, NULL, NULL),
(113, 133, 37, 'Rahmat Afriyanton', '2010511133', 'S1 Informatika', NULL, 0, NULL, NULL),
(114, 134, 37, 'Raihan Hadi Athalla', '2010511134', 'S1 Informatika', NULL, 0, NULL, NULL),
(115, 135, 37, 'Sarah Yuniza Dewi Anggadinata', '2010511135', 'S1 Informatika', NULL, 0, NULL, NULL),
(116, 136, 37, 'Akmal Yusran Rizqiansyah', '2010511136', 'S1 Informatika', NULL, 0, NULL, NULL),
(117, 137, 37, 'Mokhammad Raviandra', '2010511137', 'S1 Informatika', NULL, 0, NULL, NULL),
(118, 138, 52, 'Muhammad Faris Ramadhan', '2010511138', 'S1 Informatika', NULL, 0, NULL, NULL),
(119, 139, 52, 'Savina Rizdafayi', '2010511139', 'S1 Informatika', NULL, 0, NULL, NULL),
(120, 140, 52, 'Gilbert Hasiholan', '2010511140', 'S1 Informatika', NULL, 0, NULL, NULL),
(121, 141, 52, 'Rizanis Aqshol Himam', '2010511141', 'S1 Informatika', NULL, 0, NULL, NULL),
(122, 142, 52, 'Tito Candra Septio', '2010511142', 'S1 Informatika', NULL, 0, NULL, NULL),
(123, 143, 52, 'Nida Zakia Aldina', '2010511143', 'S1 Informatika', NULL, 0, NULL, NULL),
(124, 144, 52, 'Narendra Faza Ramadhan', '2010511144', 'S1 Informatika', NULL, 0, NULL, NULL),
(125, 145, 48, 'Farell Aldi Kusuma', '2010512001', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(126, 146, 48, 'Muhammad Azka Rizki', '2010512002', 'S1 Sistem Informasi', NULL, 0, NULL, '2024-10-14 15:23:53'),
(127, 147, 48, 'Anwar Nassihin', '2010512003', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(128, 148, 48, 'Berliana Septyani Suganda', '2010512004', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(129, 149, 48, 'Della Chintiya Dewi', '2010512005', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(130, 150, 48, 'Raissa Gabriella Putri', '2010512006', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(131, 151, 48, 'Astri Widyanti Sopandi', '2010512007', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(132, 152, 48, 'Nayla Tinneke Kusmawardhani', '2010512008', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(133, 153, 48, 'Nurcholis Adam Zhuhri', '2010512009', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(134, 154, 48, 'Mila Milenia Indah Sibarani', '2010512010', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(135, 156, 48, 'Nabil Muhammad Raihan', '2010512012', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(136, 157, 48, 'Irma Zerlina Mahirah', '2010512013', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(137, 158, 48, 'Marselindra Malihan Putri', '2010512014', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(138, 159, 48, 'Aisyah Alsyafira Gumay', '2010512015', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(139, 160, 48, 'Ni Komang Lusinta', '2010512016', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(140, 161, 48, 'Zulfatul Azizah', '2010512017', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(141, 162, 48, 'Safana Hidayati Putri', '2010512018', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(142, 163, 48, 'Ricky Syarifuddin Septian Mateka', '2010512019', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(143, 164, 48, 'Ananda Alvi Al Fadhli', '2010512020', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(144, 165, 48, 'Fahry Amzar', '2010512021', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(145, 166, 48, 'Rivan Apta Kusuma', '2010512022', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(146, 167, 48, 'Juwita Istiqomah Trahira', '2010512023', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(147, 168, 48, 'Rizka Maulidina Sutrisno', '2010512024', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(148, 169, 48, 'Natasya Febriyanti', '2010512025', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(149, 170, 48, 'Juniver Christian Natanael', '2010512026', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(150, 171, 48, 'Putra I\'zaz Dany Rizq Bramasta', '2010512027', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(151, 172, 48, 'Joyce Patricia', '2010512028', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(152, 173, 48, 'Winny Annisa Fadhila', '2010512029', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(153, 174, 48, 'Daffa Andika Zain', '2010512030', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(154, 175, 3, 'Muhamad Arif Boediman', '2010512031', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(155, 176, 3, 'Regina Josephine', '2010512032', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(156, 177, 3, 'Vissi Varrel Vedatama Sungkono', '2010512033', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(157, 178, 3, 'Maulana Yusuf', '2010512034', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(158, 179, 3, 'Dinda Aulia Setianingsih', '2010512035', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(159, 180, 3, 'Naila Noelany Maharani', '2010512036', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(160, 181, 3, 'Muhammad Safier Al Kahfa', '2010512037', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(161, 182, 3, 'Muhammad Albirr Inzal Yazidillah', '2010512038', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(162, 183, 3, 'Helwa Saudah', '2010512039', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(163, 184, 3, 'Rasikh Hafizh Fawushan', '2010512040', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(164, 200, 10, 'Muhammad Haikal Ikhsan', '2010512056', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(165, 201, 20, 'Salma Wafiq Fahroji', '2010512057', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(166, 202, 20, 'Raffael', '2010512058', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(167, 203, 20, 'Wanda Kusuma Wardani', '2010512059', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(168, 204, 20, 'Fisya Alifia Fawwazi Siregar', '2010512060', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(169, 205, 20, 'Andhika Rizq Pulubuhu', '2010512061', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(170, 206, 20, 'Nicodemus Naisau', '2010512062', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(171, 207, 20, 'Santiana', '2010512063', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(172, 208, 20, 'ADHIRA THASKIA SALSABILLA', '2010512064', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(173, 209, 20, 'Alya Zahra Waty', '2010512065', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(174, 210, 20, 'Maulida Afifah', '2010512066', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(175, 211, 20, 'Fitri Kurniawati', '2010512067', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(176, 212, 20, 'Arkiza Ariq', '2010512068', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(177, 214, 20, 'Dinda Putri Pamungkas', '2010512070', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(178, 215, 10, 'Aqila Zahara Putri', '2010512071', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(179, 216, 10, 'Allya Aurora Febrina', '2010512072', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(180, 217, 10, 'Dian Azizah Lubis', '2010512073', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(181, 218, 10, 'Stephanie Helga', '2010512074', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(182, 219, 10, 'Muhammad Ra\'afi Hafiiz', '2010512075', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(183, 221, 10, 'Yosia Ruhut Sidabutar', '2010512077', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(184, 222, 10, 'Andhi Nursahara', '2010512078', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(185, 223, 10, 'Ahmad Kayyis', '2010512079', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(186, 224, 10, 'Muhammad Aqshal Prawira', '2010512080', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(187, 225, 10, 'Rizky Yaomal Malik', '2010512081', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(188, 226, 10, 'Farhan Yusuf', '2010512082', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(189, 227, 10, 'Rayhan Khaliq Azmy', '2010512083', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(190, 228, 10, 'Hansen Kallista', '2010512084', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(191, 229, 10, 'Astrid Fadila', '2010512085', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(192, 230, 10, 'Catherine Maharani Widiasmoro', '2010512086', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(193, 232, 10, 'Ahmad Dany Wirawan', '2010512088', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(194, 234, 10, 'Muhammad Nazif Thabit', '2010512090', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(195, 235, 10, 'Muhammad Zul Fikar', '2010512091', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(196, 236, 10, 'Aulia Mahmudah', '2010512092', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(197, 237, 10, 'Muhammad Raziv Maulana Ranie', '2010512093', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(198, 238, 10, 'Maria Jevani', '2010512094', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(199, 240, 10, 'Liyora Arabel Ansely', '2010512096', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(200, 241, 10, 'Alfito Bayu Ibrahim', '2010512097', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(201, 242, 10, 'Septriediana Amalia Putrie', '2010512098', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(202, 243, 10, 'Shidqan Aliman', '2010512099', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(203, 244, 10, 'Muhammad Fahrizal', '2010512100', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(204, 245, 47, 'Faisal Rizqi Utama', '2010512101', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(205, 246, 47, 'Dzakwan Yudha Prastama', '2010512102', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(206, 247, 47, 'Alam Cahyo Laksono', '2010512103', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(207, 248, 47, 'Rakan yuvi ispradityo', '2010512104', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(208, 249, 47, 'Putri Ravika Hidayat', '2010512105', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(209, 250, 47, 'Hafidz Izdihar Muslim', '2010512106', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(210, 251, 47, 'Vincentius Ludwig Putra Widianto', '2010512107', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(211, 253, 47, 'Naomita Nabila Arani', '2010512109', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(212, 254, 47, 'Fadiyah Sutopo', '2010512110', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(213, 255, 47, 'Muhammad Zaki Hamdani', '2010512111', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(214, 256, 47, 'Raditya Rafi Harimasya', '2010512112', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(215, 257, 47, 'Duma Sere Pakpahan', '2010512113', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(216, 258, 47, 'Muhammad Raehan Safitroh', '2010512114', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(217, 259, 47, 'Danish Haikal Haholongan', '2010512115', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(218, 260, 47, 'Rafif Rasendriya Arya Putra', '2010512116', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(219, 261, 47, 'Muhammad Faizul Muttaqin', '2010512117', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(220, 262, 47, 'Aqshal Win Mahara', '2010512118', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(221, 263, 47, 'Atina Eka Vebi', '2010512119', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(222, 264, 47, 'Namirah Wahyuni Putri Hasmadi', '2010512120', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(223, 265, 47, 'Bezaliel Yehuda Dermawan Hulu', '2010512121', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(224, 266, 47, 'Zahran Irfansyah', '2010512122', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(225, 267, 47, 'Marella Elba Nafisa', '2010512123', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(226, 268, 47, 'Farhan Habib', '2010512124', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(227, 270, 44, 'Lawdzai Nuzulul Azhfar', '2010512126', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(228, 271, 44, 'Hanifa Widya Damayanti', '2010512127', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(229, 272, 44, 'Nada Anggitaningrum', '2010512128', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(230, 274, 44, 'Muhammad Husein', '2010512130', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(231, 275, 44, 'Fatih Ahmad Muzhaffar', '2010512131', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(232, 276, 44, 'Tiara Vionola Sari', '2010512132', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(233, 277, 44, 'Adhitya Fahlevi', '2010512133', 'S1 Sistem Informasi', 'Software Developer', 0, NULL, '2024-11-23 22:20:38'),
(234, 278, 44, 'Riannisa Azizah Putri', '2010512134', 'S1 Sistem Informasi', 'Software Developer', 0, NULL, '2024-10-28 07:16:59'),
(235, 279, 44, 'Amanda Nurhidayanti', '2010512135', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(236, 280, 44, 'Nugroho Aryaguna', '2010512136', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(237, 281, 44, 'Ihrom Wahyuni', '2010512137', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(238, 282, 44, 'Salsabila Faiha Puteri', '2010512138', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(239, 283, 44, 'Ray Pray Pontas', '2010512139', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(240, 284, 44, 'Sugma Ayunia Dewi Azhara', '2010512140', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(241, 285, 44, 'Syauqi Khosyi Hidayat', '2010512141', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(242, 288, 44, 'Bakkah Maulana Mashur', '2010512144', 'S1 Sistem Informasi', NULL, 0, NULL, '2024-08-25 07:31:47'),
(243, 289, 44, 'Chaerul Ilmi Al Ahyari', '2010512145', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(244, 291, 44, 'Andira Yunita', '2010512147', 'S1 Sistem Informasi', NULL, 0, NULL, NULL),
(245, 292, 17, 'Difaya Qania Nuwayyar', '2010501001', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(246, 293, 17, 'Fityara Tasya Harvina', '2010501002', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(247, 299, 17, 'Muhammad Hudan Afriansyah', '2010501008', 'D3 Sistem Informasi', 'BI Developer', 0, NULL, '2024-11-24 20:00:05'),
(248, 305, 50, 'Achmad Fauzan', '2010501014', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(249, 306, 50, 'Anfas Majdan', '2010501015', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(250, 308, 50, 'Rafi Ramadhan', '2010501017', 'D3 Sistem Informasi', NULL, 0, NULL, '2024-10-13 03:24:14'),
(251, 316, 50, 'Muhammad Sadewo Wicaksono', '2010501025', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(252, 317, 50, 'M Yanu Farhan Prasetyo', '2010501026', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(253, 321, 50, 'RENDI FAUZIANA', '2010501030', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(254, 326, 46, 'Muhammad Azcha Panghudi Luhur', '2010501035', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(255, 328, 46, 'Rayi Wicak Lazuardi', '2010501037', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(256, 332, 46, 'Jou Ezekiel', '2010501041', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(257, 339, 46, 'Erlangga Sutoyo Putra', '2010501048', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(258, 341, 46, 'Muhammad Fakhar Naufal', '2010501050', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(259, 344, 18, 'Abdul Azis Marzuqi', '2010501053', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(260, 345, 18, 'Fadiah Idzni', '2010501054', 'D3 Sistem Informasi', 'BI Developer', 0, NULL, '2024-11-24 20:06:24'),
(261, 350, 18, 'Ammar Qois Fatturrahman', '2010501059', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(262, 352, 18, 'Aqsha Nurfachrianto', '2010501061', 'D3 Sistem Informasi', NULL, 0, NULL, '2024-09-14 13:08:46'),
(263, 355, 18, 'Fadli Arfans Hakim', '2010501064', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(264, 358, 18, 'Wirangga Andriano Ramadhan', '2010501067', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(265, 360, 18, 'Mohammad Ezra Prajna', '2010501069', 'D3 Sistem Informasi', NULL, 0, NULL, NULL),
(266, 423, 5, 'Marsa Nabila', '2110512048', 'S1 Sistem Informasi', 'Software Developer', 0, '2024-10-16 17:42:09', '2024-10-28 07:39:57'),
(267, 424, 13, 'Annisa Zhafira Adhya', '2210511106', 'S1 Informatika', 'Software Engineer', 0, '2024-10-16 17:42:09', '2024-10-28 07:51:57'),
(268, 425, 35, 'Nasya Putri Salsabila', '2310501062', 'D3 Sistem Informasi', 'BI Developer', 0, '2024-10-16 17:42:09', '2024-10-28 08:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_06_145919_create_master_dosen', 1),
(6, '2023_11_10_072155_create_table_mahasiswa', 1),
(7, '2023_11_10_072709_create_data_topik_table', 1),
(8, '2023_11_10_072831_create_pengajuan_topik_table', 1),
(9, '2023_11_10_074612_create_rekomendasi_akademik_table', 1),
(10, '2023_11_10_074647_create_pengajuan_dospem_table', 1),
(11, '2023_11_26_154403_create_topik_dosen_table', 1),
(12, '2023_11_28_071604_create_forms_table', 1),
(13, '2024_06_24_135311_create_test_table', 1),
(14, '2024_08_26_151929_create_berkas_sidang_proposals_table', 2),
(16, '2024_08_26_152413_create_ruangans_table', 2),
(20, '2024_08_26_152425_create_plot_jadwals_table', 3),
(21, '2024_08_26_152426_create_ketersediaan_dosens_table', 3),
(22, '2024_08_26_152440_create_jadwal_sidangs_table', 3),
(23, '2024_08_26_152450_create_jadwal_proposals_table', 3),
(25, '2024_08_28_234458_create_site_settings_table', 4),
(26, '2024_09_08_164355_create_hasil_proposals_table', 5),
(28, '2024_09_09_220507_create_berkas_sidang_skripsis_table', 6),
(29, '2024_09_09_220539_create_jadwal_skripsis_table', 6),
(32, '2024_09_18_224534_revisi', 9),
(33, '2024_09_19_225453_revisi_jadwal', 10),
(34, '2024_09_18_223224_create_hasil_skripsi_pembimbings_table', 11),
(35, '2024_09_18_223229_create_hasil_skripsi_pengujis_table', 11),
(36, '2024_09_25_221926_jabatan', 12),
(37, '2024_10_13_125210_score_to_float', 13),
(38, '2024_10_13_133232_bebaspustaka', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_dospem`
--

CREATE TABLE `pengajuan_dospem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `topik` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `dp1_id` bigint(20) UNSIGNED NOT NULL,
  `dp2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `desc_status` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_topik`
--

CREATE TABLE `pengajuan_topik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `topik_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `desc_judul` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `desc_status` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plot_jadwals`
--

CREATE TABLE `plot_jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ruangan` bigint(20) UNSIGNED NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `prodi` varchar(35) NOT NULL,
  `jenis_sidang` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi_akademik`
--

CREATE TABLE `rekomendasi_akademik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `dosenpa_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL DEFAULT curdate(),
  `sks` int(11) NOT NULL DEFAULT 0,
  `khs_file` varchar(255) DEFAULT NULL,
  `pkm_file` varchar(255) DEFAULT NULL,
  `ukt_file` varchar(255) DEFAULT NULL,
  `toefl_file` varchar(255) DEFAULT NULL,
  `seminar_file` varchar(255) DEFAULT NULL,
  `profesi_file` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'dailyMax', '3', NULL, '2024-08-28 17:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topik_dosen`
--

CREATE TABLE `topik_dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topik_id` bigint(20) UNSIGNED NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topik_dosen`
--

INSERT INTO `topik_dosen` (`id`, `topik_id`, `dosen_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 32, NULL, NULL),
(3, 1, 39, NULL, NULL),
(4, 1, 46, NULL, NULL),
(5, 1, 55, NULL, NULL),
(6, 1, 20, NULL, NULL),
(7, 1, 44, NULL, NULL),
(8, 1, 48, NULL, NULL),
(9, 1, 17, NULL, NULL),
(10, 1, 27, NULL, NULL),
(11, 1, 10, NULL, NULL),
(12, 1, 3, NULL, NULL),
(13, 2, 2, NULL, NULL),
(14, 2, 32, NULL, NULL),
(15, 2, 39, NULL, NULL),
(16, 2, 46, NULL, NULL),
(17, 2, 55, NULL, NULL),
(18, 2, 20, NULL, NULL),
(19, 2, 44, NULL, NULL),
(20, 2, 48, NULL, NULL),
(21, 2, 17, NULL, NULL),
(22, 2, 27, NULL, NULL),
(23, 2, 10, NULL, NULL),
(24, 2, 3, NULL, NULL),
(25, 2, 23, NULL, NULL),
(26, 3, 2, NULL, NULL),
(27, 3, 32, NULL, NULL),
(28, 3, 39, NULL, NULL),
(29, 3, 46, NULL, NULL),
(30, 3, 55, NULL, NULL),
(31, 3, 20, NULL, NULL),
(32, 3, 44, NULL, NULL),
(33, 3, 48, NULL, NULL),
(34, 3, 17, NULL, NULL),
(35, 3, 27, NULL, NULL),
(36, 3, 10, NULL, NULL),
(37, 3, 3, NULL, NULL),
(38, 3, 23, NULL, NULL),
(39, 4, 15, NULL, NULL),
(40, 4, 34, NULL, NULL),
(41, 4, 13, NULL, NULL),
(42, 5, 2, NULL, NULL),
(43, 5, 32, NULL, NULL),
(44, 5, 46, NULL, NULL),
(45, 5, 55, NULL, NULL),
(46, 5, 20, NULL, NULL),
(47, 5, 44, NULL, NULL),
(48, 5, 48, NULL, NULL),
(49, 5, 27, NULL, NULL),
(50, 5, 10, NULL, NULL),
(51, 5, 3, NULL, NULL),
(52, 5, 23, NULL, NULL),
(53, 6, 23, NULL, NULL),
(54, 6, 45, NULL, NULL),
(55, 6, 46, NULL, NULL),
(56, 6, 39, NULL, NULL),
(57, 7, 49, NULL, NULL),
(58, 7, 36, NULL, NULL),
(59, 7, 44, NULL, NULL),
(60, 8, 49, NULL, NULL),
(61, 8, 15, NULL, NULL),
(62, 8, 13, NULL, NULL),
(63, 8, 34, NULL, NULL),
(64, 8, 30, NULL, NULL),
(65, 9, 4, NULL, NULL),
(66, 9, 32, NULL, NULL),
(67, 9, 34, NULL, NULL),
(68, 9, 36, NULL, NULL),
(69, 10, 10, NULL, NULL),
(70, 10, 46, NULL, NULL),
(71, 10, 39, NULL, NULL),
(72, 10, 31, NULL, NULL),
(73, 10, 55, NULL, NULL),
(74, 10, 14, NULL, NULL),
(75, 10, 45, NULL, NULL),
(76, 10, 48, NULL, NULL),
(77, 10, 50, NULL, NULL),
(78, 11, 49, NULL, NULL),
(79, 11, 10, NULL, NULL),
(80, 11, 3, NULL, NULL),
(81, 11, 47, NULL, NULL),
(82, 11, 55, NULL, NULL),
(83, 11, 44, NULL, NULL),
(84, 12, 45, NULL, NULL),
(85, 12, 10, NULL, NULL),
(86, 12, 50, NULL, NULL),
(87, 12, 48, NULL, NULL),
(88, 12, 43, NULL, NULL),
(89, 13, 3, NULL, NULL),
(90, 13, 40, NULL, NULL),
(91, 13, 55, NULL, NULL),
(92, 13, 43, NULL, NULL),
(93, 13, 14, NULL, NULL),
(94, 13, 30, NULL, NULL),
(95, 14, 14, NULL, NULL),
(96, 15, 22, NULL, NULL),
(97, 17, 32, NULL, NULL),
(98, 17, 14, NULL, NULL),
(99, 18, 31, NULL, NULL),
(100, 19, 31, NULL, NULL),
(101, 21, 32, NULL, NULL),
(102, 21, 55, NULL, NULL),
(103, 21, 22, NULL, NULL),
(104, 21, 30, NULL, NULL),
(105, 21, 43, NULL, NULL),
(106, 22, 4, NULL, NULL),
(107, 22, 18, NULL, NULL),
(108, 22, 47, NULL, NULL),
(109, 22, 14, NULL, NULL),
(110, 22, 31, NULL, NULL),
(111, 22, 30, NULL, NULL),
(112, 23, 10, NULL, NULL),
(113, 26, 4, NULL, NULL),
(114, 26, 10, NULL, NULL),
(115, 27, 36, NULL, NULL),
(116, 28, 1, NULL, NULL),
(117, 28, 31, NULL, NULL),
(118, 28, 10, NULL, NULL),
(119, 29, 31, NULL, NULL),
(120, 30, 10, NULL, NULL),
(121, 32, 23, NULL, NULL),
(122, 34, 3, NULL, NULL),
(123, 35, 14, NULL, NULL),
(124, 35, 44, NULL, NULL),
(125, 36, 31, NULL, NULL),
(126, 36, 3, NULL, NULL),
(127, 36, 10, NULL, NULL),
(128, 37, 31, NULL, NULL),
(129, 37, 37, NULL, NULL),
(130, 37, 30, NULL, NULL),
(131, 37, 22, NULL, NULL),
(132, 38, 54, NULL, NULL),
(133, 38, 31, NULL, NULL),
(134, 38, 3, NULL, NULL),
(135, 38, 10, NULL, NULL),
(136, 39, 3, NULL, NULL),
(137, 39, 10, NULL, NULL),
(138, 40, 3, NULL, NULL),
(139, 40, 10, NULL, NULL),
(140, 41, 39, NULL, NULL),
(141, 41, 31, NULL, NULL),
(142, 43, 3, NULL, NULL),
(143, 43, 10, NULL, NULL),
(144, 44, 3, NULL, NULL),
(145, 44, 10, NULL, NULL),
(146, 45, 31, NULL, NULL),
(147, 45, 37, NULL, NULL),
(148, 45, 22, NULL, NULL),
(149, 45, 14, NULL, NULL),
(150, 46, 3, NULL, NULL),
(151, 46, 10, NULL, NULL),
(152, 47, 3, NULL, NULL),
(153, 47, 10, NULL, NULL),
(154, 48, 10, NULL, NULL),
(155, 51, 3, NULL, NULL),
(156, 56, 10, NULL, NULL),
(157, 59, 31, NULL, NULL),
(158, 60, 31, NULL, NULL),
(159, 60, 30, NULL, NULL),
(160, 60, 14, NULL, NULL),
(161, 61, 31, NULL, NULL),
(162, 65, 37, NULL, NULL),
(163, 66, 31, NULL, NULL),
(164, 68, 31, NULL, NULL),
(165, 68, 14, NULL, NULL),
(166, 68, 50, NULL, NULL),
(167, 68, 48, NULL, NULL),
(168, 68, 20, NULL, NULL),
(169, 68, 10, NULL, NULL),
(170, 69, 37, NULL, NULL),
(171, 69, 55, NULL, NULL),
(172, 69, 30, NULL, NULL),
(173, 69, 14, NULL, NULL),
(174, 69, 3, NULL, NULL),
(175, 69, 10, NULL, NULL),
(176, 70, 3, NULL, NULL),
(177, 70, 10, NULL, NULL),
(178, 71, 14, NULL, NULL),
(179, 71, 3, NULL, NULL),
(180, 71, 10, NULL, NULL),
(181, 72, 14, NULL, NULL),
(182, 72, 3, NULL, NULL),
(183, 72, 10, NULL, NULL),
(184, 73, 3, NULL, NULL),
(185, 74, 3, NULL, NULL),
(186, 74, 10, NULL, NULL),
(187, 75, 14, NULL, NULL),
(188, 75, 3, NULL, NULL),
(189, 75, 10, NULL, NULL),
(190, 76, 39, NULL, NULL),
(191, 76, 31, NULL, NULL),
(192, 77, 39, NULL, NULL),
(193, 77, 10, NULL, NULL),
(194, 78, 31, NULL, NULL),
(195, 78, 10, NULL, NULL),
(196, 79, 10, NULL, NULL),
(197, 80, 10, NULL, NULL),
(198, 83, 49, NULL, NULL),
(199, 83, 47, NULL, NULL),
(200, 83, 44, NULL, NULL),
(201, 84, 49, NULL, NULL),
(202, 85, 31, NULL, NULL),
(203, 85, 27, NULL, NULL),
(204, 85, 44, NULL, NULL),
(205, 85, 10, NULL, NULL),
(206, 86, 10, NULL, NULL),
(207, 87, 55, NULL, NULL),
(208, 87, 27, NULL, NULL),
(209, 87, 50, NULL, NULL),
(210, 87, 48, NULL, NULL),
(211, 87, 44, NULL, NULL),
(212, 87, 10, NULL, NULL),
(213, 87, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim_nip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nim_nip`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Salsabila Oktafani', '2010511001', 'salsabilaoktafani22@gmail.com', NULL, '$2y$10$azWwKrP5AyT/ovbgV87TFuPRrQIjjQjUqeM3yABeBTYO.DxuK3te2', 'mahasiswa', NULL, NULL, '2024-09-26 06:59:18'),
(2, 'Muhamad Ronald Lullah', '2010511002', 'lullahronal@gmail.com', NULL, '$2y$10$zyMDp2J20nXVdY/vH0XFNuQ/nGFehFK00xN.ir2Q7.c6oVQgnxVz2', 'mahasiswa', NULL, NULL, NULL),
(3, 'Anggit Maulian', '2010511003', 'anggit123wew@gmail.com', NULL, '$2y$10$vSN7CvhA7EJ7f/g0Mha/e.DRFEEblQ7zJEMPGKXQbYZLaxLmNLuFK', 'mahasiswa', NULL, NULL, NULL),
(4, 'Enno Tegar Dwi Saputra', '2010511004', 'ennoy441@gmail.com', NULL, '$2y$10$i2sStx6jb5Xbo.qUb6CcPO2djXWq1hlnOIIlJ.Y6K35sjqIvNL9NK', 'mahasiswa', NULL, NULL, NULL),
(5, 'Muhammad Fadhillah Akbar', '2010511005', 'mfadhillahakbar14@gmail.com', NULL, '$2y$10$S7ydfk.GxvzEfLQIdZDG0OyfBvo54H1u4HmDBGaxWYk3hWpm986kS', 'mahasiswa', NULL, NULL, NULL),
(6, 'Marshela Alya Kusuma Wardani', '2010511006', 'marshela3@gmail.com', NULL, '$2y$10$r5zrzkwWe4URzFvIFHvP8.mP9S8d5g4ULc6zwunC0jojiqQ4L/PpC', 'mahasiswa', NULL, NULL, NULL),
(7, 'Zulia Agus Saputri', '2010511007', 'zuliaas05@gmail.com', NULL, '$2y$10$4R.5D8S8Vw7HHFSCRPdeBexpQjcDCQlJM/fGRezysVK6/2nazphxK', 'mahasiswa', NULL, NULL, NULL),
(8, 'Bagus Sajiwo Utomo', '2010511008', 'bagussajiwoutomo12@gmail.com', NULL, '$2y$10$bzpBU7Pj57qpshrn0hCgdeJbN8ucnLbCZn/Z44EnpewIsrhu85bie', 'mahasiswa', NULL, NULL, NULL),
(9, 'Muhammad Fhandika Rafif', '2010511009', 'dikarafif04@gmail.com', NULL, '$2y$10$4nc9BILf8L/ZAW3Y84S4M.He0io3fJB4ML2UKpbjSeCiyZu41X4O.', 'mahasiswa', NULL, NULL, NULL),
(10, 'Endow Bonapen', '2010511010', 'endowbonapen2002@gmail.com', NULL, '$2y$10$zQdHw8SlUnNCU3KElzqqNuq1TteOVdbqVxEF47KJWiGui84zIu5HO', 'mahasiswa', NULL, NULL, NULL),
(11, 'Alvin Putra Perdana', '2010511011', 'alvinputra937@gmail.com', NULL, '$2y$10$HWMMyEv4xhJ76TeXDqeJZ.xBuDzOt5o/HxTE22vnmzOHu45Elti4G', 'mahasiswa', NULL, NULL, NULL),
(12, 'Febriani Jati Nawangsih', '2010511012', 'jatinawang2019@gmail.com', NULL, '$2y$10$SBaWauch/oV/mV20aUDaAu6DC2/qDMeFkiTVWpXPdiSbWXbkLVzWa', 'mahasiswa', NULL, NULL, NULL),
(13, 'Jihan Kamilah', '2010511013', 'Kamilahjihan052@gmail.com', NULL, '$2y$10$tdz2hb5ixuNx3ZQV2r6HD.9ME5M1LqVLOixsgyHORACEw.MvAWZyK', 'mahasiswa', NULL, NULL, NULL),
(14, 'Rivardi', '2010511014', 'rivrdi@gmail.com', NULL, '$2y$10$wUBtB5Y10sXFq59wnFRIN.aSHUM4NSwNvEJnzmZt7qMl1nQE7kuby', 'mahasiswa', NULL, NULL, NULL),
(15, 'Marella Azaria Putri', '2010511015', 'marellaazariaputri@gmail.com', NULL, '$2y$10$pTkAZ9Fsr1F5ADDG/iV2xOH46DNaU6CEXgo3jtMo3q8dEdAwakJ7G', 'mahasiswa', NULL, NULL, NULL),
(16, 'Rheza Gunawan', '2010511016', 'rhezagunawan157@gmail.com', NULL, '$2y$10$Mot0raAyq6F/GLemyx6seeNVdXxtK9hIj1BgT2w.5Jod4Hv6LcCFO', 'mahasiswa', NULL, NULL, NULL),
(17, 'Arya Nur Hidayat', '2010511017', 'aryanur2802@gmail.com', NULL, '$2y$10$BmJZpkAP9USGAvahq4JzQesRvAx706txoUbopx2zxSXsEHB8FsnVe', 'mahasiswa', NULL, NULL, NULL),
(18, 'Rafi Ramdhani', '2010511018', 'Rafiramdh@gmail.com', NULL, '$2y$10$uwrIFKrHi4lrRch1EPR5XeRFAXKX1MPwL/7ejrMS3EM.Yr5E/pqWy', 'mahasiswa', NULL, NULL, NULL),
(19, 'Byqo Syach Mahendra', '2010511019', 'syadra7@gmail.com', NULL, '$2y$10$L4ntz6sFQXWx/GojzuAuw.5op.iH3Q9RetwFOvs.OuSjHHUaDvft2', 'mahasiswa', NULL, NULL, NULL),
(20, 'Rizky Firmansyah', '2010511020', 'rizkyfrsyh06@gmail.com', NULL, '$2y$10$qXsAllWxFW9ziKKnuDpmXekdyd08x0.XzSaoZdvUyKtIWBdR9XSQS', 'mahasiswa', NULL, NULL, NULL),
(21, 'Ardella Malinda Sarastri', '2010511021', 'ardellamalinda26@gmail.com', NULL, '$2y$10$FFEXODYYR.vljDZmn78zDuupUktos3sPt.8nmyxtFkwB0DqFR1Apq', 'mahasiswa', NULL, NULL, NULL),
(22, 'Mega Intan Silviana Marunduri', '2010511022', 'megaintan173@gmail.com', NULL, '$2y$10$dymrui8k3Rr3KJWz98V4Lurg1od77QioaP6KZhWAyEqVaIHAXkycm', 'mahasiswa', NULL, NULL, NULL),
(23, 'FIQRI FADILLAH', '2010511023', 'dewalinux2000@gmail.com', NULL, '$2y$10$qUW19cfNVKimYBD46ylJ1.Tp28qK26ALaKI.vSjjfgWZg51JdQCjm', 'mahasiswa', NULL, NULL, NULL),
(24, 'Rizki Firmansyah', '2010511024', 'frizki649@gmail.com', NULL, '$2y$10$6B06ZzUhpD0/PqjHUMQE6.gre9MMK49CLNtauFQCNfifQvZ.abdyi', 'mahasiswa', NULL, NULL, NULL),
(25, 'Muhammad Thoriq Al-Fatih', '2010511025', '2010511025@mahasiswa.upnvj.ac.id', NULL, '$2y$10$5QN8An5ZiDlKy1sSG80.l.zrOYPLs0VHA88O3UIC1Y2Bt44xLDK3.', 'mahasiswa', NULL, NULL, NULL),
(26, 'Nurhikmah Mawaddah Solin', '2010511026', 'nurhikmahsolin2@gmail.com', NULL, '$2y$10$8ipL5QrqLZiVdVBgbzGL6uUReb7tYaBA/50rT5CsXRB2QkuuJ/UoO', 'mahasiswa', NULL, NULL, NULL),
(27, 'Vionita Oktaviani', '2010511027', 'vnoktaviani@gmail.com', NULL, '$2y$10$BEd8RteaZ0X6o.vTOXld0OfRmpG.DxP8fpNnc1wimhESJOJ5.vrDe', 'mahasiswa', NULL, NULL, NULL),
(28, 'Mochammad Adhi Buchori', '2010511028', 'adhi.buchori@gmail.com', NULL, '$2y$10$5AbtjOOF1V6MbIcn98/Kj.kHkwEkuhholESZvXcoqUkE9JcDCxQCS', 'mahasiswa', NULL, NULL, NULL),
(29, 'Luthfiani Bahrain', '2010511029', 'luthfianibahrain@gmail.com', NULL, '$2y$10$xGzyShyAFZ3T25lux0fyf.LVe9DKxFAlo1PQ2x2NS2S8VGEYHrRlC', 'mahasiswa', NULL, NULL, NULL),
(30, 'Jozka Roihutan Siregar', '2010511030', '2010511030@mahasiswa.upnvj.ac.id', NULL, '$2y$10$w2OEgrmEDgF0OykbGzobJueG57pPhxHRGtKscB2J9ls4I9LD3rXr.', 'mahasiswa', NULL, NULL, NULL),
(31, 'Rashif Candra Zirnikh', '2010511031', '2010511031@mahasiswa.upnvj.ac.id', NULL, '$2y$10$2Vb8tAtDXtp1O9xyuPfVN.BKulJqFlNr81acjJzhTNVYv.eKhCgk6', 'mahasiswa', NULL, NULL, NULL),
(32, 'Alif Faqiih', '2010511032', 'aliffaqiih@gmail.com', NULL, '$2y$10$whN9OubqwJn6aUOS0QPjO..uikqf.7Dgs2kSCPJCCv6vUFmQQHauK', 'mahasiswa', NULL, NULL, NULL),
(33, 'Guntur Laksono Putra', '2010511033', 'gunturarshi@gmail.com', NULL, '$2y$10$GzTS7yPmUePJUtWJK6lsk.P0Tydd0znUg.983WAqk4MTBAJe41mcS', 'mahasiswa', NULL, NULL, NULL),
(34, 'R. Djoko Anung Handoko', '2010511034', 'djokoanunghandoko@gmail.com', NULL, '$2y$10$2EVYKGQ2AYnQOQIWzTsrYuEMhYiEU4/KCM2HAPrzbVWowdLcCM3aO', 'mahasiswa', NULL, NULL, NULL),
(35, 'Muhammad Ferdiansyah', '2010511035', 'ferdipro15@gmail.com', NULL, '$2y$10$ixGPUzEZux6RdLz/O1A/uegkoLXJabnzrYIiBvf2eSF97JZYC0qS.', 'mahasiswa', NULL, NULL, NULL),
(36, 'Rangga Saputra', '2010511036', 'ranggasaputra4000@gmail.com', NULL, '$2y$10$VUrxkPLSNfO9R2nQxL/JxOXeL7kHXwyZLmW/uVWlvabsK3zSZMGHW', 'mahasiswa', NULL, NULL, NULL),
(37, 'Adrian Triputra', '2010511037', 'adriantriputra.97@gmail.com', NULL, '$2y$10$1.A3ZsfqEbnlmLNBLGOsBukHTFCKes/DKjUik.grUNWq4kh9BUuX6', 'mahasiswa', NULL, NULL, NULL),
(38, 'Iftah Ridhatama', '2010511038', 'ridhatama123@gmail.com', NULL, '$2y$10$G8p7RB8CxUbv5yMCTwh9X.yMhNhkMxyY..Z8c/hgT3u1j23MgNfeO', 'mahasiswa', NULL, NULL, NULL),
(39, 'Rafiqi Yahya', '2010511039', 'rafiqiyahya@gmail.com', NULL, '$2y$10$oCySD7rAs.7Gomr0qX.2A.qnqiCcin0dRo1lejG2jyfpudSav3VD6', 'mahasiswa', NULL, NULL, NULL),
(40, 'Muhammad Akbar Pratama Putra', '2010511040', 'akbarpratama170502@gmail.com', NULL, '$2y$10$RgHHmHnFG2oQK1ybrqDQjuE4hspitDnMyShsDmSYIK6XxK7WLdqzm', 'mahasiswa', NULL, NULL, NULL),
(41, 'Wibisana Sudarto', '2010511041', 'wibisana.sudarto12@gmail.com', NULL, '$2y$10$GcmqAdquc3jUD0O5n7QunuFYo2Wgwhe1wscfkIrmyAsuhovOEgOHi', 'mahasiswa', NULL, NULL, NULL),
(42, 'Abednego Christianyoel Rumagit', '2010511042', 'abednegoefra31@gmail.com', NULL, '$2y$10$JQ1.5SPYPJp0ah5J6nlLtepxCHx5lbCEV0NPB8cuPgylE2aIyeZc6', 'mahasiswa', NULL, NULL, NULL),
(43, 'Faris Primahadi Putera Lesilolo', '2010511043', 'farisprimahadi2@gmail.com', NULL, '$2y$10$uTFv.Be4Xr.pTu4zHxU6cOE5Wo7NHe2kIoaI0YFMF3YnrCztIUmqy', 'mahasiswa', NULL, NULL, NULL),
(44, 'Raihan Kus Putranto', '2010511044', 'raihankp96@gmail.com', NULL, '$2y$10$JR0M3Cpz4/Gpha/dBx.at.x2KFnCtvyuh1xJP8pNbE.DmDnlfOJh2', 'mahasiswa', NULL, NULL, NULL),
(45, 'Melvin Marcello', '2010511045', 'melvinmarcello2978@gmail.com', NULL, '$2y$10$x8Q5ArllGckRMBxPGmxVH.nVkRk5EpfaU1IxmlCHelC2muPPieXEG', 'mahasiswa', NULL, NULL, NULL),
(46, 'Fadia Alissafitri', '2010511046', 'fadia.alissafff@gmail.com', NULL, '$2y$10$a37HcP7fLdfKNuOKBWRvh.SeFCjhf4UsQ2uW0oN/f3FOuzk04aoWC', 'mahasiswa', NULL, NULL, NULL),
(47, 'Muhammad Shidqi Wirawan', '2010511047', 'shidqi.wirawan44@gmail.com', NULL, '$2y$10$ecb6rjWcTnZTONYn.hU2PuQFPGMUrifb6X7W0HTvS1LWA8lq50ZtC', 'mahasiswa', NULL, NULL, NULL),
(48, 'RAFLI DIKA PRAMUDYA', '2010511048', 'Raflidikapramudya7@gmail.com', NULL, '$2y$10$CCmhxElA6AzIttWQ5b2CWube0rPvRpuvvU2w8lYJsCXByhmdJdvxK', 'mahasiswa', NULL, NULL, NULL),
(49, 'Adam Fauzan', '2010511049', '2010511049@mahasiswa.upnv.ac.id', NULL, '$2y$10$x0Q/4DkEhKyY5KjY9aW8F.le.F/mG7JYR9Mj7O/Slj/I0OBcIB6f6', 'mahasiswa', NULL, NULL, NULL),
(50, 'Quini Suci Ambarwati', '2010511050', 'quinisuci@gmail.com', NULL, '$2y$10$0lzOhFfdGEAKHDssacPi0ubB0UDImO2vUYPpLkfN9jjhvy4wdoMEq', 'mahasiswa', NULL, NULL, NULL),
(51, 'Riandra Putra Pratama', '2010511051', 'Riandraptr90@gmail.com', NULL, '$2y$10$UKqJVB2QhT5K9iobPJT67uJnXzqfXmz0ww3GSo3JnCPPXCQ0JZc0e', 'mahasiswa', NULL, NULL, NULL),
(52, 'Zainatul Sirti', '2010511052', 'ocazs317@gmail.com', NULL, '$2y$10$ePRhSwKUw7Wep9yD0IYXd.iaiFzEZVtbojDl1jhB3uU8ZVRWm2vp.', 'mahasiswa', NULL, NULL, NULL),
(53, 'Ibra Hasan Suraya', '2010511053', 'hasannn.9c@gmail.com', NULL, '$2y$10$YL8KGD0LuulBmJ5u.H3mBO.yWgc43iVh3VeFjuBLJncqqxkvWrwMa', 'mahasiswa', NULL, NULL, NULL),
(54, 'Muhammad Fari Abiyyudhiya', '2010511054', 'fariabyy@gmail.com', NULL, '$2y$10$LGx.qH9LTDQsKy2VgQAEJe1GCvr8KD0oM9wEG7BMfjcqFwpTGAfU6', 'mahasiswa', NULL, NULL, NULL),
(55, 'Rizky Jemal Safryan', '2010511055', 'rizkyjemal@gmail.com', NULL, '$2y$10$aWrMT/9TootFnWeQ9ZX0x.SkyunYdSg3o0QqjbeECDg8n6VkZHkH.', 'mahasiswa', NULL, NULL, NULL),
(56, 'BAYU ERIK WIBISONO', '2010511056', 'bayuerikw3@gmail.com', NULL, '$2y$10$hPhXLQLj2vlxIgCjzGkDZeVVtEBpVFX/7xJsTctCWtvJxk29KRTIu', 'mahasiswa', NULL, NULL, NULL),
(57, 'IRFAN MAULANA', '2010511057', 'irfanmaulana2802@gmail.com', NULL, '$2y$10$gBpRVByAZ1c0HUbroDkSouFSjhldX4z2K8vHwQ3BlOLlW00aO19x2', 'mahasiswa', NULL, NULL, NULL),
(58, 'Muhamad Erlan Ardiansyah', '2010511058', 'errllaannn@gmail.com', NULL, '$2y$10$oXH1zExXuUVyse8BTf4xZ.LV8xbcL4mfHNSA2wXjBSIT6tACRyKcK', 'mahasiswa', NULL, NULL, NULL),
(59, 'Ridwan Raditya', '2010511059', 'ridwan.raditya01@gmail.com', NULL, '$2y$10$8UPY6tlwBaxkf7JSo/oBTOLwTN6tG4IJwY5Ap95m/SzZ6EWxi0/4.', 'mahasiswa', NULL, NULL, NULL),
(60, 'Febby Milani', '2010511060', 'febbymln20@gmail.com', NULL, '$2y$10$iHfWUOf/P5ZY2MzQqpq7A.LFZaCEcXCHGJchosv8Bfw3isNylUYl.', 'mahasiswa', NULL, NULL, NULL),
(61, 'Arief Nur Zaid', '2010511061', 'zaidogsdjatipad.nza.anz@gmail.com', NULL, '$2y$10$treYrHqclAKzuK4ElcQvNeksF4yXlfLCzEHP0BybQNoRk6/YoBosa', 'mahasiswa', NULL, NULL, NULL),
(62, 'Eric Fernando', '2010511062', 'eric110302herly@gmail.com', NULL, '$2y$10$bpd6qSbSrFGGTcciL3ylb.Q9BdEiamtkX7qrWeemjXCADl9zeVhka', 'mahasiswa', NULL, NULL, NULL),
(63, 'Muhammad Fauzan Mufti Dhana', '2010511063', 'fauzanmd5939@gmail.com', NULL, '$2y$10$m.UTlk1cT7T9iiWVn3NNeOHi.K3S4Z29TyBAmFK/tbqp6RVmaKTOa', 'mahasiswa', NULL, NULL, NULL),
(64, 'Annisa Nur Iksan', '2010511064', 'annisanur.iksan02@gmail.com', NULL, '$2y$10$L98nwjPAO6s0hfxDolisqOiXULSFV9wD3aJTl3.MhgEf5Sv3QIGEe', 'mahasiswa', NULL, NULL, NULL),
(65, 'Kevin Gustian The', '2010511065', 'gustiankevin@gmail.com', NULL, '$2y$10$kll.Q6au0CnnU.YiX/bd8OEOtxIetsrhkBUzU0SbA0XuE2hZZZSqG', 'mahasiswa', NULL, NULL, NULL),
(66, 'Nisa Silaen', '2010511066', 'verenanisas@gmail.com', NULL, '$2y$10$1490RmVrFSgZQ2hDToGFgeup6NeT.1JWYwy4.e.kvCkAndXjaYB4O', 'mahasiswa', NULL, NULL, NULL),
(67, 'Rahman Duwi Santoso', '2010511067', 'rahmanduwis10@gmail.com', NULL, '$2y$10$JTL.An06D4AnKAc0/p798uNIV6zybN4Q/7SBRz0eaQDrqhK8lR1Ze', 'mahasiswa', NULL, NULL, NULL),
(68, 'Yudha Haryoputranto', '2010511068', 'yudhah52@gmail.com', NULL, '$2y$10$xV5zZKd4C/81GJqbrKI4/e7GKHOCFBY4erlumbiG.JpIqmKTFbag.', 'mahasiswa', NULL, NULL, NULL),
(69, 'Ivanka Larasati Kusumadewi', '2010511069', 'ivankalarasati@gmail.com', NULL, '$2y$10$wrAG4EmHC7Fkj6lGLEK78OjzLhI7/w1svOuIP/H97WlGLSnrGKDqC', 'mahasiswa', NULL, NULL, NULL),
(70, 'Muhammad Raffi Priyadiantama', '2010511070', 'Priyadiantama98@gmail.com', NULL, '$2y$10$i5JDEZ5JfsUzfms2Z2a2d.iELlwbmhMoF.mWaixe2.dYy3mq7AYp6', 'mahasiswa', NULL, NULL, NULL),
(71, 'Muhammad Alfaiz Surya', '2010511071', 'muhamadalfaiz60@gmail.com', NULL, '$2y$10$4K8nWZKVgjHdbRABqq.tP.Lp7qRqwOQ46ZlWWYkocCbJ1k6zNXrr2', 'mahasiswa', NULL, NULL, NULL),
(72, 'Marwahal Hagai Excellent', '2010511072', 'hagaiexcellent3@gmail.com', NULL, '$2y$10$/ivOOsECj9GZTJn362LeouqMJW.X34lrFGbEaAaZdVl6lUO8bg8i.', 'mahasiswa', NULL, NULL, NULL),
(73, 'Jihad Dinnurrahman', '2010511073', 'jihaddinnurrahman@gmail.com', NULL, '$2y$10$aOohqNVX3iswFdS4bJzbEucTxL2yO82ELWkPE38aHCfXNk3OvR3w2', 'mahasiswa', NULL, NULL, NULL),
(74, 'Muhammad Iqbal Saputra', '2010511074', 'iqbal.saputra369@gmail.com', NULL, '$2y$10$FWNNzkDCdfMy88IRxa7BEeW6MhPV.OwT6Wujlxp9GlgFGfCoNu9SG', 'mahasiswa', NULL, NULL, NULL),
(75, 'Dhea Syahira Julianti', '2010511075', 'dheasyahira2002@gmail.com', NULL, '$2y$10$5.mQx69nDH67HtE8mNw60e80iAU3SzmnJuGTjzN2qZdTLP1UCXTJ.', 'mahasiswa', NULL, NULL, NULL),
(76, 'Martua Pieter Roberto Simanjuntak', '2010511076', 'ucoks386@gmail.com', NULL, '$2y$10$3sjyzYaMLADR0Uk0pTdLIePDV9ie6iDK8uMeK22FpOptgPQBvSK7m', 'mahasiswa', NULL, NULL, NULL),
(77, 'Kurniawan Danil', '2010511077', 'mfaridk782@gmail.com', NULL, '$2y$10$RtzlgFYZDB4CiRsryCydEOHsQusucHSnqB2aBU.XHRV9a5YLZS5.C', 'mahasiswa', NULL, NULL, NULL),
(78, 'Muhamad Al Faza Atariq', '2010511078', 'alfaza02@gmail.com', NULL, '$2y$10$0v2vsxeY0NjXYwkNqXb7duG0lQrUgvCDClsV1eOlCdsM/dxhls.gi', 'mahasiswa', NULL, NULL, NULL),
(79, 'Nafi Dhimas Elandyaksa', '2010511079', 'dhimas8203@gmail.com', NULL, '$2y$10$DYjDz5jL6ERCf3iiI6LpWeq6oP0RkmpVw41Uuog9Sqgg5lYECvHtK', 'mahasiswa', NULL, NULL, NULL),
(80, 'Jordan Theo Immanuel Sihombing', '2010511080', 'jordansihombing17@gmail.com', NULL, '$2y$10$oxNNWMSSnRGRNOgOrfYXXOJsz7wMOQZlIiAfomIHAxwhqMClpWpx6', 'mahasiswa', NULL, NULL, NULL),
(81, 'Kukuh Fadlillah Nurendra Putra', '2010511081', 'kukuhterbang@gmail.com', NULL, '$2y$10$tkwYtZCVV6.4g4qZQdlc5ORaihOn3atIl.SGf.zkt2kuvI7P884Iu', 'mahasiswa', NULL, NULL, NULL),
(82, 'Chordan Aksa Priandoyo', '2010511082', 'chordan345@gmail.com', NULL, '$2y$10$qWWN70y2IZ.dSpGriFrMFOSCDFMyA2bG7czSpj1CXMAEmEGaP5Rjm', 'mahasiswa', NULL, NULL, NULL),
(83, 'Benny Daniel Bahari', '2010511083', 'bahari.benny@gmail.com', NULL, '$2y$10$KfhOhwf4wdxuLsIy3cKziOJoZiBSsY3Um9R/m38yxqZ3YjSx..tsS', 'mahasiswa', NULL, NULL, NULL),
(84, 'Irfan Muhammad Guvian', '2010511084', 'guvian14@gmail.com', NULL, '$2y$10$fHt7dwwaK2fbRarDzH3d/.C0y4Ljhv.mBECVtHsxFBi5c1B4Qvr8i', 'mahasiswa', NULL, NULL, NULL),
(85, 'Nur Afiifah Az-Zahra', '2010511085', 'afiifahzahra@gmail.com', NULL, '$2y$10$32glThTVOrKG6kaMbAtA6uVBGQpxm44Y.ubBdovCyUjb/tmYDIW7y', 'mahasiswa', NULL, NULL, NULL),
(86, 'Daffa Rasyid Naufan', '2010511086', 'daffa.naufan@gmail.com', NULL, '$2y$10$qkcUlCvaT/99Q.ZX0p7BQufdsqDUSM.YL.JEhjpjMOSN52LxsQJwO', 'mahasiswa', NULL, NULL, NULL),
(87, 'Resti Aprilia', '2010511087', 'restiaprilia74@gmail.com', NULL, '$2y$10$PYP.A17wS2DjTM0TZmHwF.XhEm49YE8S.mYhn8yqn67VL.q1Ti04W', 'mahasiswa', NULL, NULL, NULL),
(88, 'Bara Rifqi Ath Thoriq', '2010511088', 'bararifqi212@gmail.com', NULL, '$2y$10$rN7dH2mzQvCVDYK99hpbfePSkeaoHdlPnFzqUPfbknQO58cGo9M1a', 'mahasiswa', NULL, NULL, NULL),
(89, 'Fernanda Andyka Putra', '2010511089', 'ferdiykaputra@gmail.com', NULL, '$2y$10$DWU1A48rVQVVeUwUwWAM2.IQivbtvjcqZrzgqV5tftFQmfq1YXBwW', 'mahasiswa', NULL, NULL, NULL),
(90, 'Nauval Laudza Munadjat Pattinggi', '2010511090', 'Laudza08@gmail.com', NULL, '$2y$10$DISvEwc2oK/iI6YO/jdQs.P/8nc99cSP4bhaY5Y8Ko1W.HzW2y8QC', 'mahasiswa', NULL, NULL, NULL),
(91, 'Yaasintha La Jopin Arisca Corpputy', '2010511091', 'corpputy@gmail.com', NULL, '$2y$10$q7L26sYqb1mCgGr4kT4ReO6KPxEzjDwO7hlDtvMRSbMZFKPaAyGf6', 'mahasiswa', NULL, NULL, NULL),
(92, 'Muhammad Ghozi Attamimi', '2010511092', 'mzighozi@gmail.com', NULL, '$2y$10$afaIWDAHaXXcEPaOGam4xOsx/6X/Cy64utnil996QzZbeNGxsKBWC', 'mahasiswa', NULL, NULL, NULL),
(93, 'Gani Eka Santoso Wijaya', '2010511093', 'ganisantosoeka@gmail.com', NULL, '$2y$10$S8weiEfs0jzgRC/oWFCClOAf0QCedCGA4mf1Wgjc8UvRdsey9StFC', 'mahasiswa', NULL, NULL, NULL),
(94, 'Ken Ksatria Bahari', '2010511094', 'kenksatriab@gmail.com', NULL, '$2y$10$gCYkVBqBlb9gDnDMuep3q.DPJ0IpB4/QiOSvpyrn1Go8CV956pLFC', 'mahasiswa', NULL, NULL, NULL),
(95, 'Harianto Billy Tandias', '2010511095', 'hbtandias@gmail.com', NULL, '$2y$10$SNCG0CXa/rqyVpjJ.blTtut8uqcHNHmx0gpZgsbxbqyDmHEkiaq/m', 'mahasiswa', NULL, NULL, NULL),
(96, 'Rafi Musthafa Rustianto', '2010511096', 'rafimusthafa74@gmail.com', NULL, '$2y$10$hMOD5Cp5xBZ/1Up58Z0PrelPTdJnd7wZsC5CNQ61trV0p3g9DdO9.', 'mahasiswa', NULL, NULL, NULL),
(97, 'Pranarendra Dwikurnia', '2010511097', 'pranarendra@gmail.com', NULL, '$2y$10$pKWI.PWzVIRf41z2eqDe3uRAvh4ZEuoVqgS622Pl8QGpw7v7xHrsK', 'mahasiswa', NULL, NULL, NULL),
(98, 'Amalia Hasanah', '2010511098', 'amaliaahasanah@gmail.com', NULL, '$2y$10$.I3PVJbOdhj2LRi5NrCbuuToILs/prfSl6540d2/BABPuPGr9Yc7.', 'mahasiswa', NULL, NULL, NULL),
(99, 'Annisa Refalinanda Putri', '2010511099', 'Annisarefalinanda@gmail.com', NULL, '$2y$10$PuzJEpPSP8h1Nl..bJCTeOZNs45TERZIgikKvAYAN4ypm.LhcV7dS', 'mahasiswa', NULL, NULL, NULL),
(100, 'Givery Maradillah Yutarsyah', '2010511100', 'giverymaradillah@gmail.com', NULL, '$2y$10$AEpRuCOJ/VlRikNxiGEHm.E.B6hEhW6pHUGUbY.UbnUDTrW9i8VGm', 'mahasiswa', NULL, NULL, NULL),
(101, 'Wahyu Ilyun Al Ghifahri', '2010511101', 'wahyu.fahri18@gmail.com', NULL, '$2y$10$tQs7wMlqCbs0dex1YlmMoeqNDDmpi3jrfwXrAFKolA71.4OfJX5Qm', 'mahasiswa', NULL, NULL, NULL),
(102, 'Al-Aqsa Krisnaya Abidin', '2010511102', '2010511102@mahasiswa.upnvj.ac.id', NULL, '$2y$10$zNHB6L5UA5whzn7zK1UjOuDsy/Z9K9KC2L/F6hneUCUPyghv8bBWO', 'mahasiswa', NULL, NULL, NULL),
(103, 'Aldi Rusdi', '2010511103', 'Aldirusdi12@gmail.com', NULL, '$2y$10$OgayBNgDxshVesFTMF59zO66GBO.oBUt6TR2Cdc1c4OXGSLKzfxeC', 'mahasiswa', NULL, NULL, NULL),
(104, 'Fairuz Elqi Mochammad', '2010511104', 'elqimochammad12@gmail.com', NULL, '$2y$10$s55qTWCiQ6ZhR6V6FQZQGezRn5ORoAM17qTqIS2P1wU9YPwKpSLNy', 'mahasiswa', NULL, NULL, NULL),
(105, 'Haykal Gibran Hakim', '2010511105', 'haykalgibran46@gmail.com', NULL, '$2y$10$E7o8.wjw5X7NiHTTU5/3KOgsfNatJIJHru.YEGUdJ5qlmS8yP/bdm', 'mahasiswa', NULL, NULL, NULL),
(106, 'Johanes Gerald', '2010511106', 'jojohanesgerald@gmail.com', NULL, '$2y$10$YmUCsO160w8pnyCKw8TLWetby3HtVNTKEjcCkSBzRFBKmNgFTXPNO', 'mahasiswa', NULL, NULL, NULL),
(107, 'Annisa Fitriatuzzahra', '2010511107', 'annisa.fitriatuzzahra@gmail.com', NULL, '$2y$10$3pIWEKJh4ThR/M.yiBs8eeecfF9JjUVQ4EPUbpG03L/HRbGuflSlK', 'mahasiswa', NULL, NULL, NULL),
(108, 'Wiaji Robian Dwi Cahya', '2010511108', 'wiajirobiandwicahya25@gmail.com', NULL, '$2y$10$HQc0bHhYBmTzCZFn1Q3oj./WeTY/LrOQ7hEiMP9oymtoGSfqG6pWe', 'mahasiswa', NULL, NULL, NULL),
(109, 'Muhammad Tsany Nur Iman Kurbiana', '2010511109', 'muhtsanynur.9c@gmail.com', NULL, '$2y$10$8v34/bynPKJg4umO/yeCKuxt9aq8ixLM/wGoJ0tugzyLFkPx7/s9S', 'mahasiswa', NULL, NULL, NULL),
(110, 'Muhamad Wildan Akasyah', '2010511110', 'wildanakasyah@gmail.com', NULL, '$2y$10$gIdrv6yk1d.BWubofDO5bOCqlBcMyMLwsH9flYzIvRsRzKs76g7l2', 'mahasiswa', NULL, NULL, NULL),
(111, 'Muhammad Helmi Azhar', '2010511111', 'helmiazhar311201@gmail.com', NULL, '$2y$10$bZeVuURoWv1/.NtAHfiYSeb.nXBnyMn58m1LPS.MW37ycM/e62NlO', 'mahasiswa', NULL, NULL, NULL),
(112, 'Rahul Eky Saputra', '2010511112', 'Resaputra1007@gmail.com', NULL, '$2y$10$KM9Sa11k/InIFZQi97hu/OPmgtc.AoXXF5NtZL6Woc.mVqmNILW1y', 'mahasiswa', NULL, NULL, NULL),
(113, 'Ahmad rizki hardiansyah', '2010511113', 'hardiansyahrizki018@gmail.com', NULL, '$2y$10$O968pGFfAk9gJ2uk/8t.yOwm9n3gLf7O7bNDSol3Q4k6lCbLnu2CC', 'mahasiswa', NULL, NULL, NULL),
(114, 'Ardimas Dwi Suprayogi', '2010511114', 'dimasdwisuprayogi@gmail.com', NULL, '$2y$10$MxnRQbQ7P0zO2tIVG.9lSOCXBaChHi.OIf2cREp20S9ud7ZkKnmq2', 'mahasiswa', NULL, NULL, NULL),
(115, 'Rachall Ramdalu Gunawan', '2010511115', 'ramdalu25@gmail.com', NULL, '$2y$10$PpjzzESlHQ2duY4V3/0miOb07O2CLOZwIRlCzmxIORAZca.tcTf0W', 'mahasiswa', NULL, NULL, NULL),
(116, 'Muhammad Ihsanuddin Romdloni', '2010511116', 'ihsan.romdoni17@gmail.com', NULL, '$2y$10$YuYKeqlpkYojAm76.GmGBeW7XVFyx.TqJpJO9Lps13ShqqHYEh1MO', 'mahasiswa', NULL, NULL, NULL),
(117, 'M. Ilham Robbani', '2010511117', 'rabbani.ilham2002@gmail.com', NULL, '$2y$10$aIKCZsF/AkcJ8uDDtuPpHO.i9wA7WKvgNqiAoNv15qPsA23lN4EtO', 'mahasiswa', NULL, NULL, NULL),
(118, 'Alysha Zahira Farras Ihsani', '2010511118', 'alysha.zahira@gmail.com', NULL, '$2y$10$9z6CuZOyAZS7zsvhFIWxheu3mZkmNM.Ki73im/Sp5EEFI39d2uz.2', 'mahasiswa', NULL, NULL, NULL),
(119, 'Abyakta Wibisono', '2010511119', 'abyaktawibizitron@gmail.com', NULL, '$2y$10$C1QZgfEfo29rFExI9QOHPe44z2iJjYzBDhvuqJl/gW2Q5/K4gQ2dC', 'mahasiswa', NULL, NULL, NULL),
(120, 'Muhammad Faturrahman', '2010511120', 'mfaturrahman152002@gmail.com', NULL, '$2y$10$LUF0jaqrjoAx2pQ7.X9SDOrTGOwOtgQ/Na3yGfKQndIgzkTZec6wO', 'mahasiswa', NULL, NULL, NULL),
(121, 'Zaki Zhafarian Indraputra', '2010511121', 'zaki.indraputra@gmail.com', NULL, '$2y$10$pi12nvfeDKCAK7I3v3ES.OhHOSEwhXa1A7UQgZHZixZDQq.9iAUwW', 'mahasiswa', NULL, NULL, NULL),
(122, 'Dika Rahman Maulana', '2010511122', 'dhikarm77@gmail.com', NULL, '$2y$10$c7hf4KffXY3N5YI.cMBqCu/7saAh.y0OlqhqlC9mijtHgaU3qZjne', 'mahasiswa', NULL, NULL, NULL),
(123, 'Muhammad Fadhlan Wijaya', '2010511123', 'fadhlanwij17@gmail.com', NULL, '$2y$10$sHxN4/NlMb/nEL3saq49ju88sYQPQT0YwdQ75ppzNttZG4UX9sm0m', 'mahasiswa', NULL, NULL, NULL),
(124, 'Ihwan Nurarif Wibowo', '2010511124', 'ihwanmail375@gmail.com', NULL, '$2y$10$rBLTm0OO8hvibmJQrYczCOf.wQaVeC4I2j/AmQgRv0pxq5EfGCYu.', 'mahasiswa', NULL, NULL, NULL),
(125, 'Daffa Tangguh Ananda Kurniawan', '2010511125', 'Daffatangguh02@gmail.com', NULL, '$2y$10$uxadsZVMnC67hptT4n1jiePwaCgderL83FVDv2iVO/OONBl4iEVNy', 'mahasiswa', NULL, NULL, NULL),
(126, 'Muhammad Mitchell Tri Octaviano Syaifullah', '2010511126', 'muhammadmitchell06@gmail.com', NULL, '$2y$10$3Ywc5aSQfiHP0oX5ST1HdepzUTtdPca6xs5wOhEHeAN/Nf9Eo7eAO', 'mahasiswa', NULL, NULL, NULL),
(127, 'Gennaro Fajar Mennde', '2010511127', 'gennarofajar@gmail.com', NULL, '$2y$10$1djXa6aRb3HgtxUsDz87feDr9o04bNtQYJlBA/H6WnFXEJevUkywi', 'mahasiswa', NULL, NULL, NULL),
(128, 'Odelia Nayaka', '2010511128', 'odelianayaka26@gmail.com', NULL, '$2y$10$lrbY3ogmu7ecn/3oo.RQ.eEUhwp1KWff6ZC9L7oxGt4bqUklACGH2', 'mahasiswa', NULL, NULL, NULL),
(129, 'Daffa Rabbani', '2010511129', 'rabbanidaffa11@gmail.com', NULL, '$2y$10$FHOWxPmrAWs9/szqqcvs5eKm6ZCsAhKRNCnedjBhfq6Igu.1FhW.S', 'mahasiswa', NULL, NULL, NULL),
(130, 'Tedja Diah Rani Octavia', '2010511130', 'raniranoc@gmail.com', NULL, '$2y$10$kKBoNZlo8SB1H3jawJfafOkGn4xo2PZvwGr06hr8eLtXnr.ZRmyqi', 'mahasiswa', NULL, NULL, NULL),
(131, 'Rafigo Ghimar Firman', '2010511131', 'rafigo.ghimar@gmail.com', NULL, '$2y$10$acnndjrKz6JCngO/mAIsXuo1BsFOTlTZMF6NNvl7.QKIKqFSIqiba', 'mahasiswa', NULL, NULL, NULL),
(132, 'Lail Akbar Nugraha', '2010511132', 'lailakbar366@gmail.com', NULL, '$2y$10$6eEEkawRAAI0ecIP1kohWeUq2c2arSv9oP2a.Gl0GR1QzmDwmo2cC', 'mahasiswa', NULL, NULL, NULL),
(133, 'Rahmat Afriyanton', '2010511133', 'rahmatafriyanton@gmail.com', NULL, '$2y$10$xAT0WKOGUaep/Qs.TYZ.wOLEYIHM2OTjnJ75AX68SfY0aCAjj5Kf.', 'mahasiswa', NULL, NULL, NULL),
(134, 'Raihan Hadi Athalla', '2010511134', 'raihanhadi100@gmail.com', NULL, '$2y$10$3ENwCs97mdDR9wkg9A8.g.RBP4Ls/EQUpxMZaUOkXamNCqayRvuVK', 'mahasiswa', NULL, NULL, NULL),
(135, 'Sarah Yuniza Dewi Anggadinata', '2010511135', 'sarahyuniza74@gmail.com', NULL, '$2y$10$J60IU8kkOPGVU4V7s03QquZGP.zlg9f6jlrbIywOImaJ4t1Ugs622', 'mahasiswa', NULL, NULL, NULL),
(136, 'Akmal Yusran Rizqiansyah', '2010511136', 'akmalican303@gmail.com', NULL, '$2y$10$ayyve3Bmvi7kRlufSXG2GuQ06ahBJHDjWTlrQrGtfLwzbp3p.8GcG', 'mahasiswa', NULL, NULL, NULL),
(137, 'Mokhammad Raviandra', '2010511137', 'ravi.andra08@gmail.com', NULL, '$2y$10$2AfUbMV4NpVI/PQ/10SlO.ddFmuaiZEW4TgDaFqi3hDe72IpMxsSO', 'mahasiswa', NULL, NULL, NULL),
(138, 'Muhammad Faris Ramadhan', '2010511138', 'farisramadhan27@gmail.com', NULL, '$2y$10$G3mMbBS00WpDoMg49lHuKO4gOa7Ta7IVss7thtceVcNu/OUX.UVHq', 'mahasiswa', NULL, NULL, NULL),
(139, 'Savina Rizdafayi', '2010511139', 'savinarizdafayi@gmail.com', NULL, '$2y$10$YxIevvpMQhsv4ljxej0ov.2rEkxZ6gGMHt7j9Xol2JAN4r/E7URiy', 'mahasiswa', NULL, NULL, NULL),
(140, 'Gilbert Hasiholan', '2010511140', 'gilbertxthief@gmail.com', NULL, '$2y$10$jduK2Ve3Z6qvtDqHcrBAsuaUPeN8S91ycvs4xHMefg2Pk/7Vfs8vi', 'mahasiswa', NULL, NULL, NULL),
(141, 'Rizanis Aqshol Himam', '2010511141', 'rizanis9823@gmail.com', NULL, '$2y$10$9zFLCQ4j1eZt9vboWym0W.Ew5cul.dc1IxJzysPj1B4R3uo/GTqG6', 'mahasiswa', NULL, NULL, NULL),
(142, 'Tito Candra Septio', '2010511142', 'titocs845@gmail.com', NULL, '$2y$10$ii.RUWth/yUxHMujRarAuuGSAMK2m4t4kFoqLXJZW.RUYAZw5csn.', 'mahasiswa', NULL, NULL, NULL),
(143, 'Nida Zakia Aldina', '2010511143', 'nz.aldina@gmail.com', NULL, '$2y$10$OROS9i1b5LcuCdrYeQRom.iq/khaWZC.z4e2cv4JPZLnQ6KSM0TVK', 'mahasiswa', NULL, NULL, NULL),
(144, 'Narendra Faza Ramadhan', '2010511144', 'Narendra.faza@gmail.com', NULL, '$2y$10$liPaWDk0a2wWLma8blS.ZusRGpDQatSqdkct0EHwL0eWuPuws9PQm', 'mahasiswa', NULL, NULL, NULL),
(145, 'Farell Aldi Kusuma', '2010512001', 'farellaldi29@gmail.com', NULL, '$2y$10$cDyydJ6CaBylhJthJOBsneiD9EvRjKxssQDBdd8DMyDNyrwxT88SS', 'mahasiswa', NULL, NULL, NULL),
(146, 'Muhammad Azka Rizki', '2010512002', 'azkarizki13@gmail.com', NULL, '$2y$10$0F2QthssPVqeI9ASWyXLPOea3xvDGAyuIT8ExmSJ4IfUYq70IXBCa', 'mahasiswa', NULL, NULL, NULL),
(147, 'Anwar Nassihin', '2010512003', 'anwarnasihin1606@gmail.com', NULL, '$2y$10$p2P1Yn0buwfSX2oZf4MGY.ZMUYzARMQc5v4w9nCy.934HNOvv/F8W', 'mahasiswa', NULL, NULL, NULL),
(148, 'Berliana Septyani Suganda', '2010512004', 'berlianaseptyani18@gmail.com', NULL, '$2y$10$qjkP63IJ9JkQ9asvixERrunYxdE2bzyN.GlFz6buAl300ZKVWnGc.', 'mahasiswa', NULL, NULL, NULL),
(149, 'Della Chintiya Dewi', '2010512005', 'della.chintiya@gmail.com', NULL, '$2y$10$WGEWK9hhWMeTaHpMbMsVqeibHCciMrBD1vzNOA9k/KyYJ4GdzoUhK', 'mahasiswa', NULL, NULL, NULL),
(150, 'Raissa Gabriella Putri', '2010512006', 'raissagabriella0106@gmail.com', NULL, '$2y$10$7k8OVe/DSnIzfe6lFRgvvuzIUPoL92jeomzBVcA1KtvFhQ5lL.hD6', 'mahasiswa', NULL, NULL, NULL),
(151, 'Astri Widyanti Sopandi', '2010512007', 'astriwss27@gmail.com', NULL, '$2y$10$flr0g0rVl5vOiLOqhK2.I.WCu3P8TlgIKJdwAgtW5gO/VrhBocFdK', 'mahasiswa', NULL, NULL, NULL),
(152, 'Nayla Tinneke Kusmawardhani', '2010512008', 'naylakusmawardhani19@gmail.com', NULL, '$2y$10$GOVH7lgeJugk8HNDqad0FurB4B8mvCbHuhQ947wQfzhfSStmGLf46', 'mahasiswa', NULL, NULL, NULL),
(153, 'Nurcholis Adam Zhuhri', '2010512009', 'adamzhuhri01@gmail.com', NULL, '$2y$10$01nvrBxZ/2nx9kg/kmfMberFkbccAjiAv//sPe3FPerpkb8PMm95G', 'mahasiswa', NULL, NULL, NULL),
(154, 'Mila Milenia Indah Sibarani', '2010512010', 'milasibarani02@gmail.com', NULL, '$2y$10$g/VwXO.N8aFoGpQUCcTx9eEn43EdeR09rhvROmBarqLiIOd8yyJmK', 'mahasiswa', NULL, NULL, NULL),
(155, 'Riska Lutfiatul Musfiroh', '2010512011', 'rlutfiatulmusfiroh@gmail.com', NULL, '$2y$10$Zf9VERUSnThyGyltuU8BcO/Bkh0XwE3c4jmKa4pXKTc5hVnN0hRTm', 'mahasiswa', NULL, NULL, NULL),
(156, 'Nabil Muhammad Raihan', '2010512012', 'namura152@gmail.com', NULL, '$2y$10$Dv1K06sXpuckVlxrVA9xReBbvVHYCgdL8ciiSwLEjrr/If9XvahnO', 'mahasiswa', NULL, NULL, NULL),
(157, 'Irma Zerlina Mahirah', '2010512013', 'irmazerlinam@gmail.com', NULL, '$2y$10$HSMJjDQVPtyVpOCYDVpKieu8GzWU5jviVKNOe6g8.DnGatqnwmpku', 'mahasiswa', NULL, NULL, NULL),
(158, 'Marselindra Malihan Putri', '2010512014', 'marselindra99@gmail.com', NULL, '$2y$10$iUILn3WXRyBqzJriUqi6ye8D.9jeK6csQFU/ArPOdFqEfMNuxvCLO', 'mahasiswa', NULL, NULL, NULL),
(159, 'Aisyah Alsyafira Gumay', '2010512015', '2010512015@mahasiswa.upnvj.ac.id', NULL, '$2y$10$zGGSkKARMmPyMhHfKC0q8ur82OypbDGedPeUM4NRMLMD6Lxb4ClxG', 'mahasiswa', NULL, NULL, NULL),
(160, 'Ni Komang Lusinta', '2010512016', 'komangshinta2002@gmail.com', NULL, '$2y$10$uuzIGKZhAqATZZkg0n.Ft./u64GoweLVUxtHCvjkaandGSgQIIEym', 'mahasiswa', NULL, NULL, NULL),
(161, 'Zulfatul Azizah', '2010512017', 'Zulfaazizah2807@gmail.com', NULL, '$2y$10$hAe1eEXj1lwsBhD9pGC8k./RXDw3fHzlPQmZaluWtG2YJGW0zOP46', 'mahasiswa', NULL, NULL, NULL),
(162, 'Safana Hidayati Putri', '2010512018', 'safanaputri782@gmail.com', NULL, '$2y$10$09i88enHZR3HQSq3T6Dj8uZFw3jpA94OtBxYliaWP9AA2fFi15lB6', 'mahasiswa', NULL, NULL, NULL),
(163, 'Ricky Syarifuddin Septian Mateka', '2010512019', '2010512019@mahasiswa.upnvj.ac', NULL, '$2y$10$qdRt4/9D2zij7s2tNdGN/etwPsvDV0g5Wt44W76aAtklCOVDbHtii', 'mahasiswa', NULL, NULL, NULL),
(164, 'Ananda Alvi Al Fadhli', '2010512020', 'ALVI0206@GMAIL.COM', NULL, '$2y$10$eZmdeD6qTGDDKCt/y4D0ceFJOb6lhf/YjpE/ehvg2N/IL/YH0aQQi', 'mahasiswa', NULL, NULL, NULL),
(165, 'Fahry Amzar', '2010512021', 'fahryamzar31@gmail.com', NULL, '$2y$10$sbec5DSionpPylnilhYv7.XLTK5pUV1pg8ltH4dcUemVbJAWqlE5u', 'mahasiswa', NULL, NULL, NULL),
(166, 'Rivan Apta Kusuma', '2010512022', 'rivanapta@gmail.com', NULL, '$2y$10$01F/0e55MrIforJf.BnlMuvdZe70IxajUhBI6H7.xcMSg3kBD/3aa', 'mahasiswa', NULL, NULL, NULL),
(167, 'Juwita Istiqomah Trahira', '2010512023', 'juwitaimoet8555@gmail.com', NULL, '$2y$10$TB3Pyjby.YymCrQgLoR7WOQvkMGoP9YxYmM0kTqpAv9CXAbaWPkuG', 'mahasiswa', NULL, NULL, NULL),
(168, 'Rizka Maulidina Sutrisno', '2010512024', 'rizkamaulidina72259@gmail.com', NULL, '$2y$10$zurqsn5/hjpsqOcGO9xspeCGAEtSphJxJJtwY3CKo5bTzi5/Qvgzi', 'mahasiswa', NULL, NULL, NULL),
(169, 'Natasya Febriyanti', '2010512025', '2010512025@mahasiswa.upnvj.ac.id', NULL, '$2y$10$yqrUREa4X4URT4wdUenmkufBukOMiQ84YXGjTgkOcSwzBOKxhjM4e', 'mahasiswa', NULL, NULL, NULL),
(170, 'Juniver Christian Natanael', '2010512026', 'njuniver@gmail.com', NULL, '$2y$10$TEXc//k.5L79f9lX2C3Vp.olFdpt.ISuhGH3mZFGUeNR42hw41ZUW', 'mahasiswa', NULL, NULL, NULL),
(171, 'Putra I\'zaz Dany Rizq Bramasta', '2010512027', '2010512027@mahasiswa.upnvj.ac.id', NULL, '$2y$10$oRMXnln2xJfZ49uUKhqlKOtJmqjbZuDC6FdTeEcwzNT3awqIEztqa', 'mahasiswa', NULL, NULL, NULL),
(172, 'Joyce Patricia', '2010512028', '2010512028@mahasiswa.upnvj.ac.id', NULL, '$2y$10$oAvOBKWtGib2OVXLSDczruSAmdP6wX0pv0ZvDpx/OkhnIjTuxpk0y', 'mahasiswa', NULL, NULL, NULL),
(173, 'Winny Annisa Fadhila', '2010512029', 'winnyannisaa21@gmail.com', NULL, '$2y$10$g0uhnFsUvPNc3yv3h4gp0ePGHQugkWF/AU5lEN/SebSgmFsogI7VC', 'mahasiswa', NULL, NULL, NULL),
(174, 'Daffa Andika Zain', '2010512030', 'daffa.andikazain@gmail.com', NULL, '$2y$10$5/ET3avZtxIeJ29/bD.4q.hS5Gfk7o8V4DrQ/gpFXdtj8nMeWP.TO', 'mahasiswa', NULL, NULL, NULL),
(175, 'Muhamad Arif Boediman', '2010512031', 'marifboediman772@gmail.com', NULL, '$2y$10$DOwUwmSpXRGayatvQyjvVOwBIxMmM8LYyoY6pn5epC6/sC/ToRDJm', 'mahasiswa', NULL, NULL, NULL),
(176, 'Regina Josephine', '2010512032', 'josephine.regina3@gmail.com', NULL, '$2y$10$H3KmrquYhsf3v0Cgu1e5q.jutwz5KaY0Qz.D3Bv0ehxwrJ.CpOYsC', 'mahasiswa', NULL, NULL, NULL),
(177, 'Vissi Varrel Vedatama Sungkono', '2010512033', 'varrelvs04@gmail.com', NULL, '$2y$10$dMvsuqcwTeCf7q6JcsaV9ObC2F/eQGFkjAFEp8uF0.AoyCMSJtK5y', 'mahasiswa', NULL, NULL, NULL),
(178, 'Maulana Yusuf', '2010512034', 'ymaulana089@gmail.com', NULL, '$2y$10$e6zhVUp.sO4XcJBEW76DOuU/yKnT1VcFvY3nBkPRo2WaPduu04AQa', 'mahasiswa', NULL, NULL, NULL),
(179, 'Dinda Aulia Setianingsih', '2010512035', 'dindaaulias864@gmail.com', NULL, '$2y$10$VTNmxkximZRkSsTsX/DhaOOSM5CuW26RWxlDocr0U5TYteSWRXqPW', 'mahasiswa', NULL, NULL, NULL),
(180, 'Naila Noelany Maharani', '2010512036', 'Nailanoelany@gmail.com', NULL, '$2y$10$.Yx8ksbEPPZ1xG54X0Up.OfZkuqsV.mVH/3LlK2tBMQvfyGy/Plra', 'mahasiswa', NULL, NULL, NULL),
(181, 'Muhammad Safier Al Kahfa', '2010512037', 'kahfakun2@gmail.com', NULL, '$2y$10$1rY8rA9m8q9XCK3GZsdVKe2HR2diqqyhilEGYbUihfDggoOivTKzG', 'mahasiswa', NULL, NULL, NULL),
(182, 'Muhammad Albirr Inzal Yazidillah', '2010512038', 'muhammadinzal21@gmail.com', NULL, '$2y$10$XM0vWf5MRT/Lnf4b656xLuwMXoWb71MXChFqRoOrY7NuOdyzL0i8i', 'mahasiswa', NULL, NULL, NULL),
(183, 'Helwa Saudah', '2010512039', 'helwasaudah24@gmail.com', NULL, '$2y$10$XFOnn73OkiGdp0YVYb6TBe8B332Eg12RVLiVG.TqX.48HaO4xRzYO', 'mahasiswa', NULL, NULL, NULL),
(184, 'Rasikh Hafizh Fawushan', '2010512040', 'rasikhacik@gmail.com', NULL, '$2y$10$IM/F3pH5C6.Z3BzLVMGQlO0qBylbcFzOL4UXIJ4O4uKRDPLdrB4l2', 'mahasiswa', NULL, NULL, NULL),
(185, 'Muhammad Pradipta Yudhistira', '2010512041', 'yudhisrock@gmail.com', NULL, '$2y$10$NvSTyJjSAAJfkfc3FrIbrefluqO/1e.vdIo/7UQiFNjZHQH3AZUge', 'mahasiswa', NULL, NULL, NULL),
(186, 'Sofi Aisya', '2010512042', 'sofiaisya07@gmail.com', NULL, '$2y$10$nxhZAlpWW.SV8fPpRTvNB.u/TAcx8GnUz4Nqv3f93gxrL/InP/aPW', 'mahasiswa', NULL, NULL, NULL),
(187, 'Rifaniel Freldemar', '2010512043', 'firelsltng@gmail.com', NULL, '$2y$10$6g.ztYP2tyg6AE9Xd.hY/etHmjq4pFqRdMfk5wzEx.OS2CfqnKi/i', 'mahasiswa', NULL, NULL, NULL),
(188, 'Siti Fathimah Azzahra', '2010512044', 'sf.azzahra1703@gmail.com', NULL, '$2y$10$wr0bdep821vdFOSzhaONoO848OHTbhHTcym4SluDyUDcQHHECpHn2', 'mahasiswa', NULL, NULL, NULL),
(189, 'Bakti Samuel Barus', '2010512045', 'samuelbar845@gmail.com', NULL, '$2y$10$CisMa272wsTWO4DOrRzjm.jOfWZ3K0lL9pOb0xz38B.5WL9duttMe', 'mahasiswa', NULL, NULL, NULL),
(190, 'Rahmi Alianazahra', '2010512046', 'ralianazahra@gmail.com', NULL, '$2y$10$56YMZWhikrz5OMvGRmob/ep96/T7wKLd7zl6i26S7/vNoHg3h3x9C', 'mahasiswa', NULL, NULL, NULL),
(191, 'Tsaabitah Anggraini', '2010512047', 'tsaabitah15@gmail.com', NULL, '$2y$10$x696R7P9d1Qpnx4qJo9WFeKfF6FYfB0usgxp8mqFN0704qFVAJRUW', 'mahasiswa', NULL, NULL, NULL),
(192, 'Fikri Zakka Atqia', '2010512048', 'fikriatqia5102@gmail.com', NULL, '$2y$10$rIyK13iEGCoFNdqVuLDVJOR6Hh8klUCo/ngf3bSQZythcjkwodRUa', 'mahasiswa', NULL, NULL, NULL),
(193, 'Adzra Sajida', '2010512049', 'adzra.sajida02@gmail.com', NULL, '$2y$10$LYJcnTvLNiceopWVGUDwp.oaZIKVGnV8rVT6ASA8OU/DsJoVP.8P2', 'mahasiswa', NULL, NULL, NULL),
(194, 'Alya Rasenta Dewi', '2010512050', 'alyarasenta@gmail.com', NULL, '$2y$10$MqWyAyH7HqjbwxQkME.Z.u1ITz0HFZno5VJ4g6Zih4lvzrwHZSAbW', 'mahasiswa', NULL, NULL, NULL),
(195, 'Riza Varia Putra', '2010512051', 'variaputra8@gmail.com', NULL, '$2y$10$Ksmue66jvf8E2RJPOuFujOxPOFzaGABhQmeEz8vTNfg5e4F4AdWYu', 'mahasiswa', NULL, NULL, NULL),
(196, 'Alifia Sari Putri Diana Nur Rakhman', '2010512052', 'alifiasari49@gmail.com', NULL, '$2y$10$3SmO0i2fiQq1q6IUcWwdKurVRbWH/1BRpz3wP0AyrlVPXEDTwsIQi', 'mahasiswa', NULL, NULL, NULL),
(197, 'Indah Febryana Putri', '2010512053', 'indahfeb25@gmail.com', NULL, '$2y$10$OPA6On1iW6YBCgvU27uA6O9itjKEZi6mRoc4z/z20mslcKSDbXNou', 'mahasiswa', NULL, NULL, NULL),
(198, 'Baihaqi Firdaus', '2010512054', 'baihaqif354@gmail.com', NULL, '$2y$10$lE0Ky3swmL7uo6.w3iFmXOQaEy.7hWFASxLnEeCc/sMdDaVWLEmqW', 'mahasiswa', NULL, NULL, NULL),
(199, 'Muhammad Arya Bhagaskara', '2010512055', 'aryabhagaskara@gmail.com', NULL, '$2y$10$4Pf9wXM0bChZrAC4vfjtnOkW6khain86TnpGLq1aj7S1WyaQh8HDy', 'mahasiswa', NULL, NULL, NULL),
(200, 'Muhammad Haikal Ikhsan', '2010512056', 'muhammadhaikal623@gmail.com', NULL, '$2y$10$.SHYGL2IyCpDFPx4tSpIKeAppDdCQ2OADE2tm8zCEbPgVDS9vkzYu', 'mahasiswa', NULL, NULL, NULL),
(201, 'Salma Wafiq Fahroji', '2010512057', 'salma.wafiq78@gmail.com', NULL, '$2y$10$I8.VjXmIDjPftUI.QIWPWOcx4OHQ2WV8hUmYTtmBzpc118jmoZAtK', 'mahasiswa', NULL, NULL, NULL),
(202, 'Raffael', '2010512058', 'theochristian150@gmail.com', NULL, '$2y$10$N5OPNFopU/elgpSoyf6mHOoD3E6a6McKfMfyJnwzg1p2v6zsfOwZi', 'mahasiswa', NULL, NULL, NULL),
(203, 'Wanda Kusuma Wardani', '2010512059', 'wandakusumaw@gmail.com', NULL, '$2y$10$SC3zc.tHnJADnQsXscd0nuUKrD76erJV3CKVt0EY0x0mX0ZwcxXgi', 'mahasiswa', NULL, NULL, NULL),
(204, 'Fisya Alifia Fawwazi Siregar', '2010512060', 'fisyasrg@gmail.com', NULL, '$2y$10$ai2mEQvZhB4Ps9snRm7N9eHJ2PGbUYw3z257DnUhk.tieM80YmVZC', 'mahasiswa', NULL, NULL, NULL),
(205, 'Andhika Rizq Pulubuhu', '2010512061', 'andhikapulubuhu123@gmail.com', NULL, '$2y$10$JS8OPHPcQth478TdCGTqUuo01GCi1obNYZZaXt6dO8oXxi9IO2ci2', 'mahasiswa', NULL, NULL, NULL),
(206, 'Nicodemus Naisau', '2010512062', 'nicodemusnaisau21@gmail.com', NULL, '$2y$10$m2GiI.m7ve5N1zDwhDNPxOk9XWSsnw6WbehoRZLwHmn/vFQx7cmOe', 'mahasiswa', NULL, NULL, NULL),
(207, 'Santiana', '2010512063', 'Santiana1922@gmail.com', NULL, '$2y$10$HLKp/Rjnmq61g3c4IYIsvuRSScWJP0avues6cRWoyH8MZP3mw.ubS', 'mahasiswa', NULL, NULL, NULL),
(208, 'Adhira Thaskia Salsabilla', '2010512064', 'adhirathaskia@gmail.com', NULL, '$2y$10$OVVEuQJb8RAuW97BvVmkhOn38/NDA.TB7WpLaI//NkfbT0tPgCT/a', 'mahasiswa', NULL, NULL, NULL),
(209, 'Alya Zahra Waty', '2010512065', 'alyawaty2003@gmail.com', NULL, '$2y$10$lcbVvhhSsNeqYmxphza9yexTw6Ks8NYUUVr1fH1GAOOiGPlwYGkb2', 'mahasiswa', NULL, NULL, NULL),
(210, 'Maulida Afifah', '2010512066', 'afifahmaulida932@gmail.com', NULL, '$2y$10$eOFZxFfHZQplobk8QaLPcOywxO64dFk5tJAtbFbzhn.y/Md8geTqC', 'mahasiswa', NULL, NULL, NULL),
(211, 'Fitri Kurniawati', '2010512067', '2010512067@mahasiswa.upnvj.ac.id', NULL, '$2y$10$pgjAR90B/ccgSshyyIJT6.PNSOptMzXSHn7bGYs8kHzJdmEKLH9va', 'mahasiswa', NULL, NULL, NULL),
(212, 'Arkiza Ariq', '2010512068', 'arkizaariq@gmail.com', NULL, '$2y$10$BEp0NPFz3RN8NwreqnTs4.Yr1RP96iL179RM7xQkpjUHihYQWdN7K', 'mahasiswa', NULL, NULL, NULL),
(213, 'Farasya Syifa Hidayat', '2010512069', 'farassya02@gmail.com', NULL, '$2y$10$619QWg612ap0VngP7Y462.78wITzNgftFM3m6oPlwsjchOVKPKcD6', 'mahasiswa', NULL, NULL, NULL),
(214, 'Dinda Putri Pamungkas', '2010512070', 'Dindaputripamungkas5@gmail.com', NULL, '$2y$10$8LyCMkjkAriIQSq.2mPLV.lo.2tKqmHasr397/hT3EPqVBpTSWbom', 'mahasiswa', NULL, NULL, NULL),
(215, 'Aqila Zahara Putri', '2010512071', 'aqilaaputrii10@gmail.com', NULL, '$2y$10$nwaiI/ZykXSOP/AD8iSq5ucmN.IYmLfVaJJnPrBk73aKE/kl91W.a', 'mahasiswa', NULL, NULL, NULL),
(216, 'Allya Aurora Febrina', '2010512072', 'allyaaurora.aa@gmail.com', NULL, '$2y$10$yHln5y5CqHbj3mPTOQZZa.yyhEtCHWhpKLcS9MaeO/E7mVMpvHE3a', 'mahasiswa', NULL, NULL, NULL),
(217, 'Dian Azizah Lubis', '2010512073', 'dianazizah134@gmail.com', NULL, '$2y$10$j5cVkaNz44m5crFySk1zleq2rf.3YndyLy.8YOXNyT7es6d046RIO', 'mahasiswa', NULL, NULL, NULL),
(218, 'Stephanie Helga', '2010512074', 'stephaniehelgas@gmail.com', NULL, '$2y$10$I4x5lOTB6WcQKp37EA4aEubEFbUQadFimcTqc1j/KxpA8xvIB4Im.', 'mahasiswa', NULL, NULL, NULL),
(219, 'Muhammad Ra\'afi Hafiiz', '2010512075', 'rafihafiiz1945@gmail.com', NULL, '$2y$10$LZSrW7uICQQXjUZDgKyiOuFEWWRYyIcdyrwyVuHyikdTDbNw4fZXK', 'mahasiswa', NULL, NULL, NULL),
(220, 'Astrid Swardhani Putri', '2010512076', 'astridswardhaniputri@gmail.com', NULL, '$2y$10$wdnjaK0g7sQAixOJutXMbuRBWXdJzLLqNbLRTSOCQ9BwACZV58niK', 'mahasiswa', NULL, NULL, NULL),
(221, 'Yosia Ruhut Sidabutar', '2010512077', 'yosiasidabutar@gmail.com', NULL, '$2y$10$BYw..wkPzA9GGQSi71aBnu6koXZt6FYHIwR6h1JQSnyQQpSjI6Cc6', 'mahasiswa', NULL, NULL, NULL),
(222, 'Andhi Nursahara', '2010512078', 'andhinursaharaa@gmail.com', NULL, '$2y$10$PEq.J3Zr8RFS4oBv5SZE/.OA3g2bTEFF/6XV05zOQZ.AaU5ZEAW6y', 'mahasiswa', NULL, NULL, NULL),
(223, 'Ahmad Kayyis', '2010512079', 'ahmadkayyis2003@gmail.com', NULL, '$2y$10$3Yoislbhj3tDbZIEEZSnUejEIppiXfdMTthmv18sI8hgI/4/x2b3e', 'mahasiswa', NULL, NULL, NULL),
(224, 'Muhammad Aqshal Prawira', '2010512080', 'aqshal.map@gmail.com', NULL, '$2y$10$pfHo/8bEUyHKWonRlrW4aOJuhYJpO1kjgzPFTtzkeZBzzF4r0S1N6', 'mahasiswa', NULL, NULL, NULL),
(225, 'Rizky Yaomal Malik', '2010512081', 'ym.almalik24@gmail.com', NULL, '$2y$10$ksF4SdMpeM4WTgJt1MgyDuKFjYTHC8C2AvZ9ajsLQ.NW6TOWFooPa', 'mahasiswa', NULL, NULL, NULL),
(226, 'Farhan Yusuf', '2010512082', 'ganbarufarhan@gmail.com', NULL, '$2y$10$bO.m3p9LdvLUFFdfDnF/LO2aNAsSTuCGQ6kpTWtIHpEe3FlcG7zzS', 'mahasiswa', NULL, NULL, NULL),
(227, 'Rayhan Khaliq Azmy', '2010512083', 'ryhnkhaliq@gmail.com', NULL, '$2y$10$TsPB6J87Dk0ggRT526lf8uWCSqu4SR3V3J8lZi8H.M53iQ/fHn4Wq', 'mahasiswa', NULL, NULL, NULL),
(228, 'Hansen Kallista', '2010512084', 'hkall41@gmail.com', NULL, '$2y$10$9Rl3fjmeg5PGf/lhP6RKhe25ENZ1kikwAXu3lPcuLO4xJJiLaK5t.', 'mahasiswa', NULL, NULL, NULL),
(229, 'Astrid Fadila', '2010512085', 'acidila123@gmail.com', NULL, '$2y$10$bW9b7SBU28U09Qa8GgQOD.c7karyVZ2/TMoxyMN2nV8FDT4yA.oIu', 'mahasiswa', NULL, NULL, NULL),
(230, 'Catherine Maharani Widiasmoro', '2010512086', 'rani.widiasmoro@gmail.com', NULL, '$2y$10$YaM.zUQHklz1cOg7ur0UMuGgdldJCQAlsnZ79vqOe1q7DO8V2sry.', 'mahasiswa', NULL, NULL, NULL),
(231, 'Dinda Dwi Ninditha', '2010512087', 'dindadwinindita@gmail.com', NULL, '$2y$10$bLx4jgz63YFa11x9qTn7juB4ET0ufnYDyDkRVNebpKEKDzS4gYeRO', 'mahasiswa', NULL, NULL, NULL),
(232, 'Ahmad Dany Wirawan', '2010512088', 'adaniwirawan@gmail.com', NULL, '$2y$10$JoS7xMrpVw8eRV0Xirrq7.gZUjwgCqvJKPABSV4WSAQrU4s86csbq', 'mahasiswa', NULL, NULL, NULL),
(233, 'Khairun Nisah Hamid', '2010512089', 'hanny.knh@gmail.com', NULL, '$2y$10$Dgy7niicGV3gV9yHxAZDoOHTC9oHU9tM2WTvAJ4vFofj576fECJC.', 'mahasiswa', NULL, NULL, NULL),
(234, 'Muhammad Nazif Thabit', '2010512090', 'nazeev.thbt@gmail.com', NULL, '$2y$10$Ev8bOqGbEE39pikj7Bvwo.BajcmUHeCEod5dyis3ekHMB3IdZcoYe', 'mahasiswa', NULL, NULL, NULL),
(235, 'Muhammad Zul Fikar', '2010512091', 'mzulfikar103@gmail.com', NULL, '$2y$10$H1lk/CTlIos4YRY5TxMKv.HxgJLssRDb4.qR4xFWqRQFsTaVrAyP.', 'mahasiswa', NULL, NULL, NULL),
(236, 'Aulia Mahmudah', '2010512092', 'auliamahmudah2309@gmail.com', NULL, '$2y$10$NWPZHlSY/YUpNCO3sNNJle6TDMER4kWT6x6JNdmmNnnQwVZxyBLW.', 'mahasiswa', NULL, NULL, NULL),
(237, 'Muhammad Raziv Maulana Ranie', '2010512093', 'razivmr@gmail.com', NULL, '$2y$10$DEXiXFLWufvAi.1nt1tgWebklUQd2Hcdr/4V/iqLZNt0hFxqhjKbe', 'mahasiswa', NULL, NULL, NULL),
(238, 'Maria Jevani', '2010512094', 'mjevaniii1@gmail.com', NULL, '$2y$10$1SH4uMCilBTQ4qKXjx8/e.xobIsVQSh6Fv5NF00oNQaPNVswvjo8.', 'mahasiswa', NULL, NULL, NULL),
(239, 'Andika Richardo Napitupulu', '2010512095', 'haloandikarichardo@gmail.com', NULL, '$2y$10$arMtxJza1qDCulFHgu/IBeHlHjl0zObEUE0tBbasNWepeSYu2sSOO', 'mahasiswa', NULL, NULL, NULL),
(240, 'Liyora Arabel Ansely', '2010512096', 'arabelliyora@gmail.com', NULL, '$2y$10$f5SbgMyrzbtZAKkFceeGZuUDkT5nUg83AsZMKFfstZHajzx4zsqEC', 'mahasiswa', NULL, NULL, NULL),
(241, 'Alfito Bayu Ibrahim', '2010512097', 'nasiudukracer7@gmail.com', NULL, '$2y$10$Kco05fh6tfHqLoTINPcv.eeO7hDrMrmEdgn.EHnvCpvOiLPOIRzvm', 'mahasiswa', NULL, NULL, NULL),
(242, 'Septriediana Amalia Putrie', '2010512098', 'septriedianaamalia@gmail.com', NULL, '$2y$10$BJ9Gi5rLs/lMjEWGuZliU.Twqipgo9EZ9441RBM5wbCSVskVEOumS', 'mahasiswa', NULL, NULL, NULL),
(243, 'Shidqan Aliman', '2010512099', 'shidqanalimannn@gmail.com', NULL, '$2y$10$BBR.6gYk71vSuYhm9IIbDO2lJWHcnQ22Vn1EYUYBo2GrGI.aLBqE2', 'mahasiswa', NULL, NULL, NULL),
(244, 'Muhammad Fahrizal', '2010512100', 'mfahrizal832@gmail.com', NULL, '$2y$10$o9ySioK.ThuEzMNQFecmie3bhq01IBCoFrqBCnZWrtxBBvSU70Tfu', 'mahasiswa', NULL, NULL, NULL),
(245, 'Faisal Rizqi Utama', '2010512101', 'faisalriski51@gmail.com', NULL, '$2y$10$Cxv6X8V.2lwd9LA3eRErAOQ9CaSIK/zlF0aozCDSvwjLPTeaOXjte', 'mahasiswa', NULL, NULL, NULL),
(246, 'Dzakwan Yudha Prastama', '2010512102', 'dzakwanpratama12@gmail.com', NULL, '$2y$10$uLvrcWHAHZgHgjUawEFS/uSZZnmN7mn26kEt/v94HiH/n1uCk3aB.', 'mahasiswa', NULL, NULL, NULL),
(247, 'Alam Cahyo Laksono', '2010512103', 'alamcahyo3@gmail.com', NULL, '$2y$10$kjlTuzqIXZAAuFMSEokDSO.umyo2VJ5m8V2oAV/IjWeV7VRV.jTUa', 'mahasiswa', NULL, NULL, NULL),
(248, 'Rakan yuvi ispradityo', '2010512104', 'Rakanyuvi02@gmail.com', NULL, '$2y$10$l9vzaEhitSQNtfx48Be7H.IU6IYN8njP1ghhybPgh1SEc5XP49IzW', 'mahasiswa', NULL, NULL, NULL),
(249, 'Putri Ravika Hidayat', '2010512105', 'putriravika23@gmail.com', NULL, '$2y$10$s2ZZaOq6pizXMMftsW9MSelHUYMZb0Pbqf.uySrcqsH9f9ldxzBhK', 'mahasiswa', NULL, NULL, NULL),
(250, 'Hafidz Izdihar Muslim', '2010512106', '2010512106@mahasiswa.upnvj.ac.id', NULL, '$2y$10$TUqJ4i4bnIJNYi1scbVk7e.xthpUF6sOGui1grEC3modPHQ0hYDyq', 'mahasiswa', NULL, NULL, NULL),
(251, 'Vincentius Ludwig Putra Widianto', '2010512107', 'vincentiusludwig@gmail.com', NULL, '$2y$10$uSRfgsTj1S3WN/7ttO2Vb.Bo5Vf8dY9mtlqw.vLSfXnFWdR2uK0Qy', 'mahasiswa', NULL, NULL, NULL),
(252, 'Fikra Agha Rabbani Asayanda', '2010512108', 'fikra.rabbani@gmail.com', NULL, '$2y$10$n15baZWHlB60jQs4e4XK6.y.wqbHIktDPREsZg7B/TxJ3nieMskQ6', 'mahasiswa', NULL, NULL, NULL),
(253, 'Naomita Nabila Arani', '2010512109', 'naomitanabila08@gmail.com', NULL, '$2y$10$2s4T6GM8sCrrAGW0mIfBvef0Fzckh6ppvcmOKb6pLJX/l.deD7KsC', 'mahasiswa', NULL, NULL, NULL),
(254, 'Fadiyah Sutopo', '2010512110', 'fadiyaash12@gmail.com', NULL, '$2y$10$DW5/BueNZPtvKrkSB6Ec0.5EzddS5A7yEql7GdALIBH9jGewaSpwy', 'mahasiswa', NULL, NULL, NULL),
(255, 'Muhammad Zaki Hamdani', '2010512111', 'zaki.hamdani.221200@gmail.com', NULL, '$2y$10$.HudJJ6iEC6ne5BBc.Vgq.SFKKCCX8zhGOfPynvG3P4g03ZXH7Jfm', 'mahasiswa', NULL, NULL, NULL),
(256, 'Raditya Rafi Harimasya', '2010512112', 'radityarafi14@yahoo.com', NULL, '$2y$10$Z6q/ckMXdNnu525P.4mkSOtsol6ozq2nlHvcvoaNnk0IFgfORaXbu', 'mahasiswa', NULL, NULL, NULL),
(257, 'Duma Sere Pakpahan', '2010512113', 'Dumasere4@gmail.com', NULL, '$2y$10$D9D0SH0jL4540o5EiTpfX.WEsinqRfh4cKu.YZ36zOOdTcWqVJU66', 'mahasiswa', NULL, NULL, NULL),
(258, 'Muhammad Raehan Safitroh', '2010512114', 'raihansafitroh@gmail.com', NULL, '$2y$10$Bu3c016MjZ22hd5KHuScOuKaUAe8fEa4rQg2Hha7de9GkT1hgTm66', 'mahasiswa', NULL, NULL, NULL),
(259, 'Danish Haikal Haholongan', '2010512115', 'danish.hkl03@gmail.com', NULL, '$2y$10$/e3GPOPwaqJ0qICkHxxzTOcpmG0iqjYHLJbGVW4IoCf7LtlyPNHde', 'mahasiswa', NULL, NULL, NULL),
(260, 'Rafif Rasendriya Arya Putra', '2010512116', 'rafif797@gmail.com', NULL, '$2y$10$S/qO/nosQf3zTzgyfF0.oek7UIcFCuWUXSnFlixkSNa8aI4uI/Yaq', 'mahasiswa', NULL, NULL, NULL),
(261, 'Muhammad Faizul Muttaqin', '2010512117', 'faizul.muttaqin16@gmail.com', NULL, '$2y$10$y9WOfRJiCPqBPVLTLI1/5uvEkfOpS2SFqE/Ud2Oxqzcfuiv3HVxdS', 'mahasiswa', NULL, NULL, NULL),
(262, 'Aqshal Win Mahara', '2010512118', 'aqshalwnmhra19@gmail.com', NULL, '$2y$10$bSTgmXMzV5moz0EBZ3.0jOsuQfGhleS.9ypdOOgYuWexZkzzXMuQ2', 'mahasiswa', NULL, NULL, NULL),
(263, 'Atina Eka Vebi', '2010512119', 'atinavebi02@gmail.com', NULL, '$2y$10$NpQPFbQyQsJtLLcGE7oC/.bMQcDyqmdbLMX9KdyhG.MQszp4CM6Pq', 'mahasiswa', NULL, NULL, NULL),
(264, 'Namirah Wahyuni Putri Hasmadi', '2010512120', 'namirahrara@gmail.com', NULL, '$2y$10$SRrleom/UnCiW3FFZ4xFVuDc9Zbd/nnc/CXvTS0LDMbagySFpHSOK', 'mahasiswa', NULL, NULL, NULL),
(265, 'Bezaliel Yehuda Dermawan Hulu', '2010512121', 'bezalielbydh@gmail.com', NULL, '$2y$10$CMQ/r3KV/chV8eCuAz2oe.xWegeNP4GXMrsQkttZK7l44IEbVXeye', 'mahasiswa', NULL, NULL, NULL),
(266, 'Zahran Irfansyah', '2010512122', 'zahranirfansyah@gmail.com', NULL, '$2y$10$fCOfryztrzcjzGeJvA9vx.lCARnGs/wzJPLIoZCQAUwn6jyIVOsN2', 'mahasiswa', NULL, NULL, NULL),
(267, 'Marella Elba Nafisa', '2010512123', 'elbanafisa@gmail.com', NULL, '$2y$10$GHJir8rmWdDKAaqhuh.dTu8FdTbRlgPnEVvRLVJX5a5DxsmAwf8Xy', 'mahasiswa', NULL, NULL, NULL),
(268, 'Farhan Habib', '2010512124', 'habibhabibs564@gmail.com', NULL, '$2y$10$8TAyPmy6NfIt15/dFNLurOBfPHYfKDRO78q19n5V5//LzE14mZCJW', 'mahasiswa', NULL, NULL, NULL),
(269, 'Nadya Putrininda Zharfani', '2010512125', 'nadyaputrininda@gmail.com', NULL, '$2y$10$GlSkB83vIVlVC3jv6S9sH.wCgpkPM1sxxh5xayplUtpeuOOdsuImO', 'mahasiswa', NULL, NULL, NULL),
(270, 'Lawdzai Nuzulul Azhfar', '2010512126', 'Lawdzain@gmail.com', NULL, '$2y$10$85IgLNp.rf3Zxxk0qk8nfOjM6lvWpeSaydtJ2buSxCC0rS6aAW5G6', 'mahasiswa', NULL, NULL, NULL),
(271, 'Hanifa Widya Damayanti', '2010512127', 'hanifadamayanti15@gmail.com', NULL, '$2y$10$5/3fwEdPtNAiSGFSjsIH7.6IzwHe0QTt5FSSFdcHXG5lCEdMooXnK', 'mahasiswa', NULL, NULL, NULL),
(272, 'Nada Anggitaningrum', '2010512128', 'nadaanggitaningrum@gmail.com', NULL, '$2y$10$z9YPdnJbC2Jw7ZgFHltX..cpY..YCkLPnX0gMNQROuIINV4Vk984e', 'mahasiswa', NULL, NULL, NULL),
(273, 'Rafif Hilmy Rahardani', '2010512129', '2010512129@mahasiswa.upnvj.ac.id', NULL, '$2y$10$k7mtMiAcJKMzB7PNuAblOu2sATz6gRZtwuW0e/sAq5uGW1hQnr31K', 'mahasiswa', NULL, NULL, NULL),
(274, 'Muhammad Husein', '2010512130', 'm.huseinhaddad@gmail.com', NULL, '$2y$10$e5EgOQSORzeVhTyLcTqsL.sSX6Ogn7P8x5/5nwd7NBJHwl3WsOEoO', 'mahasiswa', NULL, NULL, NULL),
(275, 'Fatih Ahmad Muzhaffar', '2010512131', 'fatihahmad2003@gmail.com', NULL, '$2y$10$0hqyGmSaIoxfnLvWI4COKO0RmC87hlPs7pzzlVxp.csSGGzLMHkcu', 'mahasiswa', NULL, NULL, NULL),
(276, 'Tiara Vionola Sari', '2010512132', 'tiaravionolasari1@gmail.com', NULL, '$2y$10$h.hiGZN4IAa3gX.gmdBFcu2Xcfxb89xM.DWqhqI0QTFaqeJz6AlqS', 'mahasiswa', NULL, NULL, NULL),
(277, 'Adhitya Fahlevi', '2010512133', 'adhityafahlevi07@gmail.com', NULL, '$2y$10$cTPZ4gcq6BtvPBSetD0cU.0S3r6ZPe9K3L16Oxwkgy8Q1.sMTu4oO', 'mahasiswa', NULL, NULL, NULL),
(278, 'Riannisa Azizah Putri', '2010512134', 'riannisaa@gmail.com', NULL, '$2y$10$C5v5kO/.ADZmSTTZTUVYaexapvsQrb5iUKbpqh14cESLzarPjiqOa', 'mahasiswa', NULL, NULL, NULL),
(279, 'Amanda Nurhidayanti', '2010512135', 'amandanurhidayanti01@gmail.com', NULL, '$2y$10$zA59dLkE9th09Twkw4yMFOhzPoTJSYjGWwiwuJHF3f5sxLDZJS1QS', 'mahasiswa', NULL, NULL, NULL),
(280, 'Nugroho Aryaguna', '2010512136', 'nugrohoaryaguna10@gmail.com', NULL, '$2y$10$zAhl4S.GIoXj53H46FFRvepmUXatO1Zb5JNwFl4zx/.uiGehMezwa', 'mahasiswa', NULL, NULL, NULL),
(281, 'Ihrom Wahyuni', '2010512137', 'ihromwahyuniix@gmail.com', NULL, '$2y$10$.nq/V.Pil.aAfZCdetNxSu6vB4LzvZThVosjXwwyj9GXEhPNw6zb6', 'mahasiswa', NULL, NULL, NULL),
(282, 'Salsabila Faiha Puteri', '2010512138', 'salsabilafaihap@gmail.com', NULL, '$2y$10$yCp6yH.wyfItRkfvHLAmauVueF9hobi18an2Q9Qq9P6nTrEZ48hKS', 'mahasiswa', NULL, NULL, NULL),
(283, 'Ray Pray Pontas', '2010512139', 'ray.pray.pontas.1357@gmail.com', NULL, '$2y$10$oUX2VXAx.CERFGujK52.Gu2NcQL8vSHz6.neZPlT.pNreIHh43Jw.', 'mahasiswa', NULL, NULL, NULL),
(284, 'Sugma Ayunia Dewi Azhara', '2010512140', 'sugmaazhara@gmail.com', NULL, '$2y$10$RGlQhYdh2nAs2/Kg/Eh.3uVRJgHy6llnLsqZjxUafMxK/Wok5qrTG', 'mahasiswa', NULL, NULL, NULL),
(285, 'Syauqi Khosyi Hidayat', '2010512141', 'syauqikhosyi@gmail.com', NULL, '$2y$10$89xvxH5mXS0b5u3XnsdUgOM2o1eH0LEfELnlOyHCnIa570xeT9fI6', 'mahasiswa', NULL, NULL, NULL),
(286, 'Angel Christy Vanessa', '2010512142', 'angelchristyvt@gmail.com', NULL, '$2y$10$VBjEjFvQ5hSX8ZsVvcaNL.y.spiyl3OVTGkKwSOGOcuahDHEckx5K', 'mahasiswa', NULL, NULL, NULL),
(287, 'Akbar Gibrani Aliffianto', '2010512143', 'akbargibrani17@gmail.com', NULL, '$2y$10$3slv/PwLoUzJ7xvB9Cfdm.1r.5eNwG7kZvddw6HY.VEsKP6UoI98m', 'mahasiswa', NULL, NULL, NULL),
(288, 'Bakkah Maulana Mashur', '2010512144', 'bakkah10@gmail.com', NULL, '$2y$10$mssDbH2y7E3fcH/FBXySNucK07orePNppQ4hp2DgKUFUCFR1tn/k2', 'mahasiswa', NULL, NULL, NULL),
(289, 'Chaerul Ilmi Al Ahyari', '2010512145', 'chaerulilmialahyari11@gmail.com', NULL, '$2y$10$Dg9jbVzbMLHiqNYan4.25u8QTHlh2xwV.NPSX9zZlHK1d6uZpBP5G', 'mahasiswa', NULL, NULL, NULL),
(290, 'Ikhfa Andini Salsabila', '2010512146', 'ikhfasalsabila@gmail.com', NULL, '$2y$10$LGMdL9pDWomeQDb8mES50ubkRo2qiWkpDL3ALDZ4RHhq2areYn5zG', 'mahasiswa', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `nim_nip`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(291, 'Andira Yunita', '2010512147', 'andhirayp@gmail.com', NULL, '$2y$10$8y/7pQ.UmxZ1TcPu01vSEecNbMP.mrmB9SErjlo.vQBFxdmn6e5.q', 'mahasiswa', NULL, NULL, NULL),
(292, 'Difaya Qania Nuwayyar', '2010501001', 'qdifaya08@gmail.com', NULL, '$2y$10$cj93ymzsK1q3IfaxTQRKg.r2Ur0c4iXOMK3n9bIb49V8mEvEw3MdS', 'mahasiswa', NULL, NULL, NULL),
(293, 'Fityara Tasya Harvina', '2010501002', 'fityaratasya@gmail.com', NULL, '$2y$10$We3b.hICMc089tO2OufoMeqOSyQuFl9FcRmYwzyMcPPh7yiwSnBJq', 'mahasiswa', NULL, NULL, NULL),
(294, 'Syarifzul Hidayat', '2010501003', 'syarifzul1503@gmail.com', NULL, '$2y$10$IIBwUgpDipxeOWcY0A2ZB.4eeS7PPeFii8D8gTDlN7AIwjnhVURe2', 'mahasiswa', NULL, NULL, NULL),
(295, 'Jamil Satrio Pinanggito', '2010501004', 'jamil.satrio@gmail.com', NULL, '$2y$10$Vrnkb8gzBBNlUjEogWqZ0ecVr3aXVfq/VFfwqtmjK08c/sFImEZtW', 'mahasiswa', NULL, NULL, NULL),
(296, 'Alvania Permana Frynza', '2010501005', 'alvaniafrynza03@gmail.com', NULL, '$2y$10$zANfEgFNu8FXyZhFq6VH/uYWq4pHt8Z8C5mvbeRpJRXWrmTUBDr52', 'mahasiswa', NULL, NULL, NULL),
(297, 'Jesica Pitauli Kezia', '2010501006', 'jesicapitauli07@gmail.com', NULL, '$2y$10$YD2fyemoFx4x4xynVdhw.ewdd0TGWjYfPNeLeOcLBBgW.NljhITVi', 'mahasiswa', NULL, NULL, NULL),
(298, 'Masroy', '2010501007', 'rajamasroy1@gmail.com', NULL, '$2y$10$8TBgr70/Ym/z96LM70/uK.4IbkQcc9jwgr2QY1jgwVXTTPHUwSVk.', 'mahasiswa', NULL, NULL, NULL),
(299, 'Muhammad Hudan Afriansyah', '2010501008', 'muhammadhudans123@gmail.com', NULL, '$2y$10$9w/Q9Ph/aRdkKerroYSWBuN/XXRmMnMY0fiqxumJSURoBsmnUGXd2', 'mahasiswa', NULL, NULL, NULL),
(300, 'Wildan Hamid', '2010501009', 'wildanhamid38@gmail.com', NULL, '$2y$10$a1Hgq78xkdtW6NFXHOuWc.BIv/vnAZRcdadYX7bEd2gkRbIOs.4oO', 'mahasiswa', NULL, NULL, NULL),
(301, 'Adam Denta Ramadhan', '2010501010', 'adamdentaramadhan18@gmail.com', NULL, '$2y$10$L8A2wN4lLBgS/K5LLWvdrOHSfJAcRc37f3vW5ZDbIFh5LiXkVE3kW', 'mahasiswa', NULL, NULL, NULL),
(302, 'Syali Mutiara Rengganis', '2010501011', 'syali.ganis@gmail.com', NULL, '$2y$10$kqTACBhGCRmqGoSw8I9OwuN8TPS4lBbYLrMrrdwPSWDVHM89L0Evm', 'mahasiswa', NULL, NULL, NULL),
(303, 'Muhammad Abdan Syakuro', '2010501012', 'abdan810@gmail.com', NULL, '$2y$10$kWW4uSlHYYqWJaR4LnGwOuPaPUk2PQgyh5I1hy64vEqRbF2e7s4uC', 'mahasiswa', NULL, NULL, NULL),
(304, 'Amatullah Hidayati Rofi\'ah', '2010501013', 'amatullahhidayatirofiah09@gmail.com', NULL, '$2y$10$DvcZP37a/0zZ.btQAfEQ1OAZA4HL/3tdz8SdULmcIoxnuT2rZC54O', 'mahasiswa', NULL, NULL, NULL),
(305, 'Achmad Fauzan', '2010501014', '2010501014@mahasiswa.upnvj.ac.id', NULL, '$2y$10$jCQdCqIV5n7qwoGu0ktzgeHgZxSdQlAnRX/y6P5siS/SSLmGXLhg6', 'mahasiswa', NULL, NULL, NULL),
(306, 'Anfas Majdan', '2010501015', 'anfasmajdan9@gmail.com', NULL, '$2y$10$QgVfHjqymTH3NTvVsCtuI.ni6gIFWqQLd25w94BXh5vpzPVkwy3xS', 'mahasiswa', NULL, NULL, NULL),
(307, 'Nurul Rahmah Tsania', '2010501016', 'rahmahtsaniasudibyo@gmail.com', NULL, '$2y$10$7GVRKYeJUrFWJ0AbkNyaxenjeAIE0tk9PbUavA77Nl6FmKApl82l.', 'mahasiswa', NULL, NULL, NULL),
(308, 'Rafi Ramadhan', '2010501017', 'rafiramadhan154@gmail.com', NULL, '$2y$10$4b.H64HysLWMTmSpz2ekVef8Jz1F0lMvoR6pLPVmv0xmGGTDzxXLC', 'mahasiswa', NULL, NULL, NULL),
(309, 'Andhika Dyansyah', '2010501018', 'Andhikadyansyah01@gmail.com', NULL, '$2y$10$X9Mdle3I21KNAsK3qqksueUP0S/5BR7vRka29aM589X2C7S4wC2BS', 'mahasiswa', NULL, NULL, NULL),
(310, 'Azzindan Zulvan', '2010501019', 'azzindanz@gmail.com', NULL, '$2y$10$Vl8AHwCoaOaUi8KwgJNg.eRR3d466TYimjSgnXU/km.rEz6zVT3gC', 'mahasiswa', NULL, NULL, NULL),
(311, 'Andika Agung Nugraha', '2010501020', 'andikkaagungnugraha@gmail.com', NULL, '$2y$10$DX9pzp5G6IJvZQVqj46nsef9e8fytYFbfZeLbOB0ux8TUWuSjSAZm', 'mahasiswa', NULL, NULL, NULL),
(312, 'Haical Kholikirrojik', '2010501021', '2010501021@mahasiswa.upnvj.ac.id', NULL, '$2y$10$5TOlNWWdp2YtI5IQ024YI.1GZq6C02EgonwKgeju6ldUguf16u2Sy', 'mahasiswa', NULL, NULL, NULL),
(313, 'Noor Wahyu Syarif Hidayah', '2010501022', 'hewahyu6@gmail.com', NULL, '$2y$10$hPIDZivvNU8eUuB.G1Ksee9pK427R9G9VpzPBWvIlYNH7814Nsysy', 'mahasiswa', NULL, NULL, NULL),
(314, 'Luku Arizki Heraja Sanni', '2010501023', 'herajasanni20@gmail.com', NULL, '$2y$10$JrVG4vEUJrbNghqfHECFa.Yqti18WmXqhJsZlRD0evDjMEtoB5zfi', 'mahasiswa', NULL, NULL, NULL),
(315, 'Faisal Reza Febriansyah', '2010501024', 'faisalreza527@gmail.com', NULL, '$2y$10$6P8vtCxOw3DDkDtsdz2MteTyeG7KK//7Yea4PfMEioi5mBXvehvbu', 'mahasiswa', NULL, NULL, NULL),
(316, 'Muhammad Sadewo Wicaksono', '2010501025', 'm.sadewo.w@gmail.com', NULL, '$2y$10$vj9unlrZVOYwlmqXUizqouLPbSUO45PRhe9gXpTabPru3OjY7U5H6', 'mahasiswa', NULL, NULL, NULL),
(317, 'M Yanu Farhan Prasetyo', '2010501026', '2010501026@mahasiswa.upnvj.ac.id', NULL, '$2y$10$vOxdl0gQmhgrZvacyVkTf.dQ8kxdlROe8WUtJS2g8rGA/jGxECktC', 'mahasiswa', NULL, NULL, NULL),
(318, 'Muhammad Yusuf Danan Risdianto', '2010501027', 'dakatyes@gmail.com', NULL, '$2y$10$hui6H2vEgWnILpPEmXGzP.EMnOjdexqkjSfctamrz/.AZHyy3SP16', 'mahasiswa', NULL, NULL, NULL),
(319, 'Amalia Dwi Handayani', '2010501028', 'amaliadh027@gmail.com', NULL, '$2y$10$ovtZCwsz0s0FWswnmfLXqeHgsdweRRWDd7mW6/wctEaqUAsHtL8Y2', 'mahasiswa', NULL, NULL, NULL),
(320, 'Early Ariesabilal Satianto', '2010501029', 'resa.ecot02@gmail.com', NULL, '$2y$10$fjb1FrYnWm8feWp7bNBva.OWYZuOe7eD8bS5I5u/YM1Xb6LnkNVTC', 'mahasiswa', NULL, NULL, NULL),
(321, 'RENDI FAUZIANA', '2010501030', 'rendifauziana789@gmail.com', NULL, '$2y$10$/FY0hcvUTKQ0uNm5.yCEj.cavYv3cn8hBOxZfY2s1jdsH3Lvy.2WW', 'mahasiswa', NULL, NULL, NULL),
(322, 'Muhammad Dzaky', '2010501031', 'dzakyun@gmail.com', NULL, '$2y$10$I5UH4wSbCPzsxQvkWoeXHeOuL1iI7EPHPJGcsO8oGJZt/w8igKYuC', 'mahasiswa', NULL, NULL, NULL),
(323, 'Ridwan Ramadhan', '2010501032', '2010501032@mahasiswa.upnvj.ac.id', NULL, '$2y$10$w0AChC8sgvEOLRH6ZrBUDuH4vVWDfTTKk0N38E9rbnXvGKvjusEjC', 'mahasiswa', NULL, NULL, NULL),
(324, 'Ali Hakim Alfaroshi', '2010501033', '2010501033@mahasiswa.upnvj.ac.id', NULL, '$2y$10$CGGDR0rNhaWp/mqumclyceaOYUMRMscLDYPshLqpP7oOWZVC.NnzG', 'mahasiswa', NULL, NULL, NULL),
(325, 'Salsabila Az Zahra Ruswandi', '2010501034', '2010501034@mahasiswa.upnvj.ac.id', NULL, '$2y$10$t5JhQnNI5xpHVvP8M5Wq/uC0nTS0MOjvPLfr4Qkt.S24cz4UaxP6K', 'mahasiswa', NULL, NULL, NULL),
(326, 'Muhammad Azcha Panghudi Luhur', '2010501035', 'muh.azchapl.9i@gmail.com', NULL, '$2y$10$DfL2ELE3KcZRqvlT24cg4.JMzvGx9k9ikEDEoyZObemvpdE0HYs1G', 'mahasiswa', NULL, NULL, NULL),
(327, 'Ahmad Ridho', '2010501036', 'ahmdrdho02@gmail.com', NULL, '$2y$10$zau8anZe/00c2WR6ryRkt.I09g5DMGjRB5HtkSiDoZ9..VwAIkZLK', 'mahasiswa', NULL, NULL, NULL),
(328, 'Rayi Wicak Lazuardi', '2010501037', 'rayihanafi@gmail.com', NULL, '$2y$10$J7.NmlT6S6hNlOPYRVFiSu7dbYgrD8mDLghiOqrv8PSeeXjoQ0S8O', 'mahasiswa', NULL, NULL, NULL),
(329, 'Gita Hamidah', '2010501038', 'gitahamidah@gmail.com', NULL, '$2y$10$ZQVf75ZgYnHsM/MJx.UMe.QdUun2Wdi4DoRjk2AL/goQXPp/eYnwe', 'mahasiswa', NULL, NULL, NULL),
(330, 'Muhammad Izzadin Kaffa', '2010501039', 'kaffaizzadin@gmail.com', NULL, '$2y$10$vHwUUWMetAwRdzy5RCftQ.bZGriOXMPg4RZmk8luPQ3fU183zTpr2', 'mahasiswa', NULL, NULL, NULL),
(331, 'Fery Oktabrian', '2010501040', 'feryokta1908@gmail.com', NULL, '$2y$10$iXWdNFa3lkFHhUgbFcVqvOP4aYNYvK7vTpYJbV8vE2BHPC/l9dII.', 'mahasiswa', NULL, NULL, NULL),
(332, 'Jou Ezekiel', '2010501041', 'ezekieljou@gmail.com', NULL, '$2y$10$xmVI2MbCLO3hPpoug4RZxeVQQ84RFnPyre78qNCUqmmxgp8KVOFRy', 'mahasiswa', NULL, NULL, NULL),
(333, 'Ilham Muhammad Azka', '2010501042', 'ilhammuhammadazka49@gmail.com', NULL, '$2y$10$vZvSzlWTwUQQHF27dmJ7oekDfwou9oWPIjX.Ynw9/TjeOjT5PuU9e', 'mahasiswa', NULL, NULL, NULL),
(334, 'Tantri Dwi Tyastuti', '2010501043', 'tantridtst@gmail.com', NULL, '$2y$10$wde07isEGHWZbhnvy4nvLeBE3lYpuw0MOo3boEiVOORscyGwUE47C', 'mahasiswa', NULL, NULL, NULL),
(335, 'Sabilla Nugroho', '2010501044', 'sabillanugroho43@gmail.com', NULL, '$2y$10$DZtQfcWwjcpMJsYUphgqQeOZBN7y8EY.FmNbfsYQ8jnWItcVefNnK', 'mahasiswa', NULL, NULL, NULL),
(336, 'Valencia Augustine', '2010501045', 'valenciaugustine@gmail.com', NULL, '$2y$10$V4V41GqUY4VeKb201lMBvu9OPgoKe2X28x945MeiYWPJF4zRefIPe', 'mahasiswa', NULL, NULL, NULL),
(337, 'Muhammad Adi Tauliah', '2010501046', 'tmuhammadadi@gmail.com', NULL, '$2y$10$jR8oiG4GcMh.K7wlqPG3geWb5ka.OUCwmMQBm3gcTGJsdFUw0ku7.', 'mahasiswa', NULL, NULL, NULL),
(338, 'Muhammad Faishal Alim', '2010501047', '2010501047@mahasiswa.upnvj.ac.id', NULL, '$2y$10$iPudt3wY.LEQGTwNdX14HOnbsDKgnap3/2Cxb9hDlkQylKx3NtHC2', 'mahasiswa', NULL, NULL, NULL),
(339, 'Erlangga Sutoyo Putra', '2010501048', 'anggasutoyoputra@gmail.com', NULL, '$2y$10$adP8quPEnQzUkLEfebqB8OJbgG1xhSoqZChCZrrDb/FgUn714Ls92', 'mahasiswa', NULL, NULL, NULL),
(340, 'Muhammad Fikri Alrasyid', '2010501049', 'muhfikri1902@gmail.com', NULL, '$2y$10$haLNost8rWCjdp6JmNwS3OgXfgmboZ9SXTDm7UsM8KNt1DdTYy6w6', 'mahasiswa', NULL, NULL, NULL),
(341, 'Muhammad Fakhar Naufal', '2010501050', 'fakharnaufalnf3547@gmail.com', NULL, '$2y$10$sooMUdys2U97bD.lxAlupeyFo5xm2BY/vBX.Xh64PVWfqiLMDCSXa', 'mahasiswa', NULL, NULL, NULL),
(342, 'Afriyo Hary Nugroho', '2010501051', 'afriyoharynugroho@gmail.com', NULL, '$2y$10$zLOh.1SbcwbX/qCsGijXje1PmFRB3NtdbldUJD0LH5LdjkflR2dH.', 'mahasiswa', NULL, NULL, NULL),
(343, 'Tiara Iffatunadia', '2010501052', 'nadiaratia@gmail.com', NULL, '$2y$10$.Uxa5Dggcv8J8vGzrb4m.e1KHSOctFEEe.KC70lTLaSp/rVdLSs8e', 'mahasiswa', NULL, NULL, NULL),
(344, 'Abdul Azis Marzuqi', '2010501053', 'azis280302@gmail.com', NULL, '$2y$10$P5P7f99xQsiy5TW/DnOLN.rkyBbfZmd0dILwTdyyzXPNSQ3zyPQ.2', 'mahasiswa', NULL, NULL, NULL),
(345, 'Fadiah Idzni', '2010501054', 'fadiahidzni1101@gmail.com', NULL, '$2y$10$OHhZGmn8mnEPTVnj/kwPZOABlgsSAjyGjq3oxJX6YDD9K8hEWQMMq', 'mahasiswa', NULL, NULL, NULL),
(346, 'Indy Rahmah Nisrina', '2010501055', 'indyrahmah9@gmail.com', NULL, '$2y$10$kELQdJh/pawZfuZvxArnlu.Sjxm6rzhITeKlwQZsx0L6Ursj0Wl.C', 'mahasiswa', NULL, NULL, NULL),
(347, 'Yohanes Peppino Pasaribu', '2010501056', 'peppinopasaribu@gmail.com', NULL, '$2y$10$B6tYSy5VLICFeNaYsE7BhOyRyMB1dQ8ipbq/TNPd0JW1s2iEIrdjK', 'mahasiswa', NULL, NULL, NULL),
(348, 'Ajeng Dwi Maharani', '2010501057', 'ajengdwi642@gmail.com', NULL, '$2y$10$ygtLmZ8ry1nEceafotYFLe2eQOO7vL.8.oUK6KyznZ/jz4Gcp9u76', 'mahasiswa', NULL, NULL, NULL),
(349, 'Vanessya Putri Utami', '2010501058', 'vanessya711@gmail.com', NULL, '$2y$10$5BgtMSRfjz.HwP2nNKm03.KCsSNEzFTf0UMPZh4PZBUz1e9lb3ah.', 'mahasiswa', NULL, NULL, NULL),
(350, 'Ammar Qois Fatturrahman', '2010501059', 'forsakenneon5@gmail.com', NULL, '$2y$10$NcDCPnfcV5efO1L7nH3x5Ov.QVvGVHzezCzkZ6v0CSgp8KB/FRIda', 'mahasiswa', NULL, NULL, NULL),
(351, 'Fathiah Azzahrah', '2010501060', 'fathiaazr268@gmail.com', NULL, '$2y$10$Izzfm5HzhmHLJIhhhLq87.lffSrYfEhU/xdW.nhVEH5CXq8aWLOxi', 'mahasiswa', NULL, NULL, NULL),
(352, 'Aqsha Nurfachrianto', '2010501061', 'nurfachrianto@gmail.com', NULL, '$2y$10$SJjYSNoiztmGeEhoq/MBWuxufZY.kOqUW2I6BzH2D0DjdwrDX.Scy', 'mahasiswa', NULL, NULL, NULL),
(353, 'Muhamad Hanif Dzulfa', '2010501062', 'hanipjulpa@gmail.com', NULL, '$2y$10$VDEip5thW.Q23gv5ft1dWuaI6ZUShqHdcTqlwzR2bFdGnfHDtfFOm', 'mahasiswa', NULL, NULL, NULL),
(354, 'Elsafanni Putri', '2010501063', 'elsafanniptr16@gmail.com', NULL, '$2y$10$oru06YXExtdx9ve8MWqIW.r26KZn.euTDxpAFX6iFp7d28ApC5/ve', 'mahasiswa', NULL, NULL, NULL),
(355, 'Fadli Arfans Hakim', '2010501064', 'fadliarfanshakim@gmail.com', NULL, '$2y$10$bmgVHfcM0rCaC8.Xl8I0a.Zj3GduBzC/epuXFWxtzbMf46e3OWVdu', 'mahasiswa', NULL, NULL, NULL),
(356, 'Marelya Namira Sofyan', '2010501065', 'marelyanamiras@gmail.com', NULL, '$2y$10$j9CqzkCPVIIKFCrXClVTsudNkDtn/yuoOI1VHzmSAb.0/NH7fUBSC', 'mahasiswa', NULL, NULL, NULL),
(357, 'Rama Aldiansyah Ramadhan', '2010501066', 'ramaaldiansyah31@gmail.com', NULL, '$2y$10$2CbmIX.AhGZtr4POUN.qFuwicGkwwAb4vrEEOCUJetxHDjdFu2aWu', 'mahasiswa', NULL, NULL, NULL),
(358, 'Wirangga Andriano Ramadhan', '2010501067', 'wirangga.andriano1@gmail.com', NULL, '$2y$10$Ba1GoLbYo/rJSHyJvsW9ouH6.iknpC4NcbrIoiY2YdSzpNdGTv/lq', 'mahasiswa', NULL, NULL, NULL),
(359, 'Mohammad Luthfie Febrian', '2010501068', 'luthfiefbrr@gmail.com', NULL, '$2y$10$08hvVegk.9afaQDc67FXQuZWepI1rUi43r5KzOgzhaZikoLf0lPW6', 'mahasiswa', NULL, NULL, NULL),
(360, 'Mohammad Ezra Prajna', '2010501069', 'mohammadezraprajna@gmail.com', NULL, '$2y$10$KzzHC7ySvoFZIjorAgQ0ceF4H/2chwT79nfdcLm3anwqaj1NKm4Fe', 'mahasiswa', NULL, NULL, NULL),
(361, 'Bambang Triwahyono', '204250758', 'bambang.triwahyono@upnvj.ac.id', NULL, '$2y$10$mBPbOod5vxYv3vIFro1SC.Uh945w4GvQ7yP0cBK22Rl3QFL9O8t9.', 'dosen', NULL, NULL, NULL),
(362, 'Bayu Hananto', '2010896', 'bayuhananto@upnvj.ac.id', NULL, '$2y$10$y73moHr57JB/oZqpM7K30efArjsRkC5/mlzUXKERTjkWI5NHrPgva', 'dosen', NULL, NULL, NULL),
(363, 'Desta Sandya Prasvita', '303128702', '', NULL, '$2y$10$xl.i7ijmEqA3NjlL6MIvj.TL6TdEGOVZUbuJeZZn3znMo6EtZg/8a', 'dosen', NULL, NULL, NULL),
(364, 'Didit Widiyanto', '94120221', 'didit.widiyanto89@gmail.com', NULL, '$2y$10$ChiWAaOhkFoaBjbwKNgD3eDkq6IT1BFIeTlKy2hNELR2W7Fw9p7vu', 'dosen', NULL, NULL, NULL),
(365, 'Hamonangan Kinantan P.', '2088502', 'hamonangan.kp@upnvj.ac.id', NULL, '$2y$10$lDYLXVZKhwPh595SbSZfLu2K4vrR83Eex8i1GYEHGHvyey6WGUAdi', 'dosen', NULL, NULL, NULL),
(366, 'Henki Bayu Seta', '206250806', '', NULL, '$2y$10$dUUwvfNzaxEyRmCkTIeKbObHvLUI5iS9Qf2w9N8UVSibrCMki1MXS', 'dosen', NULL, NULL, NULL),
(367, 'Ichsan Mardani', '17049002', 'mardani300@gmail.com', NULL, '$2y$10$J5ZscJNWRxjLvbHNk1CoxejRw0kOlZY7E1tO0lSPAkwEgE2Y8./CW', 'dosen', NULL, NULL, NULL),
(368, 'Indra Permana Solihin', '209250865', 'indrapermana@upnvj.ac.id', NULL, '$2y$10$z.eds/lR9sKLZfn142R8LO.YrcXWKvKQ7YyNSMig3o4AAye9wntKu', 'dosen', NULL, NULL, NULL),
(369, 'I Wayan Rangga Pinastawa', '22089026', 'rangga@upnvj.ac.id', NULL, '$2y$10$7z/pOgnkKSjXThRWb6YgleI5TptyOc62sSGApkuhFHhEiAei.xBW6', 'dosen', NULL, NULL, NULL),
(370, 'Jayanta', '87110103', 'jayanta@upnvj.ac.id', NULL, '$2y$10$AJJa9W7ogHY60B9HY.qN8OkJQaQVELyHl6wZ9bxBb1w33OTI9Y6Dq', 'dosen', NULL, NULL, '2024-09-23 14:30:00'),
(371, 'Kharisma Wiati Gusti', '22089025', '', NULL, '$2y$10$iyeWvw8buG7tv3ILpk2Jk.1vQRZLaH17rVB6OLT1jmIu3o2aGABTy', 'dosen', NULL, NULL, NULL),
(372, 'Mayanda Mega Santoni', '17089002', 'megasantoni@upnvj.ac.id', NULL, '$2y$10$aVGPSWmdXETdvSMAOOmnzOF7blGyFtgngmmsZoVZMmHBmmP7JHw6C', 'dosen', NULL, NULL, NULL),
(373, 'M. Octaviano Pratama', '2008066763', 'tavgreen008@gmail.com', NULL, '$2y$10$i.NvyxwWAUYT26ya.OvLDu2Xt3T4HOhOVSOiBwyNeMRWVYXjU4VXa', 'dosen', NULL, NULL, NULL),
(374, 'Muhammad Adrezo', '200120707', 'muhammad.adrezo@upnvj.ac.id', NULL, '$2y$10$kE2TGFKq3OkjP5VqhMkleOibzWGg8s9103IwxA9D/ca22xkZ5Oqqq', 'dosen', NULL, NULL, NULL),
(375, 'Muhammad Panji M.', '22089033', 'muhammadpanji@upnvj.ac.id', NULL, '$2y$10$n3nEY67GUckRTBPLclO.l.Ilwl4fjWG1pel4ABXvf21GCsOQpu1nG', 'dosen', NULL, NULL, NULL),
(376, 'Musthofa Galih Pradana', '22089027', 'musthofagalihpradana@upnvj.ac.id', NULL, '$2y$10$01D1jMNL90Uo0bbpjMN15.CTiaJuiWVm1dyv6YzFLW.xn6cxR6CEu', 'dosen', NULL, NULL, NULL),
(377, 'Neny Rosmawarni', '22089028', 'nenyrosmawarni@upnvj.ac.id', NULL, '$2y$10$g3RgXx.0BncxyzRWO49eoe95ymIXICITL3fAxCuS/sG8fxWpKeKxq', 'dosen', NULL, NULL, NULL),
(378, 'Noor Falih', '218111369', 'falih@upnvj.ac.id', NULL, '$2y$10$WYcbu.1TVn22BeVrwZkWs.jGO1VNouRCNXWk9BL96QFrz1HOJ.J9.', 'dosen', NULL, NULL, NULL),
(379, 'Novi Trisman Hadi', '22089034', 'novitrismanhadi@upnvj.ac.id', NULL, '$2y$10$5nDUy4ce/ssdG7CNwPmIFOgYrpSqvYTpz8.chxDulddTKsxDbAp/i', 'dosen', NULL, NULL, NULL),
(380, 'Nurhuda Maulana', '22089030', 'nurhudamaulana@upnvj.ac.id', NULL, '$2y$10$B8K2ybAhboporMkmYG2HEuRzI1RuuAXK0Oc.jo2ZCTdkPy0uHd1s2', 'dosen', NULL, NULL, NULL),
(381, 'Nurul Afifah Arifuddin', '22089035', 'nurulafifaharifuddin@upnvj.ac.id', NULL, '$2y$10$PKsTtYrM7mNXIF/tEyiozu/a7jkj89QQxmpF0YOnW9G52qQy0jsLC', 'dosen', NULL, NULL, NULL),
(382, 'Nurul Chamidah', '215121177', 'nurul.chamidah@upnvj.ac.id', NULL, '$2y$10$io7Y/ZdxJHIJazPt47.d.O2rf/P7u.YbYURfrwAsAuE4HgTehC6vW', 'dosen', NULL, NULL, NULL),
(383, 'Rido Zulfahmi', '8847270018', 'rz.rz.rzedd@gmail.com', NULL, '$2y$10$0Egqs5BJSKminVY.xEKpLeW3mzJvXKDLixzab846A/xSqB4kThOqK', 'dosen', NULL, NULL, NULL),
(384, 'Ridwan Raafi\'udin', '209250881', 'raafiudin@upnvj.ac.id', NULL, '$2y$10$.c2h/VHFXzkR0RzBFDEVDuJMlwHoUCBoKcM/q61tH5FPFIsIpwIlS', 'dosen', NULL, NULL, NULL),
(385, 'Yuni Widiastiwi', '200120670', '', NULL, '$2y$10$L/Yg.aREla8RlNeMPCNWc.2ygGernE2JVuRJo8OH0QkIaT0Eob7gu', 'dosen', NULL, NULL, NULL),
(386, 'Andhika Octa Indarso', '18099009', 'andyocta@upnvj.ac.id', NULL, '$2y$10$kJwTj87ig43c4V5081DXyuqdLBw27er3N4YPDWNTz4QPYMQnawYjG', 'dosen', NULL, NULL, NULL),
(387, 'Anita Muliawati', '97120469', 'anitamuliawati@upnvj.ac.id', NULL, '$2y$10$hT/7prRYtNplQNgEn6Me/.Yyl0oNQGQ4hLSV767/ToNgiwHW9.6Xi', 'dosen', NULL, NULL, NULL),
(388, 'Artika Arista', '1993100000000000000', 'artika.arista@upnvj.ac.id', NULL, '$2y$10$bFO/1NMDUR9lIdeNKFngxOK7hCLRIft.kmyxteMgAZ8wdZ8B1cEzi', 'dosen', NULL, NULL, NULL),
(389, 'Ati Zaidiah', '97120520', 'atizaidiah@yahoo.com', NULL, '$2y$10$HES1nm9lEvosJ1Xcy8TDVuyoyAwEZoE8TJuhxZO.b77iPkA94gYM2', 'dosen', NULL, NULL, NULL),
(390, 'Bambang Saras Yulistiawan', '220112081', '', NULL, '$2y$10$XPv9TFhh46k95QD.HcUvUOorizfbE3BXXic61X2f.ICVkqLBDvOBm', 'dosen', NULL, NULL, NULL),
(391, 'Catur Nugrahaeni P. D.', '211250935', 'catur.nugrahaeni@gmail.com', NULL, '$2y$10$5ncHz5Wjn.aK64bLkJ8MWeES061BPpSgsYjKwpC5X6qczfdufS9hO', 'dosen', NULL, NULL, NULL),
(392, 'Ika Nurlaili Isnainiyah', '17019015', '', NULL, '$2y$10$g/BjShE75iOde81uA9EpA.0e/4ttcrdab20YsH2HSgmCSiC2pNEDa', 'dosen', NULL, NULL, NULL),
(393, 'I Wayan Widi Pradnyana', '25068104', 'upn.fik.widi@gmail.com', NULL, '$2y$10$.GWrvIGmMZTizxL7ct1MMOveDeWt10RE1QRhp28FC/KCqMn5UzOLC', 'dosen', NULL, NULL, NULL),
(394, 'Kraugusteeliana', '322087501', 'kraugusteeliana@upnvj.ac.id', NULL, '$2y$10$9OGges9L8OPmkKjD0TMaRuW6eIuz6UK2qqpBC4ct8lEqpa1odXl3.', 'dosen', NULL, NULL, NULL),
(395, 'Nindy Irzavika', '22089029', 'nindyirzavika@upnvj.ac.id', NULL, '$2y$10$oDWVPGeo4RWAE4ek2SKqMurp/r2ymGZrbBXu0yfF34MsWj6GjdSxe', 'dosen', NULL, NULL, NULL),
(396, 'Radinal Setyadinsa', '22089036', 'radinalsetyadinsa@upnvj.ac.id', NULL, '$2y$10$slBi1galGL3Jf2q2Ql40r.4K3TWQv8bb2bSwTbZSkuro/YgeBX172', 'dosen', NULL, NULL, NULL),
(397, 'Ria Astriratma', '218111375', 'astriratma@upnvj.ac.id', NULL, '$2y$10$PeJQLXmShLr1YzFfOE1YueBQwzRi2/hmxsgrEGN3cmFCkGybRsqvC', 'dosen', NULL, NULL, NULL),
(398, 'Rifka Dwi Amalia', '22089037', 'rifkadwiamalia@upnvj.ac.id', NULL, '$2y$10$ygzIB.8M5Ks1lqHizXtlEO5JxGb/ggURx28YgkyFT5.UyxGoYyBAq', 'dosen', NULL, NULL, NULL),
(399, 'Rio Wirawan', '420018601', 'rio.wirawan@upnvj.ac.id', NULL, '$2y$10$k5z0mv8EcLmgDOsNhehoe.nzPotf/BBQN.6LGqXTYq3kqE0aE6L6O', 'dosen', NULL, NULL, NULL),
(400, 'Rudhy Ho Purabaya', '84110055', 'rudhy.purabaya@upnvj.ac.id', NULL, '$2y$10$C3oa/PqOL/cAw8rwbtmqZ.mfYHkmbHGNG502K7W8PN4xTYzlxpI8i', 'dosen', NULL, NULL, NULL),
(401, 'Sarika', '218111372', 'sarika.afrizal@upnvj.ac.id', NULL, '$2y$10$BaWJw0t.hJB/8Dynst8n3.2.AByXYdxFjP2cXrBzptGZea0h.8uu6', 'dosen', NULL, NULL, NULL),
(402, 'Tjahjanto', '200120691', 'tjahjanto@upnvj.ac.id', NULL, '$2y$10$9JiLdyn/sq9ElgiSK9oBEuyDUny1EsE35smTkttoOeq6uVhyKFoNC', 'dosen', NULL, NULL, NULL),
(403, 'Triando Damiri Burlian', '22089031', '', NULL, '$2y$10$/Tuf3vyisLMi7GVBwT5tJOMaS5JFFJkyY7Q4FDWTgL9osUAUiIo9G', 'dosen', NULL, NULL, NULL),
(404, 'Widya Cholil', '221112080', 'widyacholil@upnvj.ac.id', NULL, '$2y$10$2Jus.9SuRb9PuaWumDuZC.woknI19Zwq/vJ.DYhRNf4hGuj5r2.am', 'dosen', NULL, NULL, NULL),
(405, 'Yulnelly', '89110054', 'yulnelly_upnvj@ac.id', NULL, '$2y$10$OGtm6dSq9E9TkZttZ0FX8uuif5qlxZhwNBYq8J2y.sRTbv1u9DT1K', 'dosen', NULL, NULL, NULL),
(406, 'Zatin Niqotaini', '22089032', '', NULL, '$2y$10$NccIMDXr9nol9IzsIjAt9OgBIfPrAbFclyfkyNK6Dh8lYRxwHaeYS', 'dosen', NULL, NULL, NULL),
(407, 'Erly Krisnanik', '98120581', 'erlykrisnanik@upnvj.ac.id', NULL, '$2y$10$iSJPoyXujgbPIGqFs7aPWeuHgwwvKF1rtruM/vk8IlhueCRSJ3CTC', 'dosen', NULL, NULL, NULL),
(408, 'Helena Nurramdhani Irmanda', '218111371', 'helenairmanda@upnvj.ac.id', NULL, '$2y$10$6yQnElXAyfo3.0wHzn0BWupY1LUMMc5cVpsegWC4m.5mSghlP8uEa', 'dosen', NULL, NULL, NULL),
(409, 'Iin Ernawati', '204250759', 'iinerti@gmail.com', NULL, '$2y$10$Qcd0dDIv2XGKjRhHNDIElORSrkgpY73ek6oMLE2iJt8I.HVNBGET6', 'dosen', NULL, NULL, NULL),
(410, 'Intan Hesti Indriana', '2096210', 'hesti@upnvj.ac.id', NULL, '$2y$10$PrtkuLkgdbpNZmIMz73nZOTKYpleK6/wNwqQKolkesUbVwa0aSo4m', 'dosen', NULL, NULL, NULL),
(411, 'Lomo Mula Tua', '8065806', 'lomomt@gmail.com', NULL, '$2y$10$82eMEuqh2RudacoOPaeL6.UlvykP.TCl5yoKx5hp9A9JC.9C6F0Cy', 'dosen', NULL, NULL, NULL),
(412, 'Mohamad Bayu Wibisono', '204120756', 'bayu.wibisono@upnvj.ac.id', NULL, '$2y$10$mQgz30ZLvQ7a7GJbDHuCR.tqE4gKpXswWAPSw6oOj9tIlafxFtsTG', 'dosen', NULL, NULL, NULL),
(413, 'Nur Hafifah Matondang', '211255077', 'nurhafifahmatondang@upnvj.ac.id', NULL, '$2y$10$j5SfS7PEYf7p242uggXqwejFyjNdLspYXowlf7wcpv/QzFJUYHrIq', 'dosen', NULL, NULL, NULL),
(414, 'Ruth Mariana Bunga Wadu', '218111374', 'ruthbungawadu@upnvj.ac.id', NULL, '$2y$10$1.AN3t239CswH2apuMAcMukDAmEbLUMOK3kLhqGkAWNNRJ4ccfJ1.', 'dosen', NULL, NULL, NULL),
(415, 'Theresia Wati', '206250807', 'theresia.atha@gmail.com', NULL, '$2y$10$hwlglgfsfI3RTEte.ZKmFeM8X/MoxD5KMVCdV.w3L2umq5NftM1FS', 'dosen', NULL, NULL, NULL),
(416, 'Tri Rahayu', '204250757', '', NULL, '$2y$10$G0N9U1RIJE2rnUevnIWk7e0.z9u5nptS0aN98ew6jO/flaP9LKktO', 'dosen', NULL, NULL, NULL),
(417, 'Staf Prodi', '', 'admin@gmail.com', NULL, '$2y$10$/JTWzwmli2bjz.eZXM2wO.obA92ppz5k4TbnqOmb/eSaJMUsnsLSq', 'admin', NULL, NULL, NULL),
(418, 'Kaprodi', '', 'kaprodi@gmail.com', NULL, '$2y$10$q1gAmUDQZyNXiUvL/xLzqeNSm3T7ZhH4Syl.C7pnfGWCDFjPfghq2', 'kaprodi', NULL, NULL, NULL),
(419, 'Dekan', '', 'dekan@gmail.com', NULL, '$2y$10$gbh7TI6VoVnTlso2jgJjRuotFs8qT7St4feS07JSYHcHTY/O/WL/q', 'dekanat', NULL, NULL, NULL),
(420, 'Wakil Dekan I', '', 'wadek1@gmail.com', NULL, '$2y$10$0OK8typ0vNlZLarogO761.QQNFIze.fB3KJliUTtVPO5uMh8Wptfq', 'dekanat', NULL, NULL, NULL),
(423, 'Marsa Nabila', '2110512048', '2110512048@mahasiswa.upnvj.ac.id', NULL, '$2y$10$ltGTMcuYfqmgHdWg2zWlyOkqI9qkVqGQZswQ1.vXQcksle5zUGeEO', 'mahasiswa', NULL, '2024-10-16 17:42:09', '2024-10-16 17:42:09'),
(424, 'Annisa Zhafira Adhya', '2210511106', '2210511106@mahasiswa.upnvj.ac.id', NULL, '$2y$10$6H90wCCJoJRsHSBV/8JN/edlTdkevdZ65nzV37vnxkKOjmv3QB9hq', 'mahasiswa', NULL, '2024-10-16 17:42:09', '2024-10-16 17:42:09'),
(425, 'Nasya Putri Salsabila', '2310501062', '2310501062@mahasiswa.upnvj.ac.id', NULL, '$2y$10$9xuT9UXex4QHoTWjFT2t5e9X1mDl7juRkJMwyPZiMm/h17.V.Hu1O', 'mahasiswa', NULL, '2024-10-16 17:42:09', '2024-10-16 17:42:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas_sidang_proposals`
--
ALTER TABLE `berkas_sidang_proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_sidang_proposals_id_pengajuan_dospem_foreign` (`id_pengajuan_dospem`);

--
-- Indexes for table `berkas_sidang_skripsis`
--
ALTER TABLE `berkas_sidang_skripsis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_sidang_skripsis_id_pengajuan_dospem_foreign` (`id_pengajuan_dospem`);

--
-- Indexes for table `data_topik`
--
ALTER TABLE `data_topik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dosen_nip_unique` (`nip`),
  ADD KEY `dosen_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forms_form_id_unique` (`form_id`);

--
-- Indexes for table `hasil_proposals`
--
ALTER TABLE `hasil_proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_proposals_id_dosen_foreign` (`id_dosen`),
  ADD KEY `hasil_proposals_id_jadwal_proposal_foreign` (`id_jadwal_proposal`);

--
-- Indexes for table `hasil_skripsi_pembimbings`
--
ALTER TABLE `hasil_skripsi_pembimbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_skripsi_pembimbings_id_dosen_foreign` (`id_dosen`),
  ADD KEY `hasil_skripsi_pembimbings_id_jadwal_skripsi_foreign` (`id_jadwal_skripsi`);

--
-- Indexes for table `hasil_skripsi_pengujis`
--
ALTER TABLE `hasil_skripsi_pengujis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_skripsi_pengujis_id_dosen_foreign` (`id_dosen`),
  ADD KEY `hasil_skripsi_pengujis_id_jadwal_skripsi_foreign` (`id_jadwal_skripsi`);

--
-- Indexes for table `jadwal_proposals`
--
ALTER TABLE `jadwal_proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_proposals_id_berkas_proposal_foreign` (`id_berkas_proposal`),
  ADD KEY `jadwal_proposals_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `jadwal_sidangs`
--
ALTER TABLE `jadwal_sidangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_sidangs_id_penguji_1_foreign` (`id_penguji_1`),
  ADD KEY `jadwal_sidangs_id_penguji_2_foreign` (`id_penguji_2`),
  ADD KEY `jadwal_sidangs_id_pembimbing_foreign` (`id_pembimbing`),
  ADD KEY `jadwal_sidangs_id_plot_jadwal_foreign` (`id_plot_jadwal`);

--
-- Indexes for table `jadwal_skripsis`
--
ALTER TABLE `jadwal_skripsis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_skripsis_id_berkas_skripsi_foreign` (`id_berkas_skripsi`),
  ADD KEY `jadwal_skripsis_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `ketersediaan_dosens`
--
ALTER TABLE `ketersediaan_dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ketersediaan_dosens_id_plot_jadwal_foreign` (`id_plot_jadwal`),
  ADD KEY `ketersediaan_dosens_id_dosen_foreign` (`id_dosen`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`),
  ADD KEY `mahasiswa_user_id_foreign` (`user_id`),
  ADD KEY `mahasiswa_dosenpa_id_foreign` (`dosenpa_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengajuan_dospem`
--
ALTER TABLE `pengajuan_dospem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_dospem_dp1_id_foreign` (`dp1_id`),
  ADD KEY `pengajuan_dospem_dp2_id_foreign` (`dp2_id`),
  ADD KEY `pengajuan_dospem_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `pengajuan_topik`
--
ALTER TABLE `pengajuan_topik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_topik_topik_id_foreign` (`topik_id`),
  ADD KEY `pengajuan_topik_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plot_jadwals`
--
ALTER TABLE `plot_jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plot_jadwals_id_ruangan_foreign` (`id_ruangan`);

--
-- Indexes for table `rekomendasi_akademik`
--
ALTER TABLE `rekomendasi_akademik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekomendasi_akademik_dosenpa_id_foreign` (`dosenpa_id`),
  ADD KEY `rekomendasi_akademik_mahasiswa_id_foreign` (`mahasiswa_id`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topik_dosen`
--
ALTER TABLE `topik_dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topik_dosen_topik_id_dosen_id_unique` (`topik_id`,`dosen_id`),
  ADD KEY `topik_dosen_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas_sidang_proposals`
--
ALTER TABLE `berkas_sidang_proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `berkas_sidang_skripsis`
--
ALTER TABLE `berkas_sidang_skripsis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `data_topik`
--
ALTER TABLE `data_topik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hasil_proposals`
--
ALTER TABLE `hasil_proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `hasil_skripsi_pembimbings`
--
ALTER TABLE `hasil_skripsi_pembimbings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hasil_skripsi_pengujis`
--
ALTER TABLE `hasil_skripsi_pengujis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jadwal_proposals`
--
ALTER TABLE `jadwal_proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jadwal_sidangs`
--
ALTER TABLE `jadwal_sidangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `jadwal_skripsis`
--
ALTER TABLE `jadwal_skripsis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ketersediaan_dosens`
--
ALTER TABLE `ketersediaan_dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengajuan_dospem`
--
ALTER TABLE `pengajuan_dospem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pengajuan_topik`
--
ALTER TABLE `pengajuan_topik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plot_jadwals`
--
ALTER TABLE `plot_jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `rekomendasi_akademik`
--
ALTER TABLE `rekomendasi_akademik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topik_dosen`
--
ALTER TABLE `topik_dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkas_sidang_proposals`
--
ALTER TABLE `berkas_sidang_proposals`
  ADD CONSTRAINT `berkas_sidang_proposals_id_pengajuan_dospem_foreign` FOREIGN KEY (`id_pengajuan_dospem`) REFERENCES `pengajuan_dospem` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berkas_sidang_skripsis`
--
ALTER TABLE `berkas_sidang_skripsis`
  ADD CONSTRAINT `berkas_sidang_skripsis_id_pengajuan_dospem_foreign` FOREIGN KEY (`id_pengajuan_dospem`) REFERENCES `pengajuan_dospem` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hasil_proposals`
--
ALTER TABLE `hasil_proposals`
  ADD CONSTRAINT `hasil_proposals_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_proposals_id_jadwal_proposal_foreign` FOREIGN KEY (`id_jadwal_proposal`) REFERENCES `jadwal_proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_skripsi_pembimbings`
--
ALTER TABLE `hasil_skripsi_pembimbings`
  ADD CONSTRAINT `hasil_skripsi_pembimbings_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_skripsi_pembimbings_id_jadwal_skripsi_foreign` FOREIGN KEY (`id_jadwal_skripsi`) REFERENCES `jadwal_skripsis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_skripsi_pengujis`
--
ALTER TABLE `hasil_skripsi_pengujis`
  ADD CONSTRAINT `hasil_skripsi_pengujis_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_skripsi_pengujis_id_jadwal_skripsi_foreign` FOREIGN KEY (`id_jadwal_skripsi`) REFERENCES `jadwal_skripsis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_proposals`
--
ALTER TABLE `jadwal_proposals`
  ADD CONSTRAINT `jadwal_proposals_id_berkas_proposal_foreign` FOREIGN KEY (`id_berkas_proposal`) REFERENCES `berkas_sidang_proposals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_proposals_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_sidangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_sidangs`
--
ALTER TABLE `jadwal_sidangs`
  ADD CONSTRAINT `jadwal_sidangs_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_sidangs_id_penguji_1_foreign` FOREIGN KEY (`id_penguji_1`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_sidangs_id_penguji_2_foreign` FOREIGN KEY (`id_penguji_2`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_sidangs_id_plot_jadwal_foreign` FOREIGN KEY (`id_plot_jadwal`) REFERENCES `plot_jadwals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_skripsis`
--
ALTER TABLE `jadwal_skripsis`
  ADD CONSTRAINT `jadwal_skripsis_id_berkas_skripsi_foreign` FOREIGN KEY (`id_berkas_skripsi`) REFERENCES `berkas_sidang_skripsis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_skripsis_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_sidangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ketersediaan_dosens`
--
ALTER TABLE `ketersediaan_dosens`
  ADD CONSTRAINT `ketersediaan_dosens_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ketersediaan_dosens_id_plot_jadwal_foreign` FOREIGN KEY (`id_plot_jadwal`) REFERENCES `plot_jadwals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_dosenpa_id_foreign` FOREIGN KEY (`dosenpa_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `mahasiswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengajuan_dospem`
--
ALTER TABLE `pengajuan_dospem`
  ADD CONSTRAINT `pengajuan_dospem_dp1_id_foreign` FOREIGN KEY (`dp1_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `pengajuan_dospem_dp2_id_foreign` FOREIGN KEY (`dp2_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `pengajuan_dospem_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `pengajuan_topik`
--
ALTER TABLE `pengajuan_topik`
  ADD CONSTRAINT `pengajuan_topik_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `pengajuan_topik_topik_id_foreign` FOREIGN KEY (`topik_id`) REFERENCES `data_topik` (`id`);

--
-- Constraints for table `plot_jadwals`
--
ALTER TABLE `plot_jadwals`
  ADD CONSTRAINT `plot_jadwals_id_ruangan_foreign` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekomendasi_akademik`
--
ALTER TABLE `rekomendasi_akademik`
  ADD CONSTRAINT `rekomendasi_akademik_dosenpa_id_foreign` FOREIGN KEY (`dosenpa_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `rekomendasi_akademik_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `topik_dosen`
--
ALTER TABLE `topik_dosen`
  ADD CONSTRAINT `topik_dosen_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `topik_dosen_topik_id_foreign` FOREIGN KEY (`topik_id`) REFERENCES `data_topik` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
