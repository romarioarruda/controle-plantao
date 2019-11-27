-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 27-Nov-2019 às 20:43
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plantao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_plantao`
--

CREATE TABLE `registro_plantao` (
  `id_registro` int(11) NOT NULL,
  `data` date NOT NULL,
  `plantonista` varchar(60) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  `hora_inicio` varchar(8) NOT NULL,
  `hora_fim` varchar(8) NOT NULL,
  `ticket` int(11) DEFAULT NULL,
  `descricao` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `registro_plantao`
--

INSERT INTO `registro_plantao` (`id_registro`, `data`, `plantonista`, `tipo`, `hora_inicio`, `hora_fim`, `ticket`, `descricao`) VALUES
(1, '2019-11-26', 'Romário Arruda', 'Chamado', '00:00', '02:00', 56454, 'Captura de flip veiculo 47'),
(2, '2019-11-20', 'Paulo Henrique', 'Chamado', '04:50', '05:30', 77979, 'Captura do flip valor o nline'),
(3, '2019-11-26', 'Romário Arruda', 'Chamado', '02:20', '03:10', 8798798, 'Problema na sincronização do ocr.'),
(4, '2019-11-20', 'Simonarde Lima', 'Chamado', '04:25', '05:50', 9798798, 'Ajudando o Paulo resolver o problema da sincronização.'),
(5, '2019-11-25', 'Thiago Silva', 'Sobreaviso', '00:00', '07:00', 0, ''),
(6, '2019-11-27', 'Romário Arruda', 'Sobreaviso', '00:00', '07:00', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registro_plantao`
--
ALTER TABLE `registro_plantao`
  ADD PRIMARY KEY (`id_registro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registro_plantao`
--
ALTER TABLE `registro_plantao`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
