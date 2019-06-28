-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Apr 2019 pada 03.22
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `kd_buku` varchar(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isbn` varchar(11) NOT NULL,
  `pengarang` varchar(200) NOT NULL,
  `halaman` int(11) NOT NULL,
  `th_terbit` date NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sinopsis` text NOT NULL,
  `kd_penerbit` varchar(5) NOT NULL,
  `kd_kategori` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`kd_buku`, `judul`, `isbn`, `pengarang`, `halaman`, `th_terbit`, `gambar`, `jumlah`, `sinopsis`, `kd_penerbit`, `kd_kategori`) VALUES
('B0001', 'Matematika 1', '2323232324', 'Supartono', 250, '2019-04-16', '', 20, 'Hello world', 'P01', 'K02'),
('B0002', 'Bahasa Indonesia 1', '343434333', 'Agus Mahendra', 300, '2019-04-23', '', 25, 'Yes hello', 'P02', 'K03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` varchar(11) NOT NULL,
  `nm_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
('K01', 'Agama'),
('K02', 'Matematika'),
('K03', 'Bahasa Indonesia'),
('K04', 'Bahasa Indonesia'),
('K05', 'Biologi'),
('K06', 'Sejarah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_pinjam` varchar(6) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `kd_siswa` varchar(5) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lama_pinjam` int(2) NOT NULL,
  `status` enum('Pinjam','Kembali') NOT NULL,
  `kd_user` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`no_pinjam`, `tgl_pinjam`, `kd_siswa`, `keterangan`, `lama_pinjam`, `status`, `kd_user`) VALUES
('PJ0001', '2019-04-16', 'S0002', 'Pinjam', 1, 'Kembali', ''),
('PJ0002', '2019-04-09', 'S0002', 'Pinjam', 3, 'Kembali', ''),
('PJ0003', '2019-04-10', 'S0001', 'Pinjam', 4, 'Pinjam', ''),
('PJ0004', '2019-04-10', 'S0004', 'Pinjam', 2, 'Kembali', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_detil`
--

CREATE TABLE `peminjaman_detil` (
  `no_pinjam` varchar(6) NOT NULL,
  `kd_buku` char(5) NOT NULL,
  `jumlah_bk` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman_detil`
--

INSERT INTO `peminjaman_detil` (`no_pinjam`, `kd_buku`, `jumlah_bk`) VALUES
('PJ0001', 'B0002', 25),
('PJ0002', 'B0002', 25),
('PJ0003', 'B0001', 20),
('PJ0004', 'B0002', 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `kd_penerbit` varchar(11) NOT NULL,
  `nm_penerbit` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`kd_penerbit`, `nm_penerbit`) VALUES
('K01', 'Erlangga'),
('K02', 'Kanisius'),
('P03', 'Karyabuku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan`
--

CREATE TABLE `pengadaan` (
  `no_pengadaan` char(5) NOT NULL,
  `tgl_pengadaan` date DEFAULT NULL,
  `kd_buku` char(5) DEFAULT NULL,
  `asal_buku` varchar(100) DEFAULT NULL,
  `jumlah` int(2) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengadaan`
--

INSERT INTO `pengadaan` (`no_pengadaan`, `tgl_pengadaan`, `kd_buku`, `asal_buku`, `jumlah`, `keterangan`) VALUES
('PB001', '2019-04-01', 'B0001', 'Guru', 23, 'Permanen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `no_kembali` char(6) NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `no_pinjam` char(6) DEFAULT NULL,
  `denda` int(12) DEFAULT NULL,
  `kd_siswa` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`no_kembali`, `tgl_kembali`, `no_pinjam`, `denda`, `kd_siswa`) VALUES
('KB0001', '2019-04-09', 'PJ0001', 2000, 'S0001'),
('KB0002', '2019-04-09', 'PJ0002', 9000, 'S0001'),
('KB0003', '2019-04-23', 'PJ0004', 9000, 'S0004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `kd_user` char(3) NOT NULL,
  `nm_user` varchar(100) DEFAULT NULL,
  `username` char(20) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`kd_user`, `nm_user`, `username`, `password`, `role`, `gambar`) VALUES
('U01', 'Bunafit Nugroho', 'admin', '21232f297a57a5a743894a0e4a801fc3', '3', 'default.jpg'),
('U02', 'Fitria Prasetia', 'fitria', 'ac43724f16e9241d990427ab7c8f4228', '3', 'default.jpg'),
('U03', 'Super Admin', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '1', 'default.jpg'),
('U04', 'kepalasekolah', 'kepsek', '8561863b55faf85b9ad67c52b3b851ac', '2', 'default.jpg'),
('U05', 'Pak Budiman', 'budiman66', 'e02b43a54cc891418113277af08cf2f1', '2', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `kd_role` int(11) NOT NULL,
  `nm_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`kd_role`, `nm_role`) VALUES
(1, 'super_admin'),
(2, 'kepala_sekolah'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `kd_siswa` char(5) NOT NULL,
  `nm_siswa` varchar(100) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `kelamin` char(1) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`kd_siswa`, `nm_siswa`, `nisn`, `kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `foto`) VALUES
('S0001', 'Sardi Sudrajad', '150001', 'L', 'Islam', 'Way Jepara, Lampung TImur', '2019-04-09', 'Jl. Suhada, Margayu, Desa. Lab Ratu Baru, Way Jepara, Lampung Timur', '08192223345', 'aleksandra-boguslaws'),
('S0002', 'Septi Suhesti', '150002', 'P', 'Islam', 'Way Jepara', '2019-01-16', 'Jl. Margahayu, Labuhan Ratu Baru, Kec. Way Jepara, Lampung Timur', '0819222343', '1.JPG'),
('S0003', 'Mohammad Sulthan', '1522292', 'L', 'Islam', 'Jakarta', '2019-04-08', 'Dusum', '082166962208', '1.JPG'),
('S0004', 'Abdul Rahman', '765765', 'L', 'Islam', 'Palembang', '2019-04-23', 'Dusun Timur', '082166962208', '1.JPG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_pinjam`
--

CREATE TABLE `tmp_pinjam` (
  `id` int(3) NOT NULL,
  `kd_buku` char(5) DEFAULT NULL,
  `jumlah` int(2) DEFAULT NULL,
  `kd_user` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kd_buku`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no_pinjam`);

--
-- Indeks untuk tabel `peminjaman_detil`
--
ALTER TABLE `peminjaman_detil`
  ADD PRIMARY KEY (`no_pinjam`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`kd_penerbit`);

--
-- Indeks untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`no_pengadaan`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`no_kembali`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kd_user`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`kd_role`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kd_siswa`);

--
-- Indeks untuk tabel `tmp_pinjam`
--
ALTER TABLE `tmp_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tmp_pinjam`
--
ALTER TABLE `tmp_pinjam`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
