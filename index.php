<?php
  require_once 'Model/database.php';
  require_once 'fpdf/fpdf.php';

  $controller = 'home';

  if(!isset($_REQUEST['c']))
  {
    require_once "Controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
  }
  else
  {
    $controller = strtolower($_REQUEST['c']);
    $acao = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

    require_once "Controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;

    call_user_func( array( $controller, $acao ) );
  }
