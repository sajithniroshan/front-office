CREATE TABLE IF NOT EXISTS `admin` (
  admin_id int(11) NOT NULL AUTO_INCREMENT,
  admin_name varchar(100) NOT NULL,
  admin_email varchar(150) NOT NULL,
  admin_password varchar(255) NOT NULL,
  admin_type enum('front-office','subject','root') NOT NULL DEFAULT 'front-office',
  admin_status enum('active','inactive') NOT NULL DEFAULT 'active',
  admin_created_at timestamp NOT NULL DEFAULT current_timestamp(),
  admin_updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (admin_id),
  UNIQUE KEY (admin_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INSERT DATA --

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Sajith Niroshan', 'root@gov.lk', 'root123');