-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Ago-2023 às 00:00
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
  `dt_entrega` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alugueis`
--

INSERT INTO `alugueis` (`id_aluguel`, `cod_liv`, `cod_leitor`, `dt_retirada`, `dt_entrega`) VALUES
(54, '1a864', '1097143764sp', '2023-08-02', '2023-08-17');

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
(9, 'David Nicholls'),
(8, 'Antoine De Saint-Exupery'),
(7, 'Anne Frank'),
(29, 'Agatha Christie');

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
(10, 'Escala'),
(9, 'Intrinseca'),
(11, 'BestBolso');

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

--
-- Extraindo dados da tabela `leitores`
--

INSERT INTO `leitores` (`id_seg`, `id_leitor`, `leitor_nome`, `leitor_aluno_prof`, `leitor_tel`, `leitor_email`) VALUES
(39, '1097143764sp', 'Junior', 'Aluno', '(18) 99168-9799', 'washington.juniin2018@gmail.com');

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
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id_seg`, `id_liv`, `liv_nome`, `liv_autor`, `liv_editora`, `liv_edicao`, `isbn`, `liv_genero`) VALUES
(12, '1a999', 'Por Lugares Increveis', 'Agatha Christie', 'Escala', '1', '978-65-5565-116-4', 'romance'),
(10, '1a864', 'Um Dia', 'David Nicholls', 'Intrinseca', '1', '978-85-8057-045-8', 'romance'),
(9, '1a865', 'O Pequeno Principe', 'Antoine De Saint-Exupery', 'Escala', '1', '080', ''),
(8, '1a863', 'O Diario de Anne Frank', 'Anne Frank', 'BestBolso', '37', '978-85-7799-000-9', 'fatos_reais');

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
  MODIFY `id_aluguel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `editora`
--
ALTER TABLE `editora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `leitores`
--
ALTER TABLE `leitores`
  MODIFY `id_seg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `id_seg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
