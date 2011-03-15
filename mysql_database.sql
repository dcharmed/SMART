-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2010 at 03:08 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `dbsmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `smart_customer`
--

CREATE TABLE IF NOT EXISTS `smart_customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) NOT NULL,
  `resolution_id` int(10) NOT NULL,
  `cust_fullname` varchar(200) NOT NULL,
  `cust_phone` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smart_customer`
--


-- --------------------------------------------------------

--
-- Table structure for table `smart_equipment`
--

CREATE TABLE IF NOT EXISTS `smart_equipment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) NOT NULL,
  `eqmt_type` int(10) NOT NULL,
  `eqmt_serialno` varchar(200) NOT NULL,
  `eqmt_measurementbefore` varchar(100) DEFAULT NULL,
  `eqmt_measurementafter` varchar(100) DEFAULT NULL,
  `eqmt_remark` text,
  `datemodified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smart_equipment`
--


-- --------------------------------------------------------

--
-- Table structure for table `smart_referencecode`
--

CREATE TABLE IF NOT EXISTS `smart_referencecode` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ref_rank` int(3) DEFAULT NULL,
  `ref_type` varchar(50) NOT NULL,
  `ref_value` varchar(50) NOT NULL,
  `ref_description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=364 ;

--
-- Dumping data for table `smart_referencecode`
--

