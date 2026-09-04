-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gleeo
CREATE DATABASE IF NOT EXISTS `gleeo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gleeo`;

-- Volcando estructura para tabla gleeo.alert_configurations
CREATE TABLE IF NOT EXISTS `alert_configurations` (
  `alert_config_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `level_id` bigint unsigned NOT NULL,
  `max_errors_allowed` int NOT NULL DEFAULT '5',
  `time_frame` enum('1 dia','1 semana','1 mes','24 Horas','7 Dias','30 Dias') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1 semana',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`alert_config_id`),
  KEY `alert_configurations_level_id_foreign` (`level_id`),
  CONSTRAINT `alert_configurations_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.alert_configurations: ~2 rows (aproximadamente)
INSERT INTO `alert_configurations` (`alert_config_id`, `level_id`, `max_errors_allowed`, `time_frame`, `state`, `created_at`, `updated_at`) VALUES
	(1, 1, 5, '24 Horas', 0, '2026-03-13 01:14:10', '2026-03-13 01:14:10'),
	(2, 2, 5, '24 Horas', 0, '2026-03-13 01:14:10', '2026-03-13 01:14:10');

-- Volcando estructura para tabla gleeo.alert_threshold
CREATE TABLE IF NOT EXISTS `alert_threshold` (
  `alert_threshold_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `decision_pattern_id` bigint unsigned NOT NULL,
  `refuerzo_fail_limit` int unsigned DEFAULT NULL,
  `alert_ce_activations` int unsigned DEFAULT NULL,
  `time_window` enum('24 Horas','7 Dias','30 Dias','N/A') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alert_recipient` enum('Profesor(a)','Estudiante') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`alert_threshold_id`),
  KEY `alert_threshold_decision_pattern_id_foreign` (`decision_pattern_id`),
  CONSTRAINT `alert_threshold_decision_pattern_id_foreign` FOREIGN KEY (`decision_pattern_id`) REFERENCES `decision_pattern` (`decision_pattern_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.alert_threshold: ~4 rows (aproximadamente)
INSERT INTO `alert_threshold` (`alert_threshold_id`, `decision_pattern_id`, `refuerzo_fail_limit`, `alert_ce_activations`, `time_window`, `alert_recipient`, `created_at`, `updated_at`, `is_active`) VALUES
	(1, 1, 0, 2, 'N/A', 'Profesor(a)', NULL, NULL, 1),
	(2, 2, 0, 2, '24 Horas', 'Estudiante', NULL, NULL, 1),
	(3, 3, 0, 4, '7 Dias', 'Estudiante', NULL, NULL, 1),
	(4, 4, 0, 2, '30 Dias', 'Estudiante', NULL, NULL, 1);

-- Volcando estructura para tabla gleeo.avatars
CREATE TABLE IF NOT EXISTS `avatars` (
  `avatar_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`avatar_id`),
  UNIQUE KEY `avatars_name_unique` (`name`),
  UNIQUE KEY `avatars_url_unique` (`url`),
  UNIQUE KEY `avatars_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.avatars: ~3 rows (aproximadamente)
INSERT INTO `avatars` (`avatar_id`, `name`, `url`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Defecto', 'default.png', 'default', NULL, NULL),
	(2, 'Niño', 'boy.png', 'boy', NULL, NULL),
	(3, 'Niña', 'girl.png', 'nina', NULL, NULL);

-- Volcando estructura para tabla gleeo.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.cache: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.cache_locks: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `countries_country_unique` (`country`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.countries: ~193 rows (aproximadamente)
INSERT INTO `countries` (`country_id`, `country`) VALUES
	(1, 'Afganistán'),
	(2, 'Albania'),
	(3, 'Alemania'),
	(4, 'Andorra'),
	(5, 'Angola'),
	(6, 'Antigua y Barbuda'),
	(7, 'Arabia Saudita'),
	(8, 'Argelia'),
	(9, 'Argentina'),
	(10, 'Armenia'),
	(11, 'Australia'),
	(12, 'Austria'),
	(13, 'Azerbaiyán'),
	(14, 'Bahamas'),
	(15, 'Bangladés'),
	(16, 'Barbados'),
	(17, 'Baréin'),
	(18, 'Bélgica'),
	(19, 'Belice'),
	(20, 'Benín'),
	(21, 'Bielorrusia'),
	(22, 'Birmania'),
	(23, 'Bolivia'),
	(24, 'Bosnia y Herzegovina'),
	(25, 'Botsuana'),
	(26, 'Brasil'),
	(27, 'Brunéi'),
	(28, 'Bulgaria'),
	(29, 'Burkina Faso'),
	(30, 'Burundi'),
	(31, 'Bután'),
	(32, 'Cabo Verde'),
	(33, 'Camboya'),
	(34, 'Camerún'),
	(35, 'Canadá'),
	(36, 'Catar'),
	(37, 'Chad'),
	(38, 'Chile'),
	(39, 'China'),
	(40, 'Chipre'),
	(41, 'Ciudad del Vaticano'),
	(42, 'Colombia'),
	(43, 'Comoras'),
	(44, 'Corea del Norte'),
	(45, 'Corea del Sur'),
	(46, 'Costa de Marfil'),
	(47, 'Costa Rica'),
	(48, 'Croacia'),
	(49, 'Cuba'),
	(50, 'Dinamarca'),
	(51, 'Dominica'),
	(52, 'Ecuador'),
	(53, 'Egipto'),
	(54, 'El Salvador'),
	(55, 'Emiratos Árabes Unidos'),
	(56, 'Eritrea'),
	(57, 'Eslovaquia'),
	(58, 'Eslovenia'),
	(59, 'España'),
	(60, 'Estados Unidos'),
	(61, 'Estonia'),
	(62, 'Etiopía'),
	(63, 'Filipinas'),
	(64, 'Finlandia'),
	(65, 'Fiyi'),
	(66, 'Francia'),
	(67, 'Gabón'),
	(68, 'Gambia'),
	(69, 'Georgia'),
	(70, 'Ghana'),
	(71, 'Granada'),
	(72, 'Grecia'),
	(73, 'Guatemala'),
	(75, 'Guinea'),
	(76, 'Guinea ecuatorial'),
	(77, 'Guinea-Bisáu'),
	(74, 'Guyana'),
	(78, 'Haití'),
	(79, 'Honduras'),
	(80, 'Hungría'),
	(81, 'India'),
	(82, 'Indonesia'),
	(83, 'Irak'),
	(84, 'Irán'),
	(85, 'Irlanda'),
	(86, 'Islandia'),
	(87, 'Islas Marshall'),
	(88, 'Islas Salomón'),
	(89, 'Israel'),
	(90, 'Italia'),
	(91, 'Jamaica'),
	(92, 'Japón'),
	(93, 'Jordania'),
	(94, 'Kazajistán'),
	(95, 'Kenia'),
	(96, 'Kirguistán'),
	(97, 'Kiribati'),
	(98, 'Kuwait'),
	(99, 'Laos'),
	(100, 'Lesoto'),
	(101, 'Letonia'),
	(102, 'Líbano'),
	(103, 'Liberia'),
	(104, 'Libia'),
	(105, 'Liechtenstein'),
	(106, 'Lituania'),
	(107, 'Luxemburgo'),
	(108, 'Madagascar'),
	(109, 'Malasia'),
	(110, 'Malaui'),
	(111, 'Maldivas'),
	(112, 'Malí'),
	(113, 'Malta'),
	(114, 'Marruecos'),
	(115, 'Mauricio'),
	(116, 'Mauritania'),
	(117, 'México'),
	(118, 'Micronesia'),
	(119, 'Moldavia'),
	(120, 'Mónaco'),
	(121, 'Mongolia'),
	(122, 'Montenegro'),
	(123, 'Mozambique'),
	(124, 'Namibia'),
	(125, 'Nauru'),
	(126, 'Nepal'),
	(127, 'Nicaragua'),
	(128, 'Níger'),
	(129, 'Nigeria'),
	(130, 'Noruega'),
	(131, 'Nueva Zelanda'),
	(132, 'Omán'),
	(133, 'Países Bajos'),
	(134, 'Pakistán'),
	(135, 'Palaos'),
	(136, 'Panamá'),
	(137, 'Papúa Nueva Guinea'),
	(138, 'Paraguay'),
	(139, 'Perú'),
	(140, 'Polonia'),
	(141, 'Portugal'),
	(142, 'Reino Unido'),
	(143, 'República Centroafricana'),
	(144, 'República Checa'),
	(145, 'República del Congo'),
	(146, 'República Democrática del Congo'),
	(147, 'República Dominicana'),
	(148, 'Ruanda'),
	(149, 'Rumanía'),
	(150, 'Rusia'),
	(151, 'Samoa'),
	(152, 'San Cristóbal y Nieves'),
	(153, 'San Marino'),
	(154, 'San Vicente y las Granadinas'),
	(155, 'Santa Lucía'),
	(156, 'Santo Tomé y Príncipe'),
	(157, 'Senegal'),
	(158, 'Serbia'),
	(159, 'Seychelles'),
	(160, 'Sierra Leona'),
	(161, 'Singapur'),
	(162, 'Siria'),
	(163, 'Somalia'),
	(164, 'Sri Lanka'),
	(165, 'Suazilandia'),
	(166, 'Sudáfrica'),
	(167, 'Sudán'),
	(168, 'Sudán del Sur'),
	(169, 'Suecia'),
	(170, 'Suiza'),
	(171, 'Surinam'),
	(172, 'Tailandia'),
	(173, 'Tanzania'),
	(174, 'Tayikistán'),
	(175, 'Timor Oriental'),
	(176, 'Togo'),
	(177, 'Tonga'),
	(178, 'Trinidad y Tobago'),
	(179, 'Túnez'),
	(180, 'Turkmenistán'),
	(181, 'Turquía'),
	(182, 'Tuvalu'),
	(183, 'Ucrania'),
	(184, 'Uganda'),
	(185, 'Uruguay'),
	(186, 'Uzbekistán'),
	(187, 'Vanuatu'),
	(188, 'Venezuela'),
	(189, 'Vietnam'),
	(190, 'Yemen'),
	(191, 'Yibuti'),
	(192, 'Zambia'),
	(193, 'Zimbabue');

-- Volcando estructura para tabla gleeo.decision_pattern
CREATE TABLE IF NOT EXISTS `decision_pattern` (
  `decision_pattern_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`decision_pattern_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.decision_pattern: ~4 rows (aproximadamente)
INSERT INTO `decision_pattern` (`decision_pattern_id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Activación del Contenido de Esfuerzo', ' Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.', 1, NULL, NULL),
	(2, 'Alerta Intervención Requerida, PreNumérico', 'Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.', 1, NULL, NULL),
	(3, 'Alerta Intervención Requerida, Numérico Emergente', 'Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.', 1, NULL, NULL),
	(4, 'Alerta Intervención Requerida, Desarrollo Emergente', 'Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.', 1, NULL, NULL);

-- Volcando estructura para tabla gleeo.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.genders
CREATE TABLE IF NOT EXISTS `genders` (
  `gender_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`gender_id`),
  UNIQUE KEY `genders_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.genders: ~2 rows (aproximadamente)
INSERT INTO `genders` (`gender_id`, `name`) VALUES
	(2, 'Femenina'),
	(1, 'Masculino');

-- Volcando estructura para tabla gleeo.guides
CREATE TABLE IF NOT EXISTS `guides` (
  `guide_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paragraph` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`guide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.guides: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.identity_cards
CREATE TABLE IF NOT EXISTS `identity_cards` (
  `identity_card_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `identity_card` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `letter` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`identity_card_id`),
  UNIQUE KEY `identity_cards_identity_card_unique` (`identity_card`),
  UNIQUE KEY `identity_cards_letter_unique` (`letter`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.identity_cards: ~6 rows (aproximadamente)
INSERT INTO `identity_cards` (`identity_card_id`, `identity_card`, `description`, `letter`) VALUES
	(1, 'Venezolano cedulado', 'Cédula de identidad para ciudadanos venezolanos.', 'V'),
	(2, 'Extranjero cedulado', 'Cédula de identidad para ciudadanos extranjeros residentes.', 'E'),
	(3, ' Ciudadano no cedulado', 'Identificador para un cuidadano que no tiene ningun documento legar.', NULL),
	(4, 'Pasaporte cedulado', 'Identificador para un cuidadano que no tiene ningun documento legar.', 'P'),
	(5, 'Gobierno', 'Identificador para un cuidadano que no tiene ningun documento legar.', 'G'),
	(6, 'Jurídico', 'Identificador para un cuidadano que no tiene ningun documento legar.', 'J');

-- Volcando estructura para tabla gleeo.insignias
CREATE TABLE IF NOT EXISTS `insignias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.insignias: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.intervention_notifications
CREATE TABLE IF NOT EXISTS `intervention_notifications` (
  `notification_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `player_id` bigint unsigned NOT NULL,
  `representative_id` bigint unsigned NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_errors_detected` int NOT NULL,
  `distinct_lessons_failed` int NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`),
  KEY `intervention_notifications_player_id_foreign` (`player_id`),
  KEY `intervention_notifications_representative_id_foreign` (`representative_id`),
  CONSTRAINT `intervention_notifications_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE,
  CONSTRAINT `intervention_notifications_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`representative_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.intervention_notifications: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.job_batches: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.lessons
CREATE TABLE IF NOT EXISTS `lessons` (
  `lesson_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `guide` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lesson_id`),
  UNIQUE KEY `lessons_title_unique` (`title`),
  UNIQUE KEY `lessons_slug_unique` (`slug`),
  KEY `lessons_topic_id_foreign` (`topic_id`),
  CONSTRAINT `lessons_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.lessons: ~3 rows (aproximadamente)
INSERT INTO `lessons` (`lesson_id`, `topic_id`, `guide`, `title`, `order`, `slug`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Contar es poner los números en orden: 1, 2, 3... ¡Intentémoslo!', 'Conteo hacia adelante', 1, 'conteo-hacia-adelante', 1, 1, '2026-03-13 00:57:55', '2026-03-13 00:57:55'),
	(2, 3, 'Sumar es como hacer una fiesta: ¡todos se reúnen en un solo grupo! Imagina que tienes caramelos en una mano y más caramelos en la otra; cuando los juntas todos en una cajita, estás agrupando. El resultado de esa agrupación es lo que llamamos SUMA.', 'El juego de agrupar objetos', 1, 'el-juego-de-agrupar-objetos', 1, 1, '2026-03-13 01:05:42', '2026-03-13 01:05:42'),
	(3, 1, 'En esta misión, nos convertiremos en astronautas. Para que nuestro cohete despegue, necesitamos activar los 10 motores en orden. Aprenderemos que cada número es un impulso más alto hacia las estrellas. ¡Si llegamos al 10, despegamos!', '¡Cosechando Números en la Granja!', 2, 'cosechando-numeros-en-la-granja', 1, 1, '2026-03-23 07:18:45', '2026-03-23 07:18:45'),
	(4, 7, 'Las figuras geométricas planas son superficies limitadas por líneas rectas o curvas. A diferencia de los objetos sólidos, estas solo tienen dos dimensiones: largo y ancho. Los polígonos, como el triángulo y el cuadrado, se clasifican según su número de lados, mientras que el círculo se define por su radio y circunferencia. Reconocer estas formas nos ayuda a entender la estructura de todo lo que vemos, desde la pantalla de tu móvil hasta las señales de tráfico.', 'El mundo en dos dimensiones', 3, 'el-mundo-en-dos-dimensiones', 1, 1, '2026-03-24 04:30:52', '2026-03-24 04:30:52');

-- Volcando estructura para tabla gleeo.levels
CREATE TABLE IF NOT EXISTS `levels` (
  `level_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `number` int NOT NULL,
  `deleted_at` tinyint(1) NOT NULL DEFAULT '1',
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`level_id`),
  UNIQUE KEY `levels_name_unique` (`name`),
  UNIQUE KEY `levels_number_unique` (`number`),
  UNIQUE KEY `levels_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.levels: ~3 rows (aproximadamente)
INSERT INTO `levels` (`level_id`, `name`, `description`, `number`, `deleted_at`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Básico', NULL, 1, 1, 'nivel-1-basico', '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(2, 'Intermedio', NULL, 2, 1, 'nivel-2-intermedio', '2026-03-13 00:52:40', '2026-03-13 00:52:40');

-- Volcando estructura para tabla gleeo.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_00_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2025_10_09_000007_create_genders_table', 1),
	(6, '2025_10_11_000009_create_identity_cards_table', 1),
	(7, '2025_12_09_173145_create_countries_table', 1),
	(8, '2025_12_10_141626_create_guides_table', 1),
	(9, '2025_12_10_184821_create_decision_pattern_table', 1),
	(10, '2025_12_10_184843_create_alert_threshold_table', 1),
	(11, '2025_12_13_192158_create_representatives_table', 1),
	(12, '2025_12_18_203806_create_levels_table', 1),
	(13, '2025_12_18_203944_create_modules_table', 1),
	(14, '2025_12_18_204024_create_topics_table', 1),
	(15, '2025_12_19_225023_create_lessons_table', 1),
	(16, '2025_12_23_140448_create_types_dynamics_table', 1),
	(17, '2025_12_23_140530_create_reinforcements_table', 1),
	(18, '2025_12_23_140725_create_practice_options_table', 1),
	(19, '2025_12_23_140820_create_insignias_table', 1),
	(20, '2025_12_23_142452_create_practices_table', 1),
	(21, '2025_12_25_121809_create_themes_table', 1),
	(22, '2025_12_27_120213_create_avatars_table', 1),
	(23, '2025_12_27_120247_create_players_table', 1),
	(24, '2025_12_29_011543_create_sufficiency_validations_table', 1),
	(25, '2025_12_29_012412_create_progress_table', 1),
	(26, '2025_12_29_165021_create_player_lessons_table', 1),
	(27, '2025_12_31_205343_create_news_board_table', 1),
	(28, '2026_01_11_133818_reinforcement_failure_limit', 1),
	(29, '2026_01_25_140748_create_player_lesson_history_table', 1),
	(30, '2026_01_25_142313_create_alert_configurations_table', 1),
	(31, '2026_01_25_142319_create_intervention_notifications_table', 1);

-- Volcando estructura para tabla gleeo.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `level_id` bigint unsigned DEFAULT NULL,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `modules_title_unique` (`title`),
  UNIQUE KEY `modules_slug_unique` (`slug`),
  KEY `modules_level_id_foreign` (`level_id`),
  CONSTRAINT `modules_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.modules: ~4 rows (aproximadamente)
INSERT INTO `modules` (`module_id`, `level_id`, `title`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Los números y el conteo', 'los-numeros-y-el-conteo', 0, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(2, 1, 'Formas y figuras geométricas', 'formas-y-figuras-geometricas', 0, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(3, 2, 'Aprendiendo a sumar y restar', 'aprendiendo-a-sumar-y-restar', 0, '2026-03-13 00:52:40', '2026-03-13 00:52:40');

-- Volcando estructura para tabla gleeo.news_board
CREATE TABLE IF NOT EXISTS `news_board` (
  `news_board_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`news_board_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.news_board: ~0 rows (aproximadamente)
INSERT INTO `news_board` (`news_board_id`, `subject`, `description`, `pdf_path`) VALUES
	(1, 'Matematicas', '¡A jugar y descubrir! Entra en un mundo lleno de colores y sorpresas diseñado especialmente para las manitos y mentes de 5 a 7 años. ¡La diversión comienza aquí!', NULL);

-- Volcando estructura para tabla gleeo.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.players
CREATE TABLE IF NOT EXISTS `players` (
  `player_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `representative_id` bigint unsigned NOT NULL,
  `gender_id` bigint unsigned NOT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `theme_id` bigint unsigned DEFAULT NULL,
  `level_assigned_id` bigint unsigned DEFAULT NULL,
  `current_level_id` bigint unsigned DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL,
  `names` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surnames` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`player_id`),
  UNIQUE KEY `players_slug_unique` (`slug`),
  KEY `players_representative_id_foreign` (`representative_id`),
  KEY `players_gender_id_foreign` (`gender_id`),
  KEY `players_avatar_id_foreign` (`avatar_id`),
  KEY `players_theme_id_foreign` (`theme_id`),
  KEY `players_level_assigned_id_foreign` (`level_assigned_id`),
  KEY `players_current_level_id_foreign` (`current_level_id`),
  KEY `players_user_id_foreign` (`user_id`),
  CONSTRAINT `players_avatar_id_foreign` FOREIGN KEY (`avatar_id`) REFERENCES `avatars` (`avatar_id`) ON DELETE SET NULL,
  CONSTRAINT `players_current_level_id_foreign` FOREIGN KEY (`current_level_id`) REFERENCES `levels` (`level_id`) ON DELETE SET NULL,
  CONSTRAINT `players_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  CONSTRAINT `players_level_assigned_id_foreign` FOREIGN KEY (`level_assigned_id`) REFERENCES `levels` (`level_id`) ON DELETE SET NULL,
  CONSTRAINT `players_representative_id_foreign` FOREIGN KEY (`representative_id`) REFERENCES `representatives` (`representative_id`) ON DELETE CASCADE,
  CONSTRAINT `players_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`theme_id`) ON DELETE SET NULL,
  CONSTRAINT `players_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.players: ~1 rows (aproximadamente)
INSERT INTO `players` (`player_id`, `representative_id`, `gender_id`, `avatar_id`, `theme_id`, `level_assigned_id`, `current_level_id`, `validated`, `user_id`, `names`, `surnames`, `date_of_birth`, `slug`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 2, 1, 2, 2, 0, 4, 'Josefo Jose', 'Garcia Godoy', '2020-02-03', 'josefo-garcia', '2026-03-24 04:35:59', '2026-03-24 04:37:14');

-- Volcando estructura para tabla gleeo.players_lessons_history
CREATE TABLE IF NOT EXISTS `players_lessons_history` (
  `player_lesson_history_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `player_id` bigint unsigned NOT NULL,
  `lesson_id` bigint unsigned NOT NULL,
  `estimated_time` time DEFAULT NULL,
  `success_rate` int NOT NULL DEFAULT '0',
  `reward_diamonds` int NOT NULL DEFAULT '0',
  `number_incorrect` int NOT NULL DEFAULT '0',
  `number_correct` int NOT NULL DEFAULT '0',
  `status` enum('Completada','Fallida') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Completada',
  `en_uso` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`player_lesson_history_id`),
  KEY `players_lessons_history_player_id_foreign` (`player_id`),
  KEY `players_lessons_history_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `players_lessons_history_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`) ON DELETE CASCADE,
  CONSTRAINT `players_lessons_history_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.players_lessons_history: ~29 rows (aproximadamente)
INSERT INTO `players_lessons_history` (`player_lesson_history_id`, `player_id`, `lesson_id`, `estimated_time`, `success_rate`, `reward_diamonds`, `number_incorrect`, `number_correct`, `status`, `en_uso`, `completed_at`, `created_at`, `updated_at`) VALUES
	(34, 2, 1, '00:00:01', 100, 1, 0, 1, 'Completada', 0, '2026-03-24 00:36:28', '2026-03-24 04:36:28', '2026-03-24 04:36:28'),
	(35, 2, 3, '00:00:02', 100, 2, 1, 1, 'Completada', 0, '2026-03-24 00:36:42', '2026-03-24 04:36:42', '2026-03-24 04:36:42'),
	(36, 2, 4, '00:00:05', 83, 5, 1, 1, 'Completada', 0, '2026-03-24 00:37:13', '2026-03-24 04:37:13', '2026-03-24 04:37:13'),
	(37, 2, 2, NULL, 100, 3, 1, 1, 'Completada', 0, '2026-03-24 00:37:34', '2026-03-24 04:37:34', '2026-03-24 04:37:34');

-- Volcando estructura para tabla gleeo.player_lessons
CREATE TABLE IF NOT EXISTS `player_lessons` (
  `player_lesson_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `player_id` bigint unsigned NOT NULL,
  `lesson_id` bigint unsigned NOT NULL,
  `estimated_time` time DEFAULT NULL,
  `reward_diamonds` int NOT NULL DEFAULT '0',
  `success_rate` int NOT NULL DEFAULT '0',
  `total_number_incorrect` int NOT NULL DEFAULT '0',
  `total_number_correct` int NOT NULL DEFAULT '0',
  `state` enum('Bloqueada','En Espera','Completada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bloqueada',
  `motivational_message` enum('¡COMIENZA TU AVENTURA!','ERES CAPAZ','AY NO...','EPICO','EXELENTE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '¡COMIENZA TU AVENTURA!',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`player_lesson_id`),
  KEY `player_lessons_player_id_foreign` (`player_id`),
  KEY `player_lessons_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `player_lessons_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`) ON DELETE CASCADE,
  CONSTRAINT `player_lessons_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.player_lessons: ~3 rows (aproximadamente)
INSERT INTO `player_lessons` (`player_lesson_id`, `player_id`, `lesson_id`, `estimated_time`, `reward_diamonds`, `success_rate`, `total_number_incorrect`, `total_number_correct`, `state`, `motivational_message`, `created_at`, `updated_at`) VALUES
	(5, 2, 1, '00:00:01', 1, 100, 0, 1, 'Completada', '¡COMIENZA TU AVENTURA!', '2026-03-24 04:36:18', '2026-03-24 04:36:28'),
	(6, 2, 3, '00:00:01', 1, 100, 1, 2, 'Completada', '¡COMIENZA TU AVENTURA!', '2026-03-24 04:36:18', '2026-03-24 04:36:42'),
	(7, 2, 4, '00:00:01', 1, 83, 3, 5, 'Completada', '¡COMIENZA TU AVENTURA!', '2026-03-24 04:36:18', '2026-03-24 04:37:13'),
	(8, 2, 2, '00:00:00', 1, 100, 1, 3, 'Completada', '¡COMIENZA TU AVENTURA!', '2026-03-24 04:37:20', '2026-03-24 04:37:34');

-- Volcando estructura para tabla gleeo.practices
CREATE TABLE IF NOT EXISTS `practices` (
  `practice_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` bigint unsigned NOT NULL,
  `reinforcement_id` bigint unsigned NOT NULL,
  `practice_option_id` bigint unsigned NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_dynamic` enum('Verdadero/Falso','Opción Múltiple','Autocompletar') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screen` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`practice_id`),
  KEY `practices_lesson_id_foreign` (`lesson_id`),
  KEY `practices_reinforcement_id_foreign` (`reinforcement_id`),
  KEY `practices_practice_option_id_foreign` (`practice_option_id`),
  CONSTRAINT `practices_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`) ON DELETE CASCADE,
  CONSTRAINT `practices_practice_option_id_foreign` FOREIGN KEY (`practice_option_id`) REFERENCES `practice_options` (`practice_option_id`) ON DELETE CASCADE,
  CONSTRAINT `practices_reinforcement_id_foreign` FOREIGN KEY (`reinforcement_id`) REFERENCES `reinforcements` (`reinforcement_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.practices: ~12 rows (aproximadamente)
INSERT INTO `practices` (`practice_id`, `lesson_id`, `reinforcement_id`, `practice_option_id`, `title`, `type_dynamic`, `screen`, `number`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '¿Qué número sigue en la secuencia? 1, 2, ...', 'Opción Múltiple', '1, 2, ...', 1, '2026-03-13 00:57:55', '2026-03-13 00:57:55'),
	(2, 2, 2, 2, 'Escucha bien', 'Opción Múltiple', 'Hay 3 pollitos y llegan 2 más. ¿Cuántos hay en total?', 1, '2026-03-13 01:05:43', '2026-03-13 01:05:43'),
	(3, 2, 3, 3, 'Escucha bien y analiza', 'Opción Múltiple', 'Tienes 4 lápices azules y 4 rojos. ¿Cuántos hay en total?', 2, '2026-03-13 01:05:43', '2026-03-13 01:05:43'),
	(4, 2, 4, 4, 'Verdadero y falso', 'Verdadero/Falso', '¿2 manzanas + 2 manzanas son 5? ', 3, '2026-03-13 01:05:43', '2026-03-13 01:05:43'),
	(5, 3, 5, 5, 'Pendiente con las papas', 'Autocompletar', 'Si tengo una papa y luego pongo otra papa, ahora tengo ___', 1, '2026-03-23 07:18:45', '2026-03-23 07:18:45'),
	(6, 3, 6, 6, 'Pendiente con los animales', 'Autocompletar', 'En el nido hay gallina, gallina y gallina... ¡en total hay ___ !', 2, '2026-03-23 07:18:45', '2026-03-23 07:18:45'),
	(7, 4, 7, 7, 'Figura de tres lados', 'Opción Múltiple', '¿Qué figura tiene tres lados y tres vértices?', 1, '2026-03-24 04:30:52', '2026-03-24 04:30:52'),
	(8, 4, 8, 8, 'Tome en cuenta la figura de un rectangulo', 'Opción Múltiple', '¿Qué hace que un rectángulo sea diferente a un cuadrado?', 2, '2026-03-24 04:30:52', '2026-03-24 04:30:52'),
	(9, 4, 9, 9, 'Figura que tiene cinco lados', 'Opción Múltiple', '¿Cómo se llama la figura que tiene cinco lados?', 3, '2026-03-24 04:30:52', '2026-03-24 04:30:52'),
	(10, 4, 10, 10, '¿Un triángulo puede tener cuatro vértices (esquinas)?', 'Verdadero/Falso', '¿Un triángulo puede tener cuatro vértices (esquinas)?', 4, '2026-03-24 04:30:52', '2026-03-24 04:30:52'),
	(11, 4, 11, 11, 'Escucha bien y analiza', 'Autocompletar', 'El punto donde se unen dos lados de una figura se llama __', 5, '2026-03-24 04:30:52', '2026-03-24 04:30:52'),
	(12, 4, 12, 12, 'Imagina una puerta.', 'Opción Múltiple', '¿Qué forma tiene generalmente una puerta o una hoja de papel?', 6, '2026-03-24 04:30:52', '2026-03-24 04:30:52');

-- Volcando estructura para tabla gleeo.practice_options
CREATE TABLE IF NOT EXISTS `practice_options` (
  `practice_option_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `variables` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_variable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`practice_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.practice_options: ~12 rows (aproximadamente)
INSERT INTO `practice_options` (`practice_option_id`, `variables`, `correct_variable`) VALUES
	(1, '1,3,6', '3'),
	(2, '3,5,4', '5'),
	(3, '3,5,8', '8'),
	(4, 'Verdad ,Falso', 'Falso'),
	(5, '2,3,12', '2'),
	(6, '56,4,3', '3'),
	(7, 'Cuadrado,Círculo,Triángulo', 'Triángulo'),
	(8, 'Tiene 5 lados,No tiene ángulos,Sus lados no son todos iguales', 'Sus lados no son todos iguales'),
	(9, 'Pentágono,Octágono,Hexágono', 'Pentágono'),
	(10, 'Verdadero,Falso', 'Falso'),
	(11, 'Lado,Vértice,Ángulo', 'Vértice'),
	(12, 'Rectangular,Circular,Triangular', 'Rectangular');

-- Volcando estructura para tabla gleeo.progress
CREATE TABLE IF NOT EXISTS `progress` (
  `progress_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `player_id` bigint unsigned NOT NULL,
  `level_id` bigint unsigned NOT NULL,
  `percentage_bar` decimal(10,2) NOT NULL DEFAULT '0.00',
  `diamonds` int NOT NULL DEFAULT '0',
  `state` enum('Completado','Bloqueado','En Progreso') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bloqueado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`progress_id`),
  KEY `progress_player_id_foreign` (`player_id`),
  KEY `progress_level_id_foreign` (`level_id`),
  CONSTRAINT `progress_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`) ON DELETE CASCADE,
  CONSTRAINT `progress_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.progress: ~2 rows (aproximadamente)
INSERT INTO `progress` (`progress_id`, `player_id`, `level_id`, `percentage_bar`, `diamonds`, `state`, `created_at`, `updated_at`) VALUES
	(3, 2, 1, 99.99, 16, 'En Progreso', '2026-03-24 04:35:59', '2026-03-24 04:37:13'),
	(4, 2, 2, 100.00, 6, 'Completado', '2026-03-24 04:35:59', '2026-03-24 04:37:34');

-- Volcando estructura para tabla gleeo.reinforcements
CREATE TABLE IF NOT EXISTS `reinforcements` (
  `reinforcement_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragraph` text COLLATE utf8mb4_unicode_ci,
  `img` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`reinforcement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.reinforcements: ~12 rows (aproximadamente)
INSERT INTO `reinforcements` (`reinforcement_id`, `title`, `paragraph`, `img`, `url`) VALUES
	(1, '¡Hagámoslo juntos!', 'Recuerda que contar es sumar uno al número anterior. Si tenemos 2 y sumamos 1, obtenemos 3.', NULL, ''),
	(2, '¡Hagamos un solo grupo!', 'Imagina que encierras a todos los pollitos en un círculo grande. Si los cuentas a todos juntos, verás que ahora son cinco.', NULL, ''),
	(3, '¡Cuenta el total!', 'Coloca los 4 azules y luego sigue contando: 5, 6, 7 y... ¡8! Agrupar hizo que el número creciera.', NULL, ''),
	(4, '¡Vamos a comprobarlo!', 'Si pones 2 manzanas y luego traes 2 más, cuéntalas todas: 1, 2, 3 y 4. ¡Son 4, no 5! Por eso la afirmación era mentira.', NULL, ''),
	(5, '¡Nivel de Energía al Máximo!', '¡Atención, valiente explorador! Contar es como cargar una batería de energía. El 1 es un poste de luz, el 2 es un patito que flota en el espacio y el 3 son dos montañitas acostadas que nos ayudan a saltar más alto.', NULL, ''),
	(6, 'Toca cada gallina con tu dedo', 'Toca cada gallina con tu dedo y di su nombre: uno... dos... ¡y tres! Cada vez que dices un número, la casita de las gallinas se pone más contenta. ¡Lo estás haciendo de maravilla, sigue así!', NULL, ''),
	(7, 'La fuerza del tres', 'El triángulo es la figura más estable en ingeniería. Su nombre proviene de', NULL, ''),
	(8, 'El equilibrio del rectángulo', 'Aunque ambos tienen 4 ángulos rectos (de 90°), el cuadrado es', NULL, ''),
	(9, 'El prefijo', 'La palabra Pentágono viene del griego penta (cinco) y gonia (ángulo). Puedes recordarlo pensando en una estrella de cinco puntas; si unes sus extremos exteriores, ¡dibujarás un pentágono!', NULL, ''),
	(10, 'La regla del tres', 'Por definición, un triángulo está formado por tres segmentos de recta que se unen en tres puntos. Si tuviera cuatro puntos de unión, automáticamente se convertiría en un cuadrilátero. ¡El número de lados siempre coincide con el de vértices!', NULL, ''),
	(11, 'Los puntos de unión', 'Imagina que los lados son calles; el vértice es la esquina exacta donde se cruzan. Si una figura tiene 4 lados, tendrá también 4 vértices.', NULL, ''),
	(12, 'Geometría en lo cotidiano', 'La mayoría de los objetos funcionales creados por el ser humano son rectangulares porque permiten encajar mejor en los espacios y son fáciles de fabricar manteniendo la estabilidad.', NULL, '');

-- Volcando estructura para tabla gleeo.reinforcement_failure_limit
CREATE TABLE IF NOT EXISTS `reinforcement_failure_limit` (
  `reinforcement_failure_limit_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `refuerzo_fail_limit` int unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reinforcement_failure_limit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.reinforcement_failure_limit: ~0 rows (aproximadamente)
INSERT INTO `reinforcement_failure_limit` (`reinforcement_failure_limit_id`, `refuerzo_fail_limit`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, NULL, NULL);

-- Volcando estructura para tabla gleeo.representatives
CREATE TABLE IF NOT EXISTS `representatives` (
  `representative_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gender_id` bigint unsigned NOT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `names` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surnames` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_center` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Profesional','Representante') COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`representative_id`),
  UNIQUE KEY `representatives_slug_unique` (`slug`),
  KEY `representatives_gender_id_foreign` (`gender_id`),
  KEY `representatives_country_id_foreign` (`country_id`),
  KEY `representatives_user_id_foreign` (`user_id`),
  CONSTRAINT `representatives_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE,
  CONSTRAINT `representatives_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  CONSTRAINT `representatives_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.representatives: ~0 rows (aproximadamente)
INSERT INTO `representatives` (`representative_id`, `gender_id`, `country_id`, `user_id`, `names`, `surnames`, `educational_center`, `type`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 2, 'Maikol Perdomo', 'Jose Barrios', 'Josefina de Acosta', 'Profesional', 'Mario-test', 0, NULL, NULL);

-- Volcando estructura para tabla gleeo.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `rol_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`rol_id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.roles: ~3 rows (aproximadamente)
INSERT INTO `roles` (`rol_id`, `name`) VALUES
	(1, 'Administrador(a)'),
	(3, 'Jugador(a)'),
	(2, 'Profesor(a)');

-- Volcando estructura para tabla gleeo.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.sessions: ~3 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('QIfemUDftoRhpMb5NpCtFUrD8X72SLLH23ARCY70', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmRQbUdRY0ZtU0JwdkVXc0p5UHV1ZVZwbm0xbE1PeTlzNDVsRzBKWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9ncmVzby1nZW5lcmFsIjtzOjU6InJvdXRlIjtzOjI1OiJjaGlsZHJlbi5nZW5lcmFsLXByb2dyZXNzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774313045),
	('Vy7VqwCXrYsrOkXPLrLfm8R1AdVVe7IqLvvrSEL2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXdOcUEyenhSOUFNNkJ1WTVOa1dBNUlTMFFieFlkd3NEdGxvY0hmYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbml2ZWxlcy9uaXZlbC0xLWJhc2ljby9mb3JtYXMteS1maWd1cmFzLWdlb21ldHJpY2FzL2VsLW11bmRvLWVuLWRvcy1kaW1lbnNpb25lcy9lbC1tdW5kby1lbi1kb3MtZGltZW5zaW9uZXMiO3M6NToicm91dGUiO3M6MjQ6InBsYXllci5nYW1pbmctZXhwZXJpZW5jZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774312404),
	('YobE7SsrI62JymcgpKr3NaM0hUy0QDrTl80ZLCY0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidnpRdkpwaWVGNU1ZNlhZaXhNS3dYUjlHRlBLaTZUZEdvSTNHeWJORCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbmljaWFyLXNlc2lvbiI7czo1OiJyb3V0ZSI7czoxMToibG9naW4uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774312405),
	('zvAWfgRbQaZJVVjAxPvVnQzjDTaa9xGKse7SBgk4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnptdlM4eElZYTQ5eWxFZTNvc1NHSUJCdmhVeUxzMlpRY1BzZGZxYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbmljaWFyLXNlc2lvbiI7czo1OiJyb3V0ZSI7czoxMToibG9naW4uaW5kZXgiO319', 1774314484);

-- Volcando estructura para tabla gleeo.sufficiency_validations
CREATE TABLE IF NOT EXISTS `sufficiency_validations` (
  `validation_sufficiency_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `player_id` bigint unsigned NOT NULL,
  `level_id` bigint unsigned DEFAULT NULL,
  `filled` tinyint(1) NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`validation_sufficiency_id`),
  KEY `sufficiency_validations_player_id_foreign` (`player_id`),
  KEY `sufficiency_validations_level_id_foreign` (`level_id`),
  CONSTRAINT `sufficiency_validations_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`) ON DELETE SET NULL,
  CONSTRAINT `sufficiency_validations_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.sufficiency_validations: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.themes
CREATE TABLE IF NOT EXISTS `themes` (
  `theme_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_path` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `border_radius` tinyint(1) NOT NULL DEFAULT '0',
  `solid_background` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic_color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `for_sale` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`theme_id`),
  UNIQUE KEY `themes_name_unique` (`name`),
  UNIQUE KEY `themes_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.themes: ~1 rows (aproximadamente)
INSERT INTO `themes` (`theme_id`, `name`, `main_color`, `secondary_color`, `background_path`, `border_radius`, `solid_background`, `topic_color`, `slug`, `for_sale`, `created_at`, `updated_at`) VALUES
	(1, 'Defecto', '#7052c2', '#ef7440', 'fondo-principal-mate.png', 1, '', 'white', 'defecto', 0, NULL, NULL);

-- Volcando estructura para tabla gleeo.topics
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_id` bigint unsigned NOT NULL,
  `title` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topics_title_unique` (`title`),
  UNIQUE KEY `topics_slug_unique` (`slug`),
  KEY `topics_module_id_foreign` (`module_id`),
  CONSTRAINT `topics_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.topics: ~4 rows (aproximadamente)
INSERT INTO `topics` (`topic_id`, `module_id`, `title`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Aprender a contar del 1 al 10', 'aprender-a-contar-del-1-al-10', 0, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(3, 3, 'La suma y el concepto de agrupar', 'la-suma-y-el-concepto-de-agrupar', 0, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(4, 3, 'La resta como quitar elementos', 'la-resta-como-quitar-elementos', 0, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(7, 2, 'El mundo en dos dimensiones', 'el-mundo-en-dos-dimensiones', 1, '2026-03-24 04:31:22', '2026-03-24 04:31:22');

-- Volcando estructura para tabla gleeo.types_dynamics
CREATE TABLE IF NOT EXISTS `types_dynamics` (
  `type_dynamic_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`type_dynamic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.types_dynamics: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gleeo.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_session` datetime DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_rol_id_foreign` (`rol_id`),
  CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gleeo.users: ~3 rows (aproximadamente)
INSERT INTO `users` (`user_id`, `user`, `email`, `email_verified_at`, `password`, `rol_id`, `remember_token`, `last_session`, `state`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$9QFh4rPWAtHO4cg3bxnqEOhqWiFKYicVqzjx0FNl6rtwTRQiBsMbW', 1, NULL, NULL, 1, 1, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(2, 'Maikol', 'maikolcomputacion@gmail.com', NULL, '$2y$12$nVk0PkSQ4Fxi.U2yVlmlTeKhCjQ8grFJg4TSEz0rLWioCWiiiN3/K', 2, NULL, NULL, 1, 1, '2026-03-13 00:52:40', '2026-03-13 00:52:40'),
	(4, 'josefo2026', NULL, NULL, '$2y$12$f6fIE6rVltX8z2TGNHYsxe65ZEqzJL59dWvsGIaXIi672ZKfLdU3.', 3, NULL, '2026-03-24 00:36:08', 1, 1, '2026-03-24 04:35:59', '2026-03-24 04:36:08');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
