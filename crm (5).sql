-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2020 at 06:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `asset_id` int(11) NOT NULL,
  `asset_code` varchar(65) NOT NULL,
  `asset_description` text NOT NULL,
  `category` varchar(65) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(65) NOT NULL,
  `purchase_date` date NOT NULL,
  `barcode` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `supervisor` int(11) NOT NULL,
  `arrived_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `closing_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `tumb_print` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_code` varchar(65) NOT NULL,
  `cust_reg_code` varchar(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact` varchar(65) NOT NULL,
  `address` text NOT NULL,
  `type` varchar(65) NOT NULL,
  `category` varchar(65) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_code`, `cust_reg_code`, `name`, `email`, `contact`, `address`, `type`, `category`, `status`) VALUES
(1, 'Matawalle4', 'Hooli/TECH/001', 'Adam', 'madam@hooli.ng', '2349028163380', 'Pluto, Milky way galaxy', 'Didnt Know', 'Well', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cust_disc`
--

CREATE TABLE `cust_disc` (
  `cust_disc_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `product_categ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cust_messages`
--

CREATE TABLE `cust_messages` (
  `cust_message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(65) NOT NULL,
  `duration` varchar(65) NOT NULL,
  `category` int(3) NOT NULL,
  `date_of_message` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `damage_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `details` text NOT NULL,
  `img_src` varchar(65) DEFAULT NULL,
  `damaged_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damages`
--

INSERT INTO `damages` (`damage_id`, `product`, `quantity`, `details`, `img_src`, `damaged_date`) VALUES
(5, 5, 3, 'asdasdasda', 'dfasfasdasdasda', '0000-00-00 00:00:00.000000'),
(6, 5, 1, 'asdasdas', 'fsdfsdfsd', '0000-00-00 00:00:00.000000');

--
-- Triggers `damages`
--
DELIMITER $$
CREATE TRIGGER `after_damages_insert` AFTER INSERT ON `damages` FOR EACH ROW UPDATE stocks SET quantity=quantity-new.quantity WHERE product=new.product AND quantity>0 AND quantity-new.quantity>-1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `driver_code` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `identity_card` text NOT NULL,
  `status` int(3) NOT NULL,
  `role` varchar(65) NOT NULL,
  `vehicle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `driver_code`, `phone`, `identity_card`, `status`, `role`, `vehicle`) VALUES
(1, 'Ranbaxy', '23456789000', 'PASSPORT 46789', 1, 'Driver', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipments_records`
--

CREATE TABLE `equipments_records` (
  `record_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `duration` text NOT NULL,
  `status` int(3) NOT NULL,
  `description` text NOT NULL,
  `item_code` int(11) NOT NULL,
  `doc_src` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `details` text NOT NULL,
  `order_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer`, `details`, `order_date`) VALUES
