-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 06:08 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 1, 4, 'Hello Jhon Smith!?', '2020-12-22 12:51:02', 1),
(2, 1, 4, 'How are you buddy', '2020-12-22 12:51:13', 1),
(3, 0, 4, '<p><img src=\"upload/Screenshot (15).png\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', '2020-12-22 12:52:12', 1),
(4, 6, 4, 'Hello Michael??', '2020-12-24 05:21:42', 0),
(5, 6, 4, '?', '2020-12-24 05:22:09', 2),
(6, 6, 4, '??', '2020-12-24 05:46:54', 0),
(7, 1, 4, 'sas', '2020-12-24 12:05:15', 1),
(8, 1, 4, 'adasas', '2020-12-25 16:12:09', 2),
(9, 1, 4, 'dsdsd', '2020-12-25 16:31:54', 1),
(10, 1, 4, 'gfgfh', '2020-12-25 16:32:53', 1),
(11, 1, 4, 'sasa', '2020-12-27 08:57:03', 1),
(12, 1, 4, 'saasa', '2020-12-27 09:24:16', 1),
(13, 4, 6, 'asas', '2020-12-27 09:40:12', 0),
(14, 6, 4, 'Okey', '2020-12-27 09:40:28', 0),
(15, 6, 4, 'hellow?', '2020-12-27 10:27:22', 0),
(16, 6, 4, 'kesa hai michael', '2020-12-27 10:32:52', 0),
(17, 0, 4, 'sasasas', '2020-12-27 11:09:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
(1, 'johnsmith', '$2y$10$4REfvTZpxLgkAR/lKG9QiOkSdahOYIR3MeoGJAyiWmRkEFfjH3396'),
(2, 'peterParker', '$2y$10$4REfvTZpxLgkAR/lKG9QiOkSdahOYIR3MeoGJAyiWmRkEFfjH3396'),
(3, 'davidMoore', '$2y$10$4REfvTZpxLgkAR/lKG9QiOkSdahOYIR3MeoGJAyiWmRkEFfjH3396'),
(4, 'sufiyanrao', '$2y$10$4b/eT.xkKP9UetbOm9YCG.7Fa5YyHvIuzXOurgnvRhP.1JU7WBCTW'),
(5, 'jhon', '$2y$10$mkdyAz29AnFOExU74QY3WORc1XZuPgb1MFdw7ukPSvanwAc9YJOaC'),
(6, 'michael', '$2y$10$fU9caw.UTkBBEATao1W7tOiCIceWBd9OqloBwPCsyIYPJyrztfjzC');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(1, 4, '2020-12-22 12:52:32', 'no'),
(2, 4, '2020-12-22 15:07:40', 'no'),
(3, 4, '2020-12-22 15:08:02', 'no'),
(4, 4, '2020-12-22 18:20:56', 'no'),
(5, 4, '2020-12-24 12:52:45', 'no'),
(6, 6, '2020-12-24 06:41:30', 'no'),
(7, 4, '2020-12-25 16:34:10', 'no'),
(8, 4, '2020-12-27 10:45:56', 'no'),
(9, 6, '2020-12-27 11:42:34', 'no'),
(10, 4, '2020-12-27 11:42:31', 'no'),
(11, 4, '2020-12-27 16:22:32', 'no'),
(12, 6, '2020-12-27 16:22:25', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_users`
--

CREATE TABLE `oauth_users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(50) NOT NULL,
  `oauth_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `modified_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oauth_users`
--

INSERT INTO `oauth_users` (`id`, `oauth_provider`, `oauth_id`, `name`, `first_name`, `last_name`, `email`, `picture`, `created_at`, `modified_at`) VALUES
(2, 'facebook', '245387290285696', 'M Sufiyan Rao', 'M', 'Rao', '', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=245387290285696&height=50&width=50&ext=1611472936&hash=AeQmszyvz6yFkH680lg', '2020-12-25 08:21:40', '2020-12-25 12:22:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `oauth_users`
--
ALTER TABLE `oauth_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
