<?php
session_start();
require_once("clases/producto.php");

$producto1 = new Producto ("0001","Lámpara",20);
$producto2 = new Producto ("0002","Fregona",2);
$producto3 = new Producto ("0003","Mueble",158);
$producto4 = new Producto ("0004","Bombilla",1);
$producto5 = new Producto ("0005","Cortina",12);

if(!isset($_SESSION['cesta']))
{
    $_SESSION['cesta'] = array();
}

if(isset($_SESSION['sesion']))
{
    $listaProductos = $_SESSION['sesion'];
}
else{
    $listaProductos = array(
        $producto1->getCodigo() => $producto1,
        $producto2->getCodigo() => $producto2,
        $producto3->getCodigo() => $producto3,
        $producto4->getCodigo() => $producto4,
        $producto5->getCodigo() => $producto5,
    );
}


function nuevoProducto(Producto $produc)
{
    global $listaProductos;
    $listaProductos[$produc->codigo] = $procud;
}

function obtenProducto($codigo)
{
    global $listaProductos;
    return $listaProductos[$codigo];
}


function eliminaProducto($codigo)
{
    global $listaProductos;
    if(isset($_SESSION['sesion']))
    {
        unset($_SESSION['sesion'][$codigo]);
    }
    else
    {
        unset($listaProductos[$codigo]);
        $_SESSION['sesion']=$listaProductos;
    }
}

function añadeProducto(Producto $prod)
{
    global $listaProductos;
    if(isset($_SESSION['sesion']))
    {
        $_SESSION['sesion'][$prod->getCodigo()] = $prod;
    }
    else
    {
        $listaProductos[$prod->getCodigo()] = $prod;
        $_SESSION['sesion']=$listaProductos;
    }
}