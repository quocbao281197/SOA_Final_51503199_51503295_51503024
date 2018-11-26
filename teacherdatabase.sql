-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 12:12 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teacherdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `USERNAME` varchar(15) COLLATE utf8_bin NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_bin NOT NULL,
  `DATECREATED` datetime NOT NULL,
  `ROLE` bit(1) NOT NULL,
  `ACTIVE` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`USERNAME`, `PASSWORD`, `DATECREATED`, `ROLE`, `ACTIVE`) VALUES
('AD001', '09d901ed8f2aa73ef638fb750f0558a1', '2018-10-22 00:42:11', b'1', b'1'),
('AD002', '611cf4dc8d2fa105a4473a0789608cea', '2018-10-22 00:42:11', b'1', b'1'),
('GV001', 'c416b3b754aa3dc82aa2f7890640ed77', '2018-10-22 00:42:11', b'0', b'1'),
('GV002', '38db138bf7b3b15a1de1e665889d460f', '2018-10-22 00:42:11', b'0', b'1'),
('GV003', '1db4f0cf129cdd9dc7546e9879b98d30', '2018-10-22 00:42:11', b'0', b'0'),
('GV004', '6b9be4488606310a78dff8f616cd1046', '2018-11-07 07:58:02', b'0', b'1'),
('GV005', 'c98d68e21f78ec793c924e70c2ce05fe', '2018-11-18 17:40:18', b'0', b'1'),
('GV006', 'e60ac09ab75c656b762ab3b5ad1647b5', '2018-11-26 08:50:07', b'0', b'1'),
('GV007', 'beb9e83d073bfb123573c2dc48d2f029', '2018-11-26 10:57:28', b'0', b'1'),
('GV008', '5e018e9badaf99e2eb6ec245db6dc65b', '2018-11-26 17:48:23', b'0', b'1'),
('GV009', 'addca990186731f71dff4f165d48ade5', '2018-11-26 17:55:01', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID` varchar(15) COLLATE utf8_bin NOT NULL,
  `NAME` varchar(45) COLLATE utf8_bin NOT NULL,
  `DOB` date NOT NULL,
  `IDENTIFYCARDNUMBER` varchar(45) COLLATE utf8_bin NOT NULL,
  `GENDER` varchar(3) COLLATE utf8_bin NOT NULL,
  `PHONENUMBER` varchar(15) COLLATE utf8_bin NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_bin NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf8_bin NOT NULL,
  `COUNTRY` varchar(100) COLLATE utf8_bin NOT NULL,
  `RELIGION` varchar(45) COLLATE utf8_bin NOT NULL,
  `STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `NAME`, `DOB`, `IDENTIFYCARDNUMBER`, `GENDER`, `PHONENUMBER`, `EMAIL`, `ADDRESS`, `COUNTRY`, `RELIGION`, `STATUS`) VALUES
('AD001', 'Nguyễn Quốc Bảo', '1997-11-28', '123456789', 'Nam', '01283561316', 'quocbao281197@gmail.com', '182 B4 Phạm Phú Thứ Phường 4 Quận 6', 'Ben Tre', 'Chúa', 1),
('AD002', 'PHAMNHATDUY', '1997-11-30', '123456781', 'Nam', '01273571317', 'nhatduypham05@gmail.com', 'None', 'Long An', 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `ID` varchar(15) COLLATE utf8_bin NOT NULL,
  `TITLE` varchar(1000) COLLATE utf8_bin NOT NULL,
  `CONTENT` text COLLATE utf8_bin NOT NULL,
  `IDADMIN` varchar(15) COLLATE utf8_bin NOT NULL,
  `DATEPOST` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`ID`, `TITLE`, `CONTENT`, `IDADMIN`, `DATEPOST`) VALUES
