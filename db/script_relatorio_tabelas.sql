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
cl.idcli,
pe.datapedido,
pr.nomeproduto,
it.quantidade,


