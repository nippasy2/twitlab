-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018 年 5 朁E06 日 10:42
-- サーバのバージョン： 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitlab`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `datas`
--

CREATE TABLE `datas` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `message` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `datas`
--

INSERT INTO `datas` (`id`, `name`, `message`, `created`) VALUES
(1, 'shin', 'shintest', '2018-05-04 09:15:24'),
(2, 'shin', 'shintest2', '2018-05-04 09:15:47'),
(3, 'shin2', 'shin2test', '2018-05-04 09:16:10'),
(4, 'shin2', 'shin2test2', '2018-05-04 09:16:10'),
(5, 'shin3', 'shin3test', '2018-05-04 09:16:51'),
(6, 'shin3', 'shin3test2', '2018-05-04 09:16:51'),
(9, 'shin3', 'shin3test3', '2018-05-04 09:18:22'),
(10, 'shin3', 'shin3test4', '2018-05-04 09:18:22'),
(12, 'shin3', 'shin3test6', '2018-05-04 09:18:39'),
(13, 'shin3', 'shin3test7', '2018-05-04 09:18:51'),
(14, 'shin3', 'shin3test8', '2018-05-04 09:18:51'),
(17, 'shin3', 'shin3test9', '2018-05-04 09:19:44'),
(18, 'shin3', 'shin3test10', '2018-05-04 09:19:44'),
(19, 'shin3', 'shin3test11', '2018-05-04 09:20:01'),
(20, 'shin3', 'shin3test12', '2018-05-04 09:20:01'),
(24, 'shin4', 'testshin4', '2018-05-04 19:08:56');

-- --------------------------------------------------------

--
-- テーブルの構造 `relations`
--

CREATE TABLE `relations` (
  `username` text NOT NULL,
  `follow` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `relations`
--

INSERT INTO `relations` (`username`, `follow`) VALUES
('shin3', 'shin'),
('shin3', 'shin2'),
('shin3', 'shin4');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`name`, `username`, `password`, `email`) VALUES
('shin', 'shin', '1a10644be240522ebc04a9c1351c9d503829f37d', 'shin@gmail.com'),
('shin2', 'shin2', '70b96795b681c234551d108e9d0da754dbb57680', 'shin2@gmail.com'),
('shin3', 'shin3', '71b60f0c097ff7546c9f8151675a6d950fc28252', 'shin3@gmail.com'),
('shin4', 'shin4', 'aaaaa', 'shin4@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datas`
--
ALTER TABLE `datas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
