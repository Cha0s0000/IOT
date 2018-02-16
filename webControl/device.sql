-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 02 月 17 日 00:18
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `air_quality`
--

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `ID` int(11) NOT NULL,
  `data_airQuality` float NOT NULL,
  `data_distance` int(11) NOT NULL,
  `data_voice` int(11) NOT NULL,
  `data_light` int(11) NOT NULL,
  `data_humi` float NOT NULL,
  `data_temp` float NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `timestamp` varchar(30) NOT NULL,
  `online_or_not` int(11) NOT NULL,
  `user` char(100) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `device`
--

INSERT INTO `device` (`num`, `ID`, `data_airQuality`, `data_distance`, `data_voice`, `data_light`, `data_humi`, `data_temp`, `client_id`, `timestamp`, `online_or_not`, `user`) VALUES
(5, 0, 0, 0, 0, 0, 0, 0, '7f0000010b5400000076', '2018 02 09 01:19:11pm', 0, '3'),
(11, 1, 1, 1, 1, 1, 0, 0, '7f0000010b5400000002', '2017 11 23 04:29:24am', 0, 'user'),
(6, 2147483647, 212, 12, 121, 212, 12, 212, '121212121', '', 0, 'user'),
(7, 2332231, 12, 12, 21, 12, 21, 12, '12345678765432', '', 1, 'user'),
(8, 34334, 234, 234, 234, 234, 23, 23, '1234554321', '', 0, 'user'),
(9, 214748372, 1, 3, 2, 3, 4, 5, '6789876543211', '', 1, 'user'),
(10, 23322345, 1, 3, 2, 3, 4, 5, '6789876543211', '', 1, 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
