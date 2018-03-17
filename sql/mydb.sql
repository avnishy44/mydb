-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2018 at 06:35 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address_line1` varchar(45) NOT NULL,
  `address_line2` varchar(45) NOT NULL,
  `address_city` varchar(45) NOT NULL,
  `address_state` varchar(45) NOT NULL,
  `address_pincode` varchar(45) NOT NULL,
  `address_landmark` varchar(45) NOT NULL,
  `address_code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_line1`, `address_line2`, `address_city`, `address_state`, `address_pincode`, `address_landmark`, `address_code`) VALUES
(1, 'vjti', 'matunga', 'mumbai', 'maharashtra', '400019', 'near khalsa college', '02aecb464c525e39bf796fd8dc0926f9bb939e5415ea5719815259bb8587c9ec'),
(2, 'khalsa college', 'matunga', 'mumbai', 'maharashtra', '400019', 'near vjti college', 'b7db0dc5371508d7617bd7149767b3f90d9c74afdf01e7c1ade686cebb72b87c'),
(3, 'vrl', 'cotton green', 'mumbai', 'maharashtra', '400019', 'badi dukaan', 'f914d08b7ce65c5b00323d396aad8f4733af408f847f1957867c8a6c6c6f9575'),
(4, 'a', 'a', 'a', 'a', 'a', 'a', 'f41cf479143e7c4124eaf7db1f49d14c9d98dc874cfc6f0ee5123a7c1097a866'),
(5, 'vjti hostel', 'matunga', 'mumbai', 'maharashtra', '400019', 'near khalsa', '327a1001a28dda39c2d2561d732b2eb4a9d797649a1396afbb4302f990bf9e26'),
(7, 'vjti', 'matunga', 'mumbai', 'maharashtra', '400019', 'near khalsa college', 'de68e6d5018436ceb964a87bf40fed62b8dcfa29525416c568bb47f9c2565104'),
(11, 'vjti', 'matunga', 'mumbai', 'maharashtra', '400019', 'near khalsa college', '977ea7e99b9a4f57baa1724584a691a10e0d2c9cd26fd1ec5460ecf534dbdccf'),
(14, 'a', 'a', 'a', 'a', 'a', 'a', '6e5d599e19bd32cd0d8eca5a2c9abcffdba6ecc9f86d89a9adf4420abb7a0571');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_firstname` varchar(45) NOT NULL,
  `customer_lastname` varchar(45) DEFAULT NULL,
  `customer_email` varchar(45) NOT NULL,
  `customer_contact` int(11) NOT NULL,
  `customer_dob` date NOT NULL,
  `address_address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_email`, `customer_contact`, `customer_dob`, `address_address_id`) VALUES
(1, 'avnish', 'yadav', 'avnish@avnish.com', 2147483647, '1998-01-27', 7),
(5, 'avnish', 'yadav', 'avnish1@avnish.com', 989889899, '1998-02-07', 11),
(7, 'a', 'a', 'as@a.a', 23456543, '2443-02-23', 14);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `product_sku` varchar(15) DEFAULT NULL,
  `product_costprice` varchar(45) NOT NULL,
  `product_sellingprice` varchar(45) NOT NULL,
  `product_dimensions` varchar(45) NOT NULL,
  `product_weight` varchar(45) NOT NULL,
  `product_description` text NOT NULL,
  `product_colour` varchar(45) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `supplier_supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`product_id`, `product_name`, `product_sku`, `product_costprice`, `product_sellingprice`, `product_dimensions`, `product_weight`, `product_description`, `product_colour`, `product_stock`, `supplier_supplier_id`) VALUES
(1, 'vinay', 'P1', '1000000000000', '9999999999999', '170', '65', 'mast maula', 'gora', 1, 5),
(2, 'vinay', 'P2', '1000000000000', '9999999999999', '170', '65', 'mast maula', 'gora', 1, 5),
(3, 'suraj', 'P3', '1000000009', '9999999999', '172', '70', 'kya', 'gora', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `product_quantity` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `additional_charges` varchar(45) DEFAULT NULL,
  `gst` varchar(45) DEFAULT NULL,
  `shipping_company` varchar(45) DEFAULT NULL,
  `shipping_charge` varchar(45) DEFAULT NULL,
  `tracking_link` varchar(60) DEFAULT NULL,
  `order_status` varchar(45) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `receiving_date` date DEFAULT NULL,
  `customer_customer_id` int(11) NOT NULL,
  `inventory_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `shipper_id` int(11) NOT NULL,
  `shipper_companyname` varchar(45) NOT NULL,
  `shipper_phone` varchar(45) NOT NULL,
  `shipper_email` varchar(45) NOT NULL,
  `order_order_id` int(11) NOT NULL,
  `order_inventory_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_companyname` varchar(45) NOT NULL,
  `supplier_contact` varchar(45) NOT NULL,
  `supplier_email` varchar(45) NOT NULL,
  `supplier_url` varchar(45) NOT NULL,
  `address_address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_companyname`, `supplier_contact`, `supplier_email`, `supplier_url`, `address_address_id`) VALUES
(1, 'vjti', '123456789', 'vjti@vjti.com', 'vjti.com', 1),
(2, 'khalsa sales', '987654321', 'khalsa@khalsa.com', 'khalsa.com', 2),
(3, 'vrl logistics', '245678678', 'vrl@vrl.com', 'vrl.com', 3),
(4, 'a', 'a', 'a@a.a', 'a.c', 4),
(5, 'sahil', '34567898', 'sahil@sahil.com', 'sahil.com', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `address_id_UNIQUE` (`address_id`),
  ADD UNIQUE KEY `address_code` (`address_code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `idcustomer_UNIQUE` (`customer_id`),
  ADD UNIQUE KEY `customer_email_UNIQUE` (`customer_email`),
  ADD UNIQUE KEY `customer_contact_UNIQUE` (`customer_contact`),
  ADD UNIQUE KEY `address_address_id` (`address_address_id`),
  ADD KEY `fk_customer_address1_idx` (`address_address_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD UNIQUE KEY `product_sku` (`product_sku`),
  ADD KEY `fk_inventory_supplier1_idx` (`supplier_supplier_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`,`inventory_product_id`),
  ADD KEY `fk_order_customer1_idx` (`customer_customer_id`),
  ADD KEY `inventory_product_id_idx` (`inventory_product_id`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`shipper_id`,`order_order_id`,`order_inventory_product_id`),
  ADD KEY `fk_shipper_order1_idx` (`order_order_id`,`order_inventory_product_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`),
  ADD UNIQUE KEY `supplier_email` (`supplier_email`),
  ADD KEY `fk_supplier_address1_idx` (`address_address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_address1` FOREIGN KEY (`address_address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_inventory_supplier1` FOREIGN KEY (`supplier_supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inventory_product_id` FOREIGN KEY (`inventory_product_id`) REFERENCES `inventory` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shipper`
--
ALTER TABLE `shipper`
  ADD CONSTRAINT `fk_shipper_order1` FOREIGN KEY (`order_order_id`,`order_inventory_product_id`) REFERENCES `order` (`order_id`, `inventory_product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `fk_supplier_address1` FOREIGN KEY (`address_address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
