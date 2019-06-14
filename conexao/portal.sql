-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Jun-2019 às 23:27
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nome`, `sobrenome`, `login`, `senha`, `email`) VALUES
(1, 'Guilherme', 'Selair', 'guiADM', 'guiADM', 'guiADM@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idAluno` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `login`, `senha`, `nome`, `sobrenome`, `sexo`, `dataNascimento`, `email`, `telefone`) VALUES
(0, 'guiselair', '515f349911995d2da0a847b1824066e2', 'Guilherme', 'Selair', 'Masculino', '1997-11-11', 'guilherme.lima1997@hotmail.com', '55992174545'),
(1, 'daniqcosta', '202cb962ac59075b964b07152d234b70', 'Daniela', 'Costa', 'Feminino', '1997-11-11', 'guilherme.lima1997@hotmail.coms', '981716709'),
(2, 'lucasdu', '202cb962ac59075b964b07152d234b70', 'Lucas', 'Duarte', 'Masculino', '1995-04-11', 'lucasdu@resdes.ufsm.br', '55991174646'),
(6503, 'testeAluno', '202cb962ac59075b964b07152d234b70', 'teste', 'teste', 'Masculino', '2019-06-05', 'teste@gmail.com', '55555555555');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno-disciplina`
--

CREATE TABLE `aluno-disciplina` (
  `idAluno` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `mensao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalhacao`
--

CREATE TABLE `avalhacao` (
  `idAvalhacao` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL,
  `conceito` varchar(100) NOT NULL,
  `final` tinyint(1) DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avalhacao`
--

INSERT INTO `avalhacao` (`idAvalhacao`, `idDisciplina`, `idTurma`, `idAluno`, `conceito`, `final`, `data`) VALUES
(50, 1, 411, 0, 'Apto', 0, '2019-06-03'),
(51, 1, 411, 0, 'Apto', 0, '2019-06-03'),
(52, 2, 321, 1, 'Não Apto', 0, '2019-06-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `color` varchar(100) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `idTurma` int(11) DEFAULT NULL,
  `geral` int(11) DEFAULT NULL,
  `postador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `calendario`
--

INSERT INTO `calendario` (`id`, `title`, `description`, `color`, `start`, `end`, `idTurma`, `geral`, `postador`) VALUES
(27, 'Prova de Programação A', '<p>Conteudo:&nbsp;</p><ol><li>Condi&ccedil;&otilde;es</li><li>Repeti&ccedil;&otilde;es</li><li>Fun&c', '#f4cc00', '2019-06-19 08:00:00', '2019-06-19 09:30:00', 411, NULL, 'Jonathan Pippi'),
(28, 'Reunião de Professores', '<p>...</p>', '#576ee5', '2019-06-25 19:00:00', '2019-06-25 21:00:00', NULL, -1, 'Guilherme Selair');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`idCurso`, `nome`) VALUES
(1, 'Técnico em Informática'),
(2, 'Técnico em Secretariado'),
(3, 'Técnico em Contabilidade');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `idDisciplina` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `nome`) VALUES
(1, 'Algoritmos C'),
(2, 'Algoritmos B'),
(3, 'Direito e Legislação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `idProfessor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `login` varchar(10) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `sobrenome`, `email`, `telefone`, `login`, `senha`, `sexo`) VALUES
(2, 'Jonathan', 'Pippi', 'pippi@gmail.com', 2147483647, 'pippi', '202cb962ac59075b964b07152d234b70', ''),
(3, 'teste', 'teste', 'teste@gmail.com', 555555555, 'testeProf', '202cb962ac59075b964b07152d234b70', 'Feminino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `idCurso`) VALUES
(411, 1),
(421, 1),
(431, 1),
(441, 1),
(211, 2),
(321, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma-aluno`
--

CREATE TABLE `turma-aluno` (
  `idTurma` int(11) NOT NULL,
  `idAluno` int(11) NOT NULL,
  `dataMatricula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma-professor`
--

CREATE TABLE `turma-professor` (
  `idDisciplina` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma-professor`
--

INSERT INTO `turma-professor` (`idDisciplina`, `idProfessor`, `idTurma`) VALUES
(1, 2, 411),
(2, 2, 321);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idAluno`);

--
-- Indexes for table `aluno-disciplina`
--
ALTER TABLE `aluno-disciplina`
  ADD KEY `idAluno` (`idAluno`),
  ADD KEY `idDisciplina` (`idDisciplina`);

--
-- Indexes for table `avalhacao`
--
ALTER TABLE `avalhacao`
  ADD PRIMARY KEY (`idAvalhacao`),
  ADD KEY `idDisciplina` (`idDisciplina`),
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `idAluno` (`idAluno`);

--
-- Indexes for table `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTurma` (`idTurma`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idProfessor`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indexes for table `turma-aluno`
--
ALTER TABLE `turma-aluno`
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `idAluno` (`idAluno`);

--
-- Indexes for table `turma-professor`
--
ALTER TABLE `turma-professor`
  ADD KEY `idDisciplina` (`idDisciplina`),
  ADD KEY `idProfessor` (`idProfessor`),
  ADD KEY `idTurma` (`idTurma`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `avalhacao`
--
ALTER TABLE `avalhacao`
  MODIFY `idAvalhacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `idProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno-disciplina`
--
ALTER TABLE `aluno-disciplina`
  ADD CONSTRAINT `aluno-disciplina_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `aluno-disciplina_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Limitadores para a tabela `avalhacao`
--
ALTER TABLE `avalhacao`
  ADD CONSTRAINT `avalhacao_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`),
  ADD CONSTRAINT `avalhacao_ibfk_3` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `avalhacao_ibfk_4` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);

--
-- Limitadores para a tabela `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_2` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `idCurso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`);

--
-- Limitadores para a tabela `turma-aluno`
--
ALTER TABLE `turma-aluno`
  ADD CONSTRAINT `idAluno` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idTurma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma-professor`
--
ALTER TABLE `turma-professor`
  ADD CONSTRAINT `turma-professor_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`),
  ADD CONSTRAINT `turma-professor_ibfk_4` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`),
  ADD CONSTRAINT `turma-professor_ibfk_5` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
