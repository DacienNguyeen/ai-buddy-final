-- 1. CẬP NHẬT BẢNG `persona`
-- Đổi tên cột, thêm cột SystemPrompt, Icon, IsPremium
ALTER TABLE `persona` 
    CHANGE `PersonaDescription` `Description` TEXT NULL DEFAULT NULL;

ALTER TABLE `persona`
    ADD COLUMN `SystemPrompt` TEXT NULL AFTER `Description`,
    ADD COLUMN `Icon` VARCHAR(50) DEFAULT '🤖' AFTER `SystemPrompt`,
    ADD COLUMN `IsPremium` TINYINT(1) DEFAULT 0 AFTER `Icon`;

-- 2. CẬP NHẬT BẢNG `topic`
-- Đổi tên cột mô tả cho chuẩn với code
ALTER TABLE `topic` 
    CHANGE `TopicDescription` `Description` TEXT NULL DEFAULT NULL;

-- 3. TẠO BẢNG `chatsessions` (Quản lý các cuộc hội thoại)
-- Lưu ý: Sử dụng tên bảng thường (chatsessions) để tránh lỗi case-sensitive
CREATE TABLE IF NOT EXISTS `chatsessions` (
  `SessionID` INT(11) NOT NULL AUTO_INCREMENT,
  `UserID` INT(11) NOT NULL,
  `PersonaID` INT(11) NOT NULL,
  `TopicID` INT(11) DEFAULT NULL,
  `Title` VARCHAR(100) DEFAULT 'New Conversation',
  `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SessionID`),
  FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  FOREIGN KEY (`PersonaID`) REFERENCES `persona` (`PersonaID`),
  FOREIGN KEY (`TopicID`) REFERENCES `topic` (`TopicID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. TẠO BẢNG `chatmessages` (Lưu nội dung tin nhắn chi tiết)
CREATE TABLE IF NOT EXISTS `chatmessages` (
  `MessageID` INT(11) NOT NULL AUTO_INCREMENT,
  `SessionID` INT(11) NOT NULL,
  `Sender` ENUM('User', 'AI') NOT NULL,
  `Content` TEXT NOT NULL,
  `ImagePath` VARCHAR(255) DEFAULT NULL,
  `AudioUrl` VARCHAR(255) DEFAULT NULL,
  `CreatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MessageID`),
  FOREIGN KEY (`SessionID`) REFERENCES `chatsessions` (`SessionID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. XÓA BẢNG CŨ KHÔNG DÙNG (Nếu có)
-- Bảng chathistory cũ không còn phù hợp với cấu trúc mới
DROP TABLE IF EXISTS `chathistory`;

-- 6. THÊM DỮ LIỆU MẪU (OPTIONAL - Để test ngay không bị trống)
-- Cập nhật dữ liệu cho Persona mặc định
UPDATE `persona` 
SET `SystemPrompt` = 'You are a friendly and empathetic AI companion. You listen to users without judgment and offer warm, supportive advice.', 
    `Icon` = '🥰', 
    `Description` = 'Always here to listen and care.'
WHERE `PersonaID` = 1;

-- Thêm một Topic mẫu nếu chưa có
INSERT INTO `topic` (`TopicName`, `Description`) 
SELECT * FROM (SELECT 'General Chat', 'Talk about anything you want.') AS tmp
WHERE NOT EXISTS (
    SELECT TopicName FROM `topic` WHERE TopicName = 'General Chat'
) LIMIT 1;

