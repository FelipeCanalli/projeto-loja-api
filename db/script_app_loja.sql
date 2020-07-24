/* 
	   SQL - app_loja
	Projeto para um aplicativo de uma loja
  (N:N) muitos para muitos
	@author Felipe Galvão Canalli
*/


-- Criação do do banco de dados com nome dbloja
create database dbloja;

use dbloja;

CREATE TABLE tbusuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(20) NOT NULL UNIQUE,
    senha VARCHAR(200) NOT NULL,
    foto VARCHAR(200) NOT NULL
)  ENGINE INNODB;

CREATE TABLE tbendereco (
    idendereco INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(10) NOT NULL,
    logradouro VARCHAR(100) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(20) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cep VARCHAR(10) NOT NULL
)  ENGINE INNODB;

CREATE TABLE tbcontato (
    idcontato INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL
)  ENGINE INNODB;

CREATE TABLE tbcliente (
    idcli INT AUTO_INCREMENT PRIMARY KEY,
    nomecli VARCHAR(50) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    sexo CHAR(5) NOT NULL,
    idcontato INT NOT NULL,
    idendereco INT NOT NULL,
    idusuarui INT NOT NULL
)  ENGINE INNODB;

ALTER TABLE `dbloja`.`tbcliente` 
CHANGE COLUMN `idcli` `idcli` INT AUTO_INCREMENT PRIMARY KEY;






CREATE TABLE tbproduto (
    idproduto INT AUTO_INCREMENT PRIMARY KEY,
    nomeproduto VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10 , 2 ) NOT NULL,
    idfoto INT NOT NULL
)  ENGINE INNODB;

CREATE TABLE tbfoto (
    idfoto INT AUTO_INCREMENT PRIMARY KEY,
    foto1 VARCHAR(200) NOT NULL,
    foto2 VARCHAR(200) NOT NULL,
    foto3 VARCHAR(200) NOT NULL,
    foto4 VARCHAR(200) NOT NULL
)  ENGINE INNODB;


CREATE TABLE tbpedido (
    idpedido INT AUTO_INCREMENT PRIMARY KEY,
    idcli INT NOT NULL,
    datapedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)  ENGINE INNODB;

CREATE TABLE tbitenspedido (
    iditens INT AUTO_INCREMENT PRIMARY KEY,
    idpedido INT NOT NULL,
    idproduto INT NOT NULL,
    quantidade INT DEFAULT 1 NOT NULL
)  ENGINE INNODB;

CREATE TABLE tbpagamento (
    idpagamento INT AUTO_INCREMENT PRIMARY KEY,
    idpedido INT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    descricao VARCHAR(200) NOT NULL,
    valor DECIMAL(10 , 2 ) NOT NULL,
    parcelas INT DEFAULT 1 NOT NULL,
    valorparcela DECIMAL(10 , 2 ) NOT NULL
)  ENGINE INNODB;

-- Setando as chaves estrangeiras

