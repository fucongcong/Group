-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2016 at 02:00 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `scarf`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `fid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `fuid` int(10) UNSIGNED NOT NULL,
  `ctime` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`fid`, `uid`, `fuid`, `ctime`) VALUES
(1, 5, 1, 0),
(2, 5, 3, 0),
(9, 3, 1, 0),
(10, 6, 3, 0),
(12, 3, 6, 0),
(13, 3, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '帖子创建人id',
  `title` varchar(255) NOT NULL COMMENT '帖子名字',
  `content` text NOT NULL COMMENT '帖子内容',
  `ctime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子创建时间',
  `mtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '最后回复时间',
  `post_num` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gid`, `uid`, `title`, `content`, `ctime`, `mtime`, `post_num`) VALUES
(1, 3, '一卡通', '今天上课路上 在西和公寓附近丢失了！！', 1462854293, 1462854293, 11),
(2, 1, '我女朋友丢了', '可以找回来吗。。。。。', 1462854431, 1462854431, 9),
(3, 5, '计算机二级课本', '不知道在哪里在哪里', 1463279465, 1463279465, 7),
(4, 5, '手机iphone6s plus', '图书馆附近丢失', 1463279502, 1463279502, 7),
(5, 5, '自行车', '我想买一辆 ', 1463279529, 1463279529, 7),
(6, 3, '铅笔', 'ssz', 1463393924, 1463393924, 4),
(7, 3, '橡皮', '橡皮丢了的点点滴滴点点滴滴', 1463393940, 1463393940, 4),
(8, 3, '橡皮', '橡皮子弹击中横梁后再次', 1463393955, 1463393955, 4),
(9, 3, '发夹', '橡皮章六天了。我的心理准备金', 1463393967, 1463393967, 4),
(10, 3, '想想', '得到的点点滴滴？你就', 1463393983, 1463393983, 4),
(11, 3, '电脑', '橡皮子弹击中我也有很久', 1463393997, 1463393997, 4),
(12, 3, '找英语课本', '在图书馆东楼2楼 遗失。上午10点左右', 1463543197, 1463543197, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups_collect`
--

CREATE TABLE `groups_collect` (
  `gc_id` int(10) UNSIGNED NOT NULL,
  `gid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `ctime` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_collect`
--

INSERT INTO `groups_collect` (`gc_id`, `gid`, `uid`, `ctime`) VALUES
(1, 2, 3, 1463380993),
(2, 3, 3, 1463381010),
(4, 5, 3, 1463381324),
(5, 1, 3, 1463394033),
(6, 11, 3, 1463394707),
(7, 4, 3, 1463395191),
(11, 8, 3, 1463521545);

-- --------------------------------------------------------

--
-- Table structure for table `groups_post`
--

CREATE TABLE `groups_post` (
  `gp_id` int(10) UNSIGNED NOT NULL,
  `gid` int(10) UNSIGNED NOT NULL COMMENT '帖子id',
  `content` text NOT NULL COMMENT '回帖内容',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '回帖时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_post`
--

INSERT INTO `groups_post` (`gp_id`, `gid`, `content`, `uid`, `ctime`) VALUES
(1, 1, '联系我', 3, 1462854307),
(2, 1, '我没看到啊', 1, 1462854341),
(3, 2, '要什么女朋友？', 3, 1462854917),
(4, 2, '完美', 1, 1462940915),
(5, 4, '有人去看的到吗', 5, 1463279623),
(6, 2, '点信心', 5, 1463279721),
(7, 2, '仿佛次', 5, 1463279734),
(8, 3, '想想', 3, 1463394716),
(9, 11, '我看到一台b480 thinkpad', 6, 1463395300),
(10, 8, '学弟', 3, 1463443584),
(11, 12, '谁有线索', 3, 1463557843);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `to_uid` int(10) UNSIGNED NOT NULL,
  `ctime` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(4) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `uid`, `to_uid`, `ctime`, `content`, `is_read`) VALUES
