-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-07-25 07:35:20
-- 服务器版本： 10.1.37-MariaDB
-- PHP 版本： 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `buglist`
--

-- --------------------------------------------------------

--
-- 表的结构 `bug`
--

CREATE TABLE `bug` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descript` varchar(255) NOT NULL,
  `raise_id` int(5) NOT NULL,
  `duty_id` int(5) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status_id` int(5) NOT NULL,
  `status_flag` int(5) NOT NULL,
  `version` varchar(10) NOT NULL,
  `last_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `descript`
--

CREATE TABLE `descript` (
  `id` int(5) NOT NULL,
  `content` varchar(255) NOT NULL,
  `bug_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `people`
--

CREATE TABLE `people` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE `status` (
  `id` int(5) NOT NULL,
  `status_name` varchar(10) NOT NULL,
  `status_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `bug`
--
ALTER TABLE `bug`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `descript`
--
ALTER TABLE `descript`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bug`
--
ALTER TABLE `bug`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `descript`
--
ALTER TABLE `descript`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `people`
--
ALTER TABLE `people`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `status`
--
ALTER TABLE `status`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
