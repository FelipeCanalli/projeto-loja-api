-- Relátorio de usuários
-- Apelidando tabelas para facilitar
select 
us.idusuario,
us.nomeusuario,
us.foto,
cl.nomecli,
cl.cpf,
cl.sexo,
ct.email,
ct.telefone,
en.tipo,
en.logradouro,
en.numero,
en.complemento,
en.bairro,
en.cep
-- inner join -> Junção interna por ID
from tbusuario us inner join tbcliente cl on us.idusuario=cl.idusuario
inner join tbcontato ct on ct.idcontato=cl.idcontato
inner join tbendereco en on en.idendereco=cl.idendereco
where us.nomeusuario = 'felipegalvao' and us.senha = md5('senha321'); 

-- tirando o parametro where você consulta todos os dados cadastrados


-- Relátorio de pedidos
select 
pe.idpedido,
pe.idcli,
pe.datapedido,
pr.nomeproduto,
pr.preco,
ip.quantidade,
pg.tipo,
pg.valor,
pg.parcelas,
pg.valorparcela
from tbpedido pe inner join tbitenspedido ip on pe.idpedido=ip.idpedido
inner join tbproduto pr on ip.idproduto=pr.idproduto
inner join tbpagamento pg on pg.idpedido = pe.idpedido
where pe.idcli = 2;

-- Relátorio para a Consulta da Tela Inicial
select p.idproduto, p.nomeproduto, p.preco, f.foto1 from tbproduto p inner join tbfoto f on p.idfoto=f.idfoto;
