-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 01:08 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorpatient`
--

-- --------------------------------------------------------

--
-- Table structure for table `dctr`
--

CREATE TABLE `dctr` (
  `dctr_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `university_id` int(11) NOT NULL,
  `hsptl_id` int(11) NOT NULL,
  `dctr_first_nm` varchar(30) NOT NULL,
  `dctr_last_nm` varchar(30) NOT NULL,
  `dctr_birthdate` date NOT NULL,
  `id_scn` text,
  `photo_scn` text,
  `speclty_id` int(10) NOT NULL,
  `dctr_gndr` enum('male','female','','') NOT NULL,
  `vertificate_state` enum('pending','accept','reject','') NOT NULL DEFAULT 'pending',
  `haveclinic` enum('0','1','','') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;--
-- Dumping data for table `dctr`
--



INSERT INTO `dctr` (`dctr_id`, `user_id`, `university_id`, `hsptl_id`, `dctr_first_nm`, `dctr_last_nm`, `dctr_birthdate`, `id_scn`, `photo_scn`, `speclty_id`, `dctr_gndr`, `vertificate_state`, `haveclinic`)
 VALUES
(1, 9, 0, 0, 'mohamed khaled', '', '1980-01-26', 'id1.png', 'photo1.png', 14, 'male', 'pending', '1'),

(2, 0, 0, 0, 'ahmed mohamed', '', '1990-01-11', 'id1.png', 'photo1.png', 1, 'male', 'pending', '1'),

(3, 0, 0, 0, 'marwa mohamed', '', '1996-01-04', 'id2.png', 'photo2.png', 5, 'female', 'pending', '0'),

(4, 12, 0, 0, 'mohamed elkomy', '', '1985-04-29', 'id4.jpg', 'photo4.jpg', 12, 'male', 'pending', '0'),

(5, 39, 0, 0, 'aaaaa', 'aaaaaaaa', '2017-03-06', NULL, NULL, 1, 'male', 'pending', '0'),

(6, 40, 0, 0, 'adsadasdsa', 'adsadadas', '2017-03-06', NULL, NULL, 1, 'female', 'pending', '0'),

(7, 41, 0, 0, 'sasasasa', 'sasasasasa', '2017-03-06', NULL, NULL, 1, 'female', 'pending', '0'),

(8, 42, 0, 0, 'nada', 'marwa', '2017-03-07', NULL, NULL, 1, 'female', 'pending', '0'),

(9, 43, 0, 0, 'wwwww', 'wwwwww', '0000-00-00', NULL, NULL, 10, 'female', 'pending', '0'),

(10, 44, 0, 0, 'nariman', 'nabil', '0000-00-00', NULL, NULL, 10, 'female', 'pending', '0');

-- --------------------------------------------------------

--
-- Table structure for table `qstn`
--

