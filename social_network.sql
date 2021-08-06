-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 10:52 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `date_create`) VALUES
(1, 'Sport', '2021-08-04 18:28:23'),
(2, 'Education', '2021-08-04 18:28:23'),
(3, 'Fashion', '2021-08-04 18:28:55'),
(4, 'Experience', '2021-08-04 18:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `CommentPoint` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`, `CommentPoint`) VALUES
(115, 25, 1, 'I want to see more pic details', 'duy_nguyen_879760', '2021-08-04 20:35:39', 1),
(116, 25, 1, 'I think Vans. Vans Old Skool is cheap and makes us comfortable. You can see more at: https://vansvietnam.com.vn/vans-old-skool ', 'tuan anh _tran_401553', '2021-08-05 11:35:25', 0),
(117, 26, 1, 'G&igrave; nữa đ&acirc;y??', 'tun_alo_585874', '2021-08-05 14:16:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commentvote`
--

CREATE TABLE `commentvote` (
  `id` int(11) NOT NULL,
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_vote_cmt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentvote`
--

INSERT INTO `commentvote` (`id`, `com_id`, `post_id`, `date`, `user_vote_cmt`) VALUES
(15, 115, 25, '2021-08-04 20:36:08', 1),
(16, 117, 26, '2021-08-05 14:16:32', 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `upload_image` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `PostPoint` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `tag_id`, `category_id`, `upload_image`, `post_date`, `PostPoint`) VALUES
(25, 1, 'Nike vs Vans, which is the best choice???', 1, 3, 'NikevsVans.png.100', '2021-08-04 20:22:54', 1),
(26, 1, 'You can recommend famous english center??', 1, 2, '', '2021-08-04 20:41:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_report` int(11) NOT NULL,
  `username_report` varchar(50) NOT NULL,
  `email_report` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `post_id`, `user_report`, `username_report`, `email_report`, `content`, `date`) VALUES
(13, 26, 1, 'duy_nguyen_879760', 'nduyquang99@gmail.com', 'ekfsjdkfs', '2021-08-05 13:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `date_create`) VALUES
(1, '#Discuss', '2021-08-04 18:26:48'),
(2, '#Tutorial', '2021-08-04 18:26:48'),
(3, '#Share', '2021-08-04 18:28:00'),
(4, '#Relax', '2021-08-04 18:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `describe_user` varchar(255) NOT NULL,
  `Relationship` text NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_cover` varchar(255) NOT NULL,
  `user_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL,
  `posts` text NOT NULL,
  `recovery_account` varchar(255) NOT NULL,
  `userpoint` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `describe_user`, `Relationship`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_cover`, `user_reg_date`, `status`, `posts`, `recovery_account`, `userpoint`) VALUES
(1, 'Duy', 'Nguyen', 'duy_nguyen_879760', 'Hello every body!', '...', '123456', 'nduyquang99@gmail.com', 'Vietnam', 'Male', '1999-09-08', 'BG.jpg.56', 'Lisa1.jpg.69', '2021-07-22 06:59:09', 'verified', 'yes', 'Iwanttoputadingintheuniverse.', 37),
(2, 'Tuan Anh ', 'Tran', 'tuan anh _tran_401553', 'Hello everyone!', '...', '123456789', 'test@test.com', 'United States', 'Male', '2000-05-02', 'Ly Lan Dich 2.png.89', 'View.benyapa01.jpg', '2021-07-29 09:59:50', 'verified', 'yes', 'Iwanttoputadingintheuniverse.', 12),
(3, 'Tũn', 'Đẹp Trai', 'tun_alo_585874', 'Hello everybody!', '...', '123456', 'tun@gmail.com', 'England', 'Male', '2021-08-13', 'image_profile.jpg', 'View.benyapa01.jpg', '2021-08-05 14:05:57', 'verified', 'no', 'Love', 233);

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `msg_body` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `msg_seen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_messages`
--

INSERT INTO `user_messages` (`id`, `user_to`, `user_from`, `msg_body`, `date`, `msg_seen`) VALUES
(13, 1, 3, 'Hi bro, did you finish your project?', '2021-08-04 09:50:06', 'no'),
(14, 3, 1, 'Yup. My work is done!', '2021-08-04 09:51:00', 'no'),
(16, 3, 1, 'How about you, bro?', '2021-08-04 09:51:29', 'no'),
(17, 1, 3, 'Yeah, I have just finished ^^', '2021-08-05 09:31:40', 'no'),
(18, 1, 3, 'Yeah, I have just finished ^^', '2021-08-05 09:31:46', 'no'),
(19, 2, 3, 'Hi, long time no see bro', '2021-08-05 10:07:23', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `Post_id` int(11) NOT NULL,
  `User_vote` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `StatusVote` varchar(1) NOT NULL DEFAULT '1' COMMENT '1: voted, 0: unvote'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `Post_id`, `User_vote`, `Date`, `StatusVote`) VALUES
(33, 25, 1, '2021-08-04 20:23:15', '1'),
(34, 26, 2, '2021-08-05 11:32:53', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_posts_users` (`user_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `commentvote`
--
ALTER TABLE `commentvote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