INSERT INTO `smart_referencecode` (`id`, `ref_rank`, `ref_type`, `ref_value`, `ref_description`) VALUES
(1, 1, 'usrgroup', '1', 'Administrator'),
(2, 2, 'usrgroup', '2', 'Manager'),
(3, 3, 'usrgroup', '3', 'Engineer'),
(4, 4, 'usrgroup', '4', 'Helpdesk'),
(5, 5, 'usrgroup', '5', 'Adukom'),
(6, 6, 'usrgroup', '6', 'User/Client'),
(7, 1, 'probcat', '01', 'Book'),
(8, 2, 'probcat', '02', 'Hardware'),
(9, 3, 'probcat', '03', 'Software'),
(10, 4, 'probcat', '04', 'Network'),
(11, 5, 'probcat', '05', 'Application'),
(12, 6, 'probcat', '06', 'Dongle'),
(13, 7, 'probcat', '07', 'Office Equipment'),
(14, 8, 'probcat', '08', 'CCTV'),
(15, 9, 'probcat', '09', 'Access Door'),
(16, 10, 'probcat', '10', 'Chip'),
(17, 11, 'probcat', '11', 'Iris Equipment'),
(18, 12, 'probcat', '12', 'User'),
(19, 13, 'probcat', '13', 'Adukom'),
(20, 1, '01', '0101', 'Book'),
(21, 1, '02', '0201', 'E2000'),
(22, 2, '02', '0202', 'Feeder'),
(23, 3, '02', '0203', 'CCD'),
(24, 4, '02', '0204', 'Parts'),
(25, 5, '02', '0205', 'Teflon Tape'),
(26, 6, '02', '0206', 'Dust'),
(27, 7, '02', '0207', 'CPU'),
(28, 8, '02', '0208', 'Monitor'),
(29, 9, '02', '0209', 'Canon'),
(30, 10, '02', '0210', 'Jarfalla'),
(31, 11, '02', '0211', 'RTE8000'),
(32, 12, '02', '0212', 'SCSI Cable/Card'),
(33, 13, '02', '0213', 'Human error'),
(34, 14, '02', '0214', 'Cleaning Kit'),
(35, 15, '02', '0215', 'Parts/Consumable'),
(36, 1, '03', '0301', 'Windows'),
(37, 2, '03', '0302', 'JURA dongle'),
(38, 3, '03', '0303', 'Spooler'),
(39, 4, '03', '0304', 'PC'),
(40, 5, '03', '0305', 'CPU'),
(41, 6, '03', '0306', 'OCR'),
(42, 7, '03', '0307', 'Anti Virus'),
(43, 8, '03', '0308', 'RTE8000'),
(44, 1, '04', '0401', 'System'),
(45, 2, '04', '0402', 'Server'),
(46, 1, '05', '0501', 'System'),
(47, 1, '07', '0701', 'Manufacture'),
(48, 2, '07', '0702', 'Renovation/Relocation'),
(49, 3, '07', '0703', 'Server'),
(50, 4, '07', '0704', 'UPS'),
(51, 5, '07', '0705', 'OKI printer'),
(52, 6, '07', '0706', 'Network Cable'),
(53, 7, '07', '0707', 'Table'),
(54, 8, '07', '0708', 'Power Building'),
(55, 1, '08', '0801', 'CCTV'),
(56, 2, '08', '0802', 'Cable'),
(57, 3, '08', '0803', 'CPU'),
(58, 4, '08', '0804', 'Monitor'),
(59, 1, '09', '0901', 'Access Door'),
(60, 1, '10', '1001', 'IRIS'),
(61, 1, '11', '1101', 'IRIS'),
(62, 2, '05', '0502', 'HTP'),
(63, 3, '05', '0503', 'IRIS encoder'),
(64, 1, '12', '1201', 'Human Error'),
(65, 2, '12', '1202', 'Guidance'),
(66, 3, '12', '1203', 'Tools'),
(67, 1, '13', '1301', 'Human Error'),
(68, 1, '0101', '1', 'Peel off'),
(69, 2, '0101', '2', 'Passport series'),
(70, 3, '0101', '3', 'Passport series'),
(71, 4, '0101', '4', 'Positon of picture column, Laminate printed in order position'),
(72, 5, '0101', '5', 'Book physically damage'),
(73, 6, '0101', '6', 'Laminate stick at passport'),
(74, 1, '0201', '1', 'Skew'),
(75, 2, '0201', '2', 'Peel off'),
(76, 3, '0201', '3', 'White line'),
(77, 4, '0201', '4', 'Red/blue line'),
(78, 5, '0201', '5', 'Picture dirty'),
(79, 6, '0201', '6', 'MRZ text missing'),
(80, 7, '0201', '7', 'Color shifting'),
(81, 8, '0201', '8', 'Dislocation'),
(82, 9, '0201', '9', 'White dots (partial blinking)'),
(83, 10, '0201', '10', 'Laminate too high'),
(84, 11, '0201', '11', 'Laminate too low'),
(85, 12, '0201', '12', 'Print on used laminate'),
(86, 13, '0201', '13', 'Print half'),
(87, 14, '0201', '14', 'Picture printed out of column'),
(88, 15, '0201', '15', 'Picture printed more to yellow'),
(89, 16, '0201', '16', 'Improper Laminate (stick at roller)'),
(90, 17, '0201', '17', 'Text/Print blur'),
(91, 18, '0201', '18', 'Book printed well, failed to eject'),
(92, 19, '0201', '19', 'Jammed at PO unit, passport damage'),
(93, 20, '0201', '20', 'Slide bar hard to rotate'),
(94, 21, '0201', '21', 'Second page tear after printed'),
(95, 22, '0201', '22', 'E2000 continues warm up'),
(96, 23, '0201', '23', 'Turn table failed to turn smoothly'),
(97, 24, '0201', '24', 'Ribbon level adjustment'),
(98, 25, '0201', '25', 'CHECK PRINTER ICRW'),
(99, 26, '0201', '26', 'CHECK PRINTER S7 ERROR 00000'),
(100, 27, '0201', '27', 'TURN ERROR 20012'),
(101, 28, '0201', '28', 'TURN ERROR 20011'),
(102, 29, '0201', '29', 'CHECK PRINTER REMOVE THE SHEET IN THE PRINTER'),
(103, 30, '0201', '30', 'BOOK FEED ERROR 00000'),
(104, 31, '0201', '31', 'BOOK FEED ERROR 1'),
(105, 32, '0201', '32', 'BOOK FEED ERROR 05101'),
(106, 33, '0201', '33', 'BOOK FEED ERROR 05201'),
(107, 34, '0201', '34', 'BOOK FEED ERROR 05204'),
(108, 35, '0201', '35', 'BOOK JAM ERROR'),
(109, 36, '0201', '36', 'BOOK JAMMED ERROR 3'),
(110, 37, '0201', '37', 'RIBBON SNS ERROR 02004'),
(111, 38, '0201', '38', 'CHECK PRINTER HUM SNS ERROR 26001'),
(112, 39, '0201', '39', 'RIBBON EMPTY 061'),
(113, 40, '0201', '40', 'RIBBON EMPTY 064'),
(114, 41, '0201', '41', 'RIBBON EMPTY 066'),
(115, 42, '0201', '42', 'PRESS ORG ERROR 15004'),
(116, 43, '0201', '43', 'CHECK PRINTER SLIDE ORG 19003'),
(117, 44, '0201', '44', 'H PRESS ERROR'),
(118, 45, '0201', '45', 'WARNING 011 CHECK FILM'),
(119, 46, '0201', '46', 'FILM EMPTY'),
(120, 47, '0201', '47', 'FILM SNS ERROR'),
(121, 48, '0201', '48', 'FILM ENC  S ERROR'),
(122, 49, '0201', '49', 'Shaft at film delivery unit loose'),
(123, 50, '0201', '50', 'HEATER UL ERROR'),
(124, 51, '0201', '51', 'HEATER TIME OUT'),
(125, 52, '0201', '52', 'Electrical Control Board faulty'),
(126, 53, '0201', '53', '32/64 jammed (PF/CCD)'),
(127, 54, '0201', '54', '32/64 jammed (CCD/E2000)'),
(128, 55, '0201', '55', '32/64 jammed (PF/CCD/E2000)'),
(129, 56, '0201', '56', '64 jammed (CCD/E2000)'),
(130, 57, '0201', '57', 'Timing belt 2 tear'),
(131, 58, '0201', '58', 'SP2 connector wire broken'),
(132, 59, '0201', '59', 'S4 sensor broken'),
(133, 60, '0201', '60', 'Film/Ribbon supporting tube spindal broken'),
(134, 61, '0201', '61', 'Timing belt adjustor didnt move along with timing belt'),
(135, 1, '0202', '1', 'Feeder S1 sensor fall down'),
(136, 2, '0202', '2', 'CHECK PRINTER PF1 x36H'),
(137, 3, '0202', '3', 'PF1/PF2 Book Empty'),
(138, 4, '0202', '4', 'PF1 [RESTART]'),
(139, 5, '0202', '5', 'PF1/PF2 SP Jam'),
(140, 6, '0202', '6', 'WARNING: Restart PF1'),
(141, 7, '0202', '7', 'PF1/PF2 Cover Open'),
(142, 8, '0202', '8', 'CHECK PRINTER: PF1 SP1 MECHA ERR 33H'),
(143, 9, '0202', '9', 'PF book gate loose'),
(144, 10, '0202', '10', 'PF1/PF2 BOOK JAM'),
(145, 11, '0202', '11', 'PF solenoid fail to move upper for 64pages'),
(146, 12, '0202', '12', 'PF spring solenoid 2 damage'),
(147, 1, '0203', '1', 'CCD hand lift faulty'),
(148, 2, '0203', '2', 'CHECK CAMERA UNIT 056'),
(149, 3, '0203', '3', 'CCD camera lens blur'),
(150, 4, '0203', '4', 'CHECK PRINTER CAMERA UNIT ERR CODE 0x32'),
(151, 5, '0203', '5', 'CCD conbeyor belt slot loose'),
(152, 1, '0204', '1', 'Cleaning platen roller screw loose'),
(153, 1, '0205', '1', 'Peel Off'),
(154, 1, '0206', '1', 'Diplomat job title not fully print'),
(155, 1, '0207', '1', 'PC running slow'),
(156, 2, '0207', '2', 'Motherboard failure'),
(157, 3, '0207', '3', 'PC always hang'),
(158, 4, '0207', '4', 'PC doesn''t accept any password'),
(159, 5, '0207', '5', 'PC failed to boot'),
(160, 6, '0207', '6', 'USB port failure'),
(161, 1, '0208', '1', 'Monitor blank'),
(162, 1, '0209', '1', 'Camera background stripe line'),
(163, 2, '0209', '2', 'Blur image'),
(164, 3, '0209', '3', 'Captured in dark images'),
(165, 4, '0209', '4', 'Lens faulty'),
(166, 5, '0209', '5', 'Canon not in live mode'),
(167, 1, '0210', '1', 'Jarfalla failed to feed'),
(168, 2, '0210', '2', 'Jarfalla printed numeric/hexdum'),
(169, 3, '0210', '3', 'Jarfalla printed without/blur text'),
(170, 4, '0210', '4', 'Jarfalla printing PMA only, others fail'),
(171, 5, '0210', '5', 'Jarfalla fail to print SPK'),
(172, 6, '0210', '6', 'Jarfalla fail to print SPC'),
(173, 7, '0210', '7', 'Jarfalla ink leakage'),
(174, 8, '0210', '8', 'Jarfalla cable faulty'),
(175, 9, '0210', '9', 'Jarfalla cable loose'),
(176, 10, '0210', '10', 'Jarfalla fail to eject passport'),
(177, 11, '0210', '11', 'Jarfalla cause pages torn/crumble'),
(178, 12, '0210', '12', 'Jarfalla printing in one raw'),
(179, 13, '0210', '13', 'Jarfalla printing not at actual position'),
(180, 14, '0210', '14', 'Jarfalla fail to switch ON/OFF'),
(181, 15, '0210', '15', 'Jarfalla switch OFF and ON automatically'),
(182, 16, '0210', '16', 'All LED light on'),
(183, 1, '0211', '1', 'Failed to QA'),
(184, 2, '0211', '2', 'unable to configure configuration port'),
(185, 3, '0211', '3', 'Error PKI 49 failed. SOD present pin.'),
(186, 4, '0211', '4', 'RTE failed to ready'),
(187, 1, '0212', '1', 'Job not listing in spooler'),
(188, 2, '0212', '2', 'SCSI cable slot faulty'),
(189, 3, '0212', '3', 'SCSI cable/card faulty'),
(190, 4, '0212', '4', 'SCSI Cable/card not detected'),
(191, 5, '0212', '5', 'SCSI cable/card loose'),
(192, 1, '0213', '1', 'SP2 cable at PO unit damaged'),
(193, 1, '0214', '1', 'Request cleaning kit'),
(194, 1, '0215', '1', 'Platen roller screw loose/damage'),
(195, 2, '0215', '2', 'Film unit hex screw broken'),
(196, 3, '0215', '3', 'Weird sound due to gear/motor'),
(197, 1, '0301', '1', 'Windows corrupt'),
(198, 2, '0301', '2', 'Check Disk Error'),
(199, 1, '0302', '1', 'Dongle error'),
(200, 2, '0302', '2', 'Dongle limited counting'),
(201, 3, '0302', '3', 'Dongle Expired'),
(202, 4, '0302', '4', 'JURA Expired'),
(203, 5, '0302', '5', 'JURA JPT warning'),
(204, 6, '0302', '6', 'IPI JURA visible'),
(205, 7, '0302', '7', 'DONGLE ERROR 1991'),
(206, 1, '0303', '1', 'Double printing'),
(207, 2, '0303', '2', 'Software testing'),
(208, 3, '0303', '3', 'Spooler dll not in latest file'),
(209, 4, '0303', '4', 'Diplomat job title not fully print'),
(210, 5, '0303', '5', 'Failed to load spooler application'),
(211, 6, '0303', '6', 'Untick check box'),
(212, 7, '0303', '7', 'PMA/PTB  64pages setting'),
(213, 8, '0303', '8', 'Fail to open target report'),
(214, 1, '0304', '1', 'Virus on PC'),
(215, 2, '0304', '2', 'PC auto restart'),
(216, 1, '0305', '1', 'Fail to find Operating System'),
(217, 2, '0305', '2', 'Blue screen'),
(218, 3, '0305', '3', 'PC auto shutdown'),
(219, 4, '0305', '4', 'Text visual bigger'),
(220, 1, '0306', '1', 'OCR printed wrong'),
(221, 2, '0306', '2', 'OCR pop windows, OK button disable'),
(222, 3, '0306', '3', 'OCR always pop up window'),
(223, 4, '0306', '4', 'OCR pop up extra digit'),
(224, 5, '0306', '5', 'Update status of passport'),
(225, 1, '0307', '1', 'Fail to remove AVIRA'),
(226, 2, '0307', '2', 'CPU detact by virus'),
(227, 1, '0308', '1', 'RTE8000.exe corrupt'),
(228, 2, '0308', '2', 'MRZ read 0 as O'),
(229, 1, '0401', '1', 'Job stop inside E2000 without error indicates'),
(230, 2, '0401', '2', 'Sistem belum SIGN ON'),
(231, 3, '0401', '3', 'System offline'),
(232, 4, '0401', '4', 'Data not listing in spooler table'),
(233, 5, '0401', '5', 'JIM system failed to load'),
(234, 6, '0401', '6', 'Gagal menjalin e-connect'),
(235, 7, '0401', '7', 'PC request access password'),
(236, 8, '0401', '8', 'Network name cannot be found'),
(237, 9, '0401', '9', 'Duplicate job in spooler list'),
(238, 10, '0401', '10', 'ID Gagal menghubungi pangkalan data'),
(239, 11, '0401', '11', 'JAMINAN KUALITI BELUM DILAKSANAKAN'),
(240, 1, '0402', '1', 'ERROR CONNECTING DATABASE1'),
(241, 2, '0402', '2', 'UNABLE TO CONNECT USER ENVIRONMENT AT SERVER'),
(242, 3, '0402', '3', 'JIM system fail to link to local server'),
(243, 4, '0402', '4', 'Unable to commit to server'),
(244, 5, '0402', '5', 'Mapping M:\\ and R:\\ doesn’t exist'),
(245, 6, '0402', '6', 'No signal input/ cable disconncet'),
(246, 7, '0402', '7', 'Server down'),
(247, 8, '0402', '8', 'Printer in status BUSY'),
(248, 9, '0402', '9', 'ODBC SQL Server Drive'),
(249, 10, '0402', '10', 'Data telah wujud di ttd_print temp'),
(250, 1, '0501', '1', 'Rekod permohonan tidak wujud'),
(251, 2, '0501', '2', 'Sila lakukan agihan stok'),
(252, 3, '0501', '3', 'Add transaction'),
(253, 4, '0501', '4', 'Stok dokumen tidak wujud'),
(254, 5, '0501', '5', 'Job list, repeating queing'),
(255, 6, '0501', '6', 'Update status of passport'),
(256, 7, '0501', '7', 'Background capture differ with printing'),
(257, 8, '0501', '8', 'Wrong path of image'),
(258, 9, '0501', '9', 'Ralat tarikh luput'),
(259, 10, '0501', '10', 'JPEG Cannot found'),
(260, 11, '0501', '11', 'No SQL data'),
(261, 12, '0501', '12', 'Gagal tangkap imej'),
(262, 13, '0501', '13', 'Extra Toppan ID'),
(263, 14, '0501', '14', 'HANYA SATU APLIKASI SAHAJA DAPAT DIJALANKAN DALAM SATU MASA'),
(264, 15, '0501', '15', 'Spooler dll not in latest file'),
(265, 16, '0501', '16', 'HTP Execution file keep pop up'),
(266, 17, '0501', '17', 'Several transaction of payment fail'),
(267, 18, '0501', '18', 'JPG cannot be found'),
(268, 19, '0501', '19', 'One or mandatory field is empty'),
(269, 20, '0501', '20', 'Failed to encode, spool.mdb fail to update job'),
(270, 21, '0501', '21', 'C++ public library'),
(271, 1, '06', '0601', 'Dongle expired'),
(272, 1, '0701', '1', 'Film empty '),
(273, 2, '0701', '2', 'Film crumble '),
(274, 3, '0701', '3', 'Film manufacture default '),
(275, 4, '0701', '4', 'Incomplete security feature at laminate'),
(276, 1, '0702', '1', 'Renovation/relocation '),
(277, 1, '0703', '1', 'Server not ready '),
(278, 2, '0703', '2', 'Server back up tape'),
(279, 1, '0704', '1', 'UPS not working '),
(280, 1, '0705', '1', 'OKI printer no power'),
(281, 1, '0706', '1', 'LAN/switch cable '),
(282, 1, '0707', '1', 'Table not stable'),
(283, 2, '0707', '2', 'Table/chair broken'),
(284, 1, '0708', '1', 'DB power building not working '),
(285, 1, '0801', '1', 'No visual/no recording save'),
(286, 2, '0801', '2', 'CCTV pointing to wrong section'),
(287, 3, '0801', '3', 'CCTV application corrupt'),
(288, 1, '0802', '1', 'No visual, blank screen'),
(289, 2, '0803', '2', 'CPU of CCTV faulty'),
(290, 1, '0804', '1', 'CCTV Monitor faulty'),
(291, 1, '0901', '1', 'Sirens fail to switch OFF'),
(292, 2, '0901', '2', 'Access reader not functioning'),
(293, 3, '0901', '3', 'PIN code reader error'),
(294, 4, '0901', '4', 'Request access card'),
(295, 1, '10', '1', 'Ralat'),
(296, 2, '10', '2', 'Ralat komunikasi 3'),
(297, 1, '1101', '1', 'UNKNOWN ACCEPTION IMPREPARE DG2'),
(298, 2, '1101', '2', 'Encoder no power '),
(299, 3, '1101', '3', 'Thumb print machine failure'),
(300, 4, '1101', '4', 'Fail to encode'),
(301, 1, '0502', '1', 'Extra Toppan ID'),
(302, 1, '0503', '1', 'Ralat sekuriti'),
(303, 2, '0503', '2', 'Encoder: GAGAL MENCARI CAP JARI'),
(304, 1, '1201', '1', 'FILM EMPTY'),
(305, 2, '1201', '2', 'Only PMA succeed, other transaction fail using Jarfalla'),
(306, 3, '1201', '3', 'Fail to perform "Agihan Stok"'),
(307, 4, '1201', '4', 'RTE8000 cable, loose'),
(308, 5, '1201', '5', 'E2000 fail to print'),
(309, 6, '1201', '6', 'Dislocation'),
(310, 7, '1201', '7', 'Improper Laminate'),
(311, 8, '1201', '8', 'Configuration Menu 32/64 pages'),
(312, 9, '1201', '9', 'Send Re-print job'),
(313, 10, '1201', '10', 'No passport inside PF'),
(314, 11, '1201', '11', 'Jarfalla printing skew'),
(315, 12, '1201', '12', 'Improper install of jarfalla catridge'),
(316, 13, '1201', '13', 'Print on used laminate'),
(317, 14, '1201', '14', 'CPU cable loose'),
(318, 1, '1202', '1', 'Install jarfalla printer'),
(319, 2, '1202', '2', 'Delete job at spooler'),
(320, 3, '1202', '3', 'Jarfalla fial to print SPC'),
(321, 4, '1202', '4', 'Untick job'),
(322, 5, '1202', '5', 'Step to review CCTV recording'),
(323, 6, '1202', '6', 'Step to lupus data'),
(324, 7, '1202', '7', 'Request to print Target report'),
(325, 8, '1202', '8', 'STOK DOKUMEN TIADA'),
(326, 1, '1203', '1', 'Request test card'),
(327, 2, '1203', '2', 'Request cleaning kit'),
(328, 1, '1301', '1', 'Wrong assignment/escarlation'),
(329, 2, '1301', '2', 'Request to replace new system board'),
(330, 1, 'state', 'kl', 'Wilayah Persekutuan Kuala Lumpur'),
(331, 2, 'state', 'ptj', 'Wilayah Persekutuan Putrajaya'),
(332, 3, 'state', 'lbn', 'Wilayah Persekutuan Labuan'),
(333, 4, 'state', 'slg', 'Selangor'),
(334, 5, 'state', 'n9', 'Negeri Sembilan'),
(335, 6, 'state', 'phg', 'Pahang'),
(336, 7, 'state', 'ktn', 'Kelantan'),
(337, 8, 'state', 'tgn', 'Terengganu'),
(338, 9, 'state', 'prk', 'Perak'),
(339, 10, 'state', 'kdh', 'Kedah'),
(340, 11, 'state', 'png', 'Pulau Pinang'),
(341, 12, 'state', 'pls', 'Perlis'),
(342, 13, 'state', 'jhr', 'Johor'),
(343, 14, 'state', 'mlk', 'Melaka'),
(344, 15, 'state', 'sbh', 'Sabah'),
(345, 16, 'state', 'swk', 'Sarawak'),
(346, 17, 'state', 'ovs', 'Overseas'),
(347, 1, 'kl', 'wpin', 'Damansara / Kuala Lumpur'),
(348, 2, 'kl', 'wwng', 'Wangsa Maju'),
(349, 1, 'n9', 'npin', 'Seremban'),
(350, 1, 'slg', 'bpin', 'Shah Alam'),
(351, 2, 'slg', 'bkaj', 'Kajang'),
(352, 3, 'slg', 'bpkl', 'Pelabuhan Klang'),
(353, 4, 'slg', 'bsub', 'Subang'),
(354, 1, 'tcktseverity', '1', 'Critical'),
(355, 2, 'tcktseverity', '2', 'Major'),
(356, 3, 'tcktseverity', '3', 'Minor'),
(357, 4, 'tcktseverity', '4', 'Info'),
(358, 1, 'tcktstatus', '1', 'Open'),
(359, 2, 'tcktstatus', '2', 'Assigned'),
(360, 4, 'tcktstatus', '4', 'Work In Progress'),
(361, 5, 'tcktstatus', '5', 'Resolved'),
(362, 6, 'tcktstatus', '6', 'Closed'),
(363, 3, 'tcktstatus', '3', 'Escalated');

