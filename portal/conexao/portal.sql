-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 27-Ago-2019 às 04:15
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
  `telefone` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `login`, `senha`, `nome`, `sobrenome`, `sexo`, `dataNascimento`, `email`, `telefone`, `status`) VALUES
('0', 'guiselair', '202cb962ac59075b964b07152d234b70', 'Guilherme', 'Selair Batista de Lima', 'Masculino', '1997-11-11', 'guilherme.lima1997@hotmail.com', '55992174545', 'desativado'),
('1', 'daniqcosta', '91b3f4671b6b51499ffb9ce34eced7dc', 'Daniela', 'Quadros da Costa', 'Feminino', '1998-03-24', 'daniqcosta@gmail.com', '55992145552', 'ativo'),
('2', 'lucasdu', 'f9da6024f9867f1c511efa704474a2c8', 'Lucas', 'Duarte', 'Masculino', '1995-03-25', 'lucasduarte@gmail.com', '55991716362', 'ativo'),
('3', 'vitorHugo', '753bf46b4a1d2b3af41f5c3868ead4cd', 'Vitor Hugo', 'Batista de Lima', 'Masculino', '2002-02-08', 'vitorhugo@gmail.com', '55993456982', 'ativo'),
('AL#01', 'alunoTeste', 'd189b67bc9e1b9df15e60b7d5fa005a0', 'Aluno', 'Teste1', 'Masculino', '1996-02-02', 'alunoTeste@gmail.com', '5599999999', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno-disciplina`
--

CREATE TABLE `aluno-disciplina` (
  `idAprovacao` int(11) NOT NULL,
  `idAluno` varchar(15) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `conceito` varchar(100) DEFAULT NULL,
  `idAvalhacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno-disciplina`
--

INSERT INTO `aluno-disciplina` (`idAprovacao`, `idAluno`, `idDisciplina`, `conceito`, `idAvalhacao`) VALUES
(1, '0', 11, 'Apto', 15),
(2, '1', 11, 'Não Apto', 16),
(3, '2', 11, 'Não Apto', 17),
(4, '3', 11, 'Apto', 18),
(5, '0', 14, 'Apto', 19),
(6, '1', 14, 'Apto', 20),
(7, '2', 14, 'Apto', 21),
(8, '3', 14, 'Apto', 22),
(9, '0', 26, 'Não Apto', 23),
(10, '1', 26, 'Apto', 24),
(11, '2', 26, 'Apto', 25),
(12, '3', 26, 'Apto', 26);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avalhacao`
--

CREATE TABLE `avalhacao` (
  `idAvalhacao` int(11) NOT NULL,
  `idDisciplina` int(11) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `idAluno` varchar(15) NOT NULL,
  `nomeAvaliacao` varchar(100) NOT NULL DEFAULT 'Prova',
  `conceito` varchar(100) NOT NULL,
  `final` tinyint(1) DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avalhacao`
--

INSERT INTO `avalhacao` (`idAvalhacao`, `idDisciplina`, `idTurma`, `idAluno`, `nomeAvaliacao`, `conceito`, `final`, `data`) VALUES
(2, 11, 411, '0', 'Prova', 'Apto', 0, '2019-07-10'),
(3, 11, 411, '1', 'Prova', 'Não Apto', 0, '2019-07-10'),
(4, 11, 411, '2', 'Prova', 'Apto', 0, '2019-07-10'),
(5, 11, 411, '3', 'Prova', 'Apto', 0, '2019-07-10'),
(6, 14, 411, '0', 'Prova', 'Apto', 0, '2019-07-12'),
(7, 14, 411, '1', 'Prova', 'Apto', 0, '2019-07-12'),
(8, 14, 411, '2', 'Prova', 'Não Apto', 0, '2019-07-12'),
(9, 14, 411, '3', 'Prova', 'Não Apto', 0, '2019-07-12'),
(11, 26, 411, '0', 'Prova', 'Não Apto', 0, '2019-07-02'),
(12, 26, 411, '1', 'Prova', 'Apto', 0, '2019-07-02'),
(13, 26, 411, '2', 'Prova', 'Apto', 0, '2019-07-02'),
(14, 26, 411, '3', 'Prova', 'Apto', 0, '2019-07-02'),
(15, 11, 411, '0', 'Prova', 'Apto', 1, '2019-07-15'),
(16, 11, 411, '1', 'Prova', 'Não Apto', 1, '2019-07-15'),
(17, 11, 411, '2', 'Prova', 'Não Apto', 1, '2019-07-15'),
(18, 11, 411, '3', 'Prova', 'Apto', 1, '2019-07-15'),
(19, 14, 411, '0', 'Prova', 'Apto', 1, '2019-07-19'),
(20, 14, 411, '1', 'Prova', 'Apto', 1, '2019-07-19'),
(21, 14, 411, '2', 'Prova', 'Apto', 1, '2019-07-19'),
(22, 14, 411, '3', 'Prova', 'Apto', 1, '2019-07-19'),
(23, 26, 411, '0', 'Prova', 'Não Apto', 1, '2019-07-19'),
(24, 26, 411, '1', 'Prova', 'Apto', 1, '2019-07-19'),
(25, 26, 411, '2', 'Prova', 'Apto', 1, '2019-07-19'),
(26, 26, 411, '3', 'Prova', 'Apto', 1, '2019-07-19'),
(27, 12, 421, '0', 'Prova', 'Apto', 0, '2019-08-21'),
(28, 26, 411, '0', 'Prova', 'Apto', 0, '2019-08-14');

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
  `idDisciplina` int(11) DEFAULT NULL,
  `geral` int(11) DEFAULT NULL,
  `postador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `calendario`
--

INSERT INTO `calendario` (`id`, `title`, `description`, `color`, `start`, `end`, `idTurma`, `idDisciplina`, `geral`, `postador`) VALUES
(1, 'Conselho de Classe', '<p>Conselho de classe para aprova&ccedil;&atilde;o de alunos. Espero todos &agrave;s 21:00</p>', '#576ee5', '2019-07-05 21:00:00', '2019-07-05 22:00:00', NULL, NULL, -1, 'Guilherme Selair'),
(2, 'Reunião de Professores', '<p>Reuni&atilde;o para escolha de turmas para o segundo semestre de 2019.</p>', '#576ee5', '2019-07-06 09:30:00', '2019-07-06 11:00:00', NULL, NULL, -1, 'Guilherme Selair'),
(3, 'Prova de Programação 1', '<p>....</p>', '#ed5959', '2019-07-10 19:00:00', '2019-07-10 21:00:00', 411, 11, NULL, 'Jonathan Pippi'),
(4, 'Atividade Prática', '<p>Tragam os mat&eacute;rias para a aula de sexta. Soldador, alicates, estanho..... Tudo.</p>', '#f4cc00', '2019-07-05 19:30:00', '2019-07-05 22:00:00', 411, 14, NULL, 'Natanael  da Silva Fim'),
(5, 'Prova de Programação 1 - Segunda Prova', '<p>Conte&uacute;do: Condi&ccedil;&atilde;o SE, Repeat, e WHILE</p>', '#f4cc00', '2019-07-15 19:00:00', '2019-07-15 21:00:00', 411, 11, NULL, 'Jonathan Pippi'),
(7, 'Lançamento de notas finais', '...', 'black', '2019-07-19 19:00:00', '2019-07-19 19:10:00', 411, 26, NULL, 'Laísa Quadros da Costa'),
(8, 'Trabalho com consulta', '<p>O trabalho ser&aacute; realizado na pr&oacute;xima aula para aqueles que n&atilde;o foram bem na primeira prova. N&atilde;o faltem.</p>', '#576ee5', '2019-07-29 19:00:00', '2019-07-29 21:00:00', 421, 12, NULL, 'Jonathan Pippi'),
(9, 'Portfólio', '<p>Portf&oacute;lio sobre crimes cibern&eacute;ticos. Temas: .....</p>', '#ed5959', '2019-07-29 21:30:00', '2019-07-29 22:30:00', 411, 26, NULL, 'Laísa Quadros da Costa'),
(10, 'Testes', '<p>Olá, pova!</p><p>Este aqui é um teste!!!!!&nbsp;</p>', '#f4cc00', '2019-08-20 21:16:00', '2019-08-20 22:00:00', 421, 12, NULL, 'Jonathan Pippi');

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
  `nome` varchar(100) NOT NULL,
  `prerequisito` int(11) DEFAULT NULL,
  `idCurso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`idDisciplina`, `nome`, `prerequisito`, `idCurso`) VALUES
(11, 'Programação 1', NULL, 1),
(12, 'Programação 2', 11, 1),
(13, 'Programação 3', 12, 1),
(14, 'Montagem e Manutenção 1', NULL, 1),
(15, 'Montagem e Manutenção 2', 14, 1),
(16, 'Montagem e Manutenção 3', 15, 1),
(17, 'Sistemas Aplicativos 1', NULL, 1),
(18, 'Sistemas Aplicativos 2', 17, 1),
(19, 'Editoração Gráfica', NULL, 1),
(20, 'Internet', NULL, 1),
(21, 'Contabilidade Geral', NULL, 1),
(22, 'Ética e Relações Humanas', NULL, 1),
(23, 'Português Instrumental 1', NULL, 1),
(24, 'Programação Web 1', NULL, 1),
(25, 'Fundamentos da Administração', NULL, 1),
(26, 'Direito e Legislação 1', NULL, 1),
(27, 'Metodologia de Pesquisa 1', NULL, 1),
(28, 'Segurança do Trabalho', NULL, 1),
(29, 'Linux e Aplicativos ', NULL, 1),
(30, 'Inglês Instrumental', NULL, 1),
(31, 'Estatística ', NULL, 1),
(32, 'Português Instrumental 2', 23, 1),
(33, 'Programação Web 2', 24, 1),
(34, 'Metodologia de Pesquisa 2', 27, 1),
(35, 'Metodologia de Pesquisa 3', 34, 1),
(36, 'Orientação de Estágio ', NULL, NULL),
(37, 'Prática Supervisionada', NULL, NULL),
(38, 'Organização e Técnicas Comerciais 1', NULL, NULL),
(39, 'Estatística Aplicada a Contabilidade 1', NULL, NULL),
(40, 'Matemática Financeira 1', NULL, NULL),
(41, 'Informática Aplicada a Contabilidade 1', NULL, NULL),
(42, 'Empreendedorismo ', NULL, NULL),
(43, 'Contabilidade Comercial', 21, NULL),
(44, 'Contabilidade Pública', NULL, NULL),
(45, 'Direito e Legislação 2', 26, NULL),
(46, 'Organização e Técnicas Comerciais 2', 38, NULL),
(48, 'Estatística Aplicada a Contabilidade 2', 39, NULL),
(49, 'Matemática Financeira 2', 40, NULL),
(50, 'Informática Aplicada a Contabilidade 2', 41, NULL),
(51, 'Gestão Empresarial', NULL, NULL),
(52, 'Economia e Mercado 1', NULL, NULL),
(53, 'Contabilidade Industrial ', 43, NULL),
(54, 'Direito e Legislação 3', 45, NULL),
(55, 'Organização e Técnicas Comerciais 3', 46, NULL),
(56, 'Português Instrumental 3', 32, NULL),
(57, 'Analise de Balanços', NULL, NULL),
(58, 'Gestão Pública', NULL, NULL),
(59, 'Economia e Mercado 2', 52, NULL),
(60, 'Orientação de Prática Supervisionada', NULL, NULL);

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
  `login` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `sobrenome`, `email`, `telefone`, `login`, `senha`, `sexo`, `status`) VALUES
(5, 'Jonathan', 'Pippi', 'jonathanpippi@gmail.com', '55992174545', 'pippi', '1cec415f3725081d65ce9f6aa6b86c49', 'Masculino', 'ativo'),
(6, 'Laísa', 'Quadros da Costa', 'laisaquadros@hotmail.com', '55992164353', 'laisaquadros', '4b7d2115f6990467b4ac1200352ff54f', 'Feminino', 'ativo'),
(7, 'Angélica', 'Menegassi da Silveira', 'angelicamenegassi@gmail.com', '53991764252', 'angelicaSilveira', '8ed2d5b4fa6fcfe09f54dc914a523e2a', 'Feminino', 'ativo'),
(8, 'Natanael ', 'da Silva Fim', 'natanaelSilva@globo.com', '65981640232', 'natanael', '1a031ff15e7099b2ee232fd94a274f56', 'Masculino', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperaSegurança`
--

CREATE TABLE `recuperaSegurança` (
  `id` int(11) NOT NULL,
  `hash` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(311, 3),
(321, 3),
(331, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma-aluno`
--

CREATE TABLE `turma-aluno` (
  `idTurma` int(11) NOT NULL,
  `idAluno` varchar(15) NOT NULL,
  `dataMatricula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma-aluno`
--

INSERT INTO `turma-aluno` (`idTurma`, `idAluno`, `dataMatricula`) VALUES
(411, '0', '2019.01'),
(411, '1', '2019.01'),
(411, '2', '2019.01'),
(421, '0', '2019.02'),
(421, '1', '2019.02'),
(421, '2', '2019.02'),
(421, '3', '2019.02');

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
(11, 5, 411, '2019.01'),
(26, 6, 411, '2019.01'),
(14, 8, 411, '2019.01'),
(13, 7, 431, '2019.01'),
(13, 7, 431, '2019.02'),
(11, 5, 411, '2019.02'),
(14, 8, 411, '2019.02'),
(15, 8, 421, '2019.01'),
(15, 8, 421, '2019.02'),
(16, 8, 431, '2019.01'),
(16, 8, 431, '2019.02'),
(26, 6, 411, '2019.02'),
(12, 5, 421, '2019.02');

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
  ADD PRIMARY KEY (`idAluno`),
  ADD UNIQUE KEY `idAluno` (`idAluno`);

--
-- Indexes for table `aluno-disciplina`
--
ALTER TABLE `aluno-disciplina`
  ADD PRIMARY KEY (`idAprovacao`),
  ADD KEY `idAluno` (`idAluno`),
  ADD KEY `idDisciplina` (`idDisciplina`),
  ADD KEY `idAvalhacao` (`idAvalhacao`);

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
  ADD KEY `idTurma` (`idTurma`),
  ADD KEY `idDisciplina` (`idDisciplina`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`idDisciplina`),
  ADD KEY `prerequisito` (`prerequisito`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idProfessor`);

--
-- Indexes for table `recuperaSegurança`
--
ALTER TABLE `recuperaSegurança`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `aluno-disciplina`
--
ALTER TABLE `aluno-disciplina`
  MODIFY `idAprovacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `avalhacao`
--
ALTER TABLE `avalhacao`
  MODIFY `idAvalhacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `idProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `recuperaSegurança`
--
ALTER TABLE `recuperaSegurança`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno-disciplina`
--
ALTER TABLE `aluno-disciplina`
  ADD CONSTRAINT `aluno-disciplina_ibfk_2` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno-disciplina_ibfk_3` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aluno-disciplina_ibfk_4` FOREIGN KEY (`idAvalhacao`) REFERENCES `avalhacao` (`idAvalhacao`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `calendario_ibfk_2` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calendario_ibfk_3` FOREIGN KEY (`idDisciplina`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`prerequisito`) REFERENCES `disciplina` (`idDisciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disciplina_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `idCurso` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turma-aluno`
--
ALTER TABLE `turma-aluno`
  ADD CONSTRAINT `idTurma` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turma-aluno_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `aluno` (`idAluno`) ON DELETE CASCADE ON UPDATE CASCADE;

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
