-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 10:53 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `aName` varchar(50) NOT NULL,
  `aEmail` varchar(100) NOT NULL,
  `aPassword` varchar(100) NOT NULL,
  `aDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aName`, `aEmail`, `aPassword`, `aDate`) VALUES
(1, 'Anand', 'Anand@arfeenkhan.com', '123456', '2019-12-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `cName` varchar(200) NOT NULL,
  `cStatus` int(100) NOT NULL DEFAULT 1,
  `cDate` datetime NOT NULL,
  `cDp` varchar(200) NOT NULL,
  `adminid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `cName`, `cStatus`, `cDate`, `cDp`, `adminid`) VALUES
(19, 'Phone', 1, '2019-12-18 01:44:10', 'Mobile.jpg', 1),
(20, 'Computer', 1, '2019-12-18 01:44:17', 'comp.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `mid` int(11) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `mDate` datetime NOT NULL,
  `mStatus` int(11) NOT NULL DEFAULT 1,
  `productid` int(111) NOT NULL,
  `adminid` int(100) NOT NULL,
  `mDp` varchar(200) NOT NULL,
  `mDescription` longtext NOT NULL,
  `mPrice` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`mid`, `mName`, `mDate`, `mStatus`, `productid`, `adminid`, `mDp`, `mDescription`, `mPrice`) VALUES
(10, 'Iphone 6s plus', '2019-12-18 02:00:10', 1, 6, 1, 'iphine1.jpg', '6.1-inch Liquid Retina HD LCD display\r\nWater and dust resistant (2 meters for up to 30 minutes, IP68)\r\nDual-camera system with 12MP Ultra Wide and Wide cameras; Night mode, Portrait mode, and 4K video up to 60fps\r\n12MP TrueDepth front camera with Portrait mode, 4K video, and Slo-Mo\r\nFace ID for secure authentication and Apple Pay\r\nA13 Bionic chip with third-generation Neural Engine\r\nFast-charge capable\r\nWireless charging 1', 42000);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `p_text` text NOT NULL,
  `p_date` datetime NOT NULL,
  `p_status` int(50) NOT NULL DEFAULT 1,
  `p_slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`p_id`, `p_name`, `p_text`, `p_date`, `p_status`, `p_slug`) VALUES
(1, 'anand sharma', 'teat test teat', '2019-11-27 10:16:22', 1, 'anand-sharma');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pName` varchar(200) NOT NULL,
  `pStatus` int(100) NOT NULL DEFAULT 1,
  `pDate` datetime NOT NULL,
  `categoriyid` int(111) NOT NULL,
  `adminid` int(100) NOT NULL,
  `pDp` varchar(200) NOT NULL,
  `pCompany` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pName`, `pStatus`, `pDate`, `categoriyid`, `adminid`, `pDp`, `pCompany`) VALUES
(6, 'Iphone', 1, '2019-12-18 01:54:08', 19, 1, 'iphine.jpg', 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `spid` int(11) NOT NULL,
  `spName` varchar(200) NOT NULL,
  `spDate` datetime NOT NULL,
  `spStatus` int(111) NOT NULL DEFAULT 1,
  `adminid` int(111) NOT NULL,
  `modelid` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`spid`, `spName`, `spDate`, `spStatus`, `adminid`, `modelid`) VALUES
(22, 'color', '2019-12-13 01:39:26', 1, 1, 8),
(24, 'color', '2019-12-13 01:39:26', 1, 1, 10),
(25, 'Ram', '2019-12-19 10:24:47', 1, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `specs_value`
--

CREATE TABLE `specs_value` (
  `spvid` int(11) NOT NULL,
  `spvName` varchar(200) NOT NULL,
  `spid` int(111) NOT NULL,
  `adminid` int(111) NOT NULL,
  `spvStatus` int(11) NOT NULL DEFAULT 1,
  `spvDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specs_value`
--

INSERT INTO `specs_value` (`spvid`, `spvName`, `spid`, `adminid`, `spvStatus`, `spvDate`) VALUES
(4, 'blue', 22, 1, 1, '2019-12-13 01:39:26'),
(5, 'green', 22, 1, 1, '2019-12-13 01:39:26'),
(8, 'blue', 24, 1, 1, '2019-12-13 01:39:26'),
(9, 'green', 24, 1, 1, '2019-12-13 01:39:26'),
(10, '8gb', 25, 1, 1, '2019-12-19 10:24:47'),
(11, '6gb', 25, 1, 1, '2019-12-19 10:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stid` int(11) NOT NULL,
  `stName` varchar(150) NOT NULL,
  `stEmail` varchar(200) NOT NULL,
  `stPassword` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `stDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stid`, `stName`, `stEmail`, `stPassword`, `status`, `stDate`) VALUES
(30, 'sss', 'sharmaanand086@gmail.com', '12', 0, '2019-11-22 08:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `link` text NOT NULL,
  `date` datetime NOT NULL,
  `Status` int(111) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `first_name`, `last_name`, `email`, `password`, `link`, `date`, `Status`) VALUES
(4, 'anand', 'sharma', 'anand@arfeenkhan.com', '81dc9bdb52d04dc20036dbd8313ed055', 'VFblgZ2jPBmYntUe6Sup', '2019-12-18 08:25:30', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `adminid` (`adminid`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `categoriyid` (`categoriyid`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`spid`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `modelid` (`modelid`);

--
-- Indexes for table `specs_value`
--
ALTER TABLE `specs_value`
  ADD PRIMARY KEY (`spvid`),
  ADD KEY `specs_value_ibfk_1` (`adminid`),
  ADD KEY `specs_value_ibfk_2` (`spid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `specs_value`
--
ALTER TABLE `specs_value`
  MODIFY `spvid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `models_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`categoriyid`) REFERENCES `categories` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specs`
--
ALTER TABLE `specs`
  ADD CONSTRAINT `specs_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specs_value`
--
ALTER TABLE `specs_value`
  ADD CONSTRAINT `specs_value_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specs_value_ibfk_2` FOREIGN KEY (`spid`) REFERENCES `specs` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
