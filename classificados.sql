-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/09/2025 às 05:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `classificados`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_usuario`, `id_categoria`, `titulo`, `descricao`, `valor`, `estado`) VALUES
(3, 1, 1, 'Hublot Editado', 'Algum produto de anÃºncio legal', 300, 1),
(4, 1, 2, 'Casaco de Fulano', 'DescriÃ§Ã£o luxuosa do casaco', 100, 0),
(5, 1, 4, 'Ferrari', 'Carro esportivo muito barato', 50, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios_imagens`
--

CREATE TABLE `anuncios_imagens` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `foto_principal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `anuncios_imagens`
--

INSERT INTO `anuncios_imagens` (`id`, `id_anuncio`, `url`, `foto_principal`) VALUES
(5, 3, 'ce22b99a632571fc5ff345eafa252a67.jpg', 0),
(6, 3, 'c38581766dff46f000ae243330ead1a8.jpg', 0),
(7, 3, 'fe31ef89de0c785c24e2007719241763.jpg', 0),
(8, 4, 'ef9b88ad9e74cd9b4f1510653da291a2.jpg', 0),
(9, 5, '04bd9d8ac92c267405cfa7682d59049b.jpg', 0),
(10, 5, 'fb3019cbc47211aed1cb32b76d660c13.jpg', 0),
(11, 5, 'c10d16f9aa0353d868bef93ff7e036c8.jpg', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Relógios'),
(2, 'Roupas'),
(3, 'Eletrônicos'),
(4, 'Carros');

-- --------------------------------------------------------

--
-- Estrutura para tabela `system_log`
--

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `system_log`
--

INSERT INTO `system_log` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(0, 0, 'Home Page', 'Home Page', '::1', '2025-09-23 23:47:56'),
(0, 0, 'Home Page', 'Home Page', '::1', '2025-09-23 23:48:02'),
(0, 0, 'Home Page', 'Home Page', '::1', '2025-09-23 23:48:03'),
(0, 0, 'Home Page', 'Home Page', '::1', '2025-09-23 23:48:04'),
(0, 0, 'Home Page', 'Home Page', '::1', '2025-09-23 23:48:05'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:48:10'),
(0, 0, 'Signup Page', 'Signup Page', '::1', '2025-09-23 23:48:13'),
(0, 0, 'Signup Page', 'Signup Page', '::1', '2025-09-23 23:48:22'),
(0, 0, 'New register user', 'New register user', '::1', '2025-09-23 23:48:53'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:48:53'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:49:27'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:52:38'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:52:45'),
(0, 0, 'Signup Page', 'Signup Page', '::1', '2025-09-23 23:55:40'),
(0, 0, 'New register user', 'New register user', '::1', '2025-09-23 23:55:53'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:55:53'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-23 23:56:02'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-24 00:00:38'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-24 00:02:56'),
(0, 0, 'Signup Page', 'Signup Page', '::1', '2025-09-24 00:02:58'),
(0, 0, 'New register user', 'New register user', '::1', '2025-09-24 00:03:24'),
(0, 0, 'Login success', 'Login success', '::1', '2025-09-24 00:03:24'),
(0, 4, 'Home Page', 'Home Page', '::1', '2025-09-24 00:03:24'),
(0, 4, 'Ad Create Page', 'Ad Create Page', '::1', '2025-09-24 00:03:30'),
(0, 4, 'My Ads Page', 'May Ads Page', '::1', '2025-09-24 00:03:33'),
(0, 4, 'My Ads Page', 'May Ads Page', '::1', '2025-09-24 00:03:35'),
(0, 4, 'My Ads Page', 'May Ads Page', '::1', '2025-09-24 00:03:36'),
(0, 4, 'Logout success', 'Logout success', '::1', '2025-09-24 00:03:38'),
(0, 0, 'Home Page', 'Home Page', '::1', '2025-09-24 00:03:38'),
(0, 0, 'Login Page', 'Login Page', '::1', '2025-09-24 00:03:40'),
(0, 0, 'Login success', 'Login success', '::1', '2025-09-24 00:03:49'),
(0, 4, 'Home Page', 'Home Page', '::1', '2025-09-24 00:03:49'),
(0, 4, 'Product Page', 'Product Page', '::1', '2025-09-24 00:06:53'),
(0, 4, 'Product Page', 'Product Page', '::1', '2025-09-24 00:08:18'),
(0, 4, 'Home Page', 'Home Page', '::1', '2025-09-24 00:08:22'),
(0, 4, 'Product Page', 'Product Page', '::1', '2025-09-24 00:08:23'),
(0, 4, 'Home Page', 'Home Page', '::1', '2025-09-24 00:08:25'),
(0, 4, 'Product Page', 'Product Page', '::1', '2025-09-24 00:08:26'),
(0, 4, 'Home Page', 'Home Page', '::1', '2025-09-24 00:08:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `senha` varchar(150) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `token`) VALUES
(4, 'Michel Angelo Machado', 'michel.a.m90@gmail.com', '$2y$10$ms6PBaO8BqbYF1gOtOTiAOsqQs8eMpleRkQXXYJhW4Q9xhhiYzz0q', '48991227211', '3994d0e0aec3aa7cc3bc37711c455bbb');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `anuncios_imagens`
--
ALTER TABLE `anuncios_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `anuncios_imagens`
--
ALTER TABLE `anuncios_imagens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
