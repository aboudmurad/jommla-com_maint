-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2011 at 08:12 PM
-- Server version: 5.5.14
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ahmed_joomla`
--

-- --------------------------------------------------------

--
-- Table structure for table `ly9lb_clients`
--

DROP TABLE IF EXISTS `#__maint_clients`;
CREATE TABLE `#__maint_clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`phone`, `email`, `name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


--
-- Dumping data for table `ly9lb_clients`
--

INSERT INTO `#__maint_clients` (`id`, `name`, `phone`, `email`) VALUES
(2, 'ابراهيم طه مصطفي', '01111379666', 'i.taha@gmail.com'),
(1, 'احمد محمد عربي', '01119329693', 'araby.ahmed@gmail.com');


-- --------------------------------------------------------

--
-- Table structure for table `ly9lb_orders`
--

DROP TABLE IF EXISTS `#__maint_orders`;
CREATE TABLE `#__maint_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `workers_fixer_id` int(10) unsigned NOT NULL,
  `workers_recipient_id` int(10) unsigned NOT NULL,

  `device_type` varchar(255) NOT NULL,
  `device_desc` TEXT NULL ,
  `work_required` TEXT NOT NULL,
  `fixed`   BOOLEAN    NOT NULL DEFAULT '0',

  `work_done` text,

  `total_money` int(11) NOT NULL DEFAULT '0',
  `discount_money` int(11) NOT NULL DEFAULT '0',
  `paied_money` int(11) NOT NULL DEFAULT '0',
  `left_money` int(11) NOT NULL DEFAULT '0',

  `entered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fixed_at` timestamp NULL DEFAULT NULL,
  `delivered_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `device_type` (`device_type`),
  KEY `client_id` (`client_id`),
  KEY `fixed` (`fixed`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ly9lb_orders`
--

INSERT INTO `#__maint_orders` (`client_id`,`workers_recipient_id` , `device_type`, `device_desc`, `work_required`, `total_money`, `discount_money`, `paied_money`, `left_money`) VALUES
    (1, 1, 'HardDisk', 'Western Digital', 'Fix Media', 120, 20, 50, 50);