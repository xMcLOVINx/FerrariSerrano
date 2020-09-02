DROP DATABASE ferrariserrano;
CREATE DATABASE ferrariserrano;
USE ferrariserrano;

# ================
# DOS ENDEREÇOS
CREATE TABLE enderecos (
	idEndereco INT NOT NULL AUTO_INCREMENT,
	cep CHAR(10) NOT NULL,
	cidade VARCHAR(60) NOT NULL,
	estado CHAR(2) NOT NULL,
	logradouro VARCHAR(60) NOT NULL,
	bairro VARCHAR(60) NOT NULL,
	numero INT(5) NOT NULL,
	PRIMARY KEY(idEndereco)
);

INSERT INTO enderecos (cep, cidade, estado, logradouro, bairro, numero) VALUES
('17.280-000', 'Pederneiras', 'SP', 'José Ferreira', 'Centro', 343);

# ================
# DAS PERMISSÕES
CREATE TABLE permissoes (
	idPermissao INT NOT NULL AUTO_INCREMENT,
	titulo VARCHAR(45) NOT NULL,
	permissoes TEXT NOT NULL,
	dataCadastro DATE NOT NULL,
	deletado ENUM('1','0') NOT NULL DEFAULT '0',
	PRIMARY KEY(idPermissao)
);

INSERT INTO permissoes (titulo, permissoes, dataCadastro) VALUES
('Administrador', 'all', CURRENT_DATE);

# ================
# DOS USUARIOS
CREATE TABLE usuarios (
	idUsuario INT NOT NULL AUTO_INCREMENT,
	idPermissao INT NULL,
	idEndereco INT NOT NULL,
	nomeCompleto VARCHAR(64) NULL,
	razaoSocial VARCHAR(40) NULL,
	cpf CHAR(14) NULL,
	cnpj CHAR(18) NULL,
	telefone VARCHAR(19) NOT NULL,
	email VARCHAR(255) NOT NULL,
	senha CHAR(60) NOT NULL, # definir
	avatar VARCHAR(65) NULL, # definir
	dataCadastro DATE NOT NULL,
	deletado ENUM('1','0') NOT NULL DEFAULT '0',
	PRIMARY KEY(idUsuario)
);

INSERT INTO usuarios (idPermissao, idEndereco, nomeCompleto, razaoSocial, cpf, cnpj, telefone, email, senha, avatar, dataCadastro) VALUES
(1, 1, 'Matheus Vinicius', 'Matheus Vinicius LTDA', '111.111.111-11', '11.111.111/1111-11', '+55 (55) 5555-55555', 'admin@admin.com', '123456', NULL, CURRENT_DATE);

# ================
# DAS CONFIG
CREATE TABLE indices (
	idIndice INT NOT NULL AUTO_INCREMENT,
	idUsuario INT NOT NULL,
	faturamento DECIMAL(11,2) NOT NULL,
	impostosR DECIMAL(11,2) NOT NULL,
	impostosP DECIMAL(4,2) NOT NULL,
	comissaoR DECIMAL(11,2) NOT NULL,
	comissaoP DECIMAL(4,2) NOT NULL,
	custosFixosR DECIMAL(11,2) NOT NULL,
	custosFixosP DECIMAL(4,2) NOT NULL,
	lucroDesejadoR DECIMAL(11,2) NOT NULL,
	lucroDesejadoP DECIMAL(4,2) NOT NULL,
	PRIMARY KEY(idIndice),
	FOREIGN KEY(idUsuario) REFERENCES usuarios (idUsuario)
);

# ================
# DAS COTACOES
CREATE TABLE simulacoes (
	idSimulacao INT NOT NULL AUTO_INCREMENT,
	idIndice INT NOT NULL,
	idUsuario INT NOT NULL,
	produto VARCHAR(30) NULL,
	fornecedor VARCHAR(60) NULL,
	precoCompra DECIMAL(11,2) NOT NULL,
	precoVenda DECIMAL(11,2) NOT NULL,
	dataCadastro DATE NOT NULL,
	tipo INT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY(idSimulacao),
	FOREIGN KEY(idIndice) REFERENCES indices (idIndice),
	FOREIGN KEY(idUsuario) REFERENCES usuarios (idUsuario)
);

CREATE TABLE simulacoes_indices (
	idSimulacaoIndice INT NOT NULL AUTO_INCREMENT,
	idSimulacao INT NOT NULL,
	markup DECIMAL(3,2) NOT NULL,
	precoEmpate DECIMAL(11,2) NOT NULL,
	comissaoR DECIMAL(11,2) NOT NULL,
	comissaoP DECIMAL(4,2) NOT NULL,
	lucroDesejadoR DECIMAL(11,2) NOT NULL,
	lucroDesejadoP DECIMAL(4,2) NOT NULL,
	PRIMARY KEY(idSimulacaoIndice),
	FOREIGN KEY(idSimulacao) REFERENCES simulacoes (idSimulacao)
);

# ================
# DAS CONFIGURAÇÕES
CREATE TABLE configuracoes (
	tituloPagina VARCHAR(100) NOT NULL,
	valorServico DECIMAL(11,2) NOT NULL,
	termosConficoes LONGTEXT NULL,
	logoPainel VARCHAR(65) NULL,
	logoApp VARCHAR(65) NULL
);

INSERT INTO configuracoes (tituloPagina, valorServico, termosConficoes, logoPainel, logoApp) VALUES
('FerrariSerrano', 1000, NULL, NULL, NULL);

# ================
# DOS PARCELAMENTOS
CREATE TABLE parcelamentos (
	idParcelamento INT NOT NULL AUTO_INCREMENT,
	titulo VARCHAR(45) NOT NULL,
	parcelas INT(2) NOT NULL,
	desconto DECIMAL(5,2) NOT NULL,
	imagem VARCHAR(65) NULL,
	dataCadastro DATE NOT NULL,
	deletado ENUM('1','0') NOT NULL DEFAULT '0',
	PRIMARY KEY(idParcelamento)
);

# ================
# DAS MENSALIDADES
CREATE TABLE mensalidades (
	idMensalidade INT NOT NULL AUTO_INCREMENT,
	idParcelamento INT NOT NULL,
	idUsuario INT NOT NULL,
	dataCadastro DATE NOT NULL,
	PRIMARY KEY(idMensalidade),
	FOREIGN KEY(idParcelamento) REFERENCES parcelamentos (idParcelamento),
	FOREIGN KEY(idUsuario) REFERENCES usuarios (idUsuario)
);

CREATE TABLE mensalidades_parcelas (
	idMensalidadeParcela INT NOT NULL AUTO_INCREMENT,
	idMensalidade INT NOT NULL,
	valorParcela DECIMAL(11,2) NOT NULL,
	dataVencimento DATE NOT NULL,
	dataPagamento DATE NOT NULL,
	pago ENUM('1','0') NOT NULL DEFAULT '0',
	PRIMARY KEY(idMensalidadeParcela),
	FOREIGN KEY(idMensalidade) REFERENCES mensalidades (idMensalidade)
);