<?php

/*//定义两个全局变量 路径
define('APP_PATH','../app/');
define('VIEW_PATH','../views/');

//新建一个控制器对象
$stuCon=new StudentController();
$stuCon->getList();*/

define('APP_PATH', '../app/');
define('VIEW_PATH', '../views/');
require_once '../app/StudentController.php';

if (isset($_SERVER['PATH_INFO'])) {
    $pathinfo = $_SERVER['PATH_INFO'];
} elseif (isset($_SERVER['REDIRECT_PATH_INFO'])) {
    $pathinfo = $_SERVER['REDIRECT_PATH_INFO'];
} else {
    $pathinfo = '';
}

$route = [
    'student' => 'student/getList',
];
$pathinfo = trim($pathinfo, '/');
if ($route[$pathinfo]) {
    $pathinfo = $route[$pathinfo];
}

$arr = explode('/', $pathinfo);
if (!isset($arr[1])) {
    die('请求信息不完整');
}
list($controller, $action) = $arr;

$controller = ucwords($controller) . 'Controller';
$controller = "\\app\\".$controller;
$stuCon = new $controller();
$stuCon->$action();


