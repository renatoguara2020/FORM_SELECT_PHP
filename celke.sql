-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22-Nov-2021 às 14:58
-- Versão do servidor: 8.0.21
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `celke`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_acessos`
--

DROP TABLE IF EXISTS `niveis_acessos`;
CREATE TABLE IF NOT EXISTS `niveis_acessos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `niveis_acessos`
--

INSERT INTO `niveis_acessos` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Super Administrador', '2021-11-23 15:24:57', NULL),
(2, 'Administrador', '2021-11-23 15:24:57', NULL),
(3, 'Aluno', '2021-11-23 15:25:16', NULL),
(4, 'Financeiro', '2021-11-23 11:54:53', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sists_usuarios`
--

DROP TABLE IF EXISTS `sists_usuarios`;
CREATE TABLE IF NOT EXISTS `sists_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sists_usuarios`
--

INSERT INTO `sists_usuarios` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Ativo', '2021-11-23 15:16:58', NULL),
(2, 'Inativo', '2021-11-23 15:16:58', NULL),
(3, 'Aguardado confirmação', '2021-11-23 15:17:13', NULL),
(4, 'Spam', '2021-11-23 11:30:44', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sists_usuario_id` int NOT NULL DEFAULT '3',
  `niveis_acesso_id` int NOT NULL DEFAULT '3',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sists_usuario_id` (`sists_usuario_id`),
  KEY `niveis_acesso_id` (`niveis_acesso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `sists_usuario_id`, `niveis_acesso_id`, `created`, `modified`) VALUES
(1, 'Cesar', 'cesar@celke.com.br', '$2y$10$H1JY9xNvH01ZfH0n8GJcJeY7LIudr/aFW11zoTvMRWLomOe0T8eeW', 1, 1, '2021-11-22 10:55:51', NULL),
(2, 'Kelly', 'kelly@celke.com.br', '$2y$10$WfVI3FaAeOBv7rKYJc/uJOm2vWepu3CwpLXuHcgqWSCE.T1u/IeMm', 1, 2, '2021-11-22 10:56:15', NULL),
(3, 'Jessica', 'jessica@celke.com.br', '$2y$10$MNpQ8pS3KYrP/dJXpxr6XeYzgpY9/qA39aIaYY/1Jd69Nbukkifhm', 2, 3, '2021-11-22 10:56:44', NULL),
(4, 'Gabrielly', 'gabrielly@celke.com.br', '$2y$10$SKSHuWYAY/fQ7RGBumcCOOSPYlf576naEVKJjoyeSfOdM2ljNKSDq', 3, 3, '2021-11-22 10:57:20', NULL),
(12, 'Marcos', 'marcos@celke.com.br', '$2y$10$bhdu0F85atlvppGWWpAfdusCuhiDkiNJ4x4HibKKnwbhtTZBEwYtW', 3, 3, '2021-11-22 11:19:54', NULL),
(13, 'Ana', 'ana@celke.com.br', '$2y$10$OLU5RKX1ZUiomcUKQkDnruALq87wKMLmciP2EXFANDblQwWVZX3eC', 3, 2, '2021-11-22 11:20:31', NULL),
(15, 'Cesar 2', 'cesar2@celke.com.br', '$2y$10$S0Nn1/76XcoBiZRrmJEcc.4qKnS74FcwnVAW7ORIRY9W96.fnkXWW', 3, 3, '2021-11-22 11:30:05', NULL),
(19, 'Cesar 3', 'cesar3@celke.com.br', '$2y$10$EpoDCPkDdVOcEGJoalWNUO92.oZ1vMukP16u6kCko6AXtx.gOnD/a', 3, 3, '2021-11-22 11:54:13', NULL);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`sists_usuario_id`) REFERENCES `sists_usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`niveis_acesso_id`) REFERENCES `niveis_acessos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
