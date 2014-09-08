-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Generation Time: 26-Mar-2014 às 11:01
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- Estrutura da tabela `contact_form`

CREATE TABLE IF NOT EXISTS `contact_form` (
  `contact_form_id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_form_date` date NOT NULL DEFAULT '0000-00-00',
  `contact_form_firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_form_lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_form_useremail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_form_usersubject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_form_usermessage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_form_department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`contact_form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;