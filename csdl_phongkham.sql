-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 09, 2024 lúc 04:53 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `csdl_phongkham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `appointments`
--

CREATE TABLE `appointments` (
  `appointmentID` varchar(50) NOT NULL,
  `patientID` varchar(50) NOT NULL,
  `appoitmentday` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `examine`
--

CREATE TABLE `examine` (
  `EXID` varchar(50) NOT NULL,
  `patientID` varchar(50) NOT NULL,
  `staffID` varchar(50) NOT NULL,
  `appointmentID` varchar(50) NOT NULL,
  `prescriptionID` varchar(50) NOT NULL,
  `useserviceID` varchar(50) NOT NULL,
  `exdaytime` datetime NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medicines`
--

CREATE TABLE `medicines` (
  `medicineID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `function` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patients`
--

CREATE TABLE `patients` (
  `patientID` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `payID` varchar(50) NOT NULL,
  `EXID` varchar(50) NOT NULL,
  `payday` datetime NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescriptionID` varchar(50) NOT NULL,
  `medicineID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `dosage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `profiles`
--

CREATE TABLE `profiles` (
  `profileID` varchar(50) NOT NULL,
  `EXID` varchar(50) NOT NULL,
  `diagnose` varchar(50) NOT NULL,
  `solution` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `serviceID` int(11) NOT NULL,
  `servicename` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staffs`
--

CREATE TABLE `staffs` (
  `staffID` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `useservices`
--

CREATE TABLE `useservices` (
  `userviceID` varchar(50) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentID`),
  ADD UNIQUE KEY `patientID` (`patientID`);

--
-- Chỉ mục cho bảng `examine`
--
ALTER TABLE `examine`
  ADD PRIMARY KEY (`EXID`),
  ADD UNIQUE KEY `patientID` (`patientID`),
  ADD UNIQUE KEY `staffID` (`staffID`),
  ADD UNIQUE KEY `prescriptionID` (`prescriptionID`),
  ADD UNIQUE KEY `useserviceID` (`useserviceID`),
  ADD UNIQUE KEY `appointmentID` (`appointmentID`);

--
-- Chỉ mục cho bảng `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicineID`);

--
-- Chỉ mục cho bảng `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientID`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payID`),
  ADD UNIQUE KEY `EXID` (`EXID`);

--
-- Chỉ mục cho bảng `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescriptionID`),
  ADD UNIQUE KEY `medicineID` (`medicineID`);

--
-- Chỉ mục cho bảng `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profileID`),
  ADD UNIQUE KEY `EXID` (`EXID`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceID`);

--
-- Chỉ mục cho bảng `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staffID`);

--
-- Chỉ mục cho bảng `useservices`
--
ALTER TABLE `useservices`
  ADD PRIMARY KEY (`userviceID`),
  ADD UNIQUE KEY `serviceID` (`serviceID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicineID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `examine`
--
ALTER TABLE `examine`
  ADD CONSTRAINT `examine_ibfk_1` FOREIGN KEY (`appointmentID`) REFERENCES `appointments` (`appointmentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examine_ibfk_2` FOREIGN KEY (`staffID`) REFERENCES `staffs` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examine_ibfk_3` FOREIGN KEY (`useserviceID`) REFERENCES `useservices` (`userviceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examine_ibfk_4` FOREIGN KEY (`EXID`) REFERENCES `payments` (`EXID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examine_ibfk_5` FOREIGN KEY (`prescriptionID`) REFERENCES `prescriptions` (`prescriptionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_ibfk_1` FOREIGN KEY (`medicineID`) REFERENCES `medicines` (`medicineID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`EXID`) REFERENCES `examine` (`EXID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `useservices`
--
ALTER TABLE `useservices`
  ADD CONSTRAINT `useservices_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `services` (`serviceID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
