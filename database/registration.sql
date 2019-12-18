-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2019 at 09:49 AM
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

CREATE TABLE IF NOT EXISTS `history` (
  `transaction_id` int(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` double NOT NULL,
  `transaction_type` varchar(15) NOT NULL DEFAULT 'WalletFund',
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`transaction_id`, `email`, `transaction_date`, `amount`, `transaction_type`) VALUES
(3, 'wendy@gmail.com', '2019-12-10 10:57:47', 15000, 'WalletFund'),
(4, 'wendy@gmail.com', '2019-12-10 14:03:31', 100000, 'WalletFund'),
(5, 'wendy@gmail.com', '2019-12-14 22:13:51', 300, 'WalletFund'),
(6, 'wendy@gmail.com', '2019-12-15 14:52:47', 500, 'WalletFund'),
(8, 'wendy@gmail.com', '2019-12-17 11:38:35', 15000, 'Acceptance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
(1, 'WendyHats', 'wendy@gmail.com', 'e0dd692dcb560bc04bfa1cbfaca9ecff', 85800, 0, 500),
(2, 'Yekinni', 'wendy4ril@gmail.com', '2cff03e4b9eb85b3bf5e924ccdc1348d', 900, 0, 900);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

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
(0, 0, 0, 30000, 'wendy@gmail.com');