('TB001', 'Admin Testing Upload new Announcement', 'foo<br />bar<br />baz<br />', 'AD001', '2018-11-19'),
('TB002', 'vasfasfasf', 'afasfas\r\nfasfaf\r\nfasfasf\r\nfasfa', 'AD001', '2018-11-20'),
('TB003', 'fafafafafaf', 'fasfasfa\r\nfasfasfas\r\nfasfasfasfafasfafsgdkjvhlb', 'AD001', '2018-11-20'),
('TB004', 'fasfasfasfaf', '3hweyeybeby\r\nyberbyewybwebybyw', 'AD001', '2018-11-20'),
('TB005', 'dad', 'wrrqr\r\nrqwrqr\r\nrqwrqrwq', 'AD001', '2018-11-20'),
('TB006', 'twebwtwbtwtb', 'wetbwbqtbwt\n\r\nfafafjafafjalsjfa;lsj\n', 'AD001', '2018-11-20'),
('TB007', 'bao dep trai', 'btwebtqwtbtbw<br>\r\nhfafhovwot<br>', 'AD001', '2018-11-20'),
('TB008', 'bao dep trai 2', 'fafasfasf<br />\r\nfasfasfasfasfas<br />\r\nfasfafasfavsdzxvz', 'AD001', '2018-11-20'),
('TB009', 'Bảo Đẹp trai 3', 'Đẹp trai quá<br />\r\nBảo ơi<br />\r\nBảo', 'AD001', '2018-11-20'),
('TB010', 'Nguyễn Quốc Bảo', 'Nguyễn Quốc Bảo - 51503199 - 15050301<br />\r\nPhạm Nhất Duy<br />\r\nNguyễn Gia An', 'AD001', '2018-11-21'),
('TB011', 'tafasafasfasfa', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', 'AD001', '2018-11-24'),
('TB012', 'Test lần 6', 'Bảo<br />\r\nĐẹp Trai', 'AD001', '2018-11-24'),
('TB013', 'safsafa', 'crvtwoevoq;wyv;owvt;oty;wv;wovt;owvt<br />\r\nsdlhnflsah;h;v.<br />\r\nlotvhwovybwov<br />\r\nvweiotwoivytowyvovytowv<br />\r\nwveibiwevtiwe', 'AD001', '2018-11-24'),
('TB014', 'test', 'test', 'AD001', '2018-11-25'),
('TB015', 'Thông báo cơn bão đổ bộ vào Sài Gòn', 'Thứ 2 được nghỉ học nha mấy em<br />\r\nThứ 3 đi học bình thường', 'AD001', '2018-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `logging`
--

CREATE TABLE IF NOT EXISTS `logging` (
  `ACCOUNTLOGGER` varchar(15) COLLATE utf8_bin NOT NULL,
  `DATE` date NOT NULL,
  `TIMESTART` time NOT NULL,
  `TIMEOUT` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logging`
--

INSERT INTO `logging` (`ACCOUNTLOGGER`, `DATE`, `TIMESTART`, `TIMEOUT`) VALUES
('AD001', '2018-11-03', '01:14:49', '01:14:58'),
('AD001', '2018-11-03', '10:25:56', '10:26:56'),
('AD001', '2018-11-03', '10:41:38', '00:00:00'),
('AD001', '2018-11-03', '10:55:30', '11:10:42'),
('AD001', '2018-11-03', '11:18:20', '00:00:00'),
('AD001', '2018-11-03', '12:28:57', '00:00:00'),
('AD001', '2018-11-03', '12:41:34', '00:00:00'),
('AD001', '2018-11-03', '14:42:24', '00:00:00'),
('AD001', '2018-11-03', '15:45:05', '00:00:00'),
('AD001', '2018-11-03', '15:46:39', '15:52:31'),
('AD001', '2018-11-03', '15:52:36', '15:53:27'),
('AD001', '2018-11-03', '15:53:36', '00:00:00'),
('AD001', '2018-11-03', '15:54:56', '15:57:50'),
('AD001', '2018-11-03', '15:57:55', '16:19:43'),
('AD001', '2018-11-03', '16:19:47', '16:20:46'),
('AD001', '2018-11-05', '20:54:39', '00:00:00'),
('AD001', '2018-11-05', '23:06:00', '00:00:00'),
('AD001', '2018-11-06', '12:53:21', '00:00:00'),
('AD001', '2018-11-06', '14:45:05', '00:00:00'),
('AD001', '2018-11-07', '07:21:38', '00:00:00'),
('AD001', '2018-11-07', '07:22:00', '08:38:17'),
('AD001', '2018-11-17', '17:35:34', '00:00:00'),
('AD001', '2018-11-17', '23:58:42', '00:00:00'),
('AD001', '2018-11-18', '15:55:14', '00:00:00'),
('AD001', '2018-11-19', '09:39:37', '00:00:00'),
('AD001', '2018-11-19', '23:20:37', '00:00:00'),
('AD001', '2018-11-20', '01:42:01', '01:43:14'),
('AD001', '2018-11-21', '07:02:26', '07:10:28'),
('AD001', '2018-11-24', '20:12:23', '20:20:31'),
('AD001', '2018-11-24', '20:21:57', '00:00:00'),
('AD001', '2018-11-24', '20:52:21', '00:00:00'),
('AD001', '2018-11-24', '22:28:41', '22:34:30'),
('AD001', '2018-11-26', '08:43:49', '00:00:00'),
('AD001', '2018-11-26', '08:44:50', '00:00:00'),
('AD001', '2018-11-26', '08:45:54', '17:56:39'),
('GV001', '2018-11-03', '10:29:47', '10:41:27'),
('GV001', '2018-11-03', '16:20:50', '16:42:26'),
('GV001', '2018-11-07', '08:38:22', '00:00:00'),
('GV001', '2018-11-21', '07:10:39', '00:00:00'),
('GV001', '2018-11-21', '07:10:49', '07:12:53'),
('GV001', '2018-11-24', '01:38:19', '00:00:00'),
('GV001', '2018-11-24', '15:16:28', '20:12:09'),
('GV001', '2018-11-25', '01:06:07', '00:00:00'),
('GV001', '2018-11-25', '16:02:08', '11:50:38'),
('GV001', '2018-11-26', '11:50:43', '11:54:22'),
('GV001', '2018-11-26', '11:54:28', '00:00:00'),
('GV001', '2018-11-26', '11:54:31', '00:00:00'),
('GV001', '2018-11-26', '11:54:42', '00:00:00'),
('GV001', '2018-11-26', '11:55:05', '00:00:00'),
('GV001', '2018-11-26', '11:55:09', '11:58:20'),
('GV001', '2018-11-26', '11:58:34', '17:22:34'),
('GV001', '2018-11-26', '17:24:23', '18:06:00'),
('GV009', '2018-11-26', '17:55:35', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `ID` varchar(15) COLLATE utf8_bin NOT NULL,
  `POSITIONNAME` varchar(45) COLLATE utf8_bin NOT NULL,
  `IDTEACHER` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`ID`, `POSITIONNAME`, `IDTEACHER`) VALUES
('001', 'Hiệu Trường', 'GV002'),
('002', 'Hiệu Phó', 'GV001'),
('003', 'Giáo Viên', 'GV003'),
('004', 'Giáo Viên', 'GV001'),
('005', 'Giáo Viên', 'GV002');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `ID` varchar(15) COLLATE utf8_bin NOT NULL,
  `MONTH` varchar(2) CHARACTER SET utf8 NOT NULL,
  `YEAR` int(11) NOT NULL,
  `TOTAL` decimal(13,3) NOT NULL,
  `TEACHER_ID` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`ID`, `MONTH`, `YEAR`, `TOTAL`, `TEACHER_ID`) VALUES
('LB001', '01', 2018, '8000000.000', 'GV001'),
('LB001', '02', 2018, '9000000.000', 'GV001'),
('LB001', '03', 2018, '10000000.000', 'GV001'),
('LB001', '04', 2018, '5000000.000', 'GV001'),
('LB001', '05', 2018, '8000000.000', 'GV001'),
('LB001', '06', 2018, '9000000.000', 'GV001'),
('LB001', '07', 2018, '12000000.000', 'GV001'),
('LB001', '08', 2018, '8000000.000', 'GV001'),
('LB001', '09', 2018, '11000000.000', 'GV001'),
('LB001', '10', 2018, '9000000.000', 'GV001'),
('LB001', '10', 2020, '10000000.000', 'GV001'),
('LB001', '11', 2018, '10000000.000', 'GV001'),
('LB002', '03', 2016, '10000000.000', 'GV002'),
('LB002', '11', 2018, '12000000.000', 'GV002'),
('LB003', '10', 2018, '11500000.000', 'GV003'),
('LB003', '11', 2016, '10000000.000', 'GV003');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `ID` varchar(15) COLLATE utf8_bin NOT NULL,
  `DAY` int(11) NOT NULL,
  `SHIFT` int(11) NOT NULL,
  `LOCATION` varchar(45) COLLATE utf8_bin NOT NULL,
  `SEMESTER` varchar(2) COLLATE utf8_bin NOT NULL,
  `YEAR` varchar(45) COLLATE utf8_bin NOT NULL,
  `IDTEACHER` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `IDTEACHER`) VALUES
('SC001', 2, 2, 'A300', 'I', '2018', 'GV001'),
('SC001', 2, 4, 'B004', 'I', '2018', 'GV001'),
('SC001', 2, 7, 'A300', 'I', '2018', 'GV001'),
('SC001', 2, 8, 'A300', 'I', '2018', 'GV001'),
('SC001', 3, 3, 'B004', 'I', '2018', 'GV001'),
('SC001', 3, 5, 'B004', 'I', '2018', 'GV001'),
('SC001', 3, 6, 'B004', 'I', '2018', 'GV001'),
('SC001', 4, 1, 'A300', 'I', '2018', 'GV001'),
('SC001', 4, 6, 'B004', 'I', '2018', 'GV001'),
('SC001', 4, 8, 'C207', 'I', '2018', 'GV001'),
('SC001', 5, 1, 'B004', 'I', '2018', 'GV001'),
('SC001', 5, 3, 'B004', 'I', '2018', 'GV001'),
('SC001', 5, 7, 'C207', 'I', '2018', 'GV001'),
('SC001', 5, 9, 'B004', 'I', '2018', 'GV001'),
('SC001', 6, 3, 'C207', 'I', '2018', 'GV001'),
('SC001', 6, 4, 'B004', 'I', '2018', 'GV001'),
('SC001', 7, 6, 'C207', 'I', '2018', 'GV001'),
('SC002', 2, 2, 'A002', 'I', '2018', 'GV002'),
('SC002', 2, 3, 'A002', 'I', '2018', 'GV002'),
('SC002', 2, 10, 'A300', 'I', '2018', 'GV002'),
('SC002', 3, 4, 'C207', 'I', '2018', 'GV002'),
('SC002', 3, 5, 'C207', 'I', '2018', 'GV002'),
('SC002', 3, 6, 'C207', 'I', '2018', 'GV002'),
('SC002', 3, 8, 'B004', 'I', '2018', 'GV002'),
('SC002', 4, 1, 'C207', 'I', '2018', 'GV002'),
('SC002', 4, 2, 'C207', 'I', '2018', 'GV002'),
('SC002', 5, 2, 'C207', 'I', '2018', 'GV002'),
('SC002', 5, 4, 'B004', 'I', '2018', 'GV002'),
('SC002', 5, 5, 'B004', 'I', '2018', 'GV002'),
('SC002', 5, 6, 'A300', 'II', '2018', 'GV002'),
('SC002', 6, 3, 'C207', 'I', '2018', 'GV002'),
('SC002', 6, 4, 'A002', 'I', '2018', 'GV002'),
('SC002', 6, 5, 'B004', 'I', '2018', 'GV002'),
('SC002', 7, 1, 'B004', 'I', '2018', 'GV002'),
('SC002', 7, 2, 'C207', 'I', '2018', 'GV002'),
('SC002', 7, 5, 'B004', 'I', '2018', 'GV002'),
('SC003', 2, 3, 'A300', 'I', '2020', 'GV003'),
('SC003', 2, 4, 'A300', 'I', '2020', 'GV003'),
('SC004', 3, 4, 'A300', 'I', '2018', 'GV004'),
('SC005', 4, 1, 'A300', 'I', '2018', 'GV005'),
('SC006', 0, 0, '0', '0', '0000', 'GV006'),
('SC007', 0, 0, '0', '0', '0000', 'GV007'),
('SC008', 0, 0, '0', '0', '0000', 'GV008'),
('SC009', 0, 0, '0', '0', '0000', 'GV009');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `ID` varchar(15) COLLATE utf8_bin NOT NULL,
  `NAME` varchar(45) COLLATE utf8_bin NOT NULL,
  `DOB` date NOT NULL,
  `IDENTIFYCARDNUMBER` varchar(15) COLLATE utf8_bin NOT NULL,
  `GENDER` varchar(3) COLLATE utf8_bin NOT NULL,
  `PHONENUMBER` varchar(15) COLLATE utf8_bin NOT NULL,
  `COUNTRY` varchar(45) COLLATE utf8_bin NOT NULL,
  `EMAIL` varchar(45) COLLATE utf8_bin NOT NULL,
  `ADDRESS` varchar(45) COLLATE utf8_bin NOT NULL,
  `RELIGION` varchar(45) COLLATE utf8_bin NOT NULL,
  `STATUS` bit(1) NOT NULL,
  `SUBJECT_NAME` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`ID`, `NAME`, `DOB`, `IDENTIFYCARDNUMBER`, `GENDER`, `PHONENUMBER`, `COUNTRY`, `EMAIL`, `ADDRESS`, `RELIGION`, `STATUS`, `SUBJECT_NAME`) VALUES
('GV001', 'Nguyễn Quốc Bảo', '1997-12-18', '025703124', 'Nam', '01202471540', 'TP Hồ Chí Minh', 'nhatduylaconcho@gmail.com11', 'Q5', 'None', b'1', 'Toán'),
('GV002', 'Trương Trấn Hào', '1997-07-03', '025703124', 'Nam', '01202471541', 'Trung Quốc', 'truongtranhao1997@gmail.com', 'Quận 5', 'None', b'0', 'Vật lý'),
('GV003', 'Lưu Trung Đạt 1', '1997-09-12', '025703124', 'Nam', '01202471543', 'Hồng Kông', 'dashluu9121997@gmail.com', 'Quận 5', 'None', b'0', 'Hóa học'),
('GV004', 'Phạm Nhất Duy', '1997-12-20', '9876516132', 'Nam', '1321654564', 'TP Hồ Chí Minh', 'nhatduylaconcho@gmail.com', '4654654', 'Hoi Giao', b'0', 'Ngữ Văn'),
('GV005', 'Hồ Cẩm Đào 2', '1997-12-20', '9876516132', 'Nam', '012024715401', 'TP Hồ Chí Minh', 'dkmDCSVN@gmail.com', 'Đường Phạm Thế Hiển Q8', 'Hoi Giao', b'1', 'Sử'),
('GV006', 'Bảo', '1997-12-20', '0257031241', 'Nam', '1321654564', 'Bến Tre', 'bao@gmail.com', 'ihfsalahs', 'Hoi Giao', b'1', 'Địa Lý'),
('GV007', 'Bảo', '1997-11-29', '0257031245', 'Nam', '1321654564', 'Bến Tre', 'bao@gmail.com', 'Pham The Hien', 'Hoi Giao', b'1', 'Giáo dục công dân'),
('GV008', 'Phạm Nhất Duy', '2018-11-02', '12345678', 'Nam', '1321654564', 'TP Hồ Chí Minh 1', 'bao@gmail.com', 'Pham The Hien', 'Hoi Giao', b'1', 'Công nghệ'),
('GV009', 'Bảo Đẹp Trai', '2018-11-19', '025703124fsaf', 'Nam', '012024715401', 'TP Hồ Chí Minh', 'bao@gmail.com', 'Q5', 'Hoi Giao', b'0', 'Tin học');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`ID`), ADD KEY `fk_ANNOUNCEMENT_Admin1` (`IDADMIN`);

--
-- Indexes for table `logging`
--
ALTER TABLE `logging`
 ADD PRIMARY KEY (`ACCOUNTLOGGER`,`DATE`,`TIMESTART`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`ID`), ADD KEY `fk_POSITION_TEACHER1` (`IDTEACHER`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
 ADD PRIMARY KEY (`ID`,`MONTH`,`YEAR`), ADD KEY `fk_SALARY_TEACHER1` (`TEACHER_ID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
 ADD PRIMARY KEY (`ID`,`DAY`,`SHIFT`), ADD KEY `fk_SCHEDULE_TEACHER1` (`IDTEACHER`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `fk_Admin_ACCOUNT` FOREIGN KEY (`ID`) REFERENCES `account` (`USERNAME`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
ADD CONSTRAINT `fk_ANNOUNCEMENT_Admin1` FOREIGN KEY (`IDADMIN`) REFERENCES `admin` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `logging`
--
ALTER TABLE `logging`
ADD CONSTRAINT `fk_LOGGING_ACCOUNT1` FOREIGN KEY (`ACCOUNTLOGGER`) REFERENCES `account` (`USERNAME`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `position`
--
ALTER TABLE `position`
ADD CONSTRAINT `fk_POSITION_TEACHER1` FOREIGN KEY (`IDTEACHER`) REFERENCES `teacher` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
ADD CONSTRAINT `fk_SALARY_TEACHER1` FOREIGN KEY (`TEACHER_ID`) REFERENCES `teacher` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
ADD CONSTRAINT `fk_SCHEDULE_TEACHER1` FOREIGN KEY (`IDTEACHER`) REFERENCES `teacher` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
