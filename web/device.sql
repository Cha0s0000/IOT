-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 02 月 09 日 13:16
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
  `data_pm` int(11) NOT NULL,
  `data_co` int(11) NOT NULL,
  `data_pwm` int(11) NOT NULL,
  `data_temp` int(11) NOT NULL,
  `data_switch_one` int(11) NOT NULL,
  `data_switch_two` int(11) NOT NULL,
  `data_switch_three` int(11) NOT NULL,
  `data_switch_four` int(11) NOT NULL,
  `data_switch_mode` int(11) NOT NULL,
  `client_id` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `timestamp` varchar(30) NOT NULL,
  `online_or_not` int(11) NOT NULL,
  `user` char(100) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `device`
--

INSERT INTO `device` (`num`, `ID`, `data_pm`, `data_co`, `data_pwm`, `data_temp`, `data_switch_one`, `data_switch_two`, `data_switch_three`, `data_switch_four`, `data_switch_mode`, `client_id`, `name`, `timestamp`, `online_or_not`, `user`) VALUES
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '7f0000010b5400000076', '121121', '2018 02 09 01:16:58pm', 0, '3'),
(11, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, '7f0000010b5400000002', '', '2017 11 23 04:29:24am', 0, 'user'),
(6, 2147483647, 212, 12, 121, 212, 12, 212, 2, 2, 1, '121212121', '教室1', '', 0, 'user'),
(7, 2332231, 12, 12, 21, 12, 21, 12, 2, 1, 1, '12345678765432', '教室2', '', 1, 'user'),
(8, 34334, 234, 234, 234, 234, 23, 23, 123, 23, 234, '1234554321', '教室3', '', 0, 'user'),
(9, 214748372, 1, 3, 2, 3, 4, 5, 2, 23, 1, '6789876543211', '教室里1234', '', 1, 'user'),
(10, 23322345, 1, 3, 2, 3, 4, 5, 2, 23, 1, '6789876543211', 'a教学楼', '', 1, 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
