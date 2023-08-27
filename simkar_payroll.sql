-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 04:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simkar_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_jabatan`
--

CREATE TABLE `access_jabatan` (
  `id` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_user_sub_menu` int(11) NOT NULL,
  `access_read` int(11) NOT NULL,
  `access_create` int(11) NOT NULL,
  `access_update` int(11) NOT NULL,
  `access_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `access_jabatan`
--

INSERT INTO `access_jabatan` (`id`, `id_jabatan`, `id_user_sub_menu`, `access_read`, `access_create`, `access_update`, `access_delete`) VALUES
(10, 2, 3, 0, 1, 1, 1),
(11, 2, 15, 1, 1, 1, 1),
(12, 2, 18, 1, 1, 1, 1),
(13, 2, 19, 1, 1, 1, 1),
(14, 2, 32, 1, 1, 1, 1),
(15, 2, 34, 1, 1, 1, 1),
(16, 2, 42, 1, 1, 1, 1),
(17, 3, 3, 1, 0, 1, 0),
(18, 3, 15, 1, 1, 1, 1),
(19, 3, 18, 0, 0, 0, 0),
(20, 3, 19, 0, 0, 0, 0),
(21, 3, 32, 1, 0, 0, 0),
(22, 3, 42, 1, 0, 0, 0),
(23, 3, 17, 0, 0, 0, 0),
(24, 8, 5, 0, 0, 0, 0),
(25, 8, 6, 0, 0, 0, 0),
(26, 8, 17, 0, 0, 0, 0),
(27, 8, 20, 0, 0, 0, 0),
(28, 8, 21, 0, 0, 0, 0),
(29, 8, 22, 0, 0, 0, 0),
(30, 8, 25, 0, 0, 0, 0),
(31, 8, 30, 0, 0, 0, 0),
(32, 8, 33, 0, 0, 0, 0),
(33, 8, 35, 0, 0, 0, 0),
(34, 8, 15, 1, 1, 1, 1),
(35, 8, 18, 1, 1, 1, 1),
(36, 8, 19, 1, 1, 1, 1),
(37, 8, 23, 0, 0, 0, 0),
(38, 8, 32, 1, 0, 0, 0),
(39, 8, 38, 0, 0, 0, 0),
(40, 8, 13, 0, 0, 0, 0),
(41, 8, 1, 0, 0, 1, 1),
(42, 8, 42, 1, 1, 1, 1),
(43, 8, 34, 1, 1, 1, 1),
(44, 2, 38, 1, 1, 1, 1),
(45, 2, 35, 1, 1, 1, 1),
(46, 2, 33, 1, 1, 1, 1),
(47, 2, 30, 1, 1, 1, 1),
(48, 2, 25, 1, 1, 1, 1),
(49, 2, 23, 1, 1, 1, 1),
(50, 2, 22, 1, 1, 1, 1),
(51, 2, 21, 1, 1, 1, 1),
(52, 2, 20, 1, 1, 1, 1),
(53, 2, 17, 1, 1, 1, 1),
(54, 2, 13, 1, 1, 1, 1),
(55, 2, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_gaji_homebase`
--

