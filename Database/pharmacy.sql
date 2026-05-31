-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2026 at 02:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `item_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `med_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`item_id`, `bill_id`, `med_id`, `qty`, `price`, `subtotal`) VALUES
(1, 0, 1, 1, 45.00, 45.00),
(2, 0, 2, 2, 750.00, 1500.00),
(3, 0, 1, 1, 45.00, 45.00),
(4, 0, 1, 10, 45.00, 450.00),
(5, 0, 1, 80, 45.00, 3600.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `cus_id` varchar(18) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `m_name` varchar(200) NOT NULL,
  `s_name` varchar(200) NOT NULL,
  `fl_name` varchar(350) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(250) NOT NULL,
  `con_no` int(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cus_id`, `f_name`, `m_name`, `s_name`, `fl_name`, `gender`, `dob`, `age`, `address`, `city`, `con_no`, `email`, `pass`) VALUES
(30, 'CUS0001', 'Haresh', 'Sapath', 'Hewage', 'Haresh Sapath Hewage', 'Male', '1990-03-10', 36, '101 විනයාලංකාර මාවත', 'කොළඹ', 716043227, 'hareshhewage@gmail.com', 'P@ssw0rd'),
(31, 'CUS0002', 'Hashan', '', 'Perera', 'Hashan  Perera', 'Male', '2005-03-10', 21, 'No.31, Murutalawa Road,\r\nPeradeniya', 'Kandy', 716666666, 'kandyfellow@gmail.com', 'P@ssw0rd'),
(58, 'CUS0003', 'Kasun', '', 'Shanaka', 'Kasun  Shanaka', 'Male', '2006-06-12', 19, 'Colombo Sri Lanka', 'Kandy', 716043227, 'haresh.groupit@delmege.co', 'P@ssw0rd'),
(59, 'CUS0004', 'Nisal', '', 'Rathnayake', 'Nisal  Rathnayake', 'Male', '2000-03-10', 26, 'Kandy', 'Mathara', 716043227, 'nisal.groupit@delmege.com', '$2y$10$4pUdXMNiAJeSdAshTZEGb.ndw/j/3KIswNhjaWMLa1060HG38.gB.'),
(79, 'CUS0005', 'Haresh', 'Sapath', 'Hewage', 'Haresh Sapath Hewage', 'Male', '1998-03-10', 28, '101 විනයාලංකාර මාවත', 'කොළඹ', 712626265, 'hareshhewage@gmail.com', '$2y$10$uJvzOzaWJF//9JL4zeSwY.aTi0DTVpcTZD/zfsE7gsGabmRca2Cua'),
(94, 'CUS0006', 'Kushan', 'Naveendra', 'Rathnayake', 'Kushan Naveendra Rathnayake', 'Male', '1990-08-25', 35, 'Goyindala,\r\nPilimathalawa', 'Kandy', 718053556, 'kushan@gmail.com', 'P@ssw0rd'),
(95, 'CUS0007', 'Shanaz', 'Sapath', 'T', 'Shanaz Sapath T', 'Male', '1990-03-10', 36, '32', 'Kandy', 716043227, 'hareshhewage@gmail.com', 'P@ssw0rd');

-- --------------------------------------------------------

--
-- Table structure for table `item_master`
--

CREATE TABLE `item_master` (
  `item_no` varchar(10) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `unit_measurement` varchar(50) DEFAULT NULL,
  `manufacturer_country` varchar(100) DEFAULT NULL,
  `pack_size` int(11) DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_master`
--

INSERT INTO `item_master` (`item_no`, `item_name`, `description`, `brand`, `unit_measurement`, `manufacturer_country`, `pack_size`, `unit_cost`, `unit_price`) VALUES
('ITM0001', 'Plaster', 'Detol Plaster', 'detol', 'Capsule', 'india', 10, 450.00, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `med_id` int(11) NOT NULL,
  `med_name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `exp_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`med_id`, `med_name`, `category`, `qty`, `price`, `exp_date`) VALUES
(1, 'Penadol', 'Tablet', 8, 45.00, '2026-05-10'),
(2, 'Palster', 'Bandege', 98, 750.00, '2028-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `po_id` varchar(20) NOT NULL,
  `vendor_id` varchar(20) NOT NULL,
  `po_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`po_id`, `vendor_id`, `po_date`, `total_amount`) VALUES
('PO0001', 'VEN0001', '2026-05-11', 0.00),
('PO0002', 'VEN0001', '2026-05-11', 0.00),
('PO0003', 'VEN0001', '2026-05-11', 0.00),
('PO0004', 'VEN0001', '2026-05-11', 0.00),
('PO0005', 'VEN0001', '2026-05-11', 0.00),
('PO0006', 'VEN0001', '2026-05-11', 0.00),
('PO0007', 'VEN0001', '2026-05-11', 0.00),
('PO0008', 'VEN0001', '2026-05-11', 0.00),
('PO0009', 'VEN0001', '2026-05-11', 0.00),
('PO0010', 'VEN0001', '2026-05-11', 0.00),
('PO0011', 'VEN0001', '2026-05-11', 0.00),
('PO0012', 'VEN0001', '2026-05-11', 0.00),
('PO0013', 'VEN0001', '2026-05-11', 0.00),
('PO0014', 'VEN0001', '2026-05-11', 0.00),
('PO0015', 'VEN0001', '2026-05-11', 0.00),
('PO0016', 'VEN0001', '2026-05-11', 0.00),
('PO0017', 'VEN0001', '2026-05-11', 0.00),
('PO0018', 'VEN0001', '2026-05-11', 0.00),
('PO0019', 'VEN0001', '2026-05-11', 0.00),
('PO0020', 'VEN0001', '2026-05-11', 0.00),
('PO0021', 'VEN0001', '2026-05-11', 0.00),
('PO0022', 'VEN0001', '2026-05-11', 0.00),
('PO0023', 'VEN0001', '2026-05-11', 0.00),
('PO0024', 'VEN0001', '2026-05-11', 0.00),
('PO0025', 'VEN0001', '2026-05-11', 0.00),
('PO0026', 'VEN0001', '2026-05-11', 0.00),
('PO0027', 'VEN0001', '2026-05-11', 0.00),
('PO0028', 'VEN0001', '2026-05-11', 0.00),
('PO0029', 'VEN0001', '2026-05-11', 0.00),
('PO0030', 'VEN0001', '2026-05-11', 0.00),
('PO0031', 'VEN0001', '2026-05-11', 0.00),
('PO0032', 'VEN0001', '2026-05-11', 0.00),
('PO0033', 'VEN0001', '2026-05-11', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order1`
--

CREATE TABLE `purchase_order1` (
  `po_no` varchar(10) NOT NULL,
  `vendor_no` varchar(10) DEFAULT NULL,
  `vendor_name` varchar(100) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `item_no` varchar(10) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order1`
--

INSERT INTO `purchase_order1` (`po_no`, `vendor_no`, `vendor_name`, `po_date`, `item_no`, `item_name`, `expiry_date`, `cost`, `quantity`, `total_cost`) VALUES
('PO0001', 'VEN0001', 'Eden Pharmasyticals', '2026-05-11', 'ITM0001', 'Plaster', '2026-05-20', 2000.00, 45, 90000.00);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` varchar(10) NOT NULL,
  `vendor_name` varchar(100) DEFAULT NULL,
  `business_registration` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `business_registration`, `country`, `postal_code`, `address`, `address2`, `contact_person`, `mobile`, `contact_no`, `fax`, `email`) VALUES
('VEN0001', 'Eden Pharmasyticals', '14567', 'Sri Lanka', '456', '42', '45', 'Sunil', '0748033651', '0812388646', '0812388616', 'haresh.groupit@delmege.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cus_id` (`cus_id`);

--
-- Indexes for table `item_master`
--
ALTER TABLE `item_master`
  ADD PRIMARY KEY (`item_no`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `purchase_order1`
--
ALTER TABLE `purchase_order1`
  ADD PRIMARY KEY (`po_no`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
