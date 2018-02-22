-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 02 月 17 日 23:24
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
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` char(20) NOT NULL,
  `password` char(50) NOT NULL,
  `type` int(11) NOT NULL,
  `sign` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`, `type`, `sign`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, '超级用户来的'),
('user', 'user', 0, '一般的用户'),
('3', '3', 0, ''),
('2', '2', 0, ''),
('1', '1', 0, ''),
('12', '12', 0, ''),
('1234', '1234', 0, ''),
('123', '123', 0, ''),
('4', '4', 0, ''),
('1212', '1212', 0, ''),
('1q', '1q', 0, '1q'),
('16677', '16677', 0, '16677');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
