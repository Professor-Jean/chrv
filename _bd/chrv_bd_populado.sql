-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Nov-2016 às 03:31
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chrv_bd`
--
CREATE DATABASE IF NOT EXISTS `chrv_bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `chrv_bd`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar as categorias a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `nome` varchar(30) NOT NULL COMMENT 'Nome da categoria que está sendo registrada, esta categoria será vinculada ao produto para melhorar a identificação do mesmo.',
  `descricao` text COMMENT 'Descrição da categoria para determinar o motivo de denominar a categoria da forma desejada.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nessa entidade serão inseridas as categorias dos produtos, que tem função de organizar os produtos de acordo com sua especificação.';

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`) VALUES
(01, 'Instrumentos de Cordas', 'Categoria para todos os Instrumentos de Corda'),
(02, 'Adaptadores', 'Categoria para todos os Adaptadores'),
(03, 'Pedais', 'Categoria para todos os Pedais'),
(04, 'Cabos', 'Categoria para todos os Cabos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar as movimentações de entrada através de números que irão se auto-incrementar a partir de cada nova movimentação.',
  `produtos_id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira para identificar os produtos na entidade entradas.',
  `fornecedores_id` tinyint(3) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Chave estrangeira para identificar os fornecedores na entidade entradas.',
  `vendedores_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `tipo` char(2) NOT NULL COMMENT 'Tipo do produto sendo ele novo ou usado.\nPN-> Produto Novo.\nPU-> Produto Usado.',
  `valor_compra` decimal(7,2) UNSIGNED NOT NULL COMMENT 'Valor do produto comprado antes de ser acrescentado impostos ou taxas e até mesmo a margem de lucro.',
  `valor_venda` decimal(7,2) UNSIGNED NOT NULL COMMENT 'Será armazenado o valor de venda do produto que será calculado com base no st, ipi, frete, despesas, margem e valor de compra.',
  `despesas` decimal(5,2) UNSIGNED NOT NULL COMMENT 'As despesas serão em porcentagem e serão inseridas após a inserção do frete, st e ipi.',
  `margem` decimal(6,2) UNSIGNED NOT NULL COMMENT 'A margem será o valor que ele receberá em cima do valor final do produto.',
  `quantidade` tinyint(3) UNSIGNED NOT NULL COMMENT 'Quantidade comprada do produto.',
  `data` date NOT NULL COMMENT 'Data da realização da compra.',
  `esgotada` tinyint(1) UNSIGNED NOT NULL COMMENT '0-> significa que o produto não está esgotado.\n1-> significa que o produto está esgotado.\nutilizado para indicar quando o produto está esgotado.',
  `frete` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT 'Frete que será incrementado acima do valor de compra do produto.',
  `st` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT 'ST que será em porcentagem e será iserida em cima do valor do produto após a inserção da porcentagem do frete.',
  `ipi` decimal(5,2) UNSIGNED DEFAULT NULL COMMENT 'IPI que será em porcentagem e será inserida em cima do valor do produto após a inserção da porcentagem do frete e após a inserção do st.',
  `nf` int(6) UNSIGNED DEFAULT NULL COMMENT 'É o número da nota fiscal do produto.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Essa entidade serve para movimentar as entradas dos produtos previamente registrados, buscando inserir dados específicos dependendo se o produto é novo ou usado.';

--
-- Extraindo dados da tabela `entradas`
--

INSERT INTO `entradas` (`id`, `produtos_id`, `fornecedores_id`, `vendedores_id`, `tipo`, `valor_compra`, `valor_venda`, `despesas`, `margem`, `quantidade`, `data`, `esgotada`, `frete`, `st`, `ipi`, `nf`) VALUES
(0000026, 000006, 002, NULL, 'PN', '13.66', '26.75', '15.00', '40.00', 10, '2014-12-02', 0, '6.85', '13.92', '5.00', 21331),
(0000027, 000004, NULL, 0003, 'PU', '230.00', '375.59', '15.00', '42.00', 1, '2015-01-11', 0, NULL, NULL, NULL, NULL),
(0000030, 000004, 001, NULL, 'PN', '241.34', '483.98', '25.00', '32.12', 3, '2015-04-11', 0, '2.68', '15.90', '0.00', 32534),
(0000032, 000006, 002, NULL, 'PN', '9.32', '26.75', '13.36', '41.32', 10, '2015-06-22', 0, '6.85', '13.92', '5.00', 54332),
(0000034, 000004, 001, NULL, 'PN', '184.34', '483.98', '24.46', '32.33', 3, '2015-08-21', 0, '2.68', '15.90', '0.00', 23421),
(0000035, 000001, 001, NULL, 'PN', '121.00', '209.12', '16.32', '23.00', 5, '2016-01-03', 0, '4.25', '15.87', '0.00', 23232),
(0000036, 000006, 002, NULL, 'PN', '7.43', '26.75', '16.53', '42.32', 10, '2015-10-05', 0, '6.85', '13.92', '5.00', 21213),
(0000037, 000006, 002, NULL, 'PN', '6.60', '26.75', '12.35', '39.03', 10, '2015-11-22', 0, '6.85', '13.92', '5.00', 65413),
(0000038, 000004, 001, NULL, 'PN', '143.54', '483.98', '24.46', '32.33', 3, '2016-01-21', 0, '2.68', '15.90', '0.00', 65332),
(0000040, 000001, 001, NULL, 'PN', '92.34', '148.59', '17.02', '18.00', 5, '2016-02-05', 0, '3.75', '12.32', '0.00', 32321),
(0000041, 000001, 001, NULL, 'PN', '112.32', '187.23', '18.03', '21.00', 3, '2016-03-10', 0, '4.02', '12.21', '0.00', 34443),
(0000042, 000001, 001, NULL, 'PN', '133.11', '233.00', '19.32', '21.00', 3, '2016-04-01', 0, '3.07', '17.63', '0.00', 32321),
(0000043, 000001, 002, NULL, 'PN', '133.11', '208.34', '19.32', '12.00', 3, '2016-05-03', 0, '3.07', '13.63', '0.00', 32321),
(0000044, 000001, 001, NULL, 'PN', '92.34', '241.23', '17.02', '29.21', 5, '2015-06-05', 0, '3.75', '12.32', '0.00', 32321),
(0000045, 000001, 001, NULL, 'PN', '112.32', '261.32', '18.03', '31.02', 3, '2016-07-20', 0, '4.02', '13.63', '0.00', 34443),
(0000046, 000001, 001, NULL, 'PN', '133.11', '275.71', '19.32', '32.54', 1, '2016-08-03', 0, '3.07', '13.63', '0.00', 32321),
(0000047, 000001, 002, NULL, 'PN', '133.11', '237.64', '19.32', '17.00', 3, '2016-09-07', 0, '3.07', '13.63', '0.00', 32321),
(0000048, 000001, 001, NULL, 'PN', '92.34', '247.12', '17.02', '29.21', 5, '2016-10-09', 0, '3.75', '12.32', '0.00', 32321),
(0000049, 000001, 001, NULL, 'PN', '112.32', '293.43', '18.03', '31.02', 3, '2016-11-10', 0, '4.02', '13.63', '0.00', 34443),
(0000060, 000001, 001, NULL, 'PN', '112.32', '309.11', '18.03', '31.02', 3, '2014-11-10', 0, '4.02', '13.63', '0.00', 34443),
(0000061, 000001, 001, NULL, 'PN', '112.32', '187.23', '18.03', '21.00', 3, '2014-12-10', 0, '4.02', '12.21', '0.00', 34443),
(0000062, 000001, 001, NULL, 'PN', '133.11', '233.00', '19.32', '21.00', 3, '2015-01-01', 0, '3.07', '17.63', '0.00', 32321),
(0000063, 000001, 002, NULL, 'PN', '133.11', '208.34', '19.32', '12.00', 1, '2015-02-03', 0, '3.07', '13.63', '0.00', 32321),
(0000064, 000001, 001, NULL, 'PN', '92.34', '193.73', '17.02', '29.21', 5, '2015-03-05', 0, '3.75', '12.32', '0.00', 32321),
(0000065, 000001, 001, NULL, 'PN', '112.32', '145.33', '18.03', '31.02', 3, '2015-04-20', 0, '4.02', '13.63', '0.00', 34443),
(0000066, 000001, 001, NULL, 'PN', '133.11', '246.00', '19.32', '32.25', 3, '2015-05-03', 0, '3.07', '13.63', '0.00', 32321),
(0000068, 000001, 001, NULL, 'PN', '92.34', '232.12', '17.02', '29.21', 5, '2015-07-09', 0, '3.75', '12.32', '0.00', 32321),
(0000069, 000001, 001, NULL, 'PN', '112.32', '211.32', '18.03', '31.02', 3, '2015-08-10', 0, '4.02', '13.63', '0.00', 34443),
(0000070, 000001, 001, NULL, 'PN', '133.11', '293.21', '19.32', '32.54', 3, '2015-09-03', 0, '3.07', '13.63', '0.00', 32321),
(0000071, 000001, 002, NULL, 'PN', '133.11', '217.64', '19.32', '17.00', 3, '2015-10-07', 0, '3.07', '13.63', '0.00', 32321),
(0000072, 000001, 001, NULL, 'PN', '92.34', '162.00', '17.02', '28.65', 5, '2015-11-09', 0, '3.75', '12.32', '0.00', 32321),
(0000073, 000001, 001, NULL, 'PN', '112.32', '205.00', '18.03', '30.83', 3, '2015-12-10', 0, '4.02', '13.63', '0.00', 34443),
(0000074, 000001, 002, NULL, 'PN', '133.11', '208.34', '19.32', '12.00', 3, '2016-06-03', 0, '3.07', '13.63', '0.00', 32321),
(0000075, 000001, NULL, 0002, 'PU', '220.00', '315.00', '10.00', '30.17', 1, '2016-11-26', 0, NULL, NULL, NULL, NULL),
(0000077, 000002, 002, NULL, 'PN', '10.00', '20.00', '10.00', '36.60', 0, '2016-11-26', 0, '10.00', '10.00', '10.00', 12033);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar os fornecedores a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `razao_social` varchar(60) NOT NULL COMMENT 'Nome na empresa que está registrado em cartório.',
  `nome` varchar(40) NOT NULL COMMENT 'Nome fantasia é aquele que é utilizado em logos.',
  `cnpj` bigint(14) UNSIGNED NOT NULL COMMENT 'Este campo serve para identificar o representante como pessoa jurídica.',
  `email` varchar(70) NOT NULL COMMENT 'Este campo conterá o email da empresa para contato geral.',
  `telefone` bigint(15) UNSIGNED NOT NULL COMMENT 'Telefone da empresa.',
  `logradouro` varchar(45) NOT NULL COMMENT 'Logradouro da empresa contendo a sua localização.',
  `cep` int(8) UNSIGNED NOT NULL COMMENT 'É o CEP de onde está localizada a empresa.',
  `numero` int(5) UNSIGNED NOT NULL COMMENT 'Número da residência ou bloco em que a empresa se encontra.',
  `bairro` varchar(22) NOT NULL COMMENT 'Bairro onde se localiza a empresa.',
  `representante` varchar(40) NOT NULL COMMENT 'Nome do representante da empresa de quem são comprados os produtos.',
  `email_rep` varchar(70) NOT NULL COMMENT 'Email do represenrtante para entrar em contato.',
  `telefone_rep` bigint(15) UNSIGNED NOT NULL COMMENT 'Telefone do representante para contato.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Essa entidade é utilizada  para inserir os fornecedores dos produtos novos, suas informações, estabelecendo uma conexão comprador - fornecedor.';

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `razao_social`, `nome`, `cnpj`, `email`, `telefone`, `logradouro`, `cep`, `numero`, `bairro`, `representante`, `email_rep`, `telefone_rep`) VALUES
(001, 'GOLDEN GUITAR INST. MUSICAIS LTDA', 'Golden Guitar', 11111111111111, 'www.goldenguitar.com.br', 1129319130, 'AV LINDOMAR GOMES DE OLIVEIRA', 2201002, 420, 'Iririu', 'Paulo', 'www.hofma.com.br', 4731231232),
(002, 'MUSICAL EXPRESS COMERCIO  LTDA', 'Musical Express', 18067791000132, 'www.musicalexpress.com.br', 4730340100, 'RUA PAPA JOAO XXIII', 1321300, 1260, 'PARQUE NOVO MUNDO', 'Paulo', 'paulo312@gmail.com', 4731233213),
(003, 'OPEN ELETRO ACUSTICA LTDA', 'Eletro Acustica', 3820825000140, 'www.openelectro.com.br', 4334207800, 'AV MINAS GERAIS', 86806430, 4141, 'Arapucarana', 'Roberto', 'roberto312@gmail.com', 4734340103);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar as marcas a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `nome` varchar(40) NOT NULL COMMENT 'Nome da marca que está sendo registrada, será vinculada ao produto para identificar a qual marca pertence.',
  `logo` varchar(255) NOT NULL COMMENT 'Logo da marca, será armazenado o caminho do arquivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nessa entidade serão inseridas as marcas dos produtos, que tem função de caracterizar os produtos segundo a sua marca.';

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`id`, `nome`, `logo`) VALUES
(01, 'Santo Angelo', 'a25b3c87ef2c69a12876ccdde49450e3.jpg'),
(02, 'Tagima', '4ecbf7e2abcde0be7dfc8f516f889e99.png'),
(03, 'Elixir', 'a7fe83f87bded4ddc339c9f8b526d996.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar os produtos a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `marcas_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira para identificar as marcas na entidade produtos.',
  `categorias_id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira para identificar as categorias na entidade produtos.',
  `nome` varchar(40) NOT NULL COMMENT 'Nome do produto que está sendo registrado, isso distinguirá nominalmente cada produto.',
  `qtd_min_estoque` tinyint(2) UNSIGNED NOT NULL COMMENT 'Quantidade mínima possível em estoque, quando atingir esta quantidade será alertado na tela do usuário que o estoque do produto está baixo.\n0-> Ativo.\n1-> Inativo.',
  `imagem` varchar(255) NOT NULL COMMENT 'Imagem do produto que está sendo registrado, nesse campo será salvo o caminho do arquivo.',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT 'Status do produto que está sendo registrado, sua função será para distinguir quando o produto está ativo ou desativo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Essa entidade serve para inserir os produtos, assim movimentados de acordo com seu tipo, novo ou usado, atribuindo nulo aos valores que não se aplicam a tal tipo.';

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `marcas_id`, `categorias_id`, `nome`, `qtd_min_estoque`, `imagem`, `status`) VALUES
(000001, 03, 01, 'Violão', 4, 'f2065edfbeb9051b1bd3c41d18397b61.jpg', 0),
(000002, 01, 02, 'Adaptador', 6, 'e5455c5afe54a2ca8527f01e41527584.jpg', 1),
(000003, 02, 03, 'Pedal', 8, 'bc5251e0242957256ae53118d7a5ad12.jpg', 0),
(000004, 01, 01, 'Guitarra', 3, 'deffbeab1763262857e3ace2dfa705b1.jpg', 0),
(000006, 01, 04, 'Cabo Ninja P10 - 3,05 MT', 10, '2d987bfac44008e5282b89ed28b216d1.jpg', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar as movimentações de saída através de números que irão se auto-incrementar a partir de cada nova movimentação.',
  `entradas_id` int(7) UNSIGNED ZEROFILL NOT NULL COMMENT 'Chave estrangeira para identificar as entradas na entidade saídas.',
  `quantidade` tinyint(2) UNSIGNED NOT NULL COMMENT 'Quantidade do produto que será retirado do estoque.',
  `motivo` char(2) NOT NULL COMMENT 'Motivo pelo qual ele está sendo retirado, como brinde, desaparecimento, furto ou venda.\nDP->desaparecimento.\nFR->furto.\nBN->brinde.\nVN->venda.',
  `desconto` tinyint(3) UNSIGNED NOT NULL COMMENT 'Porcentagem de desconto em cima do valor do produto.',
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Essa entidade serve para movimentar as saídas dos produtos previamente registrados, buscando inserir dados específicos dependendo se o produto é novo ou usado.';

--
-- Extraindo dados da tabela `saidas`
--

INSERT INTO `saidas` (`id`, `entradas_id`, `quantidade`, `motivo`, `desconto`, `data`) VALUES
(0000005, 0000063, 1, '4', 10, '2016-11-25'),
(0000006, 0000063, 1, '4', 10, '2016-11-25'),
(0000007, 0000046, 2, '4', 10, '2016-11-26'),
(0000010, 0000077, 20, '4', 10, '2016-11-26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar os usuários a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `usuario` varchar(22) NOT NULL COMMENT 'Nome de usuário que será utilizado no login do software.',
  `senha` char(32) NOT NULL COMMENT 'Senha do usuário para fazer o login no software para acessar a área de controle de estoque e registros de produtos.'
) ENGINE=InnoDB DEFAULT CHARSET=big5 COMMENT='Essa entidade serve para cadastrar os usuários que utilizarão o websoftware, esses irão inserir informações e efetuar o gerenciamento de estoque desse sistema.';

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(01, 'adm', 'b4c8ebfcab909cde31e2c14291bd9051'),
(02, 'adm1', 'b4c8ebfcab909cde31e2c14291bd9051'),
(03, 'adm2', 'b4c8ebfcab909cde31e2c14291bd9051');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar os vendedores a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `nome` varchar(40) NOT NULL COMMENT 'Nome do vendedor de um produto usado.',
  `email` varchar(70) NOT NULL COMMENT 'Email do vendedor de produto usado, para envio de contratos ou informações do produto.',
  `telefone` bigint(15) UNSIGNED NOT NULL COMMENT 'Telefone do vendedor de produto usado, para possíveis meios de contato para troca de informações.',
  `cep` int(8) UNSIGNED NOT NULL COMMENT 'CEP da rua do vendedor de produto usado, para entrega busca do instrumento ou outras coisas.',
  `logradouro` varchar(45) NOT NULL COMMENT 'Localização do vendedor de intrumento usado mora.',
  `numero` int(5) UNSIGNED NOT NULL COMMENT 'Número da residência do vendedor de instrumento usado.',
  `bairro` varchar(22) NOT NULL COMMENT 'Bairro onde se situa a rua do vendedor de intrumento usado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Essa entidade serve para inserir os vendedores dos produtos novos, suas informações, estabelecendo uma conexão vendedor - comprador.';

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`id`, `nome`, `email`, `telefone`, `cep`, `logradouro`, `numero`, `bairro`) VALUES
(0001, 'Miguel Raul Benício Souza', 'miguel_raul@soluxenergiasolar.com.br', 4312423212, 22342343, 'Rua Palmeiras', 324, 'Medeiros'),
(0002, 'André Bruno Araújo', 'andre.bruno.araujo@drimenezes.com', 2134542133, 33423544, 'Rua Canoinhas', 212, 'Ipiranga'),
(0003, 'Daniel Luiz Paulo Alves', 'daniel_alves@mega.com.br', 8135823309, 65466465, 'Rua Cinco', 375, 'Ponto Alto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mov_entrada_produtos1_idx` (`produtos_id`),
  ADD KEY `fk_entradas_fornecedores1_idx` (`fornecedores_id`),
  ADD KEY `fk_entradas_vendedores1_idx` (`vendedores_id`);

--
-- Indexes for table `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtos_marcas1_idx` (`marcas_id`),
  ADD KEY `fk_produtos_categorias1_idx` (`categorias_id`);

--
-- Indexes for table `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saidas_entradas1_idx` (`entradas_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as categorias a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as movimentações de entrada através de números que irão se auto-incrementar a partir de cada nova movimentação.', AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os fornecedores a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as marcas a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os produtos a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as movimentações de saída através de números que irão se auto-incrementar a partir de cada nova movimentação.', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os usuários a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os vendedores a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entradas_fornecedores1` FOREIGN KEY (`fornecedores_id`) REFERENCES `fornecedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entradas_vendedores1` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mov_entrada_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_marcas1` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `saidas`
--
ALTER TABLE `saidas`
  ADD CONSTRAINT `fk_saidas_entradas1` FOREIGN KEY (`entradas_id`) REFERENCES `entradas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