-- --------------------------------------------------------

--
-- Table structure for table `smart_replacement`
--

CREATE TABLE IF NOT EXISTS `smart_replacement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(10) NOT NULL,
  `ticket_id` int(10) NOT NULL,
  `rplmt_serialno` varchar(100) NOT NULL,
  `rplmt_remark` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smart_replacement`
--


-- --------------------------------------------------------

--
-- Table structure for table `smart_resolution`
--

CREATE TABLE IF NOT EXISTS `smart_resolution` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) NOT NULL,
  `rslt_status` int(2) NOT NULL,
  `rslt_date` datetime NOT NULL,
  `rslt_toppanid` varchar(50) DEFAULT NULL,
  `rslt_engineer` int(10) DEFAULT NULL,
  `rslt_servicedate` datetime DEFAULT NULL,
  `rslt_serviceno` varchar(100) DEFAULT NULL,
  `rslt_eta` datetime DEFAULT NULL,
  `rslt_etd` datetime DEFAULT NULL,
  `rslt_action` text NOT NULL,
  `rslt_method` varchar(100) DEFAULT NULL,
  `rslt_part` varchar(200) DEFAULT NULL,
  `rslt_planning` text,
  `rslt_related` varchar(200) DEFAULT NULL,
  `rslt_remark` varchar(255) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smart_resolution`
--


-- --------------------------------------------------------

--
-- Table structure for table `smart_serialnumber`
--

CREATE TABLE IF NOT EXISTS `smart_serialnumber` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `serialnumber` varchar(200) NOT NULL,
  `datemodified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smart_serialnumber`
--


-- --------------------------------------------------------

--
-- Table structure for table `smart_task`
--

CREATE TABLE IF NOT EXISTS `smart_task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) NOT NULL,
  `task_currentstatus` int(10) DEFAULT NULL,
  `task_newstatus` varchar(10) NOT NULL,
  `task_personincharge` int(2) DEFAULT NULL,
  `task_personinchargenote` text,
  `task_secpersonincharge` int(2) DEFAULT NULL,
  `task_secpersoninchargenote` text,
  `task_adukomid` int(2) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `smart_task`
