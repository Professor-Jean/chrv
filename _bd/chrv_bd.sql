-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24-Nov-2016 às 16:49
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `marcas` (
  `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL COMMENT 'Este campo serve para identificar as marcas a partir de números que irão se auto-incrementar a partir de cada nova inserção.',
  `nome` varchar(40) NOT NULL COMMENT 'Nome da marca que está sendo registrada, será vinculada ao produto para identificar a qual marca pertence.',
  `logo` varchar(255) NOT NULL COMMENT 'Logo da marca, será armazenado o caminho do arquivo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nessa entidade serão inseridas as marcas dos produtos, que tem função de caracterizar os produtos segundo a sua marca.';

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
(01, 'adm', 'b4c8ebfcab909cde31e2c14291bd9051');

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
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as categorias a partir de números que irão se auto-incrementar a partir de cada nova inserção.';
--
-- AUTO_INCREMENT for table `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as movimentações de entrada através de números que irão se auto-incrementar a partir de cada nova movimentação.';
--
-- AUTO_INCREMENT for table `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` tinyint(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os fornecedores a partir de números que irão se auto-incrementar a partir de cada nova inserção.';
--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as marcas a partir de números que irão se auto-incrementar a partir de cada nova inserção.';
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os produtos a partir de números que irão se auto-incrementar a partir de cada nova inserção.';
--
-- AUTO_INCREMENT for table `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar as movimentações de saída através de números que irão se auto-incrementar a partir de cada nova movimentação.';
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` tinyint(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os usuários a partir de números que irão se auto-incrementar a partir de cada nova inserção.', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Este campo serve para identificar os vendedores a partir de números que irão se auto-incrementar a partir de cada nova inserção.';
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
