-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 17-Jun-2019 às 00:49
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

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
(1, 'Guilherme', 'Selair', 'guiADM', 'e10adc3949ba59abbe56e057f20f883e', 'guiADM@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idAluno` varchar(15) NOT NULL,
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
('0', 'guiselair', '202cb962ac59075b964b07152d234b70', 'Guilherme', 'Selair Batista de Lima', 'Masculino', '1997-11-11', 'guilherme.lima1997@hotmail.com', '55992174545'),
('1', 'daniqcosta', '91b3f4671b6b51499ffb9ce34eced7dc', 'Daniela', 'Quadros da Costa', 'Feminino', '1998-03-24', 'daniqcosta@gmail.com', '55992145552'),
('2', 'lucasdu', 'f9da6024f9867f1c511efa704474a2c8', 'Lucas', 'Duarte', 'Masculino', '1995-03-25', 'lucasduarte@gmail.com', '55991716362'),
('3', 'vitorHugo', '753bf46b4a1d2b3af41f5c3868ead4cd', 'Vitor Hugo', 'Batista de Lima', 'Masculino', '2002-02-08', 'vitorhugo@gmail.com', '55993456982');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno-disciplina`
--

CREATE TABLE `aluno-disciplina` (
  `idAluno` varchar(15) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `conceito` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalhacao`
--

CREATE TABLE `avalhacao` (
  `idAvalhacao` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `idAluno` varchar(15) NOT NULL,
  `conceito` varchar(100) NOT NULL,
  `final` tinyint(1) DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
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
(1, 'Reunião de Professores', '<p>Reuni&atilde;o de Professor para come&ccedil;o de ano letivo. Espero a presen&ccedil;a de todos(a', '#ed5959', '2019-06-21 19:00:00', '2019-06-21 21:00:00', NULL, -1, 'Guilherme Selair'),
(2, 'Prova de Montagem e Manutenção', '<p>N&atilde;o esque&ccedil;am de trazer os materiais.&nbsp;</p><p>Conte&uacute;do da p&aacute;gina 6', '#f4cc00', '2019-06-19 19:00:00', '2019-06-19 21:30:00', 411, NULL, 'Natanael  da Silva Fim');

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
(4, 'Algoritmos A'),
(5, 'Algoritmos B'),
(6, 'Direito e Legislação'),
(7, 'Banco de Dados'),
(8, 'Programação Web'),
(9, 'Montagem e Manutenção');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `idProfessor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `login` varchar(15) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `sobrenome`, `email`, `telefone`, `login`, `senha`, `sexo`) VALUES
(5, 'Jonathan', 'Pippi', 'jonathanpippi@gmail.com', '55992174545', 'pippi', '1cec415f3725081d65ce9f6aa6b86c49', 'Masculino'),
(6, 'Laísa', 'Quadros da Costa', 'laisaquadros@hotmail.com', '55992164353', 'laisaquadr', '4b7d2115f6990467b4ac1200352ff54f', 'Feminino'),
(7, 'Angélica', 'Menegassi da Silveira', 'angelicamenegassi@gmail.com', '53991764252', 'angelicaSi', '8ed2d5b4fa6fcfe09f54dc914a523e2a', 'Feminino'),
(8, 'Natanael ', 'da Silva Fim', 'natanaelSilva@globo.com', '65981640232', 'natanael', '1a031ff15e7099b2ee232fd94a274f56', 'Masculino');

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
(441, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma-aluno`
--

CREATE TABLE `turma-aluno` (
  `idTurma` int(11) NOT NULL,
  `idAluno` varchar(15) NOT NULL,
  `dataMatricula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma-professor`
--

CREATE TABLE `turma-professor` (
  `idDisciplina` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `dataMatricula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma-professor`
--

INSERT INTO `turma-professor` (`idDisciplina`, `idProfessor`, `idTurma`, `dataMatricula`) VALUES
(4, 5, 411, '2019.01'),
(7, 7, 431, '2019.01'),
(9, 8, 411, '2019.01'),
(9, 8, 421, '2019.02');

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
  MODIFY `idAvalhacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `idProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno-disciplina`
--
ALTER TABLE `aluno-disciplina`
  ADD CONSTRAINT `aluno-disciplina_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno-disciplina_ibfk_3` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `avalhacao`
--
ALTER TABLE `avalhacao`
  ADD CONSTRAINT `avalhacao_ibfk_3` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avalhacao_ibfk_4` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_2` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `idCurso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma-aluno`
--
ALTER TABLE `turma-aluno`
  ADD CONSTRAINT `idTurma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma-professor`
--
ALTER TABLE `turma-professor`
  ADD CONSTRAINT `turma-professor_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turma-professor_ibfk_4` FOREIGN KEY (`idProfessor`) REFERENCES `professor` (`idProfessor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turma-professor_ibfk_5` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
