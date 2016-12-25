<?php
session_start(); //   http://fb3752y9.bget.ru/magic.perfume/product/all
require_once __DIR__ . '/controllers/cart_fun.php'; //  http://moyproekt3htaccess/magic.perfume/product/all

require_once __DIR__ . '/autoload.php';
        //реализация htaccess
        //var_dump($_GET['q']); string(13) "product/all/4"
$info = explode('/', $_GET['q']);

$params = array();
foreach ($info as $v)
{
    if ($v != '')
        $params[] = $v;
}
//var_dump($params); //array(2) { [0]=> string(7) "product" [1]=> string(3) "all" }
$ctrl = isset($params[0]) ? ucfirst($params[0]) : 'Product';  // ucfirst - Преобразует первый символ строки в верхний регистр
$controllerClassName = $ctrl . 'Controller';
$controller = new $controllerClassName;
        //echo $controller;die;
$action = (isset($params[1])) ? ucfirst($params[1]) : 'All';
$method = 'action' . $action;
$controller->$method();

//var_dump($_SESSION);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['total_items'] = 0; //сколько товаров в корзине
    $_SESSION['total_price'] = 0.00; //цена всех товаров в корзине
}
$get = explode('/', $_GET['q']); //реализация htaccess
$id = $get[4];
if(isset($get[4])) {
        //добавление товара в корзину
    $id = $get[4];
    add_to_cart($id);
        //сколько товаров в корзине
    $_SESSION['total_items'] = total_items($_SESSION['cart']);
        // возвращает иготовую сумму корзины
    $summ = getTotalSumm();   // echo $summ;
    $_SESSION['total_price'] = $summ;
} else {
    //сколько товаров в корзине
    $_SESSION['total_items'] = total_items($_SESSION['cart']);
    // возвращает иготовую сумму корзины
    $summ = getTotalSumm();   // echo $summ;
    $_SESSION['total_price'] = $summ;
}
/*
//реализация htaccess могло быть и так:
//echo
$patch = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$patchParts = explode('/', $patch);
//var_dump($patchParts);
$ctrl = !empty($patchParts[1]) ? ucfirst($patchParts[1]) : 'Product';   //если не пустой первый компонент, тогда берём его в качестве контроллера, иначе берём слово  News  45 мин урок 7
$act = !empty($patchParts[2]) ? ucfirst($patchParts[2]) : 'All';
//echo
$controllerClassName = $ctrl . 'Controller';

$controller = new $controllerClassName;   //Создаём контроллер - News ->  ctrl=News  //1 час 22
//echo
$method = 'action' . $act;  // Вызываем нужное действие экшен- One -> act=One  и некое ай-ди  id=7//1 час 22
$controller->$method();

*/