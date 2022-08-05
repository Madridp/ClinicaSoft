-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2022 a las 07:51:28
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinicasoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_proveedor` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_recibe` date DEFAULT NULL,
  `total_compra` decimal(10,2) NOT NULL,
  `no_factura` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tipo_compra` bigint(20) UNSIGNED NOT NULL,
  `dias_credito` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `id_proveedor`, `fecha_compra`, `fecha_recibe`, `total_compra`, `no_factura`, `id_tipo_compra`, `dias_credito`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-20', '2022-05-05', '520.00', '15225151', 1, 15, 1, '2022-07-01 07:35:59', '2022-07-01 09:44:52'),
(2, 2, '2022-07-01', '2022-07-01', '1140.00', '15255', 1, 5, 1, '2022-07-10 03:43:28', '2022-07-10 03:43:28'),
(3, 2, '2022-07-10', '2022-07-10', '1140.00', '14522515', 2, 3, 1, '2022-07-12 00:11:25', '2022-07-12 00:11:25'),
(4, 3, '2022-07-10', '2022-07-10', '110.00', NULL, 1, NULL, 1, '2022-07-12 00:13:44', '2022-07-27 07:09:27'),
(9, 2, '2022-07-01', '2022-07-02', '340.00', '152152222', 2, 10, 1, '2022-07-24 06:28:05', '2022-07-24 06:28:05'),
(10, 3, '2022-07-25', '2022-07-26', '660.00', '454515', 2, 3, 1, '2022-07-27 07:02:12', '2022-07-27 22:07:27'),
(11, 1, '2022-07-29', '2022-07-30', '780.00', '0515150', 2, 5, 1, '2022-07-30 11:50:17', '2022-07-30 11:50:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_tipo_examen`
--

CREATE TABLE `detalle_tipo_examen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_examen` bigint(20) UNSIGNED DEFAULT NULL,
  `id_tipo_examen` bigint(20) UNSIGNED DEFAULT NULL,
  `valor_examen` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `total_examen` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deuda_proveedor`
--

CREATE TABLE `deuda_proveedor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_proveedor` bigint(20) UNSIGNED NOT NULL,
  `id_compra` bigint(20) UNSIGNED NOT NULL,
  `debe` decimal(10,2) NOT NULL,
  `haber` decimal(10,2) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deuda_proveedor`
--

