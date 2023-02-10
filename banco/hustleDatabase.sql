-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Nov-2022 às 20:39
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `hustle`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chat`
--

CREATE TABLE `tb_chat` (
  `cod_chat` int(11) NOT NULL,
  `cod_usuario_publi` int(11) NOT NULL,
  `cod_usuario_session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_chat`
--

INSERT INTO `tb_chat` (`cod_chat`, `cod_usuario_publi`, `cod_usuario_session`) VALUES
(16, 51, 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comentarios`
--

CREATE TABLE `tb_comentarios` (
  `cod_comentario` int(11) NOT NULL,
  `cod_publi` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_comentarios`
--

INSERT INTO `tb_comentarios` (`cod_comentario`, `cod_publi`, `cod_usuario`, `comentario`) VALUES
(19, 150, 51, 'bom dia gente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_curtida`
--

CREATE TABLE `tb_curtida` (
  `cod_like` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_publi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_curtida`
--

INSERT INTO `tb_curtida` (`cod_like`, `cod_usuario`, `cod_publi`) VALUES
(119, 51, 150),
(120, 52, 149);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_img_publi`
--

CREATE TABLE `tb_img_publi` (
  `cod_img_publi` int(11) NOT NULL,
  `nomeImg` varchar(150) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_publi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_img_publi`
--

INSERT INTO `tb_img_publi` (`cod_img_publi`, `nomeImg`, `cod_usuario`, `cod_publi`) VALUES
(42, 'eeb86d01962d80e82fdda5faf424f5661668997669.jfif', 51, 150);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mensagem`
--

CREATE TABLE `tb_mensagem` (
  `cod_msg` int(11) NOT NULL,
  `mensagem` varchar(200) NOT NULL,
  `cod_chat` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_mensagem`
--

INSERT INTO `tb_mensagem` (`cod_msg`, `mensagem`, `cod_chat`, `cod_usuario`) VALUES
(40, 'oi lindão', 16, 52),
(41, 'oiie', 16, 51);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_publi`
--

CREATE TABLE `tb_publi` (
  `cod_publi` int(11) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `data` date NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_publi`
--

INSERT INTO `tb_publi` (`cod_publi`, `descricao`, `data`, `cod_usuario`, `cod_cat`) VALUES
(149, ' bom dia gente', '2022-11-20', 51, 1),
(150, ' coisa boa tudo functionando \r\n', '2022-11-20', 51, 0),
(151, ' oi', '0000-00-00', 51, 1),
(152, ' aaaaaa', '0000-00-00', 51, 1),
(153, ' aaaa', '0000-00-00', 51, 1),
(154, ' aaaaaaa', '0000-00-00', 51, 1),
(155, ' ae', '2022-11-21', 51, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `img` varchar(100) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `pergunta` varchar(150) NOT NULL,
  `resposta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`img`, `nome`, `telefone`, `email`, `senha`, `cidade`, `estado`, `cod_usuario`, `bio`, `pergunta`, `resposta`) VALUES
('eeb86d01962d80e82fdda5faf424f5661669048918.jfif', 'Inacio Reichert Junior', '', 'teste@gmail.com', '123', '', '', 51, 'nossa gente muito boa essa rede', 'vc eh gay??', 'sim'),
('eeb86d01962d80e82fdda5faf424f5661668997725.jfif', 'Rafael Rme', '', 'teste2@gmail.com', '123', '', '', 52, '', 'vc eh gay??', 'naoo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`cod_chat`);

--
-- Índices para tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  ADD PRIMARY KEY (`cod_comentario`);

--
-- Índices para tabela `tb_curtida`
--
ALTER TABLE `tb_curtida`
  ADD PRIMARY KEY (`cod_like`);

--
-- Índices para tabela `tb_img_publi`
--
ALTER TABLE `tb_img_publi`
  ADD PRIMARY KEY (`cod_img_publi`);

--
-- Índices para tabela `tb_mensagem`
--
ALTER TABLE `tb_mensagem`
  ADD PRIMARY KEY (`cod_msg`);

--
-- Índices para tabela `tb_publi`
--
ALTER TABLE `tb_publi`
  ADD PRIMARY KEY (`cod_publi`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `cod_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tb_comentarios`
--
ALTER TABLE `tb_comentarios`
  MODIFY `cod_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_curtida`
--
ALTER TABLE `tb_curtida`
  MODIFY `cod_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de tabela `tb_img_publi`
--
ALTER TABLE `tb_img_publi`
  MODIFY `cod_img_publi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `tb_mensagem`
--
ALTER TABLE `tb_mensagem`
  MODIFY `cod_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `tb_publi`
--
ALTER TABLE `tb_publi`
  MODIFY `cod_publi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
