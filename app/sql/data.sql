-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2016 at 01:59 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `gid` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '商品名字',
  `info` text NOT NULL COMMENT '商品介绍',
  `avatar` varchar(50) NOT NULL COMMENT '商品图片',
  `type` enum('medicinal','food','livinggoods') NOT NULL COMMENT '商品类型',
  `price` int(10) UNSIGNED NOT NULL COMMENT '商品价格',
  `order_num` int(10) UNSIGNED NOT NULL COMMENT '销量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '帖子创建人id',
  `title` varchar(255) NOT NULL COMMENT '帖子名字',
  `content` text NOT NULL COMMENT '帖子内容',
  `post_num` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ctime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子创建时间',
  `mtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '最后更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gid`, `uid`, `title`, `content`, `post_num`, `ctime`, `mtime`) VALUES
(3, 9, '丫丫小屁孩丫丫小屁孩丫丫小屁孩丫丫小屁孩', '丫丫小屁孩', 0, 1462356116, 1462356116),
(2, 9, '丫丫就是一个小屁孩', '小屁孩啊小屁孩', 2, 1462354851, 1462354851),
(12, 16, '瞎写', '详情......我红叶谷黑白世界上唯一', 1, 1463797173, 1463797173),
(9, 9, 'aaaaa', 'Lorem ipsum dolor sit er elit lamet, consectetaur cillium adipisicing pecu, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nam liber te conscient to factor tum poen legum odioque civiuda.', 6, 1463386680, 1463386680),
(5, 9, '这是接口测试', '测试内容123123', 2, 1462810611, 1462810611),
(11, 9, '高规格', '详情......哈哈哈哈', 1, 1463755433, 1463755433),
(10, 13, 'hhhhh', 'ttyy trousers raj jab an a. \nAds \n \nS \nAs \nD ', 1, 1463404369, 1463404369),
(13, 16, '123', '详情......测试', 1, 1463799847, 1463799847);

-- --------------------------------------------------------

--
-- Table structure for table `groups_ding`
--

