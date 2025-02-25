<?php

use App\Controllers\ClienteController;
use App\Controllers\ProdutoController;
use App\Controllers\PedidoController;
use App\Controllers\PedidoXProdutoController;
use CodeIgniter\Router\RouteCollection;

//ROTAS:
//AUTENTICACAO JWT
$routes->post('auth/login', 'AuthController::login');
$routes->get('usuario/perfil', 'UsuarioController::perfil', ['filter' => 'jwt']);

//CLIENTE
$routes->get('cliente', 'ClienteController::index');
$routes->get('cliente/(:segment)', 'ClienteController::show/$1');
$routes->post('cliente', 'ClienteController::create');  
$routes->put('cliente/(:segment)', 'ClienteController::update/$1');
$routes->delete('cliente/(:segment)', 'ClienteController::delete/$1'); 

//PRODUTOS
$routes->get('produto', 'ProdutoController::index');
$routes->get('produto/(:segment)', 'ProdutoController::show/$1');
$routes->post('produto', 'ProdutoController::create');  
$routes->put('produto/(:segment)', 'ProdutoController::update/$1');
$routes->delete('produto/(:segment)', 'ProdutoController::delete/$1'); 

//PEDIDOS
$routes->get('pedido', 'PedidoController::index');
$routes->get('pedido/(:segment)', 'PedidoController::show/$1');
$routes->post('pedido', 'PedidoController::create');  
$routes->put('pedido/(:segment)', 'PedidoController::update/$1');
$routes->delete('pedido/(:segment)', 'PedidoController::delete/$1'); 

//PEDIDO X PRODUTOS
$routes->post('additempedido', 'PedidoXProdutosController::adicionarProduto');  
$routes->post('delitempedido', 'PedidoXProdutosController::removerProduto');  
