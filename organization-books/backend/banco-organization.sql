-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Maio-2024 às 17:46
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco-organization`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alugueis`
--

CREATE TABLE `alugueis` (
  `id_aluguel` int(11) NOT NULL,
  `cod_liv` varchar(100) NOT NULL,
  `cod_leitor` varchar(100) NOT NULL,
  `dt_retirada` date NOT NULL,
  `dt_entrega` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `autores`
--

INSERT INTO `autores` (`id`, `nome`) VALUES
(30, 'Machado de Assis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE `editora` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`id`, `nome`) VALUES
(12, 'Moderna');

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitores`
--

CREATE TABLE `leitores` (
  `id_seg` int(11) NOT NULL,
  `id_leitor` varchar(80) NOT NULL,
  `leitor_nome` varchar(100) NOT NULL,
  `leitor_aluno_prof` char(10) NOT NULL,
  `leitor_tel` varchar(20) NOT NULL,
  `leitor_email` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id_seg` int(11) NOT NULL,
  `id_liv` varchar(100) NOT NULL,
  `liv_nome` varchar(80) NOT NULL,
  `liv_autor` varchar(80) NOT NULL,
  `liv_editora` varchar(80) NOT NULL,
  `liv_edicao` varchar(10) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `liv_genero` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alugueis`
--
ALTER TABLE `alugueis`
  ADD PRIMARY KEY (`id_aluguel`),
  ADD KEY `fk_cod_liv` (`cod_liv`),
  ADD KEY `fk_cod_leitor` (`cod_leitor`);

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nome` (`nome`);

--
-- Indexes for table `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nome_editora` (`nome`);

--
-- Indexes for table `leitores`
--
ALTER TABLE `leitores`
  ADD PRIMARY KEY (`id_seg`),
  ADD KEY `fk_id_leitor` (`id_leitor`);

--
-- Indexes for table `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_seg`),
  ADD KEY `fk_id_livro` (`id_liv`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alugueis`
--
ALTER TABLE `alugueis`
  MODIFY `id_aluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `editora`
--
ALTER TABLE `editora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `leitores`
--
ALTER TABLE `leitores`
  MODIFY `id_seg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `id_seg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