INSERT INTO `deuda_proveedor` (`id`, `id_proveedor`, `id_compra`, `debe`, `haber`, `saldo`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '1140.00', '0.00', '1140.00', 'COMPRA #3, FACT: 14522515', 1, '2022-07-12 00:11:25', '2022-07-12 00:45:24'),
(2, 2, 9, '340.00', '0.00', '340.00', 'COMPRA #9, FACT: 152152222', 1, '2022-07-24 06:28:05', '2022-07-24 06:28:05'),
(3, 3, 10, '660.00', '0.00', '660.00', 'COMPRA #10, FACT: 454515', 1, '2022-07-27 07:02:12', '2022-07-27 07:02:12'),
(4, 1, 11, '780.00', '0.00', '780.00', 'COMPRA #11, FACT: 0515150', 1, '2022-07-30 11:50:17', '2022-07-30 11:50:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_empresa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_examen` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `id_paciente` bigint(20) UNSIGNED NOT NULL,
  `valor_examen` decimal(10,2) NOT NULL,
  `examen_pagado` int(11) NOT NULL,
  `id_tecnico` bigint(20) UNSIGNED NOT NULL,
  `id_medico_referente` bigint(20) UNSIGNED DEFAULT NULL,
  `motivo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adjunto_orden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo_estimado_respuesta` datetime DEFAULT NULL,
  `documento_resultado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_usuario` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id`, `id_tipo_examen`, `fecha`, `id_paciente`, `valor_examen`, `examen_pagado`, `id_tecnico`, `id_medico_referente`, `motivo`, `adjunto_orden`, `tiempo_estimado_respuesta`, `documento_resultado`, `estado`, `id_usuario`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-07-07', 1, '150.00', 1, 1, 1, 'Urgencia medica.', 'Hoja Resultados.pdf', '2022-07-07 13:30:00', NULL, 1, NULL, '2022-07-24 00:30:09', '2022-07-24 00:30:09'),
(2, 3, '2022-07-22', 3, '180.00', 2, 1, NULL, 'Obesidad', NULL, '2022-07-22 15:22:00', 'Hoja Resultados.pdf', 1, NULL, '2022-07-24 03:22:55', '2022-07-24 03:22:55'),
(3, 1, '2022-07-02', 2, '350.00', 1, 2, NULL, 'Urge', NULL, '2022-07-19 15:39:00', NULL, 1, NULL, '2022-07-24 03:39:25', '2022-07-24 05:35:42'),
(4, 2, '2022-07-21', 3, '180.00', 1, 2, NULL, 'Mucho peso.', NULL, '2022-07-21 18:13:00', NULL, 1, NULL, '2022-07-24 06:13:56', '2022-07-24 06:13:56'),
(5, 1, '2022-07-22', 1, '150.00', 1, 1, NULL, 'Urgencia medica.', NULL, '2022-07-22 18:18:00', NULL, 1, NULL, '2022-07-24 06:18:30', '2022-07-24 06:18:30'),
(6, 3, '2022-07-25', 3, '110.00', 1, 2, 1, 'Obesidad', NULL, '2022-07-25 15:57:00', NULL, 1, NULL, '2022-07-27 03:57:35', '2022-07-27 03:57:35'),
(7, 3, '2022-07-26', 4, '130.00', 1, 2, 2, 'Obesidad', NULL, NULL, NULL, 1, NULL, '2022-07-27 04:00:17', '2022-07-27 04:00:17'),
(8, 3, '2022-07-27', 5, '130.00', 1, 2, NULL, 'Obesidad', NULL, NULL, NULL, 1, NULL, '2022-07-27 04:00:42', '2022-07-27 04:00:42'),
(9, 2, '2022-07-28', 2, '150.00', 1, 1, NULL, 'Obesidad', NULL, NULL, NULL, 1, NULL, '2022-07-27 23:53:18', '2022-07-27 23:53:18'),
(10, 1, '2022-07-29', 1, '110.00', 1, 2, NULL, 'Urgencia medica.', NULL, '2022-07-28 12:26:00', NULL, 1, NULL, '2022-07-28 00:26:38', '2022-07-28 00:26:38'),
(11, 1, '2022-07-01', 1, '170.00', 1, 1, NULL, 'urge', NULL, '2022-07-01 13:20:00', NULL, 1, NULL, '2022-07-28 01:20:20', '2022-07-28 01:20:20'),
(12, 1, '2022-07-23', 4, '160.00', 1, 2, 2, 'problemas', NULL, '2022-07-27 12:59:00', NULL, 1, NULL, '2022-07-29 00:59:53', '2022-07-29 00:59:53'),
(13, 2, '2022-07-24', 5, '110.00', 1, 2, NULL, 'problemas', NULL, NULL, NULL, 1, NULL, '2022-07-29 01:00:22', '2022-07-29 01:00:22'),
(14, 3, '2022-07-30', 1, '110.00', 1, 1, NULL, 'problemas', NULL, NULL, NULL, 1, NULL, '2022-07-29 01:05:12', '2022-07-29 01:05:12'),
(15, 3, '2022-07-31', 1, '180.00', 1, 1, NULL, 'Obesidad', NULL, NULL, NULL, 1, NULL, '2022-07-29 01:06:24', '2022-07-29 01:06:24'),
(16, 1, '2022-07-28', 1, '180.00', 1, 2, NULL, 'urge', NULL, NULL, NULL, 1, NULL, '2022-07-29 10:17:09', '2022-07-29 10:17:09'),
(17, 2, '2022-07-25', 3, '190.00', 1, 1, NULL, 'urge', NULL, NULL, NULL, 1, NULL, '2022-07-29 11:12:40', '2022-07-29 11:12:40'),
(18, 1, '2022-07-29', 3, '120.00', 1, 1, 1, 'urge', NULL, '2022-07-29 23:46:00', NULL, 1, NULL, '2022-07-30 11:46:33', '2022-07-30 11:46:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE `insumo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tipo_insumo` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `es_reactivo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `insumo`
--

INSERT INTO `insumo` (`id`, `id_tipo_insumo`, `codigo`, `nombre`, `es_reactivo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, '30220', 'RE1 Creatinina 20 ML', 1, 1, '2022-06-18 00:24:33', '2022-07-10 03:38:37'),
(2, 3, '01', 'Diluyente 20 ML', 1, 1, '2022-07-10 03:33:54', '2022-07-10 03:33:54'),
(3, 3, '02', 'Lisante LB 500 ML', 1, 1, '2022-07-10 03:34:24', '2022-07-10 03:34:24'),
(4, 1, '255', 'Porta objetos', 0, 1, '2022-07-10 03:39:11', '2022-07-10 03:39:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_insumo`
--

CREATE TABLE `lote_insumo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_compra` bigint(20) UNSIGNED NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `id_insumo` bigint(20) UNSIGNED NOT NULL,
  `no_lote` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `existencia` int(11) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lote_insumo`
--

INSERT INTO `lote_insumo` (`id`, `id_compra`, `fecha_vencimiento`, `id_insumo`, `no_lote`, `cantidad`, `existencia`, `precio_compra`, `descuento`, `subtotal`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-02-03', 1, '15155', 3, 3, '280.00', '0.00', '840.00', 1, '2022-07-10 03:43:28', '2022-07-10 03:43:28'),
(2, 2, '2026-02-03', 2, '15155', 2, 2, '150.00', '0.00', '300.00', 1, '2022-07-10 03:43:28', '2022-07-10 03:43:28'),
(3, 3, NULL, 4, '155526262', 4, 4, '110.00', '0.00', '440.00', 1, '2022-07-12 00:11:25', '2022-07-12 00:11:25'),
(4, 3, '2025-01-11', 3, '152515', 2, 2, '350.00', '0.00', '700.00', 1, '2022-07-12 00:11:25', '2022-07-12 00:11:25'),
(5, 4, NULL, 1, '12422', 1, 1, '110.00', '0.00', '110.00', 1, '2022-07-12 00:13:44', '2022-07-12 00:13:44'),
(6, 9, NULL, 4, '010', 2, 2, '110.00', '0.00', '220.00', 1, '2022-07-24 06:28:05', '2022-07-24 06:28:05'),
(7, 9, '2025-10-01', 2, '010', 1, 1, '120.00', '0.00', '120.00', 1, '2022-07-24 06:28:05', '2022-07-24 06:28:05'),
(8, 10, '2025-02-26', 1, '204', 3, 3, '110.00', '0.00', '330.00', 1, '2022-07-27 07:02:12', '2022-07-27 07:02:12'),
(9, 10, '2025-02-26', 3, '0202', 3, 3, '110.00', '0.00', '330.00', 1, '2022-07-27 07:02:12', '2022-07-27 07:02:12'),
(10, 11, '2025-06-28', 1, '0202', 3, 3, '180.00', '0.00', '540.00', 1, '2022-07-30 11:50:17', '2022-07-30 11:50:17'),
(11, 11, '2025-06-29', 2, '020', 2, 2, '120.00', '0.00', '240.00', 1, '2022-07-30 11:50:17', '2022-07-30 11:50:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_referente`
--

CREATE TABLE `medico_referente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `medico_referente`
--

INSERT INTO `medico_referente` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Leonardo Barillas Contreras', 1, '2022-06-17 21:22:52', '2022-06-17 21:23:06'),
(2, 'Estuardo André Mejía', 1, '2022-07-27 03:58:17', '2022-07-27 03:58:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_05_21_100000_create_teams_table', 1),
(7, '2020_05_21_200000_create_team_user_table', 1),
(8, '2020_05_21_300000_create_team_invitations_table', 1),
(9, '2022_04_01_172616_create_sessions_table', 1),
(10, '2022_04_28_023434_create_rols_table', 2),
(11, '2022_04_28_031630_agregar_campos_rol_y_estad_usuario', 3),
(12, '2022_04_28_033007_create_medico_referentes_table', 3),
(13, '2022_04_28_033201_create_tipo_examens_table', 3),
(14, '2022_04_28_034350_create_pacientes_table', 3),
(15, '2022_04_28_034705_create_tecnicos_table', 3),
(16, '2022_04_28_035549_create_tipo_compras_table', 3),
(17, '2022_04_28_035725_create_proveedors_table', 3),
(18, '2022_04_28_040823_create_empresas_table', 3),
(19, '2022_04_28_041002_create_tipo_insumos_table', 3),
(20, '2022_04_28_041204_create_compras_table', 3),
(21, '2022_04_28_042802_create_insumos_table', 3),
(22, '2022_04_28_043332_create_lote_insumos_table', 3),
(26, '2022_04_28_043937_create_deuda_proveedors_table', 4),
(27, '2022_04_28_045528_create_examens_table', 4),
(32, '2022_04_28_050538_create_proceso_examens_table', 5),
(33, '2022_07_29_172602_create_detalle_tipo_examens_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `genero`, `telefono`, `correo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Daniela', 'Salguero', '2003-01-06', 'Femenino', '1522652', 'daniela@gmail.com', 1, '2022-06-12 03:03:52', '2022-07-05 05:15:15'),
(2, 'Pedro', 'Madrid', '2002-02-17', 'Masculino', '33693809', 'pedro@email.com', 1, '2022-06-17 20:47:24', '2022-06-17 21:08:32'),
(3, 'Mercedes', 'Granados', '1997-05-06', 'Femenino', '425525125', 'mercedes@gmail.com', 1, '2022-07-24 03:20:13', '2022-07-24 03:20:32'),
(4, 'Joel Esteban', 'Lopez', NULL, 'Masculino', '15454151', NULL, 1, '2022-07-27 03:58:45', '2022-07-27 03:58:45'),
(5, 'Juan Andres', 'Loyo Herrera', '1998-07-25', 'Masculino', '544578555', NULL, 1, '2022-07-27 03:59:24', '2022-07-27 03:59:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso_examen`
--

CREATE TABLE `proceso_examen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_examen` bigint(20) UNSIGNED NOT NULL,
  `id_lote_insumo` bigint(20) UNSIGNED NOT NULL,
  `cantidad_utilizada` int(11) NOT NULL,
  `observacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `nit`, `telefono`, `correo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Humberto García', '1555220015', '332551552', 'humberto@gmail.com', 1, '2022-06-17 20:29:04', '2022-06-17 21:23:28'),
(2, 'Daniela Estrada Méndez', '11452252251901', '25155225', NULL, 1, '2022-07-10 03:40:11', '2022-07-10 03:40:11'),
(3, 'Esdras Salguero', '1455215105', '45514556', 'esdras@gmail.com', 1, '2022-07-12 00:12:32', '2022-07-12 00:12:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2022-05-10 06:10:35', '2022-05-10 06:10:35'),
(2, 'Secretario', 1, '2022-05-10 06:10:35', '2022-05-10 06:10:35'),
(3, 'Técnico', 1, '2022-05-10 06:10:35', '2022-05-10 06:10:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('w0v8LHerTLAt28TFhp3PZbeVs1eKGTCsn4we1T1u', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.71', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWDhWTTY5ekR1YnpPTkxUQ05ITk50c1FYbWloUVlUbG13UlZYeFE2WiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vY2xpbmljYXNvZnQudGVzdC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1659160233);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pedro\'s Team', 1, '2022-04-02 06:47:59', '2022-04-02 06:47:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico`
--

CREATE TABLE `tecnico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dpi` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tecnico`
--

INSERT INTO `tecnico` (`id`, `nombre`, `dpi`, `fecha_nacimiento`, `telefono`, `correo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'María Argelia Ramírez Granados', '335837174201901', '1998-01-16', '48572665', 'argelia@gmail.com', 1, '2022-06-17 19:54:35', '2022-06-17 20:39:57'),
(2, 'Daniza Sanchez', '5225212022522', '2002-08-04', '41678175', NULL, 1, '2022-07-05 05:18:39', '2022-07-05 05:18:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_compra`
--

CREATE TABLE `tipo_compra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_compra`
--

INSERT INTO `tipo_compra` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Contado', 1, '2022-06-17 23:19:10', '2022-07-08 05:51:38'),
(2, 'Crédito', 1, '2022-07-08 05:51:46', '2022-07-08 05:51:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_examen`
--

CREATE TABLE `tipo_examen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_examen`
--

INSERT INTO `tipo_examen` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Hematología Completa', 'Duración larga.', 1, '2022-06-17 23:37:20', '2022-06-17 23:38:00'),
(2, 'Colesterol', NULL, 1, '2022-07-24 00:25:38', '2022-07-24 00:25:38'),
(3, 'Triglicéridos', 'Duración corta.', 1, '2022-07-24 00:26:11', '2022-07-24 00:26:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_insumo`
--

CREATE TABLE `tipo_insumo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_insumo`
--

INSERT INTO `tipo_insumo` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Utensilios para Coprología', 1, '2022-06-17 22:37:01', '2022-07-10 03:37:37'),
(2, 'Reactivos para aparato químico', 1, '2022-06-20 23:03:52', '2022-07-10 03:37:05'),
(3, 'Reactivos para aparatos de hematologia', 1, '2022-07-10 03:33:24', '2022-07-10 03:33:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_rol` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `estado`, `id_rol`) VALUES
(1, 'Pedro Madrid', 'santiagosanga@gmail.com', NULL, '$2y$10$KtRD7uYx8AZ7AY0HBY1mk.5JJcHwAXOVtvG65EYMJVtAEHeNQiJRW', NULL, NULL, NULL, 'ycsQ3GKezhnidYOEY6cyUdO1qgkCpBRJRpgplxamCFnsnVDETKyseLekHYug', 1, NULL, '2022-04-02 06:47:59', '2022-07-29 12:12:02', 1, 3),
(3, 'Josué Ahias Enoc Madrid', 'josuemadrid@admin.com', NULL, '$2y$10$qBpWGGZd8XtB5gGmHQhNUO7AR5t3hcCYw0b4mYpZFIHTZrOrTC5Ji', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-10 06:10:53', '2022-07-29 11:17:31', 1, 1),
(9, 'Brandon Elías Velásquez', 'brandon@admin.com', NULL, '$2y$10$3yDEU9dImLYGdNIe3hvclu.NXkMkv2XpYhkPAbkDBvZVIpyCtDtg6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-21 21:48:49', '2022-07-29 11:59:22', 1, 3),
(10, 'Aleida Yadira Anton', 'aleida@admin.com', NULL, '$2y$10$8Sopx/jB/BxrxorXhYAm5OuvPT0xOQxCdQF1xmzTw0w/BSZLDTNUK', NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-03 23:19:52', '2022-07-29 12:12:26', 1, 2),
(11, 'Santiago Anton', 'santiago@admin.com', NULL, '$2y$10$jl4EeKnhGkbtboVNHlgZYOUYrVT9uSmbl.ST4QSN/5vS.nazkxdn6', NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-29 04:27:14', '2022-07-29 12:12:58', 1, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compra_id_proveedor_foreign` (`id_proveedor`),
  ADD KEY `compra_id_tipo_compra_foreign` (`id_tipo_compra`);

--
-- Indices de la tabla `detalle_tipo_examen`
--
ALTER TABLE `detalle_tipo_examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_tipo_examen_id_examen_foreign` (`id_examen`),
  ADD KEY `detalle_tipo_examen_id_tipo_examen_foreign` (`id_tipo_examen`);

--
-- Indices de la tabla `deuda_proveedor`
--
ALTER TABLE `deuda_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deuda_proveedor_id_compra_foreign` (`id_compra`),
  ADD KEY `deuda_proveedor_id_proveedor_foreign` (`id_proveedor`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examen_id_tipo_examen_foreign` (`id_tipo_examen`),
  ADD KEY `examen_id_paciente_foreign` (`id_paciente`),
  ADD KEY `examen_id_tecnico_foreign` (`id_tecnico`),
  ADD KEY `examen_id_medico_referente_foreign` (`id_medico_referente`),
  ADD KEY `examen_id_usuario_foreign` (`id_usuario`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insumo_id_tipo_insumo_foreign` (`id_tipo_insumo`);

--
-- Indices de la tabla `lote_insumo`
--
ALTER TABLE `lote_insumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lote_insumo_id_compra_foreign` (`id_compra`),
  ADD KEY `lote_insumo_id_insumo_foreign` (`id_insumo`);

--
-- Indices de la tabla `medico_referente`
--
ALTER TABLE `medico_referente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `proceso_examen`
--
ALTER TABLE `proceso_examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proceso_examen_id_examen_foreign` (`id_examen`),
  ADD KEY `proceso_examen_id_lote_insumo_foreign` (`id_lote_insumo`),
  ADD KEY `proceso_examen_id_usuario_foreign` (`id_usuario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indices de la tabla `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indices de la tabla `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indices de la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_compra`
--
ALTER TABLE `tipo_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_examen`
--
ALTER TABLE `tipo_examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_insumo`
--
ALTER TABLE `tipo_insumo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_rol_foreign` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_tipo_examen`
--
ALTER TABLE `detalle_tipo_examen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deuda_proveedor`
--
ALTER TABLE `deuda_proveedor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumo`
--
ALTER TABLE `insumo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lote_insumo`
--
ALTER TABLE `lote_insumo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `medico_referente`
--
ALTER TABLE `medico_referente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso_examen`
--
ALTER TABLE `proceso_examen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tecnico`
--
ALTER TABLE `tecnico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_compra`
--
ALTER TABLE `tipo_compra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_examen`
--
ALTER TABLE `tipo_examen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_insumo`
--
ALTER TABLE `tipo_insumo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_id_proveedor_foreign` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`),
  ADD CONSTRAINT `compra_id_tipo_compra_foreign` FOREIGN KEY (`id_tipo_compra`) REFERENCES `tipo_compra` (`id`);

--
-- Filtros para la tabla `detalle_tipo_examen`
--
ALTER TABLE `detalle_tipo_examen`
  ADD CONSTRAINT `detalle_tipo_examen_id_examen_foreign` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id`),
  ADD CONSTRAINT `detalle_tipo_examen_id_tipo_examen_foreign` FOREIGN KEY (`id_tipo_examen`) REFERENCES `tipo_examen` (`id`);

--
-- Filtros para la tabla `deuda_proveedor`
--
ALTER TABLE `deuda_proveedor`
  ADD CONSTRAINT `deuda_proveedor_id_compra_foreign` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  ADD CONSTRAINT `deuda_proveedor_id_proveedor_foreign` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `examen_id_medico_referente_foreign` FOREIGN KEY (`id_medico_referente`) REFERENCES `medico_referente` (`id`),
  ADD CONSTRAINT `examen_id_paciente_foreign` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `examen_id_tecnico_foreign` FOREIGN KEY (`id_tecnico`) REFERENCES `tecnico` (`id`),
  ADD CONSTRAINT `examen_id_tipo_examen_foreign` FOREIGN KEY (`id_tipo_examen`) REFERENCES `tipo_examen` (`id`),
  ADD CONSTRAINT `examen_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD CONSTRAINT `insumo_id_tipo_insumo_foreign` FOREIGN KEY (`id_tipo_insumo`) REFERENCES `tipo_insumo` (`id`);

--
-- Filtros para la tabla `lote_insumo`
--
ALTER TABLE `lote_insumo`
  ADD CONSTRAINT `lote_insumo_id_compra_foreign` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  ADD CONSTRAINT `lote_insumo_id_insumo_foreign` FOREIGN KEY (`id_insumo`) REFERENCES `insumo` (`id`);

--
-- Filtros para la tabla `proceso_examen`
--
ALTER TABLE `proceso_examen`
  ADD CONSTRAINT `proceso_examen_id_examen_foreign` FOREIGN KEY (`id_examen`) REFERENCES `examen` (`id`),
  ADD CONSTRAINT `proceso_examen_id_lote_insumo_foreign` FOREIGN KEY (`id_lote_insumo`) REFERENCES `lote_insumo` (`id`),
  ADD CONSTRAINT `proceso_examen_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