--


-- --------------------------------------------------------

--
-- Table structure for table `smart_ticket`
--

CREATE TABLE IF NOT EXISTS `smart_ticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tckt_refnumber` varchar(200) NOT NULL,
  `tckt_status` int(2) NOT NULL,
  `tckt_date` date NOT NULL,
  `tckt_issuedbygusr` int(2) DEFAULT NULL,
  `tckt_issuedbyiduser` int(2) DEFAULT NULL,
  `tckt_issuedbycontactuser` varchar(100) DEFAULT NULL,
  `tckt_issuedbyadukomid` varchar(20) DEFAULT NULL,
  `tckt_issuedreportedby` int(2) NOT NULL,
  `tckt_state` varchar(10) DEFAULT NULL,
  `tckt_branch` varchar(10) NOT NULL,
  `tckt_severity` int(2) NOT NULL,
  `tckt_adukomn` varchar(50) DEFAULT NULL,
  `tckt_toppanid` varchar(10) DEFAULT NULL,
  `tckt_esc` varchar(50) DEFAULT NULL,
  `tckt_tag` varchar(100) DEFAULT NULL,
  `tckt_category` varchar(10) NOT NULL,
  `tckt_subcategory` varchar(10) DEFAULT NULL,
  `tckt_subcatdetail` varchar(10) DEFAULT NULL,
  `tckt_eqpmtserial` varchar(200) DEFAULT NULL,
  `tckt_description` text NOT NULL,
  `tckt_closedbyuser` int(2) DEFAULT NULL,
  `tckt_closedbyadukom` varchar(10) DEFAULT NULL,
  `tckt_closedon` datetime DEFAULT NULL,
  `tckt_closedreportedby` int(2) DEFAULT NULL,
  `datemodified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `smart_ticket`
--

INSERT INTO `smart_ticket` (`id`, `tckt_refnumber`, `tckt_status`, `tckt_date`, `tckt_issuedbygusr`, `tckt_issuedbyiduser`, `tckt_issuedbycontactuser`, `tckt_issuedbyadukomid`, `tckt_issuedreportedby`, `tckt_state`, `tckt_branch`, `tckt_severity`, `tckt_adukomn`, `tckt_toppanid`, `tckt_esc`, `tckt_tag`, `tckt_category`, `tckt_subcategory`, `tckt_subcatdetail`, `tckt_eqpmtserial`, `tckt_description`, `tckt_closedbyuser`, `tckt_closedbyadukom`, `tckt_closedon`, `tckt_closedreportedby`, `datemodified`) VALUES
(1, '#test', 1, '2010-02-16', 3, 1, '1213213', NULL, 0, 'slg', 'bpin', 3, NULL, 't1', NULL, 'test', '01', '0101', '4', '123123', 'test', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smart_user`
--

CREATE TABLE IF NOT EXISTS `smart_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usr_status` int(2) NOT NULL,
  `usr_username` varchar(20) NOT NULL,
  `usr_password` varchar(20) DEFAULT '12345',
  `usr_group` int(2) NOT NULL DEFAULT '6',
  `usr_email` varchar(200) NOT NULL,
  `usr_fullname` varchar(255) NOT NULL,
  `usr_staffid` varchar(20) NOT NULL,
  `usr_post` int(2) DEFAULT NULL,
  `usr_address` text,
  `usr_gender` varchar(2) NOT NULL,
  `usr_dateofbirth` date DEFAULT NULL,
  `datemodified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `smart_user`
--

INSERT INTO `smart_user` (`id`, `usr_status`, `usr_username`, `usr_password`, `usr_group`, `usr_email`, `usr_fullname`, `usr_staffid`, `usr_post`, `usr_address`, `usr_gender`, `usr_dateofbirth`, `datemodified`) VALUES
(1, 1, 'adawiyah', '123456', 1, 'adawiyah@gmail.com', 'Adawiyah Ashar', '007', NULL, NULL, '2', '2010-02-25', NULL);