(1, 1, 'products:rice,beans,Banana,Mango;\r\nprices:20,30,40,50;\r\npuchasing_price:1,2,3,4;\r\norders:a,b,c,d', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `unit_measure` varchar(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privelages`
--

CREATE TABLE `privelages` (
  `priv_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `actions` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `assigner` int(11) NOT NULL,
  `user_menus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privelages`
--

INSERT INTO `privelages` (`priv_id`, `user`, `actions`, `last_updated`, `assigner`, `user_menus`) VALUES
(28, 1, 'refresh_user,assign_previleges,revoke_previlege,update_previlege,update_name,update_role,update_status,update_first_name', '2020-07-23 12:57:25.680972', 2, 'AB'),
(32, 3, 'added_new', '2020-07-23 17:18:11.117249', 1, 'AB'),
(35, 2, 'temper_table', '2020-07-23 17:23:27.759077', 1, 'AB');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `description` varchar(65) NOT NULL,
  `category` int(11) NOT NULL,
  `barcode` varchar(256) NOT NULL,
  `product_code` varchar(65) NOT NULL,
  `img_src` varchar(65) NOT NULL,
  `supplier` int(11) NOT NULL,
  `expiry_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `rack` int(11) NOT NULL,
  `item_type` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `description`, `category`, `barcode`, `product_code`, `img_src`, `supplier`, `expiry_date`, `rack`, `item_type`) VALUES
(5, 'Food Item', 1, 'sdasdasdasd', 'dasdasdasdaczx', 'fghdfkfjeaksdaksdak', 1, '0000-00-00 00:00:00.000000', 11, 'Consumables'),
(6, 'Vegetables', 1, 'fasdasjdasjdasj', 'asduaraysyas', 'sdasdaklsljasjdkasj', 1, '0000-00-00 00:00:00.000000', 11, 'Perishables');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `category_name` varchar(256) NOT NULL,
  `category_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `category_name`, `category_desc`) VALUES
(1, 'Food Items', 'This contains food supplement from Romania and other EU countries');

-- --------------------------------------------------------

--
-- Table structure for table `product_config`
--

CREATE TABLE `product_config` (
  `prod_config_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `unit_measure` varchar(65) NOT NULL,
  `unit_restr` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `product_disc_id` int(11) NOT NULL,
  `product_category` int(11) NOT NULL,
  `details` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date_from` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `date_after` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `invoice` varchar(65) NOT NULL,
  `request` int(11) NOT NULL,
  `purchased_qty` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `purchase_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `rack_id` int(11) NOT NULL,
  `rack_warehouse` int(11) NOT NULL,
  `rack_row` int(11) NOT NULL,
  `rack_column` int(11) NOT NULL,
  `rack_level` varchar(65) NOT NULL,
  `rack_zone` int(11) NOT NULL,
  `rack_position` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`rack_id`, `rack_warehouse`, `rack_row`, `rack_column`, `rack_level`, `rack_zone`, `rack_position`) VALUES
(11, 9, 3, 3, 'Level 4', 3, 'Middle');

-- --------------------------------------------------------

--
-- Table structure for table `receptions`
--

CREATE TABLE `receptions` (
  `reception_id` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `status` varchar(65) NOT NULL,
  `supplier` int(11) NOT NULL,
  `request_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests_hist`
--

CREATE TABLE `requests_hist` (
  `request_hist_id` int(11) NOT NULL,
  `negotiated_price` int(11) NOT NULL,
  `request` int(11) NOT NULL,
  `contract_price` int(11) NOT NULL,
  `history_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `invoice` varchar(65) NOT NULL,
  `seller` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `sold_qty` int(11) NOT NULL,
  `sales_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `invoice`, `seller`, `product`, `sold_qty`, `sales_date`, `order`) VALUES
(1, 'sdasdasdasd', 6, 6, 34, '0000-00-00 00:00:00.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_code` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `identity_card` varchar(6) NOT NULL,
  `role` varchar(65) NOT NULL,
  `dept` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `img_src` varchar(65) NOT NULL,
  `status` int(2) NOT NULL,
  `employment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_code`, `first_name`, `last_name`, `identity_card`, `role`, `dept`, `phone`, `email`, `address`, `img_src`, `status`, `employment_date`) VALUES
(3, 'ddd45ttu', 'Adam', 'Mustapha', 'Passpo', 'Driver', 'Production', '2349028163333', 'matawalle4u@gmail.com', 'Millionaire Quarters', 'sdasdasdasdasdasdas', 1, '2020-08-03'),
(4, 'test_Code101', 'First Edited', 'Daniel', '890987', 'Manager', 'Production', '09023467777', 'matawallepopa@gmail.com', 'Romania', 'uploads/logo.png', 7, '0000-00-00'),
(6, 'test_Code102', 'Popa Adam', 'Daniel', '890988', 'Manager', 'Production', '09023467777', 'matawallepopa@gmail.com', 'Romania', 'uploads/logo.png', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `staffs_contract`
--

CREATE TABLE `staffs_contract` (
  `contract_id` int(11) NOT NULL,
  `contract_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `staff` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `termination` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staffs_documents`
--

CREATE TABLE `staffs_documents` (
  `document_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(3) NOT NULL,
  `expiry` date NOT NULL,
  `doc_src` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staffs_rotation`
--

CREATE TABLE `staffs_rotation` (
  `rotation_id` int(11) NOT NULL,
  `staff` int(11) NOT NULL,
  `days_hours` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `rack` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(65) NOT NULL,
  `warehouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `product`, `rack`, `quantity`, `status`, `warehouse`) VALUES
(15, 5, 11, 50, '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_code` varchar(65) NOT NULL,
  `reg_code` varchar(65) DEFAULT NULL,
  `name` varchar(65) NOT NULL,
  `category` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `status` int(2) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_code`, `reg_code`, `name`, `category`, `phone`, `email`, `address`, `status`, `added_date`) VALUES
(1, 'Daniel001', 'danod i0123', 'Popa Daniel Adam', 'Food Supplement', '1234678', 'werty@gma.co', 'Roma', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tee`
--

CREATE TABLE `tee` (
  `email` varchar(65) NOT NULL,
  `suna` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tee`
--

INSERT INTO `tee` (`email`, `suna`) VALUES
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria'),
('Adam#sds$', 'Gashi ake a nigeria');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `transaction_table` varchar(65) NOT NULL,
  `table_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `transfer_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `transfer_docs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `transfers`
--
DELIMITER $$
CREATE TRIGGER `after_transfer_insert` AFTER INSERT ON `transfers` FOR EACH ROW UPDATE stocks SET quantity=quantity-new.quantity WHERE product=new.product AND warehouse=new.sender
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(35) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `password` varchar(65) NOT NULL,
  `status` int(2) NOT NULL,
  `last_coordinates` varchar(256) NOT NULL,
  `date_added` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `last_login` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `phone`, `name`, `email`, `role`, `password`, `status`, `last_coordinates`, `date_added`, `last_login`) VALUES
(1, '2349028163380', 'DDDDD Ada', 'matawalle4u@gmail.com', 'Deve', 'd90932f3ddd8e19e04825c5980da58f7', 1, '7.004346.22232', '2020-07-22 18:08:11.507158', '2020-07-22 18:08:11.507158'),
(2, '4902816338', 'Daniel', 'daniel@gmail.com', 'CEO', 'd90932f3ddd8e19e04825c5980da58f7', 1, '7.004346.22232', '2020-07-22 18:10:46.682033', '2020-07-22 18:10:46.682033'),
(3, '08034666113', 'Hauwa', 'hauwa@gmail.com', 'CEO', 'd90932f3ddd8e19e04825c5980da58f7', 0, '0.004346.22232', '2020-07-23 12:16:33.984602', '2020-07-23 12:16:33.984602');

-- --------------------------------------------------------

--
-- Table structure for table `users_messages`
--

CREATE TABLE `users_messages` (
  `user_message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(65) NOT NULL,
  `duration` varchar(65) NOT NULL,
  `category` int(3) NOT NULL,
  `date_of_message` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_updates`
--

CREATE TABLE `user_updates` (
  `user_updates_id` int(11) NOT NULL,
  `updater` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_previleges` text NOT NULL,
  `update_time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_updates`
--

INSERT INTO `user_updates` (`user_updates_id`, `updater`, `updated_user`, `updated_previleges`, `update_time`) VALUES
(1, 1, 1, 'PREVSSSS', '2020-08-04 18:52:30.000000'),
(2, 2, 2, 'PREVSSSS', '2020-08-04 20:39:49.000000');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_code` varchar(65) NOT NULL,
  `description` varchar(65) NOT NULL,
  `licence_expiry` date NOT NULL,
  `insurance_expiry` date NOT NULL,
  `other_expiries` date DEFAULT NULL,
  `category` varchar(65) NOT NULL,
  `gps_data` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_code`, `description`, `licence_expiry`, `insurance_expiry`, `other_expiries`, `category`, `gps_data`) VALUES
(1, 'MERCEDES009', 'The latest', '2020-08-19', '2020-08-14', '2020-08-28', 'Lorry', '123.90,234.56.57');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `warehouse_id` int(11) NOT NULL,
  `warehouse_name` varchar(65) NOT NULL,
  `warehouse_address` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`warehouse_id`, `warehouse_name`, `warehouse_address`) VALUES
(3, 'Updated Name 3333', 'Iasi Nigeria Romania'),
(4, 'Updated Name', 'Iasi Nigeria Romania'),
(5, 'Warehouse Iasi', 'Iasi Nigeria Romania'),
(6, 'Warehouse Iasi', 'Iasi Nigeria Romania'),
(7, 'Adamawa', 'Iasi Nigeria Romania'),
(8, 'Zaria', 'Iasi Nigeria Romania'),
(9, 'Kaduna', 'Iasi Nigeria Romania'),
(10, 'Bucharest', 'Iasi Nigeria Romania');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_zones`
--

CREATE TABLE `warehouse_zones` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(65) NOT NULL,
  `zone_warehouse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse_zones`
--

INSERT INTO `warehouse_zones` (`zone_id`, `zone_name`, `zone_warehouse`) VALUES
(1, 'Damage zone', 3),
(2, 'Reception zone', 3),
(3, 'Delivery Zone', 3),
(6, 'l', 4),
(9, 'Sa', 4),
(10, 'T', 3),
(11, 'Fat', 8),
(12, 'ku', 10),
(13, 'Damage Zaria', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`asset_id`),
  ADD UNIQUE KEY `asset_code` (`asset_code`),
  ADD KEY `warehouse` (`warehouse`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `staff` (`staff`),
  ADD KEY `supervisor` (`supervisor`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `cust_disc`
--
ALTER TABLE `cust_disc`
  ADD PRIMARY KEY (`cust_disc_id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `product_categ` (`product_categ`);

--
-- Indexes for table `cust_messages`
--
ALTER TABLE `cust_messages`
  ADD PRIMARY KEY (`cust_message_id`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`damage_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `driver_code` (`driver_code`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `vehicle` (`vehicle`);

--
-- Indexes for table `equipments_records`
--
ALTER TABLE `equipments_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `staff` (`staff`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `privelages`
--
ALTER TABLE `privelages`
  ADD PRIMARY KEY (`priv_id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `assigner` (`assigner`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `rack` (`rack`),
  ADD KEY `products_ibfk_3` (`category`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_config`
--
ALTER TABLE `product_config`
  ADD PRIMARY KEY (`prod_config_id`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`product_disc_id`),
  ADD KEY `product_category` (`product_category`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `request` (`request`),
  ADD KEY `driver` (`driver`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`rack_id`),
  ADD KEY `warehouse` (`rack_warehouse`),
  ADD KEY `racks_ibfk_2` (`rack_zone`);

--
-- Indexes for table `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`reception_id`),
  ADD KEY `warehouse` (`warehouse`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `product` (`product`),
  ADD KEY `warehouse` (`warehouse`);

--
-- Indexes for table `requests_hist`
--
ALTER TABLE `requests_hist`
  ADD PRIMARY KEY (`request_hist_id`),
  ADD KEY `request` (`request`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `seller` (`seller`),
  ADD KEY `sales_ibfk_2` (`product`),
  ADD KEY `order` (`order`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_code` (`staff_code`),
  ADD UNIQUE KEY `identity_card` (`identity_card`);

--
-- Indexes for table `staffs_contract`
--
ALTER TABLE `staffs_contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD UNIQUE KEY `staff` (`staff`);

--
-- Indexes for table `staffs_documents`
--
ALTER TABLE `staffs_documents`
  ADD PRIMARY KEY (`document_id`),
  ADD UNIQUE KEY `staff` (`staff`);

--
-- Indexes for table `staffs_rotation`
--
ALTER TABLE `staffs_rotation`
  ADD PRIMARY KEY (`rotation_id`),
  ADD UNIQUE KEY `staff` (`staff`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product` (`product`),
  ADD KEY `warehouse` (`rack`),
  ADD KEY `warehouse_2` (`warehouse`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_code` (`supplier_code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `driver` (`driver`),
  ADD KEY `product` (`product`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD PRIMARY KEY (`user_message_id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `reciever` (`reciever`);

--
-- Indexes for table `user_updates`
--
ALTER TABLE `user_updates`
  ADD PRIMARY KEY (`user_updates_id`),
  ADD KEY `updater` (`updater`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD UNIQUE KEY `vehicle_code` (`vehicle_code`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- Indexes for table `warehouse_zones`
--
ALTER TABLE `warehouse_zones`
  ADD PRIMARY KEY (`zone_id`),
  ADD KEY `warehouse` (`zone_warehouse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cust_disc`
--
ALTER TABLE `cust_disc`
  MODIFY `cust_disc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cust_messages`
--
ALTER TABLE `cust_messages`
  MODIFY `cust_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `damage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipments_records`
--
ALTER TABLE `equipments_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privelages`
--
ALTER TABLE `privelages`
  MODIFY `priv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_config`
--
ALTER TABLE `product_config`
  MODIFY `prod_config_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `product_disc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `rack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `receptions`
--
ALTER TABLE `receptions`
  MODIFY `reception_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests_hist`
--
ALTER TABLE `requests_hist`
  MODIFY `request_hist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staffs_contract`
--
ALTER TABLE `staffs_contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs_documents`
--
ALTER TABLE `staffs_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs_rotation`
--
ALTER TABLE `staffs_rotation`
  MODIFY `rotation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_messages`
--
ALTER TABLE `users_messages`
  MODIFY `user_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_updates`
--
ALTER TABLE `user_updates`
  MODIFY `user_updates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `warehouse_zones`
--
ALTER TABLE `warehouse_zones`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_1` FOREIGN KEY (`warehouse`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`staff`) REFERENCES `staffs` (`staff_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`supervisor`) REFERENCES `staffs` (`staff_id`);

--
-- Constraints for table `cust_disc`
--
ALTER TABLE `cust_disc`
  ADD CONSTRAINT `cust_disc_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `cust_disc_ibfk_2` FOREIGN KEY (`product_categ`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE;

--
-- Constraints for table `cust_messages`
--
ALTER TABLE `cust_messages`
  ADD CONSTRAINT `cust_messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE;

--
-- Constraints for table `damages`
--
ALTER TABLE `damages`
  ADD CONSTRAINT `damages_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`vehicle`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE CASCADE;

--
-- Constraints for table `equipments_records`
--
ALTER TABLE `equipments_records`
  ADD CONSTRAINT `equipments_records_ibfk_1` FOREIGN KEY (`staff`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `privelages`
--
ALTER TABLE `privelages`
  ADD CONSTRAINT `privelages_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `privelages_ibfk_2` FOREIGN KEY (`assigner`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`rack`) REFERENCES `racks` (`rack_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_config`
--
ALTER TABLE `product_config`
  ADD CONSTRAINT `product_config_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_ibfk_1` FOREIGN KEY (`product_category`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`request`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`driver`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE;

--
-- Constraints for table `racks`
--
ALTER TABLE `racks`
  ADD CONSTRAINT `racks_ibfk_1` FOREIGN KEY (`rack_warehouse`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `racks_ibfk_2` FOREIGN KEY (`rack_zone`) REFERENCES `warehouse_zones` (`zone_id`) ON DELETE CASCADE;

--
-- Constraints for table `receptions`
--
ALTER TABLE `receptions`
  ADD CONSTRAINT `receptions_ibfk_1` FOREIGN KEY (`warehouse`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`warehouse`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE;

--
-- Constraints for table `requests_hist`
--
ALTER TABLE `requests_hist`
  ADD CONSTRAINT `requests_hist_ibfk_1` FOREIGN KEY (`request`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`seller`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`order`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `staffs_contract`
--
ALTER TABLE `staffs_contract`
  ADD CONSTRAINT `staffs_contract_ibfk_1` FOREIGN KEY (`staff`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`rack`) REFERENCES `racks` (`rack_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_ibfk_3` FOREIGN KEY (`warehouse`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`driver`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_ibfk_3` FOREIGN KEY (`sender`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_ibfk_4` FOREIGN KEY (`receiver`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE;

--
-- Constraints for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD CONSTRAINT `users_messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_messages_ibfk_2` FOREIGN KEY (`reciever`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_updates`
--
ALTER TABLE `user_updates`
  ADD CONSTRAINT `user_updates_ibfk_1` FOREIGN KEY (`updater`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_updates_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `warehouse_zones`
--
ALTER TABLE `warehouse_zones`
  ADD CONSTRAINT `warehouse_zones_ibfk_1` FOREIGN KEY (`zone_warehouse`) REFERENCES `warehouses` (`warehouse_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
