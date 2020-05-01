-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 01, 2020 at 08:21 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ihistory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article`
--

CREATE TABLE `tbl_article` (
  `articleId` int(11) NOT NULL,
  `articleTitle` text NOT NULL,
  `articleType` enum('CONT','EVNT','NEWS','') NOT NULL,
  `fromDate` datetime NOT NULL,
  `toDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_article`
--

INSERT INTO `tbl_article` (`articleId`, `articleTitle`, `articleType`, `fromDate`, `toDate`) VALUES
(1, 'Home Page', 'CONT', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Article 2', 'EVNT', '2020-04-29 00:00:00', '2020-05-02 00:00:00'),
(3, 'Article 3', 'NEWS', '2020-04-29 00:00:00', '2020-05-01 00:00:00'),
(4, 'Article 4', 'CONT', '2020-04-29 00:00:00', '2020-05-01 00:00:00'),
(5, 'Article 5', 'EVNT', '2020-04-30 00:00:00', '2020-04-30 00:00:00'),
(6, 'History of Magadh', 'CONT', '2020-04-23 00:00:00', '2030-04-23 00:00:00'),
(7, 'History of Jagannath Temple', 'CONT', '2020-04-03 00:00:00', '2030-04-03 00:00:00'),
(8, 'History of Jagannath Temple', 'CONT', '2020-04-03 00:00:00', '2030-04-03 00:00:00'),
(9, 'History of Jagannath Temple', 'CONT', '2020-04-03 00:00:00', '2030-04-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_article_content_map`
--

CREATE TABLE `tbl_article_content_map` (
  `articleId` int(11) NOT NULL,
  `contentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `contentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `contentTitle` varchar(200) NOT NULL,
  `isPublished` int(11) NOT NULL,
  `publishedBy` varchar(100) NOT NULL,
  `addedBy` varchar(100) NOT NULL,
  `addedDate` datetime NOT NULL,
  `isActive` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`contentId`, `content`, `contentTitle`, `isPublished`, `publishedBy`, `addedBy`, `addedDate`, `isActive`) VALUES
(1, 'Home Page Description', 'Hom Page', 1, '1', '1', '2020-05-01 01:58:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_digitalcontent`
--

CREATE TABLE `tbl_digitalcontent` (
  `fileId` int(11) NOT NULL,
  `fileType` enum('IMG','VID','PDF') NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `addedDate` date NOT NULL,
  `addedBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `eventId` int(11) NOT NULL,
  `eventTitle` varchar(255) NOT NULL,
  `eventLocation` varchar(255) NOT NULL,
  `eventOrganizers` varchar(255) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `galleryId` int(11) NOT NULL,
  `eventDescription` varchar(255) NOT NULL,
  `articleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `newsId` int(11) NOT NULL,
  `newsTitle` varchar(255) NOT NULL,
  `newsDesc` text NOT NULL,
  `newsDate` date NOT NULL,
  `newsSource` varchar(255) NOT NULL,
  `newsReportedBy` varchar(255) NOT NULL,
  `galleryId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nodetree`
--

CREATE TABLE `tbl_nodetree` (
  `nodeId` int(11) NOT NULL,
  `nodeParentId` int(11) NOT NULL,
  `nodeText` varchar(200) NOT NULL,
  `nodeDesc` text NOT NULL,
  `articleId` int(11) NOT NULL,
  `treeType` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nodetree`
--

INSERT INTO `tbl_nodetree` (`nodeId`, `nodeParentId`, `nodeText`, `nodeDesc`, `articleId`, `treeType`) VALUES
(1, 1, 'About US Page', '', 1, 'TM'),
(2, 1, 'Contact Pge', '', 3, 'Artcles'),
(3, 1, 'Home', '', 0, 'Tags'),
(4, 1, 'Home', '', 0, 'Tags'),
(5, 1, 'Home', '', 0, 'Tags'),
(6, 6, 'gallery', '', 9, 'TM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPass` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `desig` enum('SA','MOD','REV','ADM') NOT NULL,
  `addedBy` varchar(200) NOT NULL,
  `addedDate` date NOT NULL,
  `phone` varchar(10) NOT NULL,
  `isActive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `userName`, `userPass`, `email`, `desig`, `addedBy`, `addedDate`, `phone`, `isActive`) VALUES
(1, 'admin', 'e6e061838856bf47e1de730719fb2609', 'panigrahi.abhinaya@gmail.com', 'SA', '', '0000-00-00', '9538982801', 1),
(6, 'Abhinaya', '5b7450a63b4c6b4d336113d4ab634fbb', 'abhi@rmail.com', 'REV', '', '0000-00-00', '9898989898', 1),
(14, 'Amlan Pa', '21eb15938f33882ed7fd185b3cd465ca', 'am@gmail.com', 'MOD', '', '0000-00-00', '8787898987', 0),
(26, 'Sagar', '2157889b9c48d4f40da8a05b89df8920', 'sg@gmail.com', 'ADM', '', '0000-00-00', '9999999999', 1),
(30, 'Rahul', 'ebaaba27b32928a25f2ad6185fc0cc74', 'rahul@gmail.com', '', '', '0000-00-00', '6565656565', 0),
(39, 'Gunjan', 'dce4087bfe5249b2f3e9f981876541d1', 'gunjan@gmail.com', 'ADM', '', '0000-00-00', '9904046224', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD PRIMARY KEY (`articleId`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`contentId`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `tbl_nodetree`
--
ALTER TABLE `tbl_nodetree`
  ADD PRIMARY KEY (`nodeId`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_article`
--
ALTER TABLE `tbl_article`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `contentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_nodetree`
--
ALTER TABLE `tbl_nodetree`
  MODIFY `nodeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
