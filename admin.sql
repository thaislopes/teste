-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Jul-2021 às 15:41
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_funcionario`
--

CREATE TABLE `cad_funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sobrenome` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cad_funcionario`
--

INSERT INTO `cad_funcionario` (`id_funcionario`, `nome`, `sobrenome`, `data`, `cpf`, `email`, `senha`) VALUES
(1, 'Aline', 'Silva', '29-01-1996', '1234567800', 'aline12@gmail.com', '963258'),
(3, 'Fabio', 'Souza', '02-08-1994', '1234567890', 'fabio@hotmail.com', '741258');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id_noticias` int(11) NOT NULL,
  `data` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `resumo` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `texto` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `destaque` enum('sim','nao') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id_noticias`, `data`, `titulo`, `resumo`, `texto`, `destaque`) VALUES
(13, '01-07-2021', 'Lira vÃª chance de PLs da Reforma TibutÃ¡ria aprovados antes do recesso', 'O presidente da CÃ¢mara avaliou que os projetos que tramitam na Casa sobre o tema possam ser votados ainda antes do recesso parlamentar.', ' presidente da CÃ¢mara, Arthur Lira (PP-AL), quer acelerar a aprovaÃ§Ã£o dos dois projetos de lei sobre a reforma tributÃ¡ria, atualmente em tramitaÃ§Ã£o na Casa e aprovar as duas matÃ©rias nos prÃ³ximos 15 dias, antes do recesso parlamentar. "HÃ¡ chance dos dois PLs da reforma tributÃ¡ria serem aprovados antes do recesso, mas temos que chegar a um texto que traga melhorias ao sistema efetivamente, mesmo com a simplicidade do quÃ³rum", escreveu Lira no Twitter.\r\nEle quer tambÃ©m aprovar a Lei de Diretrizes OrÃ§amentÃ¡rias (LDO), as mudanÃ§as no CÃ³digo Eleitoral, a regularizaÃ§Ã£o fundiÃ¡ria e o fim dos supersÃ¡larios em apenas duas semanas. Em relaÃ§Ã£o ao PL da privatizaÃ§Ã£o dos Correios, Lira ponderou que depende ainda dos encaminhamentos do relator do texto.\r\n\r\n"Temos que ter a instalaÃ§Ã£o da CMO para aprovaÃ§Ã£o da LDO ainda nos prÃ³ximos 15 dias", relatou no Twitter. "Avisei aos lÃ­deres que se nÃ³s nÃ£o tivermos a votaÃ§Ã£o da LDO, nÃ£o vamos fazer recesso branco. NÃ³s vamos continuar fazendo sessÃµes e as pautas" disse Lira a jornalistas na CÃ¢mara.\r\n\r\nEm discussÃ£o na Casa estÃ£o dois projetos um sobre a fusÃ£o do PIS/Cofins em um novo imposto, chamado de ContribuiÃ§Ã£o sobre Bens e ServiÃ§os (CBS) e outro sobre mudanÃ§as no imposto de renda de pessoas fÃ­sicas e jurÃ­dicas.', 'sim'),
(16, '02-07-2021', 'Crescimento do emprego nos EUA acelera em junho; desemprego sobe para 5,9%', 'Foram criadas 850 mil vagas de trabalho fora do setor agrÃ­cola no mÃªs passado, depois de 583 mil em maio, informou o Departamento de Trabalho nesta sexta-feira, em seu relatÃ³rio de empregos monitorado de perto.', 'O crescimento do emprego nos Estados Unidos acelerou em junho, Ã  medida que empresas, desesperadas para aumentar a produÃ§Ã£o e os serviÃ§os em meio Ã  crescente demanda, elevaram os salÃ¡rios e ofereceram incentivos para atrair milhÃµes de norte-americanos desempregados relutantes de volta Ã  forÃ§a de trabalho.\r\nForam criadas 850 mil vagas de trabalho fora do setor agrÃ­cola no mÃªs passado, depois de 583 mil em maio, informou o Departamento de Trabalho nesta sexta-feira, em seu relatÃ³rio de empregos monitorado de perto. A taxa de desemprego subiu de 5,8% em maio para 5,9% em junho.\r\n\r\nA taxa de desemprego foi subestimada por haver pessoas que se classificam erroneamente como "empregadas, mas ausentes do trabalho". HÃ¡ um nÃºmero recorde de 9,3 milhÃµes de vagas abertas. Economistas consultados pela Reuters previam criaÃ§Ã£o de 700 mil vagas de trabalho no mÃªs passado e uma queda da taxa de desemprego para 5,7%.', 'sim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cad_funcionario`
--
ALTER TABLE `cad_funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cad_funcionario`
--
ALTER TABLE `cad_funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