CREATE TABLE `groups_ding` (
  `gd_id` int(10) UNSIGNED NOT NULL,
  `gid` int(10) UNSIGNED NOT NULL COMMENT '帖子id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '点赞时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_ding`
--

INSERT INTO `groups_ding` (`gd_id`, `gid`, `uid`, `ctime`) VALUES
(2, 2, 9, 1462684980);

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
(2, 2, '沙发', 9, 1462687681),
(5, 5, 'Kkkk', 9, 1463494291),
(12, 10, 'hahahah', 9, 1463536512),
(13, 9, 'Wee', 9, 1463704252),
(17, 9, '玉体\n', 9, 1463755409),
(18, 11, '我们', 16, 1463794665),
(19, 13, '我的', 16, 1463799860),
(20, 12, 'Ssdad', 9, 1463801268);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `lid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `token` varchar(50) NOT NULL COMMENT 'token',
  `etime` int(10) UNSIGNED NOT NULL COMMENT '过期时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`lid`, `uid`, `token`, `etime`) VALUES
(3, 9, '7ctkclf5wrcw808gg8cw4gkc4k8c4ow', 1466399786),
(4, 10, '1hmentc5qn7okwgc8kwc0cw0gsck84g', 1464968890),
(5, 13, 'oiusia1kxwggockowwckw8ks8g0sggo', 1465996325),
(6, 14, 'laphsqq56lcgwkockwkkko8gg0gsks8', 1465288724),
(7, 11, '2tut2t8ctgow4w4sk8cowo0gwk0w8oc', 1466006059),
(8, 15, '3a9sirsb2akggc48kwg04g4gg8o0k4w', 1466269075),
(9, 16, 'lo9m4er2d0gk48k0c0o0kc8scss80og', 1466401689);

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `nid` int(10) UNSIGNED NOT NULL,
  `from_id` int(10) UNSIGNED NOT NULL COMMENT '发起人',
  `to_id` int(10) UNSIGNED NOT NULL COMMENT '发给谁',
  `content` text NOT NULL COMMENT '通知内容',
  `type` varchar(20) NOT NULL DEFAULT 'default' COMMENT '通知类型',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '发送时间',
  `is_read` tinyint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否已读'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `oid` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '订单标题',
  `amount` int(10) UNSIGNED NOT NULL COMMENT '订单金额',
  `data` varchar(255) NOT NULL COMMENT '订单内容',
  `status` enum('created','paid','closed') NOT NULL COMMENT '订单状态',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `ptime` int(10) UNSIGNED NOT NULL COMMENT '付款时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `pid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `pname` varchar(50) NOT NULL COMMENT '宠物名字',
  `avatar` varchar(50) DEFAULT NULL COMMENT '宠物头像',
  `sex` enum('gong','mu') NOT NULL DEFAULT 'gong' COMMENT '宠物性别',
  `age` int(10) UNSIGNED NOT NULL COMMENT '宠物年纪',
  `type` enum('dog','cat','reptile','other') NOT NULL COMMENT '宠物类型',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '宠物创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`pid`, `uid`, `pname`, `avatar`, `sex`, `age`, `type`, `ctime`) VALUES
(16, 9, 'ssww', 'pet_16_36197c69', 'mu', 3, 'reptile', 1463802982),
(15, 16, '源源', NULL, 'gong', 1, 'dog', 1463800089),
(14, 16, '123', NULL, 'gong', 123, 'cat', 1463799924),
(11, 15, 'pony', NULL, 'mu', 2, 'cat', 1463677166),
(9, 13, 'kkk', 'pet_9_a4e83aaa', 'mu', 2, 'reptile', 1463377315),
(10, 9, 'orange', NULL, 'gong', 2, 'dog', 1463579110);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `mobile` varchar(20) NOT NULL COMMENT '手机',
  `avatar` varchar(50) DEFAULT NULL COMMENT '头像',
  `sex` enum('male','female') NOT NULL DEFAULT 'male' COMMENT '性别',
  `ctime` int(10) UNSIGNED NOT NULL COMMENT '注册时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `mobile`, `avatar`, `sex`, `ctime`) VALUES
(9, 'coco12', '8ddcff3a80f4189ca1c9d4d902c3c909', '18768176260', 'user_9_84c97354.', 'male', 1462253881),
(10, '1709', 'e10adc3949ba59abbe56e057f20f883e', '13300000000', 'user_10_3a5800fc.jpg', 'male', 1462294842),
(11, '2513', 'e10adc3949ba59abbe56e057f20f883e', '13300000001', NULL, 'male', 1462371309),
(12, '9445', 'e10adc3949ba59abbe56e057f20f883e', '13300000002', NULL, 'male', 1462371453),
(13, '3586', '25d55ad283aa400af464c76d713c07ad', '13300000003', 'user_13_8b475a0f', 'male', 1462374260),
(14, '4899', '25d55ad283aa400af464c76d713c07ad', '13300000007', 'user_14_30736856.', 'male', 1462631010),
(15, 'test09', '25d55ad283aa400af464c76d713c07ad', '13300000009', 'user_15_d3e54f9f', 'female', 1463677063),
(16, '3220', '25d55ad283aa400af464c76d713c07ad', '13777556506', NULL, 'male', 1463757959);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `vid` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `pid` int(10) UNSIGNED NOT NULL COMMENT '宠物id',
  `vinfo` text NOT NULL COMMENT '宠物状况',
  `mobile` varchar(30) NOT NULL COMMENT '联系方式',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `ctime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`vid`, `uid`, `pid`, `vinfo`, `mobile`, `address`, `ctime`) VALUES
(3, 9, 4, '细小', '18754121121', '北京三环山区', 1463554900),
(5, 9, 10, '细小', '18754121121', '北京三环山区', 1463554900),
(6, 9, 10, '123123', 'QQQQQQ.com', 'where', 1463644709),
(7, 16, 13, '啦啦啦啦啦啦', '1234666666', '设计师将', 1463758684),
(8, 16, 13, 'Uuuu', '2233567', '好后悔过', 1463794634),
(9, 16, 13, '我的心\n', '1377569293', '我的心里都会', 1463799696);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `groups_ding`
--
ALTER TABLE `groups_ding`
  ADD PRIMARY KEY (`gd_id`);

--
-- Indexes for table `groups_post`
--
ALTER TABLE `groups_post`
  ADD PRIMARY KEY (`gp_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`lid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `to_id` (`to_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `mobile` (`mobile`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `gid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `groups_ding`
--
ALTER TABLE `groups_ding`
  MODIFY `gd_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groups_post`
--
ALTER TABLE `groups_post`
  MODIFY `gp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `nid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `oid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `vid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;