ALTER TABLE `dbloja`.`tbcliente` 
ADD CONSTRAINT `fk_cliente_pk_contato`
  FOREIGN KEY (`idcontato`)
  REFERENCES `dbloja`.`tbcontato` (`idcontato`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `dbloja`.`tbcliente` 
ADD CONSTRAINT `fk_cliente_pk_endereco`
  FOREIGN KEY (`idendereco`)
  REFERENCES `dbloja`.`tbendereco` (`idendereco`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbloja`.`tbcliente` 
ADD CONSTRAINT `fk_cliente_pk_usuario`
  FOREIGN KEY (`idusuario`)
  REFERENCES `dbloja`.`tbusuario` (`idusuario`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `dbloja`.`tbproduto` 
ADD CONSTRAINT `fk_produto_pk_foto`
  FOREIGN KEY (`idfoto`)
  REFERENCES `dbloja`.`tbfoto` (`idfoto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  -- o bloco de código abaixo e os similares
  -- parte da chave estrangeira idcli da tabela tbpedido
  -- vindo da tbcliente no paramentro idcli
  
  ALTER TABLE `dbloja`.`tbpedido` 
ADD CONSTRAINT `fk_pedido_pk_cliente`
  FOREIGN KEY (`idcli`)
  REFERENCES `dbloja`.`tbcliente` (`idcli`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
    ALTER TABLE `dbloja`.`tbitenspedido` 
ADD CONSTRAINT `fk_itens_pk_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbloja`.`tbpedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  
      ALTER TABLE `dbloja`.`tbitenspedido` 
ADD CONSTRAINT `fk_itens_pk_produto`
  FOREIGN KEY (`idproduto`)
  REFERENCES `dbloja`.`tbproduto` (`idproduto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


      ALTER TABLE `dbloja`.`tbpagamento` 
ADD CONSTRAINT `fk_pagamento_pk_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbloja`.`tbpedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  
-- inserindo dados nas tabelas manualmente para teste de funcionalidade e relacionamentos
-- tbusuario
INSERT into tbusuario (login, senha, foto) VALUES('admin',md5('admin321'),'admin.png');
INSERT into tbusuario (login, senha, foto) VALUES('felipegalvao',md5('senha321'),'IMG_20200412.jpg'); 
INSERT into tbusuario (login, senha, foto) VALUES('marianalopes',md5('marimari2'),'IMG_20190211.jpg'); 
 select * from tbusuario;

-- tbendereco
INSERT into tbendereco (tipo, logradouro, numero, complemento, bairro, cep) VALUES('Rua','das bromelhas','87','casa 2','Jardim Azul','03686-100');
INSERT into tbendereco (tipo, logradouro, numero, complemento, bairro, cep) VALUES('Av','Águia de Haia','1004','Portão branco','Girassol','03716-100');
 select * from tbendereco;

 -- tbcontato
INSERT INTO tbcontato (email, telefone) VALUES('felipeemail@exemplo.com','99944-1111');
INSERT INTO tbcontato (email, telefone) VALUES('marilopes@exemplo.com','99641-4111');
 select * from tbcontato;
 
 -- tbcliente
 INSERT INTO tbcliente (nomecli,cpf,sexo,idcontato,idendereco,idusuario) VALUES('Felipe Galvão Canalli','333.531.123-11','M','1','1','2');
 INSERT INTO tbcliente (nomecli,cpf,sexo,idcontato,idendereco,idusuario) VALUES('Mariana Lopes da Silva','221.551.223-16','F','2','2','3');
  select * from tbcliente;
  
 -- tbfoto
 INSERT INTO tbfoto(foto1,foto2,foto3,foto4) VALUES ('monitor1.png','monitor2.png','monitor3.png','monitor4.png');
 INSERT INTO tbfoto(foto1,foto2,foto3,foto4) VALUES ('mouse1.jpg','mouse2.png','mouse3.jpg','mouse4.jpg');
 INSERT INTO tbfoto(foto1,foto2,foto3,foto4) VALUES ('mousepad1.jpg','mousepad2.jpg','mousepad3.jpg','mousepad4.jpg');
  select * from tbfoto;

   -- tbproduto
 INSERT INTO tbproduto (nomeproduto, descricao, preco, idfoto) VALUES('Monitor Philips','LED LCD 18.5"','459.90','1');
 INSERT INTO tbproduto (nomeproduto, descricao, preco, idfoto) VALUES('Mouse HyperX','Pulsefire Surge RGB 16000 DPI','470.47','4');
 INSERT INTO tbproduto (nomeproduto, descricao, preco, idfoto) VALUES('Mousepad Rise Gaming','Scorpion Costurado Grande Fibertek Red','37.53','3');
 select * from tbproduto;
 
   -- tbpedido
 INSERT INTO tbpedido(idcli) VALUES (2);
 INSERT INTO tbpedido(idcli) VALUES (1);
  select * from tbpedido;
 
   -- tbitenspedido
 INSERT INTO tbitenspedido(idpedido,idproduto,quantidade) VALUES (1,3,2);
 INSERT INTO tbitenspedido(idpedido,idproduto,quantidade) VALUES (1,2,1);
 INSERT INTO tbitenspedido(idpedido,idproduto,quantidade) VALUES (2,1,1);
 select * from tbitenspedido;

  -- tbpagamento 
 insert into tbpagamento(idpedido,tipo,descricao,valor,parcelas,valorparcela)values(1,'cartão','1024 1441 2111 1111| Mariana L da Silva | 12/02/2051 | 445',545.53,2,272.76);
 insert into tbpagamento(idpedido,tipo,descricao,valor,parcelas,valorparcela)values(2,'cartão','2222 2422 2555 7155| Felipe G Canalli | 24/05/2041 | 745',459.90,1,459.90);  
 select * from tbpagamento;
  
 -- total de vendas
 select sum(valor) as Total from tbpagamento;
