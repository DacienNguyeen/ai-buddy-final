-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2025 at 07:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aibuddy_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(100) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `AdminEmail`, `AdminPassword`, `Role`) VALUES
(2, 'admin', 'admin@email.com', '123456', 'SuperAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `BadgeID` int(11) NOT NULL,
  `BadgeName` varchar(100) DEFAULT NULL,
  `BadgeSymbol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badgecondition`
--

CREATE TABLE `badgecondition` (
  `ConditionID` int(11) NOT NULL,
  `BadgeID` int(11) NOT NULL,
  `ConditionTypeID` int(11) NOT NULL,
  `ConditionValue` varchar(100) DEFAULT NULL,
  `BadgeDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chathistory`
--

CREATE TABLE `chathistory` (
  `ChatID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PersonaID` int(11) DEFAULT NULL,
  `TopicID` int(11) DEFAULT NULL,
  `ChatTime` datetime DEFAULT current_timestamp(),
  `MessageContent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chathistory`
--

INSERT INTO `chathistory` (`ChatID`, `UserID`, `PersonaID`, `TopicID`, `ChatTime`, `MessageContent`) VALUES
(1, 101, 2, 2, '2025-12-13 12:07:15', 'Làm sao để sửa lỗi kết nối database trong PHP vậy?'),
(2, 101, 2, 2, '2025-12-13 13:07:15', 'Cảm ơn, mình đã cấu hình lại file config và chạy ổn rồi.'),
(3, 102, 1, 6, '2025-12-12 17:07:15', 'Gợi ý cho mình thực đơn eat clean trong 7 ngày để giảm cân nhé.'),
(4, 102, 1, 6, '2025-12-12 18:07:15', 'Mình bị dị ứng hải sản, bạn đổi món khác được không?'),
(5, 103, 3, 5, '2025-12-13 16:37:15', 'Viết giúp mình một đoạn caption thả thính hài hước đăng Facebook.'),
(6, 104, 1, 3, '2025-12-11 17:07:15', 'Mình đang buồn vì cãi nhau với người yêu, hãy cho mình lời khuyên.'),
(7, 101, 2, 4, '2025-12-13 16:57:15', 'Giải thích ngắn gọn về nguyên lý hoạt động của Blockchain.'),
(8, 103, 3, 1, '2025-12-13 17:07:15', 'Kể cho tôi nghe một câu chuyện cười ngắn đi.');

-- --------------------------------------------------------

--
-- Table structure for table `conditiontype`
--

CREATE TABLE `conditiontype` (
  `ConditionTypeID` int(11) NOT NULL,
  `ConditionName` varchar(100) DEFAULT NULL,
  `ConditionDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emotionentry`
--

CREATE TABLE `emotionentry` (
  `EntryID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IconID` int(11) DEFAULT NULL,
  `EntryTime` datetime DEFAULT current_timestamp(),
  `EmotionDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emotionentry`
--

INSERT INTO `emotionentry` (`EntryID`, `UserID`, `IconID`, `EntryTime`, `EmotionDescription`) VALUES
(2, 111, 5, '2025-12-20 08:40:08', 'ádsa'),
(3, 111, 1, '2025-12-20 10:02:08', 'đâsd'),
(4, 112, 4, '2025-12-20 10:05:18', 'hôm nay tao buồn'),
(5, 115, 1, '2025-12-20 12:14:22', 'hôm nay t đ vui'),
(6, 116, 8, '2025-12-20 15:37:43', 'jshdajshdjahsd'),
(7, 116, 3, '2025-12-20 15:38:23', 'hádhashd'),
(8, 116, 1, '2025-12-20 15:38:27', 'jksjdsjd'),
(9, 116, 2, '2025-12-18 15:38:55', 'sạdjashd'),
(10, 116, 2, '2025-12-22 15:39:02', ''),
(11, 116, 4, '2025-12-21 15:39:11', ''),
(12, 118, 4, '2025-12-20 18:27:21', 'sdasdasd'),
(13, 118, 4, '2025-12-21 18:27:27', ''),
(14, 118, 2, '2025-12-21 18:27:32', ''),
(15, 118, 8, '2025-12-21 18:27:38', ''),
(16, 118, 8, '2025-12-19 18:27:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `FormID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `FormTopic` varchar(100) DEFAULT NULL,
  `FormContent` text DEFAULT NULL,
  `FormStatus` varchar(20) DEFAULT NULL,
  `FormCreationTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`FormID`, `UserID`, `AdminID`, `FormTopic`, `FormContent`, `FormStatus`, `FormCreationTime`) VALUES
(1, 110, NULL, 'Technical Support', 'máy bị lag', 'Pending', '2025-12-20 12:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `icon`
--

CREATE TABLE `icon` (
  `IconID` int(11) NOT NULL,
  `IconName` varchar(50) DEFAULT NULL,
  `IconSymbol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `icon`
--

INSERT INTO `icon` (`IconID`, `IconName`, `IconSymbol`) VALUES
(1, 'Angry', '🍕'),
(2, 'Sad', '😔'),
(3, 'Tired', '🥱'),
(4, 'Okay', '🙂'),
(5, 'Calm', '😌'),
(6, 'Joyful', '😊'),
(8, 'Cũng cũng', '⚽');

-- --------------------------------------------------------

--
-- Table structure for table `meditationsession`
--

CREATE TABLE `meditationsession` (
  `SessionID` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `SessionName` varchar(100) DEFAULT NULL,
  `SessionType` varchar(50) DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `FilePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `MembershipID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `MembershipStatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `PersonaID` int(11) NOT NULL,
  `PersonaName` varchar(100) NOT NULL,
  `PersonaDescription` text DEFAULT NULL,
  `PersonalityTraits` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`PersonaID`, `PersonaName`, `PersonaDescription`, `PersonalityTraits`) VALUES
(1, 'Trợ lý Thân thiện', 'Một người bạn đồng hành luôn lắng nghe, thấu hiểu và hỗ trợ người dùng giải quyết vấn đề với thái độ tích cực, ấm áp.', 'Vui vẻ, Nhiệt tình, Chu đáo, Tích cực, Kiên nhẫn'),
(2, 'Chuyên gia Phân tích', 'Phong cách làm việc chuyên nghiệp, tập trung vào dữ liệu thực tế, logic và đưa ra các lời khuyên ngắn gọn, chính xác.', 'Nghiêm túc, Logic, Sắc sảo, Khách quan, Điềm tĩnh'),
(3, 'Nghệ sĩ Sáng tạo', 'Thích hợp cho việc viết lách, brainstorming ý tưởng và những cuộc trò chuyện đầy cảm hứng nghệ thuật, văn thơ.', 'Sáng tạo, Bay bổng, Hài hước, Phá cách, Lãng mạn');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `PlanID` int(11) NOT NULL,
  `PlanName` varchar(100) NOT NULL,
  `PlanDescription` text DEFAULT NULL,
  `PlanPrice` decimal(10,2) DEFAULT NULL,
  `BillingCycle` varchar(20) DEFAULT NULL,
  `PlanVideoURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`PlanID`, `PlanName`, `PlanDescription`, `PlanPrice`, `BillingCycle`, `PlanVideoURL`) VALUES
(1, 'Free', 'Basic features available (2 trials)', 0.00, 'Daily', 'https://www.youtube.com/watch?v=bXyPSlZPDiY'),
(2, 'Essential', 'Unlock advanced featured.', 99000.00, 'Monthly', 'https://www.youtube.com/watch?v=hpomJDXnHZE'),
(3, 'Premium', 'Unlocked exclusive feature.', 990000.00, 'Daily', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `planfeature`
--

CREATE TABLE `planfeature` (
  `FeatureID` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `FeatureDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planfeature`
--

INSERT INTO `planfeature` (`FeatureID`, `PlanID`, `FeatureDescription`) VALUES
(1, 1, '2 short sessions (13 minutes)'),
(2, 1, 'Breathing Animation'),
(3, 1, 'Basic Chatbot'),
(4, 2, '5 sessions'),
(5, 2, 'Emotion Chat + Mood Chart'),
(6, 2, 'Select multiple persona + topic (counselor, parents...)'),
(7, 3, '30 diverse sessions'),
(8, 3, 'Select multiple persona + topic (psychologists...)'),
(9, 3, 'Automatic focus reminders'),
(10, 3, 'Analyze emotional trends'),
(11, 3, 'Deeper Emotional Insights');

-- --------------------------------------------------------

--
-- Table structure for table `refundrequest`
--

CREATE TABLE `refundrequest` (
  `RefundID` int(11) NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `RefundType` varchar(20) DEFAULT NULL,
  `RefundAmount` decimal(10,2) DEFAULT NULL,
  `RefundDetails` text DEFAULT NULL,
  `EvidencePath` varchar(255) DEFAULT NULL,
  `RefundStatus` varchar(20) DEFAULT NULL,
  `AdminResponse` text DEFAULT NULL,
  `RequestDate` datetime DEFAULT current_timestamp(),
  `UpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refundrequest`
--

INSERT INTO `refundrequest` (`RefundID`, `TransactionID`, `RefundType`, `RefundAmount`, `RefundDetails`, `EvidencePath`, `RefundStatus`, `AdminResponse`, `RequestDate`, `UpdatedDate`) VALUES
(3, 1, 'Sai gói dịch vụ', 500000.00, 'Tôi mua nhầm gói doanh nghiệp thay vì cá nhân', 'images/evidence/ev1.jpg', 'Pending', NULL, '2025-12-13 15:39:47', NULL),
(4, 2, 'Lỗi thanh toán', 200000.00, 'Bị trừ tiền 2 lần', 'images/evidence/ev2.png', 'Approved', 'Đã hoàn tiền vào ví', '2025-12-13 15:39:47', NULL),
(8, 17, 'Service Not Working', 90000.00, 'quá lag', NULL, 'Pending', NULL, '2025-12-20 21:43:38', NULL),
(9, 24, 'Service Not Working', 990000.00, 'ádasd', NULL, 'Pending', NULL, '2025-12-21 00:07:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `ReportType` varchar(50) DEFAULT NULL,
  `ReportContent` text DEFAULT NULL,
  `ReportStartTime` datetime DEFAULT NULL,
  `ReportEndTime` datetime DEFAULT NULL,
  `ReportTime` datetime DEFAULT current_timestamp(),
  `Status` varchar(20) DEFAULT 'Pending',
  `AdminResponse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`ReportID`, `UserID`, `AdminID`, `ReportType`, `ReportContent`, `ReportStartTime`, `ReportEndTime`, `ReportTime`, `Status`, `AdminResponse`) VALUES
(1, 101, NULL, 'Lỗi kỹ thuật', 'Tôi không thể đăng nhập vào tài khoản premium.', '2025-12-13 15:28:40', '2025-12-13 15:28:40', '2025-12-13 15:28:40', 'Pending', 'im đi gobi'),
(2, 102, NULL, 'Nội dung xấu', 'Có người dùng đăng tải nội dung không phù hợp.', '2025-12-13 15:28:40', '2025-12-13 15:28:40', '2025-12-13 15:28:40', 'Processed', 'kệ nó đi'),
(3, 103, NULL, 'Thanh toán', 'Tôi đã thanh toán nhưng chưa được nâng cấp gói.', '2025-12-13 15:28:40', '2025-12-13 15:28:40', '2025-12-13 15:28:40', 'Resolved', NULL),
(4, 110, NULL, 'Technical Support', 'máy bị lag', '2025-12-20 13:05:41', '2025-12-20 13:05:41', '2025-12-20 13:05:41', 'Pending', 'kệ m'),
(5, 115, NULL, 'Lỗi kỹ thuật', 'lag', '2025-12-20 18:25:05', '2025-12-20 18:25:05', '2025-12-20 18:25:05', 'Pending', 'ok'),
(6, 116, NULL, 'Nội dung xấu', 'lag', '2025-12-20 21:45:19', '2025-12-20 21:45:19', '2025-12-20 21:45:19', 'Resolved', 'ok'),
(7, 116, NULL, 'Nội dung xấu', 'lag', '2025-12-20 21:45:44', '2025-12-20 21:45:44', '2025-12-20 21:45:44', 'Pending', NULL),
(8, 116, NULL, 'Nội dung xấu', 'lag', '2025-12-20 21:45:55', '2025-12-20 21:45:55', '2025-12-20 21:45:55', 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptioncancel`
--

CREATE TABLE `subscriptioncancel` (
  `CancelID` int(11) NOT NULL,
  `MembershipID` int(11) NOT NULL,
  `CancellationType` varchar(20) DEFAULT NULL,
  `CancellationReason` text DEFAULT NULL,
  `CancellationTime` datetime DEFAULT current_timestamp(),
  `CancellationStatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptioncancel`
--

INSERT INTO `subscriptioncancel` (`CancelID`, `MembershipID`, `CancellationType`, `CancellationReason`, `CancellationTime`, `CancellationStatus`) VALUES
(17, 33, 'Immediate', 'I don’t use the service much', '2025-12-21 08:11:16', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `TopicID` int(11) NOT NULL,
  `TopicName` varchar(100) NOT NULL,
  `TopicDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`TopicID`, `TopicName`, `TopicDescription`) VALUES
(1, 'Trò chuyện hàng ngày', 'Thảo luận về các chủ đề đời sống, sở thích, tâm sự và chia sẻ câu chuyện cá nhân một cách tự nhiên.'),
(2, 'Công nghệ & Lập trình', 'Hỗ trợ giải đáp thắc mắc về code, sửa lỗi, tìm hiểu công nghệ mới và các công cụ phần mềm.'),
(3, 'Tư vấn tình cảm', 'Lắng nghe và đưa ra lời khuyên khách quan cho các vấn đề về tình yêu, gia đình và các mối quan hệ xã hội.'),
(4, 'Học tập & Giáo dục', 'Hỗ trợ giải bài tập, tìm kiếm tài liệu tham khảo, dịch thuật và gợi ý phương pháp học tập hiệu quả.'),
(5, 'Sáng tạo nội dung', 'Gợi ý ý tưởng viết bài, soạn thảo email, kịch bản video, làm thơ hoặc viết truyện ngắn.'),
(6, 'Sức khỏe & Đời sống', 'Cung cấp thông tin tham khảo về dinh dưỡng, các bài tập thể dục và mẹo vặt để có lối sống lành mạnh.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `PaymentStatus` varchar(20) DEFAULT NULL,
  `PaymentTime` datetime DEFAULT current_timestamp(),
  `Amount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `OrderID`, `PaymentMethod`, `PaymentStatus`, `PaymentTime`, `Amount`) VALUES
(1, 1, 'Momo', 'Completed', '2023-10-25 09:35:00', NULL),
(2, 3, 'Ví nội bộ', 'Completed', '2023-10-27 10:05:00', NULL),
(3, 5, 'ZaloPay', 'Completed', '2023-10-29 08:25:00', NULL),
(4, 23, 'Credit Card', 'Completed', '2025-12-20 18:05:52', 99000.00),
(5, 24, 'Momo', 'Completed', '2025-12-20 18:07:02', 990000.00),
(6, 26, 'Bank Transfer', 'Completed', '2025-12-20 18:19:24', 990000.00),
(7, 27, 'Momo', 'Completed', '2025-12-20 18:26:55', 99000.00),
(8, 29, 'Momo', 'Completed', '2025-12-21 01:37:03', 99000.00),
(9, 30, 'Bank Transfer', 'Completed', '2025-12-21 01:54:21', 990000.00),
(10, 31, 'Credit Card', 'Completed', '2025-12-21 01:55:10', 99000.00),
(11, 32, 'Momo', 'Completed', '2025-12-21 01:56:46', 99000.00),
(12, 33, 'Bank Transfer', 'Completed', '2025-12-21 02:05:32', 99000.00),
(13, 34, 'Credit Card', 'Completed', '2025-12-21 02:12:00', 99000.00);

-- --------------------------------------------------------

--
-- Table structure for table `userbadge`
--

CREATE TABLE `userbadge` (
  `UserBadgeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BadgeID` int(11) NOT NULL,
  `ReceiveTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `OrderStatus` varchar(20) DEFAULT NULL,
  `PurchaseTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userorder`
--

INSERT INTO `userorder` (`OrderID`, `UserID`, `PlanID`, `TotalAmount`, `OrderStatus`, `PurchaseTime`) VALUES
(1, 101, 2, 99000.00, 'Completed', '2023-10-25 09:30:00'),
(2, 102, 3, 990000.00, 'Pending', '2023-10-26 14:15:00'),
(3, 103, 1, 0.00, 'Completed', '2023-10-27 10:00:00'),
(5, 104, 2, 99000.00, 'Completed', '2023-10-29 08:20:00'),
(6, 114, 1, 0.00, 'Completed', '2025-12-20 10:31:59'),
(7, 114, 2, 99000.00, 'Completed', '2025-12-20 10:35:35'),
(8, 114, 3, 990000.00, 'Cancelled', '2025-12-20 10:40:10'),
(10, 110, 1, 0.00, 'Completed', '2025-12-20 11:11:59'),
(11, 115, 1, 0.00, 'Completed', '2025-12-20 12:17:14'),
(12, 115, 2, 99000.00, 'Completed', '2025-12-20 12:18:11'),
(15, 116, 1, 0.00, 'Completed', '2025-12-20 15:40:31'),
(16, 116, 2, 99000.00, 'Cancelled', '2025-12-20 15:41:17'),
(17, 116, 3, 90000.00, 'Completed', '2025-12-20 15:43:16'),
(18, 117, 1, 0.00, 'Cancelled', '2025-12-20 23:39:28'),
(23, 118, 2, 99000.00, 'Cancelled', '2025-12-20 18:05:52'),
(24, 118, 3, 990000.00, 'Cancelled', '2025-12-20 18:07:02'),
(25, 118, 1, 0.00, 'Completed', '2025-12-21 00:08:00'),
(26, 118, 3, 990000.00, 'Cancelled', '2025-12-20 18:19:24'),
(27, 118, 2, 99000.00, 'Completed', '2025-12-20 18:26:55'),
(28, 119, 1, 0.00, 'Completed', '2025-12-21 07:28:29'),
(29, 119, 2, 99000.00, 'Cancelled', '2025-12-21 01:37:03'),
(30, 119, 3, 990000.00, 'Cancelled', '2025-12-21 01:54:21'),
(31, 119, 2, 99000.00, 'Cancelled', '2025-12-21 01:55:10'),
(32, 119, 2, 99000.00, 'Cancelled', '2025-12-21 01:56:46'),
(33, 120, 2, 99000.00, 'Cancelled', '2025-12-21 02:05:32'),
(34, 120, 2, 99000.00, 'Completed', '2025-12-21 02:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `BirthDate` date DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `UsageLeft` int(11) DEFAULT 0 COMMENT 'Số lần sử dụng còn lại',
  `IsTrialActive` tinyint(1) DEFAULT 0 COMMENT 'Đang dùng thử hay không',
  `secret_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `UserEmail`, `UserPassword`, `BirthDate`, `PhoneNumber`, `Gender`, `UsageLeft`, `IsTrialActive`, `secret_answer`) VALUES
(101, 'Nguyễn Văn An', 'an.nguyen@example.com', '123456', '1995-05-15', '0901112222', 'Nam', 0, 0, ''),
(102, 'Trần Thị Bích', 'bich.tran@example.com', '123456', '1998-10-20', '0912333444', 'Nữ', 0, 0, ''),
(103, 'Lê Hoàng Nam', 'nam.le@example.com', '123456', '2000-01-01', '0988777666', 'Nam', 0, 0, ''),
(104, 'Phạm Thu Hà', 'ha.pham@example.com', '123456', '1992-12-12', '0905555888', 'Nữ', 0, 0, ''),
(106, 'nguyendeptrai', 'phamtrongnguyen04@gmail.com', '$2y$10$KyCfdmGqnH2RuqAehgYyBemEvXxKZXNqAPShWT3aESkVlPL0q.5/S', '2005-03-11', '0396043816', 'Other', 0, 2, ''),
(107, 'tnguyen', '123@gmail.com', '$2y$10$PfAexkL0EWHQZqhhk8QJ2.mlNVol7hzCOMqObeQxpjefNXIf7j2Lm', '2008-03-11', '1234567890', 'Male', 0, 0, ''),
(108, 'tuibidien', '113@gmail.com', '$2y$10$yXU/EGXB5Tc7By7IqbOOo.0RKsm3ul1GF9fJGk53IGRy1PtxF4IE.', '2005-03-11', '0396043816', 'Other', 0, 0, ''),
(110, 'tuibidien', 'tbd@gmail.com', '$2y$10$.Y3YDfmMShjJopPLFE1YIOP1Ra80Xl8Rcma.CRah05TTWgUA/PzCi', '2005-03-11', '0396043816', 'Other', 2, 1, ''),
(111, 'edward', 'edward@gmail.com', '$2y$10$DBj9DaY1/J9lbb9TDHpzvuNQWc7UMHE.o//ZW59PY/5DDrrdYRDRa', '2011-11-22', '0396043816', 'Male', 1, 1, 'cat'),
(112, 'deptrai', 'eddy@gmail.com', '$2y$10$haJu8WP1ceCXgWPyywbXZO5vYBTUY6/dmjyEdSN8UPUt6dUWjtL8e', '2005-03-11', '0396043816', 'Male', 2, 1, 'dog'),
(113, 'eddi', 'eddi@gmai.com', '$2y$10$3BW8ImopVEmUq2dqMTwUVe.87aIoaFVtqF.RcaY4NYkXQbItrFQKm', '2004-02-11', '1234567890', 'Male', 2, 1, 'frog'),
(114, 'edward1', 'edward1@gmail.com', '$2y$10$wqRn2B8bjxfO2p146A6oo.xWRzxKl3WvrhYvbb0hbtm8MgpdfrYfO', NULL, '32482374823784', NULL, 9999, 1, 'cat'),
(115, 'nguyen321', 'nguyen123@gmail.com', '$2y$10$IdZffX688mUhvDBZ3M1RyuJBKzzJAtUryITMhBI71B5gkExkk14Gq', '2005-03-11', '1234567890', 'Male', 9999, 1, 'cat'),
(116, 'nguyen3213', 'nguyen321@gmail.com', '$2y$10$O49FfXc4lpd3NeH.Zs8dPusN6ZRo9buulByLh7Vg3EyKJIgIA9cGK', '2005-03-11', '1234567890', 'Male', 9999, 1, 'chicken'),
(117, 'chu', 'chu@gmail.com', '$2y$10$iqK4mcr3usFPfxDYnl8X9.KTefcEQd8tPOsfQNsKxE05YqFyGs9A.', '2006-02-25', '1234567890', 'Female', 2, 1, 'cat'),
(118, 'chuchu', 'chuchu@gmail.com', '$2y$10$PgRhbpbhuqp7Hycv/A8CX.BcGr9nKM3QnajXgJGYdBIrl2XsuFs4G', '2006-02-25', '1234567890', 'Female', 9999, 1, 'cat'),
(119, 'phamnguyen', 'phamnguyen@gmail.com', '$2y$10$f114MZaEwS4CgJw8b8rhNeODdHwAytEqhfKsRRd6P.aM1Oujq/7Mu', '2005-03-11', '0396043816', 'Male', 9999, 1, 'cat'),
(120, 'MAI', 'dinhhothienbao1312@gmail.com', '$2y$10$tHSJ11IPpQEoFGU9F/tGDuw4TF4KHcxgF.JJdccrmCLIOMXjfbsyK', '2005-06-07', '0826360672', 'Female', 9999, 1, 'dog');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`BadgeID`);

--
-- Indexes for table `badgecondition`
--
ALTER TABLE `badgecondition`
  ADD PRIMARY KEY (`ConditionID`),
  ADD KEY `BadgeID` (`BadgeID`),
  ADD KEY `ConditionTypeID` (`ConditionTypeID`);

--
-- Indexes for table `chathistory`
--
ALTER TABLE `chathistory`
  ADD PRIMARY KEY (`ChatID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PersonaID` (`PersonaID`),
  ADD KEY `TopicID` (`TopicID`);

--
-- Indexes for table `conditiontype`
--
ALTER TABLE `conditiontype`
  ADD PRIMARY KEY (`ConditionTypeID`);

--
-- Indexes for table `emotionentry`
--
ALTER TABLE `emotionentry`
  ADD PRIMARY KEY (`EntryID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `IconID` (`IconID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`FormID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `icon`
--
ALTER TABLE `icon`
  ADD PRIMARY KEY (`IconID`);

--
-- Indexes for table `meditationsession`
--
ALTER TABLE `meditationsession`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `PlanID` (`PlanID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`MembershipID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlanID` (`PlanID`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`PersonaID`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`PlanID`);

--
-- Indexes for table `planfeature`
--
ALTER TABLE `planfeature`
  ADD PRIMARY KEY (`FeatureID`),
  ADD KEY `PlanID` (`PlanID`);

--
-- Indexes for table `refundrequest`
--
ALTER TABLE `refundrequest`
  ADD PRIMARY KEY (`RefundID`),
  ADD KEY `TransactionID` (`TransactionID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `subscriptioncancel`
--
ALTER TABLE `subscriptioncancel`
  ADD PRIMARY KEY (`CancelID`),
  ADD KEY `fk_cancel_membership` (`MembershipID`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`TopicID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `userbadge`
--
ALTER TABLE `userbadge`
  ADD PRIMARY KEY (`UserBadgeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BadgeID` (`BadgeID`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `PlanID` (`PlanID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `BadgeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badgecondition`
--
ALTER TABLE `badgecondition`
  MODIFY `ConditionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chathistory`
--
ALTER TABLE `chathistory`
  MODIFY `ChatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `conditiontype`
--
ALTER TABLE `conditiontype`
  MODIFY `ConditionTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emotionentry`
--
ALTER TABLE `emotionentry`
  MODIFY `EntryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `FormID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `icon`
--
ALTER TABLE `icon`
  MODIFY `IconID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meditationsession`
--
ALTER TABLE `meditationsession`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `MembershipID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `PersonaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `PlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `planfeature`
--
ALTER TABLE `planfeature`
  MODIFY `FeatureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `refundrequest`
--
ALTER TABLE `refundrequest`
  MODIFY `RefundID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscriptioncancel`
--
ALTER TABLE `subscriptioncancel`
  MODIFY `CancelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `TopicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userbadge`
--
ALTER TABLE `userbadge`
  MODIFY `UserBadgeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badgecondition`
--
ALTER TABLE `badgecondition`
  ADD CONSTRAINT `badgecondition_ibfk_1` FOREIGN KEY (`BadgeID`) REFERENCES `badge` (`BadgeID`),
  ADD CONSTRAINT `badgecondition_ibfk_2` FOREIGN KEY (`ConditionTypeID`) REFERENCES `conditiontype` (`ConditionTypeID`);

--
-- Constraints for table `chathistory`
--
ALTER TABLE `chathistory`
  ADD CONSTRAINT `chathistory_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `chathistory_ibfk_2` FOREIGN KEY (`PersonaID`) REFERENCES `persona` (`PersonaID`),
  ADD CONSTRAINT `chathistory_ibfk_3` FOREIGN KEY (`TopicID`) REFERENCES `topic` (`TopicID`);

--
-- Constraints for table `emotionentry`
--
ALTER TABLE `emotionentry`
  ADD CONSTRAINT `emotionentry_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `emotionentry_ibfk_2` FOREIGN KEY (`IconID`) REFERENCES `icon` (`IconID`);

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `form_ibfk_2` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `meditationsession`
--
ALTER TABLE `meditationsession`
  ADD CONSTRAINT `meditationsession_ibfk_1` FOREIGN KEY (`PlanID`) REFERENCES `plan` (`PlanID`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `membership_ibfk_2` FOREIGN KEY (`PlanID`) REFERENCES `plan` (`PlanID`);

--
-- Constraints for table `planfeature`
--
ALTER TABLE `planfeature`
  ADD CONSTRAINT `planfeature_ibfk_1` FOREIGN KEY (`PlanID`) REFERENCES `plan` (`PlanID`);

--
-- Constraints for table `refundrequest`
--
ALTER TABLE `refundrequest`
  ADD CONSTRAINT `fk_refund_userorder` FOREIGN KEY (`TransactionID`) REFERENCES `userorder` (`OrderID`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `userorder` (`OrderID`);

--
-- Constraints for table `userbadge`
--
ALTER TABLE `userbadge`
  ADD CONSTRAINT `userbadge_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userbadge_ibfk_2` FOREIGN KEY (`BadgeID`) REFERENCES `badge` (`BadgeID`);

--
-- Constraints for table `userorder`
--
ALTER TABLE `userorder`
  ADD CONSTRAINT `userorder_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userorder_ibfk_2` FOREIGN KEY (`PlanID`) REFERENCES `plan` (`PlanID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
