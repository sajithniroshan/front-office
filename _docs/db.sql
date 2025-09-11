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

CREATE TABLE IF NOT EXISTS `gn` (
  gn_id int(11) NOT NULL,
  gn_name varchar(70) NOT NULL,
  gn_code varchar(30) NOT NULL,
  PRIMARY KEY (gn_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `village` (
  village_id int(11) NOT NULL,
  village_name varchar(70) NOT NULL,
  gn_id int(11) NOT NULl,
  PRIMARY KEY (village_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `section` (
  section_id int(11) NOT NULL,
  section_name varchar(100) NOT NULL,
  PRIMARY KEY (section_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `requirement_state` (
  state_id int(11) NOT NULL,
  state_name varchar(100) NOT NULL,
  PRIMARY KEY (state_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `user` (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  user_unique varchar(255) NOT NULL,
  user_name varchar(255) NOT NULL,
  user_nic varchar(12) NOT NULL,
  user_telephone varchar(12) NOT NULL,
  user_address varchar(512) NOT NULL,
  user_gn smallint(5) NOT NULL,
  user_village smallint(5) NOT NULL,
  user_section smallint(5) NOT NULL,
  user_remarks varchar(512) NOT NULL,
  user_requirement_state smallint(5) NOT NULL,
  user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  user_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id),
  UNIQUE KEY (user_unique)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INSERT DATA --

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Sajith Niroshan', 'root@gov.lk', 'cf2e875d70c402e4aaf32ceb64b1fa6f7396af59'); -- root123 --

INSERT INTO `requirement_state` (`state_id`, `state_name`) VALUES
(1, 'Pending'),
(2, 'Success'),
(3, 'Need Additional Document'),
(4, 'Processing'),
(5, 'Transfer to other office'),
(6, 'Customer Revisit');

INSERT INTO `gn` (`gn_id`, `gn_name`, `gn_code`) VALUES
(1, 'ඉඳිකොලපැලැස්ස', '149/B/2'),
(2, 'කටුපිලගම', '149/A'),
(3, 'කිරිඉබ්බන්වැව', '149/E/2'),
(4, 'නුගේගලයාය', '149/F/1'),
(5, 'පුංචිවැව', '149/G/2'),
(6, 'බහිරාව', '149/B/1'),
(7, 'මහගම', '149/B'),
(8, 'මුතුමිණිගම', '149/A/1'),
(9, 'වැලිආර', '149/G/1'),
(10, 'සමගිපුර', '149/G'),
(11, 'සෙවනගල', '149/E/1'),
(12, 'හබරත්තාවෙල', '149/B/3'),
(13, 'හබරලුවැව', '149/E'),
(14, 'හබුරුගල', '149/F'),
(15, 'වෙනත්', '-');


INSERT INTO `village` (`village_id`, `village_name`, `gn_id`) VALUES
(1, 'ඉඳිකොලපැලැස්ස -(ii)', 1),
(2, 'ඉඳිකොළපැලැස්ස-(i)', 1),
(3, 'ගැමුණුපුර', 1),
(4, 'ආනන්ද ගම', 2),
(5, 'උස්වැලිආර ගම', 2),
(6, 'එකමුතුගම නැගෙනහිර', 2),
(7, 'එකමුතුගම බටහිර', 2),
(8, 'කාවන්තිස්සපුර', 2),
(9, 'කොවුල්ආර උතුර', 2),
(10, 'කොවුල්ආර දකුණ', 2),
(11, 'මඩාරගම', 2),
(12, 'වලවේගම', 2),
(13, 'සමනලගම', 2),
(14, 'කිරිඉබ්බන්වැව -(ii)', 3),
(15, 'කිරිඉබ්බන්වැව දකුණ ජනපදය', 3),
(16, 'කෝන්ගහපැලැස්ස', 3),
(17, 'දෙමටපැලැස්ස', 3),
(18, 'බෝගහ හන්දිය', 3),
(19, 'සිරිදේවගම', 3),
(20, '14 - කණුව', 4),
(21, 'එළිසන්කන්ද (එඩිසන්කන්ද)', 4),
(22, 'කටුවනයාය', 4),
(23, 'කටුවැව', 4),
(24, 'තුංකමයාය', 4),
(25, 'නුගේගලයාය - නැගෙනහිර', 4),
(26, 'නුගේගලයාය - බටහිර', 4),
(27, 'මිද්දෙනියාය', 4),
(28, 'කටුව ගම', 5),
(29, 'ගල්කණුයාය', 5),
(30, 'පුංචිවැව', 5),
(31, 'වැව්තුඩුව', 5),
(32, 'එක්සත්පුර', 6),
(33, 'ඩංඩුම (කො)', 6),
(34, 'බහිරාව(කොටසක්)', 6),
(35, 'මිහිඳුගම', 6),
(36, 'කඳවුරුපෙදෙස', 7),
(37, 'කුරුගම්වැටිය', 7),
(38, 'මහගම උතුර', 7),
(39, 'මහගම දකුණ', 7),
(40, 'ගිණිගල්පැලැස්ස', 8),
(41, 'තල්පතගම', 8),
(42, 'දලුක්කැටිය', 8),
(43, 'නාමල් ගම', 8),
(44, 'මකුළුවගම', 8),
(45, 'මුතුමිණිගම', 8),
(46, 'කුමාරපුර', 9),
(47, 'වැලිආර', 9),
(48, 'දේවපුර', 10),
(49, 'උඩවලව පාර', 10),
(50, 'නෙළුම්වැව', 10),
(51, 'නෙළුම්සිරි ගම', 10),
(52, 'සමගිපුර', 10),
(53, 'ඩංඩුම', 11),
(54, 'නවෝදාගම', 11),
(55, 'මිහිඳුපුර', 11),
(56, 'ලක්සිරිගම', 11),
(57, 'වාසනාගම', 11),
(58, 'සම්පත්ගම', 11),
(59, 'සෙවනගල ආයතන නිවාස සංකීර්ණය', 11),
(60, 'සෙවනගල උතුර', 11),
(61, 'සෙවනගල ගම', 11),
(62, 'සෙවනගල හන්දිය', 11),
(63, 'කලුදියආර', 12),
(64, 'දෙමෝදර', 12),
(65, 'මහවැලිගම', 12),
(66, 'වීරමණ්ඩිය', 12),
(67, 'හබරත්තාවෙල', 12),
(68, 'උඩමව්ආර', 13),
(69, 'තුන්හිරියාව', 13),
(70, 'මයුරාගම', 13),
(71, 'වැවේයාය ගම', 13),
(72, 'හබරලුවැව', 13),
(73, 'ඉකිරියජුලාන', 14),
(74, 'කැටගල්ආර', 14),
(75, 'කිරිඉබ්බන්වැව - වම', 14),
(76, 'දිජ්ජුලාන', 14),
(77, 'බෝධිරාජපුර', 14),
(78, 'සමාධිපුර', 14),
(79, 'හබුරුගල', 14),
(80, 'බහිරාව(කො)', 12),
(81, 'වෙනත්', 15);

INSERT INTO `section` (`section_id`, `section_name`) VALUES
(1, 'ආයතන අංශය'),
(2, 'ඉඩම් අංශය'),
(3, 'ගිණුම් අංශය'),
(4, 'සමාජ සේවා අංශය'),
(5, 'සැලසුම් අංශය'),
(6, 'රෙජිස්ට්&zwj;රාර් අංශය'),
(7, 'හැඳුනුම්පත් අංශය'),
(8, 'විදේශ සේවා'),
(9, 'සමෘද්ධි අංශය'),
(10, 'අනුයක්ත ක්ෂේත්&zwj;ර නිලධාරී අංශය'),
(11, 'ඵලදායිතා අංශය'),
(12, 'කුඩා ව්&zwj;යාපාර අංශය'),
(13, 'විදතා සම්පත් මධ්&zwj;යස්ථානය');

