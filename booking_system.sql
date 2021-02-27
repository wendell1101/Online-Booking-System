-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2021 at 03:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(163, 'drinks', 'drinks'),
(165, 'pastries', 'pastries'),
(170, 'desserts', 'desserts');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `image`, `price`, `description`, `category_id`) VALUES
(30, 'Cappucino', 'cappucino', '1614254109_cappucino.png', 140, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi                                                                                                                                     ', 163),
(31, 'Espresso', 'espresso', '1613013845_espresso.png', 100, '                                        lorem dolor sir amet                                                     ', 163),
(32, 'Americano', 'americano', '1613013853_americano.png', 130, '                                                            lorem impsum dolor sir amet                                                                         ', 163),
(33, 'Affogato', 'affogato', '1613013863_affogato.png', 180, '                    lorem ipsum dolor sir amet                    ', 163),
(34, 'White Choco Mocha', 'white-choco-mocha', '1613013880_iced coffee.png', 165, '                    lorem impsum dolor sir amet                    ', 163),
(35, 'Caramel Macchiato', 'caramel-macchiato', '1614168780_caramel macchiato.png', 165, '                                                                                lorem ipsum dolor sir amet                                                                                ', 163),
(36, 'Iced Caffe Latte', 'iced-caffe-latte', '1613013924_iced caffe latte.png', 140, '                    lorem impsum dolor sir amet                    ', 163),
(37, 'Croissant', 'croissant', '1613014000_croissant.png', 50, '                                                                                ', 165),
(38, 'Salt Bread', 'salt-bread', '1613014008_bread bun.png', 40, '                                                                                ', 165),
(39, 'Wheat Loaf Bread ', 'wheat-loaf-bread', '1613014021_bread 2.png', 60, '                                                                                ', 165),
(40, 'Banana L', 'banana-l', '1613014032_bread.png', 50, '                                                                                ', 165),
(41, 'Vanilla Marble', 'vanilla-marble', '1613014041_doughnut.png', 40, '                                                                                ', 165),
(42, 'Glazed Donut', 'glazed-donut', '1613014050_glazed.png', 30, '                                                                                ', 165),
(43, 'Macaroon', 'macaroon', '1613014059_macaroons.png', 120, '                                                                                ', 165),
(44, 'Empanada', 'empanada', '1613014070_empanada.png', 60, '                                                                                ', 165),
(57, 'Caffé Lattee', 'caffe-lattee', '1613463287_caffe latte.png', 140, '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', 163),
(70, 'Chessecake', 'chessecake', '1613627096_cheese cake.png', 80, '                                        ', 170),
(71, 'Chocolate Cake', 'chocolate-cake', '1613627119_choco cake.png', 60, '                                        ', 170),
(72, 'Java Chip Cupcake', 'java-chip-cupcake', '1613627203_choco cupcake.png', 40, '                                        ', 170),
(73, 'Cookies', 'cookies', '1613627239_choco chip.png', 30, '                                                                                ', 170),
(74, 'Brownies', 'brownies', '1613627257_brownie.png', 40, '                                        ', 170),
(75, 'Crepe', 'crepe', '1613627274_crepe.png', 100, '                                        ', 170),
(76, 'Ice Cream', 'ice-cream', '1613790150_mint.png', 80, '                                                                                ', 170),
(77, 'Banana Muffin', 'banana-muffin', '1614228346_banana_muffin.png', 30, '                                                                                                                                                                                                        ', 170);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  `no_of_people` int(11) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `transaction_id`, `date_time`, `no_of_people`, `contact_number`, `status`, `user_id`, `created_at`) VALUES
(52, '7e389f324bf52a', '2021-02-15 18:00:00', 2, '+639959768531', 'reserved', 97, '2021-02-14 04:49:32'),
(66, 'd827668721ea6a', '2021-02-24 16:00:00', 3, '+639959768531', 'completed', 93, '2021-02-20 02:52:05'),
(67, '581e3b84b137c5', '2021-02-24 16:00:00', 3, '+639959768531', 'pending', 93, '2021-02-20 02:52:18'),
(68, '57c199e7b24ac6', '2021-02-24 16:00:00', 4, '+639959768531', 'pending', 93, '2021-02-20 02:52:28'),
(69, '34ee0f099c6a1d', '2021-02-25 16:00:00', 5, '+639959768531', 'completed', 93, '2021-02-20 02:53:35'),
(70, '57faacfea088d5', '2021-02-22 16:00:00', 2, '+639959768531', 'completed', 105, '2021-02-20 02:54:27'),
(71, '75b20bd7d0b1c0', '2021-02-25 16:00:00', 4, '+639959768531', 'reserved', 110, '2021-02-20 06:43:07'),
(72, 'e84224cc57d2aa', '2021-02-23 16:00:00', 2, '+639959768531', 'reserved', 111, '2021-02-22 06:30:24'),
(73, 'd96046d1837a9c', '2021-02-24 16:00:00', 2, '+639959768531', 'pending', 113, '2021-02-23 13:25:35'),
(74, '6db17000700a1a', '2021-02-25 16:00:00', 3, '+639959768531', 'pending', 114, '2021-02-24 03:49:57'),
(75, '68bc1409db5080', '2021-02-25 16:00:00', 5, '+639959768531', 'completed', 114, '2021-02-24 03:50:09'),
(76, '4de25e941b237b', '2021-02-25 16:00:00', 4, '+639959768531', 'reserved', 115, '2021-02-24 04:07:20'),
(77, 'b007a516c19d21', '2021-02-27 16:00:00', 2, '+639959768531', 'pending', 116, '2021-02-24 04:11:46'),
(78, '27c33a7e93e2ab', '2021-03-18 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:02:12'),
(79, 'e6e703eff89caf', '2021-04-14 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:06:09'),
(80, 'b7e9e10c74a58c', '2021-04-15 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:06:26'),
(81, '947e6f64a3d972', '2021-01-11 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:07:34'),
(82, 'a51715eb9a3140', '2021-01-26 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:07:44'),
(83, 'f8feb10847775c', '2021-01-21 16:00:00', 2, '+639959768531', 'reserved', 107, '2021-02-24 06:07:59'),
(84, '89705bfa8910fb', '2021-04-15 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:08:16'),
(85, '9b4ef70dc532dd', '2021-03-17 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:18:53'),
(86, '9c25db8fc43dfa', '2021-05-19 16:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 06:19:04'),
(87, 'cb4e34abbb1586', '2021-06-17 16:00:00', 2, '+639959768531', 'cancelled', 107, '2021-02-24 06:19:17'),
(88, '2d0b343961c70f', '2021-03-16 16:00:00', 2, '+639959768531', 'reserved', 107, '2021-02-24 06:19:44'),
(91, 'ee34a66bc3c3be', '2021-05-29 19:00:00', 2, '+639959768531', 'pending', 107, '2021-02-24 12:11:45'),
(93, 'a9d8865db0fe2a', '2021-04-22 16:00:00', 2, '+639959768531', 'completed', 122, '2021-02-26 03:57:58'),
(94, '4e252e3cc62027', '2021-02-27 16:00:00', 3, '+639959768531', 'completed', 123, '2021-02-26 04:07:49'),
(95, '7ee21bfcaef1e4', '2021-03-25 16:00:00', 2, '+639959768531', 'reserved', 124, '2021-02-26 05:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_product_manager` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `token`, `active`, `is_admin`, `is_product_manager`, `created_at`) VALUES
(87, 'julia', 'dejesus', 'julia@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'ba4326f3d7d25c', 1, 0, 1, '2021-02-06 09:15:26'),
(91, 'sample', 'sample', 'sample@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'd2e2dab4316edd', 1, 0, 0, '2021-02-06 11:44:04'),
(93, 'wendell', 'suazo', 'admin2@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'b9cc830767b048', 1, 1, 0, '2021-02-10 12:21:12'),
(94, 'wendell-updated-zzz', 'suazo', '1233234@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'f0964f85c870d0', 1, 0, 0, '2021-02-13 00:36:40'),
(97, 'wendell', 'suazo', '1212@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '47154760b41b5f', 1, 1, 0, '2021-02-13 06:43:21'),
(105, 'john', 'doe', 'john@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '8aa75510d7372b', 1, 0, 1, '2021-02-20 02:53:49'),
(107, 'wendell', 'suazo', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'c1b95dbe8796ef', 1, 1, 0, '2021-02-20 02:56:54'),
(108, 'jane', 'doe', 'jane@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'd8cfd09a3e4ad4', 1, 0, 1, '2021-02-20 02:58:28'),
(110, 'naruto', 'uzumaki', 'wendellchansuazo11asdfasf@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '44444bc7a6a15a', 1, 0, 0, '2021-02-20 06:42:33'),
(111, 'sasuke', 'uchiha', 'dfd@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'b5a45387eef822', 1, 0, 0, '2021-02-22 06:28:51'),
(113, 'sarada', 'uchiha', 'asdf@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'a8d97f6bc3c2f9', 1, 0, 0, '2021-02-23 12:54:27'),
(114, 'ben', 'smith', 'admin3@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'd3134fe2f68b9f', 1, 1, 0, '2021-02-24 03:49:28'),
(115, 'elizabeth', 'smith', 'wendellchansssssuazo11@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'd23a416993c078', 1, 0, 0, '2021-02-24 04:06:48'),
(116, 'richard', 'wilson', 'wendellchansuazadfafao11@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '4f47f9ac0837f1', 1, 0, 0, '2021-02-24 04:11:25'),
(117, 'wendell', 'suazo', 'admiaDn@gmail.com', 'b635ecb0e1740791b06b7a31158e25d5', '3a2fcb9c736351', 0, 0, 0, '2021-02-24 06:56:31'),
(118, 'goku ', 'son', 'songoku@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '41089f65247228', 0, 0, 0, '2021-02-25 04:25:14'),
(119, 'boruto', 'uzumaki', 'boruto@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '22ecc79b9a0a0a', 1, 0, 0, '2021-02-25 04:38:41'),
(120, 'gohan', 'son', 'songohan@gmail.com', 'wendell1101', '', 1, 0, 0, '2021-02-25 04:52:58'),
(122, 'wendell', 'suazo', 'wendellchansuazo11@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', 'd736d0fb5e7aac', 1, 0, 0, '2021-02-26 03:56:42'),
(123, 'wendell', 'suazo', 'testing@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '5d160b164584fa', 1, 0, 0, '2021-02-26 04:07:39'),
(124, 'james', 'gowsling', 'testing2@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '6696c2af2754f1', 1, 0, 0, '2021-02-26 05:30:58'),
(125, 'pikachu', 'ketcham', 'pikachu@gmail.com', '405c71b3a5f67c7bacf39a2820ec686a', '5b0ac0f3d164b6', 0, 0, 0, '2021-02-26 05:59:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`,`category_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