CREATE TABLE `t_gaji_homebase` (
  `id` int(11) NOT NULL,
  `nidn` text NOT NULL,
  `no_rekening` varchar(32) NOT NULL,
  `periode` date NOT NULL,
  `nama_dosen` varchar(64) NOT NULL,
  `tempat_lahir` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pendidikan` varchar(12) NOT NULL,
  `tmt` date NOT NULL,
  `tahun_kerja` varchar(4) NOT NULL,
  `program_studi` varchar(16) NOT NULL,
  `jabatan` varchar(16) NOT NULL,
  `jabatan_fungsional` varchar(16) NOT NULL,
  `status_dosen` int(11) NOT NULL,
  `golongan` text NOT NULL,
  `gaji_pokok` decimal(9,2) NOT NULL,
  `t_jabatan_fungsional` decimal(9,2) NOT NULL,
  `t_pendidikan_s3` decimal(9,2) NOT NULL,
  `transport_makan` decimal(9,2) NOT NULL,
  `t_jabatan_struktural` decimal(9,2) NOT NULL,
  `insentif` decimal(9,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_gaji_tendik`
--

CREATE TABLE `t_gaji_tendik` (
  `id` int(11) NOT NULL,
  `nip` varchar(12) NOT NULL,
  `nama_karyawan` varchar(64) NOT NULL,
  `golongan` varchar(16) NOT NULL,
  `gaji_pokok` decimal(11,2) NOT NULL,
  `t_jabatan_fungsional` decimal(11,2) NOT NULL,
  `t_pendidikan_s3` decimal(11,2) NOT NULL,
  `transport_makan` decimal(11,2) NOT NULL,
  `t_jabatan_struktural` decimal(11,2) NOT NULL,
  `t_jabatan_rangkap` decimal(11,2) NOT NULL,
  `bpjs_yayasan_ketnaker` decimal(3,2) NOT NULL,
  `bpjs_yayasan_kesehatan` decimal(3,2) NOT NULL,
  `bpjs_pribadi_ketnaker` decimal(3,2) NOT NULL,
  `bpjs_pribadi_kesehatan` decimal(3,2) NOT NULL,
  `transisi` decimal(11,2) NOT NULL,
  `status` int(1) NOT NULL,
  `pinjaman` decimal(11,2) NOT NULL,
  `periode` date DEFAULT NULL,
  `tanggal_submit` datetime DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_gaji_tendik`
--

INSERT INTO `t_gaji_tendik` (`id`, `nip`, `nama_karyawan`, `golongan`, `gaji_pokok`, `t_jabatan_fungsional`, `t_pendidikan_s3`, `transport_makan`, `t_jabatan_struktural`, `t_jabatan_rangkap`, `bpjs_yayasan_ketnaker`, `bpjs_yayasan_kesehatan`, `bpjs_pribadi_ketnaker`, `bpjs_pribadi_kesehatan`, `transisi`, `status`, `pinjaman`, `periode`, `tanggal_submit`, `tanggal_transaksi`, `keterangan`) VALUES
(1, '411119036', '', '', 4500000.00, 500000.00, 0.00, 500000.00, 0.00, 0.00, 0.00, 2.00, 1.00, 1.20, 0.00, 0, 100000.00, '2023-06-18', NULL, NULL, NULL),
(2, '41111111', '', '', 2400000.00, 500000.00, 0.00, 0.00, 0.00, 0.00, 2.00, 1.00, 0.50, 0.00, 0.00, 0, 0.00, '2023-06-28', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `tmpt_lahir` varchar(128) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(128) DEFAULT NULL,
  `agama` varchar(128) DEFAULT NULL,
  `status_pernikahan` varchar(128) DEFAULT NULL,
  `nik_ktp` bigint(16) DEFAULT NULL,
  `nik_karyawan` bigint(13) DEFAULT NULL,
  `nama_bank` varchar(128) DEFAULT NULL,
  `no_rek` bigint(16) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `email_undira` varchar(128) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `nama_darurat` varchar(128) DEFAULT NULL,
  `telp_darurat` varchar(12) DEFAULT NULL,
  `no_bpjs_kesehatan` bigint(13) DEFAULT NULL,
  `no_bpjs_ketenagakerjaan` bigint(11) DEFAULT NULL,
  `jenis_pegawai` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `tgl_bergabung` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `approval` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `jabatan_id`, `address`, `tmpt_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `status_pernikahan`, `nik_ktp`, `nik_karyawan`, `nama_bank`, `no_rek`, `npwp`, `email`, `email_undira`, `telp`, `nama_darurat`, `telp_darurat`, `no_bpjs_kesehatan`, `no_bpjs_ketenagakerjaan`, `jenis_pegawai`, `image`, `password`, `role_id`, `is_active`, `tgl_bergabung`, `created_at`, `approval`) VALUES
(1, 'Hengky Darmawan', 1, 'Jakarta Barat, Indonesia', 'Pontianak', '2001-02-22', 'Pria', 'Buddha', 'Singel', 3174092505520003, 1100000000011, 'BCA', 1234567891123, '12.345.678.9-101.012', 'hengky@gmail.com', 'hengkydarmawan66@gmail.com', '082186629996', 'Ani', '082196629997', 12345671111, 123456789, 'tendik', 'default.png', '$2y$10$N5bHf8.9YGi9IZjg0i2qCOePlknbmuhr7GHzATV3v4bsIpsUDm7KW', 1, 1, '2022-12-13', '2021-11-02', 'approved'),
(69, 'Hengky Admins', 2, 'Jakarta', 'Paris', '2023-06-01', 'Perempuan', 'Hindu', 'belum menikah', 6101042202010002, 3214113, 'BCA', 1221444111, '12.345.678.9-101.017', 'hengkycross172@gmail.com', 'hengkycross172@gmail.com', '089659172256', 'Eko', '085117522255', 123456722, 123456733, NULL, 'default.png', '$2y$10$YPN9CfOXfnhaCcO0SIKeoO0cQdOa.GEJbPmL5kH.vDozZ4AJsFiFW', 2, 1, '2023-06-02', NULL, 'approved'),
(70, 'Hengky Stafs', 1, 'jakarta', 'Jepang', '2023-06-01', 'Perempuan', 'Buddha', 'nikah', 61516444413211, 6151644, 'BCA', 615564641, '12.345.678.9-101.014', 'hengkydarmawan52@gmail.com', 'hengkydarmawan52@gmail.com', '0858815141', 'ada', '0812116163', 123456724, 123456724, NULL, 'default.png', '$2y$10$MbMeJkJH47kWj0nFgpTeeOHKAZZ4FF7q4opokbgHtz1J5f6Rdh8au', 3, 1, '2023-06-22', NULL, 'approved'),
(71, 'Riko (SP)', 1, 'Bandung', 'Bandung', '1999-04-07', 'pria', 'Islam', 'belum menikah', 6101042202010002, 411119036, 'BCA', 1221444111, '12.345.678.9-101.020', 'rikorinaldiansyah26@gmail.com', 'rikorinaldiansyah26@gmail.com', '089659115555', 'tes', '085117522254', 123456722, 1234567, NULL, 'default.png', '$2y$10$XRV9Hx3Y.uhQdpsocTpsgOzlZnqEsbngDkQxcX34D1bHIXKW/Ee6i', 1, 1, '2023-06-05', NULL, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`, `sub_menu_id`) VALUES
(1, 1, 1, 1),
(23, 2, 17, 1),
(25, 3, 17, 1),
(29, 3, 18, 1),
(33, 1, 17, 1),
(38, 1, 20, 1),
(42, 2, 21, 1),
(45, 3, 6, 1),
(67, 2, 2, 0),
(71, 2, 6, 0),
(73, 2, 12, 0),
(75, 2, 18, 0),
(77, 2, 23, 0),
(83, 3, 7, 0),
(87, 3, 2, 0),
(90, 2, 7, 0),
(93, 1, 4, 0),
(94, 1, 24, 0),
(96, 1, 25, 0),
(97, 1, 26, 0),
(102, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_jabatan`
--

CREATE TABLE `user_jabatan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_jabatan`
--

INSERT INTO `user_jabatan` (`id`, `user_id`, `jabatan_id`, `role_id`) VALUES
(1, 7, 3, 1),
(2, 7, 5, 3),
(3, 68, 7, 0),
(4, 68, 9, 0),
(7, 1, 1, 1),
(8, 1, 7, 3),
(16, 70, 1, 1),
(17, 70, 7, 3),
(18, 69, 2, 1),
(19, 69, 7, 3),
(20, 71, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Staf'),
(3, 'User'),
(4, 'Menu'),
(5, 'Laporan'),
(6, 'Absensi'),
(7, 'Gaji'),
(12, 'Master Data'),
(16, 'Sertifikat'),
(18, 'Setting'),
(23, 'Access'),
(24, 'Payroll'),
(26, 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'User'),
(4, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Dashboard', 'staf', 'fas fa-fw fa-tachometer-alt', 1),
(3, 3, 'Dashboard', 'user', 'fas fa-fw fa-tachometer-alt', 1),
(5, 4, 'Menu Management', 'menu', 'far fa-fw fa-folder', 1),
(6, 4, 'Sub Menu Management', 'menu/submenu', 'far fa-fw fa-folder-open', 1),
(13, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-lock', 1),
(15, 18, 'My Profile', 'setting', 'fas fa-fw fa-users-cog', 1),
(17, 12, 'Data Pegawai', 'pegawai', 'fas fa-fw fa-user-tie', 1),
(18, 18, 'Edit Profile', 'setting/edit', 'fas fa-fw fa-user-edit', 1),
(19, 18, 'Change Password', 'setting/changepassword', 'fas fa-fw fa-user-lock', 1),
(20, 12, 'Data Keluarga Pegawai', 'keluarga', 'fas fa-fw fa-house-user', 1),
(21, 12, 'Data Posisi Jabatan', 'jabatan', 'fas fa-fw fa-briefcase', 1),
(22, 12, 'Data Pendidikan', 'pendidikan', 'fas fa-fw fa-graduation-cap', 1),
(23, 12, 'Data Pelatihan', 'pelatihan', 'fas fa-fw fa-chalkboard-teacher', 1),
(25, 12, 'Data Seminar', 'seminar', 'fas fa-fw fa-laptop', 1),
(30, 12, 'Data Pengalaman', 'pengalaman', 'fas fa-fw fa-laptop-house', 1),
(32, 7, 'Slip Gaji', 'gaji/slip', 'fas fa-fw fa-wallet', 1),
(33, 12, 'Data Libur', 'libur', 'fas fa-fw fa-calendar-week', 1),
(34, 6, 'Rekap Absen', 'absensi', 'fas fa-fw fa-user-check', 1),
(35, 12, 'Data Staf', 'staf/pegawai', 'fas fa-fw fa-users', 0),
(38, 1, 'Approval User', 'approval', 'fas fa-fw fa-user-check', 0),
(42, 23, 'Access Menu', 'access', 'fas fa-fw fa-users', 1),
(44, 24, 'Gaji Tendik', 'tendik', 'fas fa-fw fa-user-tag', 1),
(45, 24, 'Gaji Dosen Homebase', 'homebase', 'fas fa-users', 1),
(46, 24, 'Gaji Dosen Kontrak', 'tes', 'fas fa-user-edit', 0),
(47, 26, 'Data Pinjaman', 'tes', 'fas fa-fw fa-paper-plane', 1),
(48, 1, 'Approval Gaji', 'approve', 'fas fa-fw fa-tasks', 1),
(49, 26, 'Slip Gaji Tendik', 'tes', 'fas fa-scroll', 1),
(50, 26, 'Slip Gaji Dosen Homebase', 'tes', 'fas fa-sticky-note', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_jabatan`
--
ALTER TABLE `access_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_gaji_homebase`
--
ALTER TABLE `t_gaji_homebase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_gaji_tendik`
--
ALTER TABLE `t_gaji_tendik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_jabatan`
--
ALTER TABLE `user_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_jabatan`
--
ALTER TABLE `access_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `t_gaji_homebase`
--
ALTER TABLE `t_gaji_homebase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_gaji_tendik`
--
ALTER TABLE `t_gaji_tendik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `user_jabatan`
--
ALTER TABLE `user_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
