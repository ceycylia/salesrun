-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Mar 2025 pada 04.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsdm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `actual`
--

CREATE TABLE `actual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_fso` bigint(20) NOT NULL,
  `visitpipeline_id` bigint(20) UNSIGNED NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `acc_number` bigint(20) NOT NULL,
  `actual` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `month` int(11) GENERATED ALWAYS AS (month(`timestamp`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `actual`
--

INSERT INTO `actual` (`id`, `id_fso`, `visitpipeline_id`, `branch_code`, `product_id`, `acc_number`, `actual`, `timestamp`) VALUES
(2, 0, 3, '2020', 2, 1020202, 2000000, '2025-03-26 02:02:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'email_password', 'cey@gmail.com', NULL, '2025-03-04 01:31:04', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `closing_pipelines`
--

CREATE TABLE `closing_pipelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pipeline_id` bigint(20) UNSIGNED NOT NULL,
  `pipeline_product` varchar(255) NOT NULL,
  `actual` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1741023703, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1741023703, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1741023703, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pipelines`
--

CREATE TABLE `pipelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `potential` bigint(20) UNSIGNED NOT NULL,
  `address` longtext NOT NULL,
  `address_note` varchar(50) DEFAULT NULL,
  `job` varchar(255) NOT NULL,
  `exiting_pipelines` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pipelines`
--

INSERT INTO `pipelines` (`id`, `uuid`, `name`, `potential`, `address`, `address_note`, `job`, `exiting_pipelines`) VALUES
(2, '550e8400-e29b-41d4-a716-446655440002', 'Pipeline B', 200000, 'Jl. Sudirman No. 53, polonia, medan kota, medan', 'kantor B', 'Pensiunan', 1),
(3, '550e8400-e29b-41d4-a716-446655440003', 'Pipeline C', 150000, 'Jl. Diponegoro No. 10', 'Sebelah sekolah', 'Manager', 1),
(5, '550e8400-e29b-41d4-a716-446655440005', 'Pipeline E', 120000, 'Jl. Ahmad Yani No. 20', 'Samping SPBU', 'Analyst', 1),
(7, '550e8400-e29b-41d4-a716-446655440007', 'Pipeline G', 300000, 'Jl. MH Thamrin No. 25', 'Dekat taman', 'Consultant', 1),
(20, '', 'pipeline saya', 300000, 'jalan jalan kita, medan selayang, medan johor, medan', 'rumah', 'BUMN', 1),
(21, '', 'pipeline 19', 10000000, 'jalan pijer podi, kwala bekala, medan johor, kota medan', 'rumah', 'Pekerja Industri Kreatif', 1),
(22, '', 'Yanto', 10000000, 'sun plaza, bonjol, polonia, medan', 'mall', 'Guru/Dosen', 0),
(23, '', 'ceycylia dear', 1000000000, 'kantor cabang bank sumut , kwala bekala, medan johor, medan', 'kantor saya', 'Mahasiswa', 1),
(25, '', 'ceycilia dear', 20000000, 'jalan imam bonjol, polonia, medan kota, medan', 'kantor ', 'BUMD', 1),
(27, '', 'Ceycylia Dear Amizafatel ', 200000, 'jalan pijer podi, kwala bekala, medan johor, medan', 'rumah', 'Freelancer', 0),
(28, '', 'pak eko', 50000000, 'flamboyan, medan baru, medan johor, medan', 'rumah pipeline', 'Freelancer', 0),
(29, '', 'pak eko', 50000000, 'flamboyan, medan baru, medan johor, medan', 'rumah pipeline', 'Supir', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `timeline` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `id_product`, `name`, `description`, `timeline`, `created_by`, `status`) VALUES
(2, 'PROD-000001', 'tabungan', 'ini tabungan', '2025-03-20 08:20:29', NULL, 1),
(3, 'PROD-000002', 'giro', 'ini giro', '2025-03-20 08:20:48', NULL, 1),
(9, '', '22', '222', '2025-03-20 06:21:49', NULL, 1),
(10, '', '22', '222', '2025-03-20 06:22:11', NULL, 1),
(11, '', 'Investasi ', 'investasi Emas', '2025-03-20 06:24:09', NULL, 1),
(12, '33', '3333', '33', '2025-03-21 02:23:18', NULL, 1),
(13, 'PROD-02', 'tabungan emas', 'ini adalah tabungan emas', '2025-03-23 18:32:03', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(9) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `target`
--

CREATE TABLE `target` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_fso` varchar(255) NOT NULL,
  `target` bigint(20) NOT NULL,
  `month` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `target`
--

INSERT INTO `target` (`id`, `id_fso`, `target`, `month`, `timestamp`) VALUES
(1, '0', 300000000, 'januari', '0000-00-00 00:00:00'),
(2, '2', 10000000, 'maret', '2025-03-27 02:03:05'),
(3, '', 200000000, 'april', '2025-03-27 02:10:09'),
(4, '22', 999999999, 'februari', '2025-03-27 02:13:11'),
(5, '123', 123, '123', '2025-03-27 02:14:46'),
(6, '122', 122, '122', '2025-03-27 02:15:55'),
(7, '1123', 12123, '12313', '2025-03-27 02:17:38'),
(8, '1123', 12123, '12313', '2025-03-27 02:18:56'),
(9, '99', 99, '99', '2025-03-27 02:19:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `visit_pipelines`
--

CREATE TABLE `visit_pipelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pipeline_id` bigint(20) UNSIGNED NOT NULL,
  `date_visit` datetime NOT NULL,
  `location_visit` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prospect_visit` bigint(20) NOT NULL,
  `closing_plan` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `coment` varchar(255) NOT NULL,
  `status_closing` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visit_pipelines`
--

INSERT INTO `visit_pipelines` (`id`, `pipeline_id`, `date_visit`, `location_visit`, `product_id`, `prospect_visit`, `closing_plan`, `status`, `coment`, `status_closing`) VALUES
(3, 2, '2025-03-20 00:00:00', 'Singapura', 2, 150000, '2025-03-21 00:00:00', 'warm', 'ha', 1),
(4, 3, '2025-03-20 00:00:00', 'Singapura', 11, 500000, '2025-03-22 00:00:00', 'warm', '', 0),
(7, 20, '2025-12-21 00:00:00', 'jalan jalan kita, medan selayang, medan johor, medan', 2, 200000, '2025-12-21 00:00:00', 'cold', 'bagus bgt', 0),
(8, 23, '2025-03-14 00:00:00', 'indomaret depan kantor cabang kwala bekala', 2, 10000000000, '2025-03-14 00:00:00', 'hot ', 'aduh dia banyak bgt duitnya', 0),
(10, 7, '2025-03-14 00:00:00', 'Jl. MH Thamrin No. 25', 2, 1000000, '2025-03-14 00:00:00', 'warm', 'clientnya kurang oke', 0),
(11, 5, '2025-03-14 00:00:00', 'Jl. Ahmad Yani No. 20', 2, 20000, '2025-03-14 00:00:00', 'warm', 'kurang oke', 1),
(12, 25, '2025-03-18 00:00:00', 'jalan imam bonjol, polonia, medan kota, medan', 2, 4000000, '2025-03-18 00:00:00', 'warm', 'ganti jadi text', 1),
(13, 7, '2025-03-20 00:00:00', 'jalan jalan kita, medan selayang, medan johor, medan', 2, 20000, '2025-03-21 00:00:00', 'warm', 'hhoslsls', 0),
(14, 22, '2020-02-20 00:00:00', 'ee', 2, 333, '2020-02-20 00:00:00', 'warm', '33', 0),
(15, 22, '2020-02-20 00:00:00', '22', 2, 22, '2020-02-20 00:00:00', 'hot', 'dd', 0),
(16, 7, '2020-02-20 00:00:00', 'Jl. MH Thamrin No. 25', NULL, 1000000, '2020-02-20 00:00:00', 'hot', 'eeee', 1),
(17, 22, '2025-02-22 00:00:00', 'yaya', 3, 20000, '2025-02-22 00:00:00', 'warm', 'fff', 1),
(18, 27, '2025-03-22 00:00:00', 'jalan pijer podi, kwala bekala, medan johor, medan', 11, 200000, '2025-03-15 00:00:00', 'warm', 'baik', 1),
(19, 27, '2025-03-22 00:00:00', 'jalan pijer podi, kwala bekala, medan johor, medan', 11, 200000, '2025-03-15 00:00:00', 'warm', 'baik', 0),
(20, 28, '2025-03-26 00:00:00', 'usu', 2, 50000000, '2025-03-28 00:00:00', 'hot', 'banyak tanya ', 1),
(21, 27, '2025-03-27 00:00:00', 'usu', 13, 50000000, '2025-03-28 00:00:00', 'warm', 'bagus', 1),
(22, 27, '2025-03-27 00:00:00', 'usu', 13, 50000000, '2025-03-28 00:00:00', 'warm', 'bagus', 1),
(23, 27, '2025-03-27 00:00:00', 'ususd', 13, 50000000, '2025-03-28 00:00:00', 'warm', 'bagus', 0),
(24, 27, '2025-03-27 00:00:00', 'ususd', 13, 50000000, '2025-03-28 00:00:00', 'warm', 'baguss', 1),
(25, 28, '2025-03-27 00:00:00', 'disana', 3, 50000000000, '2025-03-28 00:00:00', 'hot', 'gajelas', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `actual`
--
ALTER TABLE `actual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_actual_visit` (`visitpipeline_id`),
  ADD KEY `fk_actual_product` (`product_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `closing_pipelines`
--
ALTER TABLE `closing_pipelines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pipelines`
--
ALTER TABLE `pipelines`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_users_user_id_foreign` (`created_by`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `visit_pipelines`
--
ALTER TABLE `visit_pipelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_pipeline` (`pipeline_id`),
  ADD KEY `visit_pipeline_product_id` (`product_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `actual`
--
ALTER TABLE `actual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `closing_pipelines`
--
ALTER TABLE `closing_pipelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pipelines`
--
ALTER TABLE `pipelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `target`
--
ALTER TABLE `target`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `visit_pipelines`
--
ALTER TABLE `visit_pipelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `actual`
--
ALTER TABLE `actual`
  ADD CONSTRAINT `fk_actual_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_actual_visit` FOREIGN KEY (`visitpipeline_id`) REFERENCES `visit_pipelines` (`id`);

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_users_user_id_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `visit_pipelines`
--
ALTER TABLE `visit_pipelines`
  ADD CONSTRAINT `visit_pipeline_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
