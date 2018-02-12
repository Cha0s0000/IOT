-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2018 年 02 月 12 日 20:09
-- 服务器版本: 5.6.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_steemitcha0s0000`
--

-- --------------------------------------------------------

--
-- 表的结构 `switch`
--

CREATE TABLE IF NOT EXISTS `switch` (
  `ID` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `timestamp` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `switch`
--

INSERT INTO `switch` (`ID`, `state`, `timestamp`) VALUES
(1, 1, '08:05:05pm');
