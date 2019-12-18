-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2019 at 01:16 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `transaction_id` int(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` double NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`transaction_id`, `email`, `transaction_date`, `amount`) VALUES
(3, 'wendy@gmail.com', '2019-12-10 10:57:47', 15000),
(4, 'wendy@gmail.com', '2019-12-10 14:03:31', 100000),
(5, 'wendy@gmail.com', '2019-12-14 22:13:51', 300);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `wallet_balance` int(7) NOT NULL DEFAULT '0',
  `bonus` int(7) NOT NULL DEFAULT '0',
  `last_payment_amount` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `wallet_balance`, `bonus`, `last_payment_amount`) VALUES
(1, 'WendyHats', 'wendy@gmail.com', 'e0dd692dcb560bc04bfa1cbfaca9ecff', 115300, 0, 300),
(2, 'Yekinni', 'wendy4ril@gmail.com', '2cff03e4b9eb85b3bf5e924ccdc1348d', 900, 0, 900);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(3) NOT NULL,
  `wallet_balance` int(7) NOT NULL,
  `bonus` int(5) NOT NULL,
  `last_payment_amt` int(7) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `wallet_balance`, `bonus`, `last_payment_amt`, `email`) VALUES
(0, 0, 0, 300, 'wendy@gmail.com');