CREATE TABLE `qstn` (
  `qstn_id` int(20) NOT NULL,
  `qstn_txt` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `spclty_id` int(10) NOT NULL,
  `qstn_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qstn_cmnt`
--

CREATE TABLE `qstn_cmnt` (
  `qstn_cmnt_id` int(100) NOT NULL,
  `dctr_id` int(10) NOT NULL,
  `qstn_cmnt_txt` text NOT NULL,
  `qstn_id` int(20) NOT NULL,
  `qstn_cmnt_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `qstn_cmnt_like`
--

CREATE TABLE `qstn_cmnt_like` (
  `qstn_cmnt_like_id` int(11) NOT NULL,
  `qstn_cmnt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('like','dislike') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `spclty`
--
CREATE TABLE `spclty` (
  `spclty_id` int(10) NOT NULL,
  `spclty_nm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spclty`
--





INSERT INTO `spclty` (`spclty_id`, `spclty_nm`) VALUES
(1, 'Ear, Nose and Throat'),
(2, 'dentist'),
(3, 'psychological'),

(4, 'pediatric'),
(5, 'bones and joints'),
(6, 'kidney and urinary'),
(7, 'skin and venereal'),
(8, 'Obstetrics and Gynecology'),
(9, 'ophthalmologist'),

(10, 'physiotherapist'),
(11, 'Gastroenterology'),
(12, 'Chest'),
(13, 'heart'),
(14, 'veins'),
(15, 'Neurologists');-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `signup_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar` varchar(200) NOT NULL DEFAULT 'images/profiles/basic.png',
  `acc_type` enum('dtr','ptn','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `signup_dt`, `avatar`, `acc_type`) VALUES

(9, 'mohamed@yahoo.com', '123456', 'mohamed', '2017-03-28 22:41:12', 'images/profiles/14148724799116508510_1726012144091574_4057322958628311894_n.jpg', 'dtr'),

(10, 'marwa@yahoo.com', '123456', 'maro', '2017-03-31 23:49:38', 'images/profiles/basic.png', 'dtr'),

(11, 'marwaelshora2013@gmail.com', '123456', 'marwa', '2017-03-31 23:49:08', 'images/profiles/basic.png', 'ptn'),

(12, 'mostafa.tarek.ibm@gmail.com', '123456', 'tofeee', '2017-03-31 23:49:41', 'images/profiles/basic.png', 'dtr'),

(13, 'marwty_@gmail.com', 'sdsdsds', 'marwty', '0000-00-00 00:00:00', 'images/profiles/5914897022702017-01-17 at 16-27-48.png', 'dtr'),

(14, 'abdo@net.com', '123456789', 'abdo', '2017-03-31 23:49:44', 'images/profiles/basic.png', 'dtr'),

(15, 'marwa@ffdf', '123456', 'mmmmm', '0000-00-00 00:00:00', 'images/profiles/4614897031428007_631204840283299_1699358316_n.jpg', 'dtr'),

(16, 'marwawqwqw', '123456wqw', 'wqwqwqw', '0000-00-00 00:00:00', 'images/profiles/43148970332913882_695938570485839_6688096957268946856_n.jpg', 'dtr'),

(17, '', '', '', '2017-03-31 23:49:12', 'images/profiles/basic.png', 'ptn'),
(19, 'sco.com', '12345', 'sco', '2017-03-31 23:49:16', 'images/profiles/basic.png', 'ptn'),

(23, 'sasa.com', '147258369', 'sasa', '2017-03-31 23:49:20', 'images/profiles/basic.png', 'ptn'),

(24, 'shaway.com', '147258369', 'shaway', '2017-03-31 23:49:23', 'images/profiles/basic.png', 'ptn'),

(26, 'komy.com', '147258369', 'komy', '2017-03-31 23:49:25', 'images/profiles/basic.png', 'ptn'),

(28, 'mohamed', '147258369', 'sss', '0000-00-00 00:00:00', 'images/profiles/101490616362121031052414-11-sandy-damage-1031-horizontal-gallery.jpg', 'dtr'),

(29, 'abdo.com', '147258369', 'abdelghany', '2017-03-31 23:49:28', 'images/profiles/basic.png', 'ptn'),

(30, 'mmmmmmmm', '147258369', 'mmmmmmm', '2017-03-31 23:49:30', 'images/profiles/basic.png', 'ptn'),

(31, 'mmmmmmmmmmmmmmmmm', '12345', 'mmmmmmmmmmmmmmmmm', '2017-03-31 23:49:33', 'images/profiles/basic.png', 'ptn'),

(32, 'eeeeeeeeeeeeeeeeeeeeeeee', '147258369', 'eeeeeeeeeeeeeeeeeeeee', '2017-03-27 12:23:53', 'images/profiles/72149061743317351310_1797365570591136_793060124_n.jpg', 'ptn'),

(35, 'salma.com', '147258369', 'netsa', '2017-03-28 19:14:11', 'images/profiles/26149072845116836433_1222947247820606_3762390328277190091_o.jpg', 'dtr'),

(39, 'mohamed', '147258369', 'aaaaaa', '2017-03-28 19:30:50', 'images/profiles/1149072945015319070_1198969283528840_8248089035707622264_n.jpg', 'dtr'),

(40, 'mohamed', '147258369', 'asdasdasda', '2017-03-28 20:40:29', 'images/profiles/3414907336298007_631204840283299_1699358316_n.jpg', 'dtr'),

(41, 'mohameds', '147258369', 'sasasasa', '2017-03-28 20:43:49', 'images/profiles/6414907338291993_483534051696740_1698811753_n.jpg', 'dtr'),

(42, 'mohamed', '147258369', 'sasas', '2017-03-28 20:45:36', 'images/profiles/5414907339368561_717537598263046_399081729_n.jpg', 'dtr'),

(43, 'mohamed', '147258369', 'wwwwww', '2017-03-28 20:48:44', 'images/profiles/514907341243567_4673453911235_41442887_n.jpg', 'dtr'),

(44, 'nana.com', '147258369', 'nanaa', '2017-03-28 20:52:27', 'images/profiles/65149073434711957_801661523178885_8631468756111157117_n.jpg', 'dtr'),

(50, 'marwaelshora2013@gmail.com', 'eng2014marwa', 'malshoura', '2017-04-01 21:03:19', 'images/profiles/basic.png', 'admin'),

(51, 'marwaelshora2013@gmail.com', 'eng2014marwa', 'marrrrro', '2017-04-02 12:12:30', 'images/profiles/391491135150DSC_0021.JPG', 'ptn'),

(52, 'meko.com', '123456789', 'meko', '2017-04-03 12:19:50', 'images/profiles/131491221990DSC_0027.JPG', ''),

(53, 'bebe.com', '123456', 'bebo', '2017-04-03 12:21:13', 'images/profiles/741491222073DSC_0025.JPG', ''),

(54, 'sfdsfsd', 'eng2014marwa', 'dsfsdfs', '2017-04-03 12:24:56', 'images/profiles/481491222296DSC_0021.JPG', ''),

(55, 'sdghfsg', 'eng2014marwa', 'sdghjhgfdfg', '2017-04-03 12:26:03', 'images/profiles/771491222363DSC_0023.JPG', ''),

(56, 'nosa.com', 'eng2014marwa', 'nosa', '2017-04-03 12:47:53', 'images/profiles/921491223673DSC_0027.JPG', ''),

(57, 'asdfghj', 'eng2014marwa', 'sdfghj', '2017-04-03 12:49:41', 'images/profiles/171491223781DSC_0024.JPG', ''),

(59, 'sasasa', 'eng2014marwa', 'sSASA', '2017-04-03 12:53:59', 'images/profiles/141491224039DSC_0025.JPG', ''),
(60, 'toto', 'eng2014marwa', 'torky', '2017-04-03 12:55:28', 'images/profiles/811491224128DSC_0025.JPG', ''),

(62, 'asdsadas', 'eng2014marwa', 'asasasa', '2017-04-03 13:00:51', 'images/profiles/541491224451DSC_0027.JPG', ''),
(68, 'lala', 'eng2014marwa', 'lala', '2017-04-03 13:15:24', 'images/profiles/61491225324DSC_0025.JPG', ''),

(69, 'lalal', 'ewew', 'lalaaa', '2017-04-03 13:16:43', 'images/profiles/171491225403DSC_0023.JPG', ''),

(71, 'asdsadas', 'ere', 'asdasdasd', '2017-04-03 13:18:07', 'images/profiles/51491225487DSC_0023.JPG', ''),

(75, 'asdfgh', 'eng2014marwa', 'asdfgh', '2017-04-03 13:28:24', 'images/profiles/251491226104DSC_0025.JPG', ''),
(80, 'redaaa', 'eng2014marwa', 'reda', '2017-04-10 13:05:37', 'images/profiles/basic.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dctr`
--
ALTER TABLE `dctr`
  ADD PRIMARY KEY (`dctr_id`),
  ADD KEY `speclty_id` (`speclty_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `qstn`
--
ALTER TABLE `qstn`
  ADD PRIMARY KEY (`qstn_id`),
  ADD KEY `ptnt_id` (`user_id`),
  ADD KEY `spclty_id` (`spclty_id`);

--
-- Indexes for table `qstn_cmnt`
--
ALTER TABLE `qstn_cmnt`
  ADD PRIMARY KEY (`qstn_cmnt_id`),
  ADD KEY `qstn_id` (`qstn_id`),
  ADD KEY `dctr_id` (`dctr_id`);

--
-- Indexes for table `qstn_cmnt_like`
--
ALTER TABLE `qstn_cmnt_like`
  ADD PRIMARY KEY (`qstn_cmnt_like_id`),
  ADD KEY `qstn_cmnt_id` (`qstn_cmnt_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `spclty`
--
ALTER TABLE `spclty`
  ADD PRIMARY KEY (`spclty_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);



--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dctr`
--
ALTER TABLE `dctr`
  MODIFY `dctr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `qstn`
--
ALTER TABLE `qstn`
  MODIFY `qstn_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qstn_cmnt`
--
ALTER TABLE `qstn_cmnt`
  MODIFY `qstn_cmnt_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qstn_cmnt_like`
--
ALTER TABLE `qstn_cmnt_like`
  MODIFY `qstn_cmnt_like_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `spclty`
--
ALTER TABLE `spclty`
  MODIFY `spclty_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dctr`
--
ALTER TABLE `dctr`
  ADD CONSTRAINT `dctr_spclty` FOREIGN KEY (`speclty_id`) REFERENCES `spclty` (`spclty_id`);



--
-- Constraints for table `qstn`
--
ALTER TABLE `qstn`
  ADD CONSTRAINT `qstn_spclty` FOREIGN KEY (`spclty_id`) REFERENCES `spclty` (`spclty_id`),
  ADD CONSTRAINT `qstn_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);



--
-- Constraints for table `qstn_cmnt`
--
ALTER TABLE `qstn_cmnt`
  ADD CONSTRAINT `qstn_cmnt` FOREIGN KEY (`qstn_id`) REFERENCES `qstn` (`qstn_id`),
  ADD CONSTRAINT `qstn_cmnt_dctr` FOREIGN KEY (`dctr_id`) REFERENCES `dctr` (`dctr_id`);



--
-- Constraints for table `qstn_cmnt_like`
--
ALTER TABLE `qstn_cmnt_like`
  ADD CONSTRAINT `qstn_cmnt_id_fk` FOREIGN KEY (`qstn_cmnt_id`) REFERENCES `qstn_cmnt` (`qstn_cmnt_id`),
  ADD CONSTRAINT `user_cmnt_like` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
