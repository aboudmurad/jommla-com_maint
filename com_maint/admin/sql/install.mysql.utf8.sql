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

DROP TABLE IF EXISTS `#__maint_money`;
CREATE TABLE `#__maint_money` (
  `id` int(111) 	  unsigned NOT NULL AUTO_INCREMENT,
  `datetime_from` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_to` TIMESTAMP NULL,
  `worker_id` int(111) 	  unsigned NOT NULL,
  `manager_id` int(111) 	  unsigned NOT NULL DEFAULT '0',
  `money` int(111) 	  unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `datetime_from` (`datetime_from`),
  KEY `worker_id` (`worker_id`),
  KEY `manager_id` (`manager_id`),
  KEY `datetime_to` (`datetime_to`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


INSERT INTO `#__maint_money` (`worker_id`, `money`, `datetime_to`) VALUES
(42, 20, NOW());
--
-- Table structure for table `ly9lb_clients`
--

DROP TABLE IF EXISTS `#__maint_clients`;
CREATE TABLE `#__maint_clients` (
  `id` int(111) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`phone`, `email`, `name`)  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


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
  `id` int(111) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(111) unsigned NOT NULL,
  `workers_fixer_id` int(111) unsigned NOT NULL,
  `workers_recipient_id` int(111) unsigned NOT NULL,

  `device_type` varchar(120) NOT NULL,
  `device_desc` TEXT NULL ,
  `device_accessories` TEXT NULL ,
  `work_required` TEXT NOT NULL,
  `fixed`   BOOLEAN    NOT NULL DEFAULT '0',
  `work_done` text,
  
  `extra_parts_notes` TEXT NULL,
  `extra_parts_notes_paied` BOOLEAN    NOT NULL DEFAULT '0',

  `total_money` int(11) NOT NULL DEFAULT '0',
  `discount_money` int(11) NOT NULL DEFAULT '0',
  `paied_money` int(11) NOT NULL DEFAULT '0',
  `left_money` int(11) NOT NULL DEFAULT '0',

  `entered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fixed_at` timestamp NULL DEFAULT NULL,
  `delivered_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `device_type` (`device_type`) ,
  KEY `client_id` (`client_id`) ,
  KEY `fixed` (`fixed`) 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ly9lb_orders`
--

INSERT INTO `#__maint_orders` (`client_id`,`workers_recipient_id` , `device_type`,`device_accessories`, `device_desc`, `work_required`, `total_money`, `discount_money`, `paied_money`, `left_money`) VALUES
    (1, 42, 'HardDisk', 'كيس', 'Western Digital', 'Fix Media', 120, 20, 50, 50);
