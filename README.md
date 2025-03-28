# Felipe Sloboda - 24/02/2024 14:07  
# Teste Dev JR. para empresa L5  
# PHP + Codeigniter4 + MySql  

# DESCRIÇÃO DO PROBLEMA  
CRIAR API COM CRUD DE CLIENTE, PRODUTO, E PEDIDO. AUTENTICADO COM JWT E COM PAGINAÇÃO E FILTROS  

# PARTE 1/2 - OK  
CLIENTES(CRUD) (ID, CPF/CNPJ, NOME/RAZAO SOCIAL)  
PRODUTOS(CRUD) (ID, DESCRICAO, QTD, PRECO)  
PEDIDOS(CRUD) (ABERTO, PAGO, CANCELADO)  

# PARTE 2/2 - OK  
PAGINACAO E FILTROS  
JWT  

# COMO INSTALAR EXECUTAR NA MINHA MAQUINA ?  
1.CLONE OS ARQUIVOS DO GITHUB PARA O DIRETORIO WWW DO SERVER  
2.CRIE UM BANCO DE DADOS MYSQL COM O NOME "teste-l5"  
3.EXECUTE AS MIGRATIONS PARA CRIAR AS TABELAS: php spark migrate  
4.EXECUTE AS SEED PARA POPULAR OS DADOS NO BANCO: (obrigatório nessa ordem)  
php spark db:seed ClientesSeeder  
php spark db:seed ProdutosSeeder  
php spark db:seed PedidosSeeder  
php spark db:seed PedidoXProdutosSeeder  
5.EXECUTE O SERVIDOR: php spark serve  
6.EFETUE O LOGIN NO ENDPOINT ABAIXO:  
http://localhost:8080/auth/login  
email=teste@email.com  
senha=123456  
Copie o token configure o Header (Accept=application/json, Authorization= Bearer TOKEN) substiua o TOKEN pelo token copiado  
7.ENVIE REQUISIÇÕES PARA OS ENDPOINTS ABAIXO:  
OBS: Disponibilizado o arquivo do POSTMAN com as requisições prontas. (/arquivos/requisicoes postman) basta importar o arquivo e utilizar.  

# ENDPOINTS:  
http://localhost:8080/auth/login (email=teste@email.com / senha=123456)   
http://localhost:8080/cliente  
http://localhost:8080/produto  
http://localhost:8080/pedido  
http://localhost:8080/additempedido  
http://localhost:8080/delitempedido  

# BANCO DE DADOS:  
CLIENTES  
PRODUTOS  
PEDIDOS (FK: CLIENTE_ID)  
PEDIDOXPRODUTOS (FK: PEDIDO_ID + PRODUTO_ID)  
RELACIONAMENTOS:  
1-N (1CLIENTE TEM N PEDIDOS, CADA PEDIDO SÓ TEM UM CLIENTE)  
N-N (N PEDIDOS TEM N PRODUTOS, N PRODUTOS PERTENCEM A N PEDIDOS)  
CONFORME DIAGRAMA:  

![DIAGRAMA BANCO DE DADOS](https://github.com/FelipeSloboda/testeL5/blob/main/Arquivos/DIAGRAMA%20BD.PNG)

# RECURSOS UTILIZADOS:  
MIGRATIONS  
SEEDER  
FACTORY (POPULAÇÃO DAS TABELAS DB EM MASSA - FEITO MANUALMENTE) (app/database/factories)  
ROTAS  
MODEL (COM RELACIONAMENTOS)  
CONTROLLER (MODELO --RESSOURCE)  
VALIDAÇÃO DE DADOS (FORM FORMREQUEST) (FEITO MANUALMENTE) (REGRAS ESPECIFICAS E MENSAGENS DE ERRO PERSONALIZADAS*) (app/requests)  
RELACIONAMENTOS (1CLIENTE-NPEDIDOS) (NPEDIDOS-NPRODUTOS)  
JSONRESPONSES PERSONALIZADA* CONFORME EXEMPLO SOLICITADO (COM RESPONSES) (FEITO MANUALMENTE) (app/helpers/responses)  
AUTENTICAÇÃO JWT  
QUERY STRING: PAGINAÇÃO E FILTROS  

# CONSIDERAÇÕES FINAIS  
DESAFIO 1 E 2 FEITOS COM SUCESSO, TESTADOS, FUNCIONANDO E DOCUMENTADO. FEITO EM APROXIMADAMENTE 1 DIA, SEM MUITA DIFICULDADE, E UTILIZEI OS RECURSOS CITADOS ACIMA DO QUAL JA TENHO DOMINIO. DUVIDAS FICO A DISPOSIÇÃO.  