(1, 3, 1, 1463455362, 'hi', 1),
(2, 4, 1, 1463455372, '可以勾搭吗', 1),
(3, 1, 3, 1463455609, '好哒', 1),
(4, 1, 3, 1463455623, '你是哪个学院的？', 1),
(5, 3, 1, 1463455655, '艺术学院', 1),
(6, 1, 3, 1463455761, '我也是啊', 1),
(7, 1, 3, 1463455909, '单身', 1),
(8, 3, 6, 1463460174, '勾搭吗', 0),
(9, 3, 6, 1463460175, '勾搭吗', 0),
(10, 3, 1, 1463460254, '我们不约', 1),
(11, 1, 4, 1463481861, '来啊 勾搭', 0),
(12, 3, 1, 1463543030, '黄志忠', 1),
(13, 1, 3, 1463561312, '？bb', 1),
(14, 3, 1, 1463561331, '什么？', 1),
(15, 1, 4, 1464590049, '', 0),
(16, 1, 4, 1464590054, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scarf`
--

CREATE TABLE `scarf` (
  `sid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `to_uid` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `ctime` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scarf`
--

INSERT INTO `scarf` (`sid`, `uid`, `to_uid`, `content`, `ctime`) VALUES
(1, 3, 5, '', 1463542464),
(2, 3, 5, '感谢你帮我找到了电脑，给你一个赞。么么哒', 1463542840),
(3, 1, 3, '谢谢帮我找到东西', 1463542929),
(4, 3, 4, '谢谢帮我找东西！么么哒', 1463543007);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `avatar` varchar(50) DEFAULT NULL COMMENT '头像',
  `sex` enum('male','female') NOT NULL DEFAULT 'male' COMMENT '性别',
  `school` varchar(50) DEFAULT NULL COMMENT '学校',
  `content` varchar(255) NOT NULL DEFAULT '',
  `sign` varchar(255) NOT NULL DEFAULT '',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '注册时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `email`, `avatar`, `sex`, `school`, `content`, `sign`, `ctime`) VALUES
(1, '灵梦', 'b0baee9d279d34fa1dfd71aadb908c3f', 'test@test.com', NULL, 'male', NULL, '', '', 1462788267),
(2, '伤感', 'b0baee9d279d34fa1dfd71aadb908c3f', 'tora@tora.com', NULL, 'male', NULL, '', '', 1462788494),
(3, '陌路', 'e10adc3949ba59abbe56e057f20f883e', '664985936@qq.com', NULL, 'female', NULL, '哥是风一样的男人', '别被我迷倒', 1462788906),
(4, '饭糕', 'c32ecc29cedc6b26049aa46e3012458a', '375174419@qq.com', NULL, 'male', NULL, '', '', 1462789007),
(5, '青峰虾', 'b0baee9d279d34fa1dfd71aadb908c3f', '1234@qq.com', NULL, 'female', NULL, '我是小飞侠', '帅气逼人', 1463279381),
(6, '小麦', 'b0baee9d279d34fa1dfd71aadb908c3f', '123@163.com', NULL, 'male', NULL, '', '', 1463395223),
(7, '我是', 'b0baee9d279d34fa1dfd71aadb908c3f', '111@qq.com', NULL, 'female', NULL, '帅', '', 1463543238);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `groups_collect`
--
ALTER TABLE `groups_collect`
  ADD PRIMARY KEY (`gc_id`);

--
-- Indexes for table `groups_post`
--
ALTER TABLE `groups_post`
  ADD PRIMARY KEY (`gp_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `scarf`
--
ALTER TABLE `scarf`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `fid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `groups_collect`
--
ALTER TABLE `groups_collect`
  MODIFY `gc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `groups_post`
--
ALTER TABLE `groups_post`
  MODIFY `gp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `scarf`
--
ALTER TABLE `scarf`
  MODIFY `sid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;