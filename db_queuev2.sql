-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Sep 2024 pada 06.33
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
-- Database: `db_queuev2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Kategori data', 'lorem ipsum is amet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merchants`
--

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `location`, `category`, `created_at`) VALUES
(1, 'Merchant ABC', 'Jl. Sudirman No. 45', 'Retail', '2024-09-24 11:20:46'),
(2, 'Merchant DFG', 'Jl. Aceh No. 01', 'Retail', '2024-09-24 11:21:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `merchant_categories`
--

CREATE TABLE `merchant_categories` (
  `merchant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `queue_number` int(11) NOT NULL,
  `queue_status` enum('waiting','processing','completed') DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `queues`
--

INSERT INTO `queues` (`id`, `user_id`, `merchant_id`, `service_id`, `queue_number`, `queue_status`, `created_at`) VALUES
(1, 4, 1, 1, 1, 'waiting', '2024-09-26 21:23:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `merchant_id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 1, 'Cuci Mobil', 'Layanan cuci mobil standar', 50000.00, '2024-09-24 11:21:11'),
(2, 1, 'Cuci Motor', 'Layanan cuci motor matic', 20000.00, '2024-09-24 11:21:33'),
(3, 2, 'Service HP', 'Layanan benerin hp', 500000.00, '2024-09-24 11:22:04'),
(4, 2, 'Service Laptop', 'Layanan benerin laptop', 800000.00, '2024-09-24 11:22:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `role` varchar(60) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `auth_token`, `created_at`, `role`, `create_time`, `update_time`, `status`) VALUES
(3, 'dadan', 'dadan@gmail.com', '$2y$13$P2ke2c/l/Mq5IlPh8r30vuQwwGouqiKL9lHQVNDmiclCIdaaAIsGW', NULL, '2024-09-26 15:48:27', 'customer', '2024-09-26 17:48:27', '2024-09-26 17:48:27', '10'),
(4, 'dika', 'dika@gmail.com', '$2y$13$63oUn/7zP02kqGFccfwpveArMobLZs6oUlbdqZT0X6oKwbYOuQEkS', NULL, '2024-09-27 00:40:54', 'customer', '2024-09-27 02:40:54', '2024-09-27 02:40:54', '10'),
(5, 'admin', 'admin@gmail.com', '$2y$13$pR2evSfZwj5T7R5mSIJZ.O0Q5E9M1FCVyEgvZa2wYut19TlCB73Ia', NULL, '2024-09-27 04:29:14', 'admin', '2024-09-27 06:29:14', '2024-09-27 06:29:14', '10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `merchant_categories`
--
ALTER TABLE `merchant_categories`
  ADD PRIMARY KEY (`merchant_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `merchant_id` (`merchant_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_id` (`merchant_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `merchant_categories`
--
ALTER TABLE `merchant_categories`
  ADD CONSTRAINT `merchant_categories_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `merchant_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `queues_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `queues_ibfk_2` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `queues_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
