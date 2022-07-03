-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 14-Abr-2021 às 21:07
-- Versão do servidor: 5.5.68-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asw001`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_administrador`
--

CREATE TABLE IF NOT EXISTS `V_administrador` (
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_alvo`
--

CREATE TABLE IF NOT EXISTS `V_alvo` (
  `designacao` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_area`
--

CREATE TABLE IF NOT EXISTS `V_area` (
  `designacao` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_candidatura`
--

CREATE TABLE IF NOT EXISTS `V_candidatura` (
  `projeto` varchar(4) CHARACTER SET utf8 NOT NULL,
  `voluntario` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_instituicao`
--

CREATE TABLE IF NOT EXISTS `V_instituicao` (
  `nif` int(9) NOT NULL DEFAULT '0',
  `nome` varchar(60) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(150) CHARACTER SET utf8 NOT NULL,
  `telefone` decimal(9,0) NOT NULL,
  `morada` varchar(60) CHARACTER SET utf8 NOT NULL,
  `distrito` varchar(30) CHARACTER SET utf8 NOT NULL,
  `concelho` varchar(30) CHARACTER SET utf8 NOT NULL,
  `freguesia` varchar(500) CHARACTER SET utf8 NOT NULL,
  `email_inst` varchar(30) CHARACTER SET utf8 NOT NULL,
  `url_web` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `representante` varchar(40) CHARACTER SET utf8 NOT NULL,
  `email_repres` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_proj_horario`
--

CREATE TABLE IF NOT EXISTS `V_proj_horario` (
  `projeto` varchar(4) CHARACTER SET utf8 NOT NULL,
  `dia` varchar(10) CHARACTER SET utf8 NOT NULL,
  `periodo` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_projeto`
--

CREATE TABLE IF NOT EXISTS `V_projeto` (
  `nif` int(9) NOT NULL,
  `id` varchar(4) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `carta` tinyint(1) DEFAULT NULL,
  `distrito` varchar(30) CHARACTER SET utf8 NOT NULL,
  `concelho` varchar(30) CHARACTER SET utf8 NOT NULL,
  `freguesia` varchar(30) CHARACTER SET utf8 NOT NULL,
  `area` varchar(50) CHARACTER SET utf8 NOT NULL,
  `funcao` varchar(30) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `alvo` varchar(10) CHARACTER SET utf8 NOT NULL,
  `vagas` decimal(4,0) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL,
  `foto` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `atividade` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_vol_alvo`
--

CREATE TABLE IF NOT EXISTS `V_vol_alvo` (
  `voluntario` decimal(8,0) NOT NULL,
  `alvo` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_vol_area`
--

CREATE TABLE IF NOT EXISTS `V_vol_area` (
  `voluntario` decimal(8,0) NOT NULL,
  `area` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_vol_disponibilidade`
--

CREATE TABLE IF NOT EXISTS `V_vol_disponibilidade` (
  `voluntario` decimal(8,0) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_vol_horario`
--

CREATE TABLE IF NOT EXISTS `V_vol_horario` (
  `voluntario` decimal(8,0) NOT NULL,
  `dia` varchar(10) CHARACTER SET utf8 NOT NULL,
  `periodo` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `V_voluntario`
--

CREATE TABLE IF NOT EXISTS `V_voluntario` (
  `cc` decimal(8,0) NOT NULL DEFAULT '0',
  `nome` varchar(40) CHARACTER SET utf8 NOT NULL,
  `genero` char(1) CHARACTER SET utf8 NOT NULL,
  `nascimento` date NOT NULL,
  `telemovel` decimal(9,0) NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `distrito` varchar(30) CHARACTER SET utf8 NOT NULL,
  `concelho` varchar(30) CHARACTER SET utf8 NOT NULL,
  `freguesia` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `foto` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `carta` tinyint(1) DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `nif` decimal(8,0) NOT NULL DEFAULT '0',
  `nome` varchar(40) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telemovel` decimal(9,0) NOT NULL,
  `tefefone` decimal(9,0) NOT NULL,
  `morada` varchar(40) CHARACTER SET utf8 NOT NULL,
  `distrito` varchar(30) CHARACTER SET utf8 NOT NULL,
  `concelho` varchar(30) CHARACTER SET utf8 NOT NULL,
  `freguesia` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `url_inst` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `representante` varchar(40) CHARACTER SET utf8 NOT NULL,
  `email_repres` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pass_repres` varchar(40) CHARACTER SET utf8 NOT NULL,
  `registado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `nome` varchar(50) NOT NULL,
  `idade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperacao`
--

CREATE TABLE IF NOT EXISTS `recuperacao` (
  `utilizador` varchar(255) CHARACTER SET utf8 NOT NULL,
  `confirmacao` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `V_administrador`
--
ALTER TABLE `V_administrador`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `V_alvo`
--
ALTER TABLE `V_alvo`
  ADD PRIMARY KEY (`designacao`);

--
-- Indexes for table `V_area`
--
ALTER TABLE `V_area`
  ADD PRIMARY KEY (`designacao`);

--
-- Indexes for table `V_candidatura`
--
ALTER TABLE `V_candidatura`
  ADD PRIMARY KEY (`projeto`,`voluntario`),
  ADD KEY `v_fk` (`voluntario`);

--
-- Indexes for table `V_instituicao`
--
ALTER TABLE `V_instituicao`
  ADD PRIMARY KEY (`nif`),
  ADD UNIQUE KEY `email` (`email_inst`),
  ADD UNIQUE KEY `email_repres` (`email_repres`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nif` (`nif`),
  ADD UNIQUE KEY `url_inst` (`url_web`);

--
-- Indexes for table `V_proj_horario`
--
ALTER TABLE `V_proj_horario`
  ADD PRIMARY KEY (`projeto`,`dia`,`periodo`);

--
-- Indexes for table `V_projeto`
--
ALTER TABLE `V_projeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nif` (`nif`);

--
-- Indexes for table `V_vol_alvo`
--
ALTER TABLE `V_vol_alvo`
  ADD PRIMARY KEY (`voluntario`,`alvo`),
  ADD KEY `alvo_fk` (`alvo`);

--
-- Indexes for table `V_vol_area`
--
ALTER TABLE `V_vol_area`
  ADD PRIMARY KEY (`voluntario`,`area`),
  ADD KEY `area_fk` (`area`);

--
-- Indexes for table `V_vol_disponibilidade`
--
ALTER TABLE `V_vol_disponibilidade`
  ADD PRIMARY KEY (`voluntario`,`inicio`,`fim`);

--
-- Indexes for table `V_vol_horario`
--
ALTER TABLE `V_vol_horario`
  ADD PRIMARY KEY (`voluntario`,`dia`,`periodo`),
  ADD KEY `relacao_v_fk` (`voluntario`);

--
-- Indexes for table `V_voluntario`
--
ALTER TABLE `V_voluntario`
  ADD PRIMARY KEY (`cc`),
  ADD UNIQUE KEY `telemóvel` (`telemovel`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`nif`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_repres` (`email_repres`),
  ADD UNIQUE KEY `url_inst` (`url_inst`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD PRIMARY KEY (`utilizador`),
  ADD KEY `utilizador` (`utilizador`,`confirmacao`(255));

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `V_candidatura`
--
ALTER TABLE `V_candidatura`
  ADD CONSTRAINT `p_fk` FOREIGN KEY (`projeto`) REFERENCES `V_projeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `v_fk` FOREIGN KEY (`voluntario`) REFERENCES `V_voluntario` (`cc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `V_proj_horario`
--
ALTER TABLE `V_proj_horario`
  ADD CONSTRAINT `proj_id_fk` FOREIGN KEY (`projeto`) REFERENCES `V_projeto` (`id`);

--
-- Limitadores para a tabela `V_projeto`
--
ALTER TABLE `V_projeto`
  ADD CONSTRAINT `V_projeto_ibfk_1` FOREIGN KEY (`nif`) REFERENCES `V_instituicao` (`nif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `V_vol_alvo`
--
ALTER TABLE `V_vol_alvo`
  ADD CONSTRAINT `alvo_fk` FOREIGN KEY (`alvo`) REFERENCES `V_alvo` (`designacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volcc_fk` FOREIGN KEY (`voluntario`) REFERENCES `V_voluntario` (`cc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `V_vol_area`
--
ALTER TABLE `V_vol_area`
  ADD CONSTRAINT `area_fk` FOREIGN KEY (`area`) REFERENCES `V_area` (`designacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cc_fk` FOREIGN KEY (`voluntario`) REFERENCES `V_voluntario` (`cc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `V_vol_disponibilidade`
--
ALTER TABLE `V_vol_disponibilidade`
  ADD CONSTRAINT `vol_fk` FOREIGN KEY (`voluntario`) REFERENCES `V_voluntario` (`cc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `V_vol_horario`
--
ALTER TABLE `V_vol_horario`
  ADD CONSTRAINT `vol_cc_fk` FOREIGN KEY (`voluntario`) REFERENCES `V_voluntario` (`cc`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
