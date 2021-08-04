-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 01:33 PM
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
(100, 6, 1, 'hello', 'tuan anh _tran_401553', '2021-08-01 08:34:53', 0),
(101, 6, 1, 'hello moi nguoi', 'tuan anh _tran_401553', '2021-08-01 08:34:59', 0),
(102, 6, 1, 'oke chua ne ', 'tuan anh _tran_401553', '2021-08-01 08:35:20', 0),
(103, 5, 2, 'aloo', 'tuan anh _tran_401553', '2021-08-01 18:27:45', 0),
(104, 4, 2, 'alo', 'duy_nguyen_879760', '2021-08-02 09:07:54', 0),
(106, 4, 2, 'gi nua day', 'duy_nguyen_879760', '2021-08-03 08:16:52', 0),
(113, 15, 1, 'alo', 'duy_nguyen_879760', '2021-08-04 10:05:55', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(255) NOT NULL,
  `upload_image` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `PostPoint` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `upload_image`, `post_date`, `PostPoint`) VALUES
(2, 2, 'hi everybody', '', '2021-07-30 06:58:35', 0),
(3, 2, 'kkkk', '', '2021-07-30 07:03:42', 0),
(4, 2, 'hi, how are you', '', '2021-07-30 07:04:02', 0),
(5, 2, 'noooo', '', '2021-07-30 07:05:52', 1),
(6, 1, 'hello ', '1712857.png.40', '2021-07-30 20:00:46', 2),
(7, 1, 'hi everybody oke chua', 'Screenshot 2021-07-04 032044.png.72', '2021-08-02 19:47:55', 2),
(9, 1, 'No', '1712857.png.89', '2021-08-03 08:25:09', 1),
(14, 1, 'alo ạ', '', '2021-08-03 10:35:20', 1),
(15, 1, 'a', '', '2021-08-04 09:37:26', 0);

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
(9, 5, 1, 'duy_nguyen_879760', 'nduyquang99@gmail.com', 'sai roi nha', '2021-08-01 07:23:33'),
(10, 4, 1, 'duy_nguyen_879760', 'nduyquang99@gmail.com', 'a', '2021-08-02 10:26:47'),
(11, 6, 1, 'duy_nguyen_879760', 'nduyquang99@gmail.com', 'aa', '2021-08-02 18:54:04'),
(12, 6, 1, 'duy_nguyen_879760', 'nduyquang99@gmail.com', 'oke chua', '2021-08-02 18:54:27');

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
(1, 'Duy', 'Nguyen', 'duy_nguyen_879760', 'Hello Coding Cafe. This is my default status!', '...', '123456789', 'nduyquang99@gmail.com', 'Vietnam', 'Male', '1999-09-08', 'BG.jpg.56', 'Lisa1.jpg.69', '2021-07-22 06:59:09', 'verified', 'yes', 'Iwanttoputadingintheuniverse.', 0),
(2, 'Tuan Anh ', 'Tran', 'tuan anh _tran_401553', 'Hello Coding Cafe. This is my default status!', '...', '123456789', 'test@test.com', 'United States', 'Male', '2000-05-02', 'Ly Lan Dich 2.png.89', 'View.benyapa01.jpg', '2021-07-29 09:59:50', 'verified', 'yes', 'Iwanttoputadingintheuniverse.', 0);

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
(17, 5, 1, '2021-08-02 18:45:15', '1'),
(19, 6, 1, '2021-08-02 18:54:47', '1'),
(25, 7, 2, '2021-08-03 07:37:15', '1'),
(26, 9, 1, '2021-08-03 08:29:05', '1'),
(28, 7, 1, '2021-08-03 11:14:31', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`,`post_id`);

--
-- Indexes for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_vote_cmt` (`com_id`,`post_id`),
  ADD KEY `FK_VOTE_usr` (`user_vote_cmt`);

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
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `FK_REPORT_POSTS` (`post_id`),
  ADD KEY `FK_REPORT_USERS` (`user_report`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `Fk_vote_posts` (`Post_id`),
  ADD KEY `FK_VOTE_USERs` (`User_vote`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `commentvote`
--
ALTER TABLE `commentvote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `FK_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_comments_users2` FOREIGN KEY (`comment_author`) REFERENCES `users` (`user_name`);

--
-- Constraints for table `commentvote`
--
ALTER TABLE `commentvote`
  ADD CONSTRAINT `FK_VOTE_usr` FOREIGN KEY (`user_vote_cmt`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_vote_cmt` FOREIGN KEY (`com_id`,`post_id`) REFERENCES `comments` (`com_id`, `post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FK_REPORT_POSTS` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `FK_REPORT_USERS` FOREIGN KEY (`user_report`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_VOTE_USERs` FOREIGN KEY (`User_vote`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `Fk_vote_posts` FOREIGN KEY (`Post_id`) REFERENCES `posts` (`post_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
