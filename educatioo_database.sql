-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-01-2022 a las 19:06:01
-- Versión del servidor: 5.7.28
-- Versión de PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `educatioo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `correct_answ` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classroom_student`
--

DROP TABLE IF EXISTS `classroom_student`;
CREATE TABLE IF NOT EXISTS `classroom_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classroom_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `pin` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exams`
--

DROP TABLE IF EXISTS `exams`;
CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `min_points` int(11) NOT NULL,
  `start_at` datetime NOT NULL,
  `ends_at` datetime NOT NULL,
  `author` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_questions`
--

DROP TABLE IF EXISTS `exam_questions`;
CREATE TABLE IF NOT EXISTS `exam_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `value` int(5) NOT NULL,
  `next_question` int(11) DEFAULT NULL,
  `show_in_resukt` tinyint(1) NOT NULL DEFAULT '0',
  `latest_question` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lands`
--

DROP TABLE IF EXISTS `lands`;
CREATE TABLE IF NOT EXISTS `lands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) DEFAULT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lands`
--

INSERT INTO `lands` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`, `created_at`, `updated_at`) VALUES
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', '', 0, 246, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', '', 0, 61, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', '', 0, 672, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'YT', 'MAYOTTE', 'Mayotte', '', 0, 269, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', '', 0, 970, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', '', 0, 381, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', '', 0, 670, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `levels`
--

DROP TABLE IF EXISTS `levels`;
CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `levels`
--

INSERT INTO `levels` (`id`, `level`, `created_at`, `updated_at`) VALUES
(2, 'eeeee', '2021-12-23 02:49:14', '2021-12-23 02:49:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plans`
--

INSERT INTO `plans` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Example Plan', '2021-12-23 03:05:57', '2021-12-23 03:05:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `value` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','trainer','student') NOT NULL,
  `school` varchar(255) DEFAULT NULL,
  `land_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_session` date DEFAULT NULL,
  `subscription_date` date DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `total_students` int(11) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `image`, `name`, `email`, `password`, `role`, `school`, `land_id`, `created_at`, `updated_at`, `last_session`, `subscription_date`, `plan_id`, `total_students`, `remember_token`) VALUES
(1, '/star-admin/images/faces/face10.jpg', 'Yeny Firvida ', 'yfirvida@yahoo.es', '$2y$10$.P.ebgafhpIVCdYjMXlF/O6T7c.JUB7V5lclU3mAiMvsrtl1cdVte', 'admin', NULL, 150, '2021-12-18 19:32:53', '2022-01-03 19:03:18', NULL, '2021-12-09', NULL, 0, NULL),
(2, NULL, 'Trainer one l', 'admin@me.com', '$2y$10$.P.ebgafhpIVCdYjMXlF/O6T7c.JUB7V5lclU3mAiMvsrtl1cdVte', 'trainer', 'some school', 150, '2021-12-23 03:25:35', '2021-12-23 09:19:45', NULL, '2021-12-22', 1, NULL, NULL),
(3, NULL, 'teriner two', 'otheremail@mail.com', '$2y$10$.P.ebgafhpIVCdYjMXlF/O6T7c.JUB7V5lclU3mAiMvsrtl1cdVte', 'trainer', '', 19, '2021-12-23 03:29:26', '2021-12-23 03:29:26', NULL, '2021-12-23', 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
