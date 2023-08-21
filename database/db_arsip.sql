-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 01:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `gup`
--

CREATE TABLE `gup` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `no_spm` int(11) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `box` int(11) NOT NULL,
  `file_gup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gup`
--

INSERT INTO `gup` (`id`, `user_id`, `no_spm`, `uraian`, `tanggal`, `box`, `file_gup`) VALUES
(1, 1, 65345, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-01-12', 3, 'gup-1691158815.pdf'),
(2, 1, 36253, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-02-08', 3, 'gup-1691158864.pdf'),
(3, 1, 63452, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-03-09', 4, 'gup-1691158876.pdf'),
(4, 1, 46246, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-04-13', 4, 'gup-1691158888.pdf'),
(5, 1, 46346, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-05-18', 6, 'gup-1691158901.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `lumpsum`
--

CREATE TABLE `lumpsum` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `no_spm` int(11) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `box` int(11) NOT NULL,
  `file_lumpsum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lumpsum`
--

INSERT INTO `lumpsum` (`id`, `user_id`, `no_spm`, `uraian`, `tanggal`, `box`, `file_lumpsum`) VALUES
(1, 1, 12342, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-08-21', 4, 'lumpsum-1691157739.pdf'),
(2, 1, 65345, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?\r\n', '2023-02-15', 3, 'lumpsum-1691157958.pdf'),
(3, 1, 54243, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-08-26', 1, 'lumpsum-1691158117.pdf'),
(4, 1, 54375, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-03-16', 2, 'lumpsum-1691158238.pdf'),
(5, 1, 24563, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-05-25', 1, 'lumpsum-1691158384.pdf'),
(6, 1, 65354, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga adipisci dolorem hic voluptatibus provident similique accusamus aspernatur impedit! Vero totam natus consectetur alias enim dolor quod fugit cum voluptates quos?', '2023-07-13', 2, 'lumpsum-1691158410.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-06-08-131303', 'App\\Database\\Migrations\\Users', 'default', 'App', 1690863690, 1),
(2, '2023-08-01-034927', 'App\\Database\\Migrations\\Lumpsum', 'default', 'App', 1690863691, 1),
(3, '2023-08-01-034939', 'App\\Database\\Migrations\\Gup', 'default', 'App', 1690863691, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nip`, `username`, `email`, `password`, `role`, `image`) VALUES
(1, 'John Dae Update', 19753050, 'admin', 'admin@gmail.com', '$2y$10$VjAjO.PSw85Wh4aEE47n8.g/s8rclL9VROz9WcGFYSWb4roCzU4g2', 'admin', 'user-1691165536.jpg'),
(2, 'Dewi Kurnia', 19753051, 'user', 'user@gmail.com', '$2y$10$IQWfHb2it5RewQpeu6kt8.eTUFJ7upZVTfQWplM9o0U7uXgf4umyO', 'user', 'user-1691157640.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gup`
--
ALTER TABLE `gup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lumpsum`
--
ALTER TABLE `lumpsum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gup`
--
ALTER TABLE `gup`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lumpsum`
--
ALTER TABLE `lumpsum`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
