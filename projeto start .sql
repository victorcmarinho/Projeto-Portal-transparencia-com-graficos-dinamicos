-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 25-Ago-2018 às 08:06
-- Versão do servidor: 5.7.21
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
-- Database: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acao`
--

DROP TABLE IF EXISTS `acao`;
CREATE TABLE IF NOT EXISTS `acao` (
  `idacao` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alinea`
--

DROP TABLE IF EXISTS `alinea`;
CREATE TABLE IF NOT EXISTS `alinea` (
  `idalinea` varchar(100) NOT NULL,
  `subalinea_idsubalinea` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idalinea`),
  KEY `fk_alinea_subalinea1_idx` (`subalinea_idsubalinea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aplicacao`
--

DROP TABLE IF EXISTS `aplicacao`;
CREATE TABLE IF NOT EXISTS `aplicacao` (
  `idaplicacao` varchar(100) NOT NULL,
  PRIMARY KEY (`idaplicacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aplicacao`
--

INSERT INTO `aplicacao` (`idaplicacao`) VALUES
('100 - GERAL TOTAL'),
('110 - GERAL'),
('130 - CIDE - CONTRIBUIÇÃO DE INTERVENÇÃO NO DOMÍNIO ECONÔMICO'),
('200 - EDUCAÇÃO - RECURSOS ESPECÍFICOS'),
('220 - ENSINO FUNDAMENTAL - RECURSOS ESPECÍFICOS'),
('230 - ENSINO MÉDIO - RECURSOS ESPECÍFICOS'),
('260 - EDUCAÇÃO - FUNDEB - RECURSOS PRÓPRIOS'),
('300 - SAÚDE - RECURSOS ESPECÍFICOS'),
('310 - SAÚDE - GERAL'),
('400 - TRÂNSITO - RECURSOS ESPECÍFICOS'),
('500 - ASSISTÊNCIA SOCIAL - RECURSOS ESPECÍFICOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aplicacao_variavel`
--

DROP TABLE IF EXISTS `aplicacao_variavel`;
CREATE TABLE IF NOT EXISTS `aplicacao_variavel` (
  `idaplicacao_variavel` varchar(100) NOT NULL,
  PRIMARY KEY (`idaplicacao_variavel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` varchar(100) NOT NULL,
  `subcategoria_idsubcategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idcategoria`),
  KEY `fk_categoria_subcategoria1_idx` (`subcategoria_idsubcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `subcategoria_idsubcategoria`) VALUES
('10000000 - RECEITAS CORRENTES', '11000000 - RECEITA TRIBUTÁRIA'),
('20000000 - RECEITAS DE CAPITAL', '24000000 - TRANSFERÊNCIAS DE CAPITAL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesa`
--

DROP TABLE IF EXISTS `despesa`;
CREATE TABLE IF NOT EXISTS `despesa` (
  `iddespesa` int(11) NOT NULL,
  `tipo_despesa_idtipo_despesa` varchar(45) NOT NULL,
  `numero_empenho_numero` varchar(10) NOT NULL,
  `pessoas_cpfcnpj` varchar(70) NOT NULL,
  `data` varchar(10) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `funcao_idfuncao` varchar(45) NOT NULL,
  `programa_idprograma` int(11) NOT NULL,
  `acao_idacao` int(11) NOT NULL,
  `fonte_recurso_idfonte_recurso` varchar(100) NOT NULL,
  `aplicacao_idaplicacao` varchar(100) NOT NULL,
  `modalidade_idmodalidade` varchar(50) NOT NULL,
  `elemento_idelemento` varchar(75) NOT NULL,
  `historico` varchar(100) DEFAULT NULL,
  `orgao_id` varchar(45) NOT NULL,
  PRIMARY KEY (`iddespesa`),
  KEY `fk_despesa_pessoas1_idx` (`pessoas_cpfcnpj`),
  KEY `fk_despesa_programa1_idx` (`programa_idprograma`),
  KEY `fk_despesa_acao1_idx` (`acao_idacao`),
  KEY `fk_despesa_numero_empenho1_idx` (`numero_empenho_numero`),
  KEY `fk_despesa_aplicacao1_idx` (`aplicacao_idaplicacao`),
  KEY `fk_despesa_tipo_despesa1_idx` (`tipo_despesa_idtipo_despesa`),
  KEY `fk_despesa_funcao1_idx` (`funcao_idfuncao`),
  KEY `fk_despesa_modalidade1_idx` (`modalidade_idmodalidade`),
  KEY `fk_despesa_fonte_recurso1_idx` (`fonte_recurso_idfonte_recurso`),
  KEY `fk_despesa_elemento1_idx` (`elemento_idelemento`),
  KEY `fk_despesa_orgao1_idx` (`orgao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `elemento`
--

DROP TABLE IF EXISTS `elemento`;
CREATE TABLE IF NOT EXISTS `elemento` (
  `idelemento` varchar(75) NOT NULL,
  PRIMARY KEY (`idelemento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fonte`
--

DROP TABLE IF EXISTS `fonte`;
CREATE TABLE IF NOT EXISTS `fonte` (
  `idfonte` varchar(100) NOT NULL,
  PRIMARY KEY (`idfonte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fonte`
--

INSERT INTO `fonte` (`idfonte`) VALUES
('11100000 - IMPOSTOS'),
('11200000 - TAXAS'),
('13200000 - RECEITAS DE VALORES MOBILIÁRIOS'),
('13300000 - RECEITA DE CONCESSÕES E PERMISSÕES'),
('16000000 - RECEITA DE SERVIÇOS'),
('17200000 - TRANSFERÊNCIAS INTERGOVERNAMENTAIS'),
('17300000 - TRANSFERÊNCIAS DE INSTITUIÇÕES PRIVADAS'),
('19100000 - MULTAS E JUROS DE MORA'),
('19200000 - INDENIZAÇÕES E RESTITUIÇÕES'),
('19300000 - RECEITA DA DÍVIDA ATIVA'),
('19900000 - RECEITAS CORRENTES DIVERSAS'),
('24200000 - TRANSFERÊNCIAS INTERGOVERNAMENTAIS'),
('24700000 - TRANSFERÊNCIAS DE CONVÊNIOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fonte_recurso`
--

DROP TABLE IF EXISTS `fonte_recurso`;
CREATE TABLE IF NOT EXISTS `fonte_recurso` (
  `idfonte_recurso` varchar(100) NOT NULL,
  PRIMARY KEY (`idfonte_recurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fonte_recurso`
--

INSERT INTO `fonte_recurso` (`idfonte_recurso`) VALUES
('01 - TESOURO'),
('02 - TRANSFERÊNCIAS E CONVÊNIOS ESTADUAIS-VINCULADOS'),
('03 - RECURSOS PRÓPRIOS DE FUNDOS ESPECIAIS DE DESPESA-VINCULADOS'),
('05 - TRANSFERÊNCIAS E CONVÊNIOS FEDERAIS-VINCULADOS'),
('06 - OUTRAS FONTES DE RECURSOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

DROP TABLE IF EXISTS `funcao`;
CREATE TABLE IF NOT EXISTS `funcao` (
  `idfuncao` varchar(45) NOT NULL,
  `sub_funcao_idsub_funcao` varchar(45) NOT NULL,
  PRIMARY KEY (`idfuncao`),
  KEY `fk_funcao_sub_funcao1_idx` (`sub_funcao_idsub_funcao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `importacoes`
--

DROP TABLE IF EXISTS `importacoes`;
CREATE TABLE IF NOT EXISTS `importacoes` (
  `id` int(11) NOT NULL,
  `datatime` datetime DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_importacoes_usuarios1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `licitacao`
--

DROP TABLE IF EXISTS `licitacao`;
CREATE TABLE IF NOT EXISTS `licitacao` (
  `idlicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `contrato` varchar(100) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `objetivo` text,
  `inicio` date DEFAULT NULL,
  `termino` date DEFAULT NULL,
  `valor` decimal(10,0) DEFAULT NULL,
  `orgao_id` varchar(45) NOT NULL,
  `arquivo` varchar(455) DEFAULT NULL,
  PRIMARY KEY (`idlicitacao`),
  KEY `fk_licitacao_orgao1_idx` (`orgao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidade`
--

DROP TABLE IF EXISTS `modalidade`;
CREATE TABLE IF NOT EXISTS `modalidade` (
  `idmodalidade` varchar(50) NOT NULL,
  PRIMARY KEY (`idmodalidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `numero_empenho`
--

DROP TABLE IF EXISTS `numero_empenho`;
CREATE TABLE IF NOT EXISTS `numero_empenho` (
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orgao`
--

DROP TABLE IF EXISTS `orgao`;
CREATE TABLE IF NOT EXISTS `orgao` (
  `id` varchar(45) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `nome` varchar(45) DEFAULT NULL,
  `cpfcnpj` varchar(70) NOT NULL,
  PRIMARY KEY (`cpfcnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `poder`
--

DROP TABLE IF EXISTS `poder`;
CREATE TABLE IF NOT EXISTS `poder` (
  `idpoder` varchar(45) NOT NULL,
  PRIMARY KEY (`idpoder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `programa`
--

DROP TABLE IF EXISTS `programa`;
CREATE TABLE IF NOT EXISTS `programa` (
  `idprograma` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idprograma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

DROP TABLE IF EXISTS `receita`;
CREATE TABLE IF NOT EXISTS `receita` (
  `idreceita` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `categoria_idcategoria` varchar(100) NOT NULL,
  `aplicacao_idaplicacao` varchar(100) NOT NULL,
  `data` date DEFAULT NULL,
  `poder_idpoder` varchar(45) NOT NULL,
  `fonte_recurso_idfonte_recurso` varchar(100) NOT NULL,
  `aplicacao_variavel_idaplicacao_variavel` varchar(100) NOT NULL,
  `fonte_idfonte` varchar(100) NOT NULL,
  `rubrica_idrubrica` varchar(100) NOT NULL,
  `alinea_idalinea` varchar(100) NOT NULL,
  `orgao_id` varchar(45) NOT NULL,
  PRIMARY KEY (`idreceita`),
  KEY `fk_receita_alinea1_idx` (`alinea_idalinea`),
  KEY `fk_receita_rubrica1_idx` (`rubrica_idrubrica`),
  KEY `fk_receita_categoria1_idx` (`categoria_idcategoria`),
  KEY `fk_receita_aplicacao_variavel1_idx` (`aplicacao_variavel_idaplicacao_variavel`),
  KEY `fk_receita_fonte_recurso1_idx` (`fonte_recurso_idfonte_recurso`),
  KEY `fk_receita_poder1_idx` (`poder_idpoder`),
  KEY `fk_receita_aplicacao1_idx` (`aplicacao_idaplicacao`),
  KEY `fk_receita_fonte1_idx` (`fonte_idfonte`),
  KEY `fk_receita_orgao1_idx` (`orgao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rubrica`
--

DROP TABLE IF EXISTS `rubrica`;
CREATE TABLE IF NOT EXISTS `rubrica` (
  `idrubrica` varchar(100) NOT NULL,
  PRIMARY KEY (`idrubrica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rubrica`
--

INSERT INTO `rubrica` (`idrubrica`) VALUES
(''),
('11120000 - IMPOSTOS SOBRE O PATRIMÔNIO E A RENDA'),
('11130000 - IMPOSTOS SOBRE A PRODUÇÃO E A CIRCULAÇÃO'),
('11210000 - TAXAS PELO EXERCÍCIO DO PODER DE POLICIA'),
('11220000 - TAXAS PELA PRESTAÇÃO DE SERVIÇOS'),
('13220000 - DIVIDENDOS'),
('13250000 - REMUNERAÇÃO DE DEPÓSITOS BANCÁRIOS'),
('13320000 - RECEITA DE CONCESSÕES E PERMISSÕES - EXPLORAÇÃO DE RECURSOS NATURAIS'),
('16000000 - RECEITA DE SERVIÇOS'),
('17210000 - TRANSFERÊNCIAS DA UNIÃO'),
('17220000 - TRANSFERÊNCIAS DOS ESTADOS'),
('17240000 - TRANSFERÊNCIAS MULTIGOVERNAMENTAIS'),
('19110000 - MULTAS E JUROS DE MORA DOS TRIBUTOS'),
('19130000 - MULTAS E JUROS DE MORA DA DIVIDA ATIVA DOS TRIBUTOS'),
('19190000 - MULTAS DE OUTRAS ORIGENS'),
('19220000 - RESTITUIÇÕES'),
('19310000 - RECEITA DA DÍVIDA ATIVA TRIBUTÁRIA'),
('19320000 - RECEITA DA DÍVIDA ATIVA NÃO TRIBUTÁRIA'),
('19900000 - RECEITAS CORRENTES DIVERSAS'),
('24210000 - TRANSFERÊNCIAS DA UNIÃO'),
('24720000 - TRANSFERÊNCIAS DE CONVÊNIOS DOS ESTADOS E DE SUAS ENTIDADES');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subalinea`
--

DROP TABLE IF EXISTS `subalinea`;
CREATE TABLE IF NOT EXISTS `subalinea` (
  `idsubalinea` varchar(100) NOT NULL,
  PRIMARY KEY (`idsubalinea`),
  UNIQUE KEY `idsubalinea_UNIQUE` (`idsubalinea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `idsubcategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idsubcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subcategoria`
--

INSERT INTO `subcategoria` (`idsubcategoria`) VALUES
('11000000 - RECEITA TRIBUTÁRIA'),
('13000000 - RECEITA PATRIMONIAL'),
('16000000 - RECEITA DE SERVIÇOS'),
('17000000 - TRANSFERÊNCIAS CORRENTES'),
('19000000 - OUTRAS RECEITAS CORRENTES'),
('24000000 - TRANSFERÊNCIAS DE CAPITAL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_funcao`
--

DROP TABLE IF EXISTS `sub_funcao`;
CREATE TABLE IF NOT EXISTS `sub_funcao` (
  `idsub_funcao` varchar(45) NOT NULL,
  PRIMARY KEY (`idsub_funcao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_despesa`
--

DROP TABLE IF EXISTS `tipo_despesa`;
CREATE TABLE IF NOT EXISTS `tipo_despesa` (
  `idtipo_despesa` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipo_despesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(90) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT '1',
  `nivel` tinyint(4) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `ativo`, `nivel`, `cpf`) VALUES
(1, 'root', 'root@root', '63a9f0ea7bb98050796b649e85481845', 1, 1, 'root');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alinea`
--
ALTER TABLE `alinea`
  ADD CONSTRAINT `fk_alinea_subalinea1` FOREIGN KEY (`subalinea_idsubalinea`) REFERENCES `subalinea` (`idsubalinea`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_subcategoria1` FOREIGN KEY (`subcategoria_idsubcategoria`) REFERENCES `subcategoria` (`idsubcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `despesa`
--
ALTER TABLE `despesa`
  ADD CONSTRAINT `fk_despesa_acao1` FOREIGN KEY (`acao_idacao`) REFERENCES `acao` (`idacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_aplicacao1` FOREIGN KEY (`aplicacao_idaplicacao`) REFERENCES `aplicacao` (`idaplicacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_elemento1` FOREIGN KEY (`elemento_idelemento`) REFERENCES `elemento` (`idelemento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_fonte_recurso1` FOREIGN KEY (`fonte_recurso_idfonte_recurso`) REFERENCES `fonte_recurso` (`idfonte_recurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_funcao1` FOREIGN KEY (`funcao_idfuncao`) REFERENCES `funcao` (`idfuncao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_modalidade1` FOREIGN KEY (`modalidade_idmodalidade`) REFERENCES `modalidade` (`idmodalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_numero_empenho1` FOREIGN KEY (`numero_empenho_numero`) REFERENCES `numero_empenho` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_orgao1` FOREIGN KEY (`orgao_id`) REFERENCES `orgao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_pessoas1` FOREIGN KEY (`pessoas_cpfcnpj`) REFERENCES `pessoas` (`cpfcnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_programa1` FOREIGN KEY (`programa_idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_despesa_tipo_despesa1` FOREIGN KEY (`tipo_despesa_idtipo_despesa`) REFERENCES `tipo_despesa` (`idtipo_despesa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcao`
--
ALTER TABLE `funcao`
  ADD CONSTRAINT `fk_funcao_sub_funcao1` FOREIGN KEY (`sub_funcao_idsub_funcao`) REFERENCES `sub_funcao` (`idsub_funcao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `importacoes`
--
ALTER TABLE `importacoes`
  ADD CONSTRAINT `fk_importacoes_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `licitacao`
--
ALTER TABLE `licitacao`
  ADD CONSTRAINT `fk_licitacao_orgao1` FOREIGN KEY (`orgao_id`) REFERENCES `orgao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `fk_receita_alinea1` FOREIGN KEY (`alinea_idalinea`) REFERENCES `alinea` (`idalinea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_aplicacao1` FOREIGN KEY (`aplicacao_idaplicacao`) REFERENCES `aplicacao` (`idaplicacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_aplicacao_variavel1` FOREIGN KEY (`aplicacao_variavel_idaplicacao_variavel`) REFERENCES `aplicacao_variavel` (`idaplicacao_variavel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_categoria1` FOREIGN KEY (`categoria_idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_fonte1` FOREIGN KEY (`fonte_idfonte`) REFERENCES `fonte` (`idfonte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_fonte_recurso1` FOREIGN KEY (`fonte_recurso_idfonte_recurso`) REFERENCES `fonte_recurso` (`idfonte_recurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_orgao1` FOREIGN KEY (`orgao_id`) REFERENCES `orgao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_poder1` FOREIGN KEY (`poder_idpoder`) REFERENCES `poder` (`idpoder`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_receita_rubrica1` FOREIGN KEY (`rubrica_idrubrica`) REFERENCES `rubrica` (`idrubrica`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
