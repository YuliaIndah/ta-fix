-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26 Apr 2018 pada 05.09
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta-fix`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `acc_kegiatan`
--

CREATE TABLE `acc_kegiatan` (
  `kode_acc_kegiatan` int(20) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `kode_jenis_kegiatan` int(20) NOT NULL,
  `ranking` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `acc_kegiatan`
--

INSERT INTO `acc_kegiatan` (`kode_acc_kegiatan`, `id_pengguna`, `kode_jenis_kegiatan`, `ranking`, `created_at`, `updated_at`) VALUES
(9, 2, 2, 1, '2018-04-24 10:05:28', NULL),
(11, 3, 2, 2, '2018-04-24 10:06:28', NULL),
(12, 2, 1, 1, '2018-04-24 14:54:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` int(20) NOT NULL,
  `kode_jenis_barang` int(20) DEFAULT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(20) NOT NULL,
  `captcha_time` int(10) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(270, 1524708944, '::1', 'ak66H9z6'),
(271, 1524708945, '::1', 'b0nWABiR'),
(272, 1524708972, '::1', 'ivQjug3L'),
(273, 1524709145, '::1', 'uije0Rxw'),
(274, 1524709172, '::1', 'VWhoSdop'),
(275, 1524709193, '::1', 'ZfbrVJBx'),
(276, 1524709619, '::1', 'mnsZ2vyc'),
(277, 1524709777, '::1', 'pw40SiFo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_diri`
--

CREATE TABLE `data_diri` (
  `no_identitas` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jen_kel` enum('Laki - laki','Perempuan') NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_diri`
--

INSERT INTO `data_diri` (`no_identitas`, `nama`, `jen_kel`, `tmp_lahir`, `tgl_lahir`, `alamat`, `no_hp`, `created_at`, `updated_at`) VALUES
(12, 'mbak sekdep', 'Laki - laki', 'semarang', '1998-04-06', 'semarangang', '019238012734', '2018-04-23 16:47:09', '2018-04-23 16:48:38'),
(123, 'mbak staf keu', 'Laki - laki', 'gunungkiduls', '1998-04-07', 'gunungkidulsa', '09122343423', '2018-04-24 00:23:31', '2018-04-24 00:25:27'),
(3423, 'mbak anin', 'Perempuan', 'Wates', '1998-04-07', 'wates', '34234', '2018-04-23 17:16:53', '2018-04-23 17:26:57'),
(8098, 'mas kepala akademik', 'Laki - laki', 'bandung', '1998-04-03', 'bandung', '86995464564', '2018-04-24 00:40:03', '2018-04-24 04:04:09'),
(8696, 'mbak staf akademik', 'Laki - laki', 'bandung', '1998-04-06', 'bantul', '897897', '2018-04-24 04:06:34', '2018-04-24 04:07:54'),
(76567, 'dek mahasiswa', 'Perempuan', 'klaten', '1998-04-24', 'klaten4', '8078832423423', '2018-04-24 04:42:44', '2018-04-24 04:43:40'),
(87587, 'kak manajer sarpras', 'Perempuan', 'sleman', '1998-04-09', 'sleman', '987987', '2018-04-24 04:17:09', NULL),
(989968, 'dek staf sarpras', 'Perempuan', 'kuprog', '1998-04-24', 'kulon porgo', '9868', '2018-04-24 04:17:58', '2018-04-24 04:26:06'),
(340305180219950002, 'Febriyan Yoga Pratama', 'Laki - laki', 'Gunungkidul', '1998-04-23', 'Gunungkidul', '081217109583', '2018-04-23 15:30:27', '2018-04-25 16:27:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_prosedur`
--

CREATE TABLE `dokumen_prosedur` (
  `kode_doc` int(5) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  `tipe_doc` enum('pegawai','mahasiswa','barang') NOT NULL,
  `size` varchar(5) NOT NULL,
  `status` enum('aktif','tidak') NOT NULL DEFAULT 'tidak',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumen_prosedur`
--

INSERT INTO `dokumen_prosedur` (`kode_doc`, `nama_file`, `tipe_doc`, `size`, `status`, `created_at`, `updated_at`) VALUES
(1, '92d5078af21f868fdbb54a52431a000f.pdf', 'pegawai', '61.17', 'aktif', '2018-04-25 10:45:10', '2018-04-25 10:45:10'),
(9, '57414f2e9b1e4b7cf21743ba5dffdc12.pdf', 'barang', '335.1', 'aktif', '2018-04-25 13:18:18', '2018-04-25 13:18:18'),
(10, '4cf055ffa9cb21472c4c76623a3b74cf.pdf', 'mahasiswa', '61.17', 'aktif', '2018-04-25 13:18:21', '2018-04-25 13:18:21'),
(11, '3c4ec338cc0fd080da32a878130dcc8b.pdf', 'mahasiswa', '61.17', 'tidak', '2018-04-25 14:04:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_upload`
--

CREATE TABLE `file_upload` (
  `kode_file` int(10) NOT NULL,
  `kode_kegiatan` int(20) NOT NULL,
  `nama_file` varchar(200) NOT NULL,
  `ukuran_file` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_upload`
--

INSERT INTO `file_upload` (`kode_file`, `kode_kegiatan`, `nama_file`, `ukuran_file`, `created_at`, `updated_at`) VALUES
(10, 13, '9433991ff15d51a215c2ff39df8447b0.pdf', 13.12, '2018-04-23 16:05:28', NULL),
(12, 15, 'e484aee3fe2ba4f7ceb8f0fd05ac36f4.pdf', 13.12, '2018-04-23 16:55:18', NULL),
(13, 16, 'f1e66abc92d02c2ea9aace9560476fbf.pdf', 238.6, '2018-04-23 17:34:03', NULL),
(14, 17, '115857c3c2db13303f1e8cbd744d30aa.pdf', 335.15, '2018-04-24 00:30:34', NULL),
(15, 18, '7e1e4c7ac090be1d85706b855541939a.pdf', 52.42, '2018-04-24 00:43:35', NULL),
(16, 19, 'ed58e277b7e800996c57234b06b99655.pdf', 1739.95, '2018-04-24 01:12:42', NULL),
(17, 20, '485ffbeb0d24e661cd5692c6ae1192f5.pdf', 61.17, '2018-04-24 03:58:04', NULL),
(18, 21, 'abc4d4c99e75c855600ef94b2fa965fe.pdf', 1739.95, '2018-04-24 04:04:40', NULL),
(19, 22, '4b669cbba501145d27c0a8ea3992f249.pdf', 1739.95, '2018-04-24 04:11:21', NULL),
(20, 23, '36a7ecf7a5302594acb1eadf6bb2ffd5.pdf', 1739.95, '2018-04-24 04:26:50', NULL),
(21, 24, 'abe306fa097fbd6b70267d4c5f37c45f.pdf', 1739.95, '2018-04-24 04:48:04', NULL),
(22, 25, '1701fc354f83457a76450536f2f87b64.pdf', 1739.95, '2018-04-24 14:12:35', NULL),
(23, 26, '4e576417e9d99e31989a22f1e1990fd4.pdf', 1739.95, '2018-04-24 14:12:55', NULL),
(24, 27, 'f4c1e57101d84026805e02a3040bbef1.pdf', 1739.95, '2018-04-24 15:41:01', NULL),
(25, 28, '31dfb90931a5ec4a015c7432205206c5.pdf', 1739.95, '2018-04-24 15:48:20', NULL),
(26, 29, '3fc6184bc4e2daf36b6f0a971cb00fea.pdf', 335.15, '2018-04-24 15:54:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_pengajuan`
--

CREATE TABLE `item_pengajuan` (
  `kode_item_pengajuan` int(20) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `kode_barang` int(20) NOT NULL,
  `kode_pengajuan` int(20) DEFAULT NULL,
  `status_pengajuan` enum('baru','proses','selesai','tolak','tunda') NOT NULL DEFAULT 'baru',
  `tgl_item_pengajuan` date NOT NULL,
  `nama_item_pengajuan` varchar(50) NOT NULL,
  `status_persediaan` enum('tersedia','tidak tersedia') NOT NULL DEFAULT 'tidak tersedia',
  `url` varchar(100) NOT NULL,
  `harga_satuan` int(12) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `jumlah` int(12) NOT NULL,
  `file_gambar` varchar(200) NOT NULL,
  `pimpinan` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `kode_jabatan` int(20) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`kode_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Kepala', '2018-04-02 02:51:51', '2018-04-17 15:53:15'),
(2, 'Sekretaris', '2018-04-02 02:51:51', '2018-04-17 15:53:25'),
(3, 'Manajer', '2018-04-02 02:54:48', '2018-04-17 15:53:35'),
(4, 'Staf', '2018-04-02 02:54:48', '2018-04-17 15:53:45'),
(5, 'Mahasiswa', '2018-04-02 02:54:55', '2018-04-17 15:53:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `kode_jenis_barang` int(20) NOT NULL,
  `nama_jenis_barang` enum('habis pakai','aset','belum terdefinisi') NOT NULL DEFAULT 'belum terdefinisi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`kode_jenis_barang`, `nama_jenis_barang`, `created_at`, `updated_at`) VALUES
(1, 'habis pakai', '2018-04-01 12:32:49', '2018-04-17 17:01:39'),
(2, 'aset', '2018-04-01 12:32:49', '2018-04-01 12:32:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `kode_jenis_kegiatan` int(20) NOT NULL,
  `nama_jenis_kegiatan` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_kegiatan`
--

INSERT INTO `jenis_kegiatan` (`kode_jenis_kegiatan`, `nama_jenis_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 'Kegiatan Pegawai', '2018-04-01 12:12:29', '2018-04-18 07:20:52'),
(2, 'Kegiatan Mahasiswa', '2018-04-01 12:12:29', '2018-04-01 12:12:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kode_kegiatan` int(20) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `kode_jenis_kegiatan` int(20) NOT NULL,
  `nama_kegiatan` varchar(200) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `tgl_selesai_kegiatan` date NOT NULL,
  `dana_diajukan` int(12) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `dana_disetujui` int(12) NOT NULL,
  `pimpinan` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`kode_kegiatan`, `id_pengguna`, `kode_jenis_kegiatan`, `nama_kegiatan`, `tgl_kegiatan`, `tgl_selesai_kegiatan`, `dana_diajukan`, `tgl_pengajuan`, `dana_disetujui`, `pimpinan`, `created_at`, `updated_at`) VALUES
(13, 2, 1, 'tes kadep', '2018-04-23', '2018-04-23', 11111, '2018-04-23', 0, 2, '2018-04-23 16:05:28', NULL),
(15, 3, 1, 'tes sekdep', '2018-04-26', '2018-04-30', 1, '2018-04-23', 0, 3, '2018-04-23 16:55:18', NULL),
(16, 4, 1, 'tes manajer keuangan', '2018-04-25', '2018-04-25', 10, '2018-04-23', 0, 4, '2018-04-23 17:34:03', NULL),
(17, 5, 1, 'tes staf keu', '2018-04-24', '2018-04-24', 10, '2018-04-24', 0, 3423, '2018-04-24 00:30:33', NULL),
(18, 6, 1, 'tes kepala akademi', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 6, '2018-04-24 00:43:35', NULL),
(19, 5, 1, 'tes staf keu 2', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 3423, '2018-04-24 01:12:42', NULL),
(20, 4, 1, 'tes mankeu lagi', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 4, '2018-04-24 03:58:04', NULL),
(21, 6, 1, 'tes kademik', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 6, '2018-04-24 04:04:40', NULL),
(22, 7, 1, 'tes staf akademik', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 6, '2018-04-24 04:11:20', '2018-04-24 15:44:15'),
(23, 9, 1, 'tes staf sarpras', '2018-04-24', '2018-04-24', 10, '2018-04-24', 0, 87587, '2018-04-24 04:26:50', NULL),
(24, 10, 2, 'tes mahasiswa', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 0, '2018-04-24 04:48:04', NULL),
(25, 10, 2, 'tes mhs tola', '2018-04-24', '2018-04-24', 90, '2018-04-24', 0, 0, '2018-04-24 14:12:35', NULL),
(26, 10, 2, 'tes mhs terima', '2018-04-24', '2018-04-24', 880, '2018-04-24', 0, 0, '2018-04-24 14:12:55', NULL),
(27, 7, 1, 'tes staf akademik pimpinan', '2018-04-24', '2018-04-24', 90909, '2018-04-24', 0, 6, '2018-04-24 15:41:01', '2018-04-24 15:44:11'),
(28, 6, 1, 'tes kepala akademik', '2018-04-24', '2018-04-24', 19201, '2018-04-24', 0, 6, '2018-04-24 15:48:20', NULL),
(29, 4, 1, 'tes manajer keuangan harusnya new dikadep', '2018-04-24', '2018-04-24', 900, '2018-04-24', 0, 4, '2018-04-24 15:54:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_progress`
--

CREATE TABLE `nama_progress` (
  `kode_nama_progress` int(20) NOT NULL,
  `nama_progress` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nama_progress`
--

INSERT INTO `nama_progress` (`kode_nama_progress`, `nama_progress`, `created_at`, `updated_at`) VALUES
(1, 'DITERIMA', '2018-04-03 11:08:16', '2018-04-18 08:25:13'),
(2, 'DITOLAK', '2018-04-03 11:08:16', '2018-04-03 11:08:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `kode_pengajuan` int(20) NOT NULL,
  `nama_pengajuan` varchar(20) NOT NULL,
  `file_rab` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `no_identitas` bigint(20) NOT NULL,
  `kode_unit` int(20) NOT NULL,
  `kode_jabatan` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `status_email` enum('0','1') NOT NULL,
  `exp_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `no_identitas`, `kode_unit`, `kode_jabatan`, `email`, `password`, `status`, `status_email`, `exp_date`, `created_at`, `updated_at`) VALUES
(2, 340305180219950002, 1, 1, 'febriyanyoga@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'aktif', '1', '0000-00-00', '2018-04-23 15:30:27', '2018-04-26 02:31:31'),
(3, 12, 1, 2, 'sekdep@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-23 16:47:09', '2018-04-23 16:48:02'),
(4, 3423, 3, 3, 'manajer_keuangan@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-23 17:16:53', '2018-04-23 17:19:20'),
(5, 123, 3, 4, 'staf_keuangan@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-24 00:23:31', '2018-04-24 00:24:29'),
(6, 8098, 4, 1, 'kepala_akademik@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-24 00:40:03', '2018-04-24 00:40:37'),
(7, 8696, 4, 4, 'staf_akademik@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-24 04:06:34', '2018-04-24 04:07:16'),
(8, 87587, 2, 3, 'manajer_sarpras@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-24 04:17:09', '2018-04-24 04:20:00'),
(9, 989968, 2, 4, 'staf_sarpras@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-24 04:17:58', '2018-04-24 04:20:07'),
(10, 76567, 8, 5, 'mahasiswa@gmail.com', 'ee3ee6f00d2d5e2d7c028529cca6a311', 'aktif', '1', '0000-00-00', '2018-04-24 04:42:44', '2018-04-24 04:43:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress`
--

CREATE TABLE `progress` (
  `kode_progress` int(20) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `kode_fk` int(20) NOT NULL,
  `kode_nama_progress` int(20) NOT NULL,
  `komentar` varchar(50) NOT NULL,
  `waktu_progress` time NOT NULL,
  `tgl_progress` date NOT NULL,
  `jenis_progress` enum('barang','kegiatan') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `progress`
--

INSERT INTO `progress` (`kode_progress`, `id_pengguna`, `kode_fk`, `kode_nama_progress`, `komentar`, `waktu_progress`, `tgl_progress`, `jenis_progress`, `created_at`, `updated_at`) VALUES
(45, 2, 13, 1, 'insert otomatis', '21:35:28', '2018-04-23', 'kegiatan', '2018-04-23 16:05:28', NULL),
(46, 3, 15, 1, 'insert otomatis', '22:25:18', '2018-04-23', 'kegiatan', '2018-04-23 16:55:18', NULL),
(47, 4, 16, 1, 'insert otomatis', '23:04:03', '2018-04-23', 'kegiatan', '2018-04-23 17:34:03', NULL),
(48, 6, 18, 1, 'insert otomatis', '06:13:35', '2018-04-24', 'kegiatan', '2018-04-24 00:43:35', NULL),
(49, 4, 17, 1, ' oke', '07:30:00', '2018-04-24', 'kegiatan', '2018-04-24 02:00:58', NULL),
(50, 2, 18, 2, ' jelek', '08:50:00', '2018-04-24', 'kegiatan', '2018-04-24 03:20:34', NULL),
(51, 4, 20, 1, 'insert otomatis', '09:28:04', '2018-04-24', 'kegiatan', '2018-04-24 03:58:04', NULL),
(52, 4, 17, 1, ' bagus\r\n', '09:29:00', '2018-04-24', 'kegiatan', '2018-04-24 03:59:07', NULL),
(53, 4, 19, 2, ' jelek', '09:29:00', '2018-04-24', 'kegiatan', '2018-04-24 03:59:26', NULL),
(54, 2, 17, 2, ' jelek', '09:30:00', '2018-04-24', 'kegiatan', '2018-04-24 04:00:06', NULL),
(55, 6, 21, 1, 'insert otomatis', '09:34:40', '2018-04-24', 'kegiatan', '2018-04-24 04:04:40', NULL),
(56, 6, 22, 1, ' jelek\r\n', '09:44:00', '2018-04-24', 'kegiatan', '2018-04-24 04:14:20', NULL),
(57, 8, 23, 1, ' oke', '10:09:00', '2018-04-24', 'kegiatan', '2018-04-24 04:39:52', NULL),
(58, 3, 24, 1, ' oke nih', '10:26:00', '2018-04-24', 'kegiatan', '2018-04-24 04:56:55', NULL),
(59, 2, 19, 1, ' sip', '10:36:00', '2018-04-24', 'kegiatan', '2018-04-24 05:06:28', NULL),
(60, 2, 23, 1, ' sip', '10:36:00', '2018-04-24', 'kegiatan', '2018-04-24 05:06:57', NULL),
(61, 2, 24, 1, ' oke', '10:37:00', '2018-04-24', 'kegiatan', '2018-04-24 05:07:46', NULL),
(62, 3, 26, 1, ' okde', '19:43:00', '2018-04-24', 'kegiatan', '2018-04-24 14:13:09', NULL),
(63, 2, 26, 1, ' okedeh', '19:45:00', '2018-04-24', 'kegiatan', '2018-04-24 14:15:09', NULL),
(64, 3, 25, 2, ' hehehehe jelek', '19:45:00', '2018-04-24', 'kegiatan', '2018-04-24 14:15:31', NULL),
(65, 6, 27, 2, ' elik', '21:16:00', '2018-04-24', 'kegiatan', '2018-04-24 15:46:30', NULL),
(66, 6, 28, 1, 'insert otomatis', '21:18:20', '2018-04-24', 'kegiatan', '2018-04-24 15:48:20', NULL),
(67, 4, 29, 1, 'insert otomatis', '21:24:02', '2018-04-24', 'kegiatan', '2018-04-24 15:54:02', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `kode_unit` int(20) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`kode_unit`, `nama_unit`, `created_at`, `updated_at`) VALUES
(1, 'Departemen', '2018-04-02 02:37:35', '2018-04-17 16:26:31'),
(2, 'Sarana dan Prasarana', '2018-04-02 02:37:35', '2018-04-02 02:37:35'),
(3, 'Keuangan', '2018-04-02 02:48:17', '2018-04-02 02:48:17'),
(4, 'Akademik', '2018-04-02 02:48:17', '2018-04-02 02:48:17'),
(5, 'Tata Usaha', '2018-04-02 02:48:37', '2018-04-02 02:48:37'),
(6, 'Laboratorium Rekayasa Perangkat Lunak', '2018-04-02 02:48:37', '2018-04-25 14:46:35'),
(7, 'Kemahasiswaan', '2018-04-02 02:48:58', '2018-04-02 02:48:58'),
(8, 'KM TEDI', '2018-04-02 02:48:58', '2018-04-02 02:48:58'),
(9, 'Laboratorium Tenaga Listrik', '2018-04-25 14:47:03', NULL),
(10, 'Laboratorium Elektronika ', '2018-04-25 14:47:33', NULL),
(11, 'Laboratorium Teknologi dan Aplikasi Jaringan ', '2018-04-25 14:48:00', NULL),
(12, 'Laboratorium Instrumentasi dan Kendali', '2018-04-25 14:48:49', NULL),
(13, 'Komputer dan Sistem Informasi', '2018-04-25 14:49:24', NULL),
(14, 'Teknik Elektro', '2018-04-25 14:49:34', NULL),
(15, 'Teknik Jaringan', '2018-04-25 14:49:45', NULL),
(16, 'Elektronika dan Instrumentasi', '2018-04-25 14:50:01', NULL),
(17, 'Metrologi dan Instrumentasi', '2018-04-25 14:50:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_kegiatan`
--
ALTER TABLE `acc_kegiatan`
  ADD PRIMARY KEY (`kode_acc_kegiatan`),
  ADD KEY `kode_jabatan` (`id_pengguna`),
  ADD KEY `kode_jenis_kegiatan` (`kode_jenis_kegiatan`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_jenis_barang` (`kode_jenis_barang`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`);

--
-- Indexes for table `data_diri`
--
ALTER TABLE `data_diri`
  ADD PRIMARY KEY (`no_identitas`);

--
-- Indexes for table `dokumen_prosedur`
--
ALTER TABLE `dokumen_prosedur`
  ADD PRIMARY KEY (`kode_doc`);

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`kode_file`),
  ADD KEY `kode_kegiatan` (`kode_kegiatan`);

--
-- Indexes for table `item_pengajuan`
--
ALTER TABLE `item_pengajuan`
  ADD PRIMARY KEY (`kode_item_pengajuan`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_pengajuan` (`kode_pengajuan`),
  ADD KEY `item_pengajuan_ibfk_3` (`id_pengguna`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode_jabatan`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`kode_jenis_barang`);

--
-- Indexes for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`kode_jenis_kegiatan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kode_kegiatan`),
  ADD KEY `kode_jenis_kegiatan` (`kode_jenis_kegiatan`),
  ADD KEY `no_identitas` (`id_pengguna`);

--
-- Indexes for table `nama_progress`
--
ALTER TABLE `nama_progress`
  ADD PRIMARY KEY (`kode_nama_progress`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`kode_pengajuan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `kode_unit` (`kode_unit`),
  ADD KEY `kode_jabatan` (`kode_jabatan`),
  ADD KEY `no_identitas` (`no_identitas`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`kode_progress`),
  ADD KEY `kode_kegiatan` (`kode_fk`),
  ADD KEY `kode_nama_progress` (`kode_nama_progress`),
  ADD KEY `no_identitas` (`id_pengguna`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`kode_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_kegiatan`
--
ALTER TABLE `acc_kegiatan`
  MODIFY `kode_acc_kegiatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kode_barang` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;
--
-- AUTO_INCREMENT for table `dokumen_prosedur`
--
ALTER TABLE `dokumen_prosedur`
  MODIFY `kode_doc` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `kode_file` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `item_pengajuan`
--
ALTER TABLE `item_pengajuan`
  MODIFY `kode_item_pengajuan` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `kode_jabatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `kode_jenis_barang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `kode_jenis_kegiatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kode_kegiatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `nama_progress`
--
ALTER TABLE `nama_progress`
  MODIFY `kode_nama_progress` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `kode_pengajuan` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `kode_progress` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `kode_unit` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `acc_kegiatan`
--
ALTER TABLE `acc_kegiatan`
  ADD CONSTRAINT `acc_kegiatan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acc_kegiatan_ibfk_2` FOREIGN KEY (`kode_jenis_kegiatan`) REFERENCES `jenis_kegiatan` (`kode_jenis_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kode_jenis_barang`) REFERENCES `jenis_barang` (`kode_jenis_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `file_upload`
--
ALTER TABLE `file_upload`
  ADD CONSTRAINT `file_upload_ibfk_1` FOREIGN KEY (`kode_kegiatan`) REFERENCES `kegiatan` (`kode_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_pengajuan`
--
ALTER TABLE `item_pengajuan`
  ADD CONSTRAINT `item_pengajuan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pengajuan_ibfk_2` FOREIGN KEY (`kode_pengajuan`) REFERENCES `pengajuan` (`kode_pengajuan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pengajuan_ibfk_3` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kegiatan_ibfk_2` FOREIGN KEY (`kode_jenis_kegiatan`) REFERENCES `jenis_kegiatan` (`kode_jenis_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`kode_unit`) REFERENCES `unit` (`kode_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_ibfk_2` FOREIGN KEY (`kode_jabatan`) REFERENCES `jabatan` (`kode_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengguna_ibfk_3` FOREIGN KEY (`no_identitas`) REFERENCES `data_diri` (`no_identitas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`kode_nama_progress`) REFERENCES `nama_progress` (`kode_nama_progress`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
