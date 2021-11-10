<?php
function pintarDetalles($codigo)
{
    $producto = obtenProducto($codigo);
    $nombre = $producto->getNombre();
    $precio = $producto->getPrecio();

    echo "<div id=\"detalles\">";
    echo "<form action=\"\" method=\"post\">";
    echo "Código: <input type=\"text\" name=\"codigo\" value=\"$codigo\"><br><br>";
    echo "Nombre: <input type=\"text\" name=\"nombre\" value=\"$nombre\"><br><br>";
    echo "Precio: <input type=\"text\" name=\"precio\" value=\"$precio\"><br><br>";
    echo "<input type=\"submit\" name=\"guardar\" value=\"GUARDAR\">";
    echo "<input type=\"submit\" name=\"eliminar\" value=\"BORRAR\">";
    echo "</form>";
    echo "</div>";
    
}

function pintarProductos()
{
    global $listaProductos;
    $productos = $listaProductos;
    
    echo "<div id=\"lista\">";
    echo "<form action=\"\" method=\"post\">";
    foreach($productos as &$valor)
    {
        $codigo = $valor->getCodigo();
        $codigoCesta = $valor->getCodigo()."C";
        echo $valor->getCodigo()." --- ".$valor->getNombre()." --- ".$valor->getPrecio()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"$codigo\" value=\"EDITAR\">"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"$codigoCesta\" value=\"AÑADIR\">"."<br><br>";
    }
    echo "</form>";
    echo "</div>";
    
}

function saberBoton()
{
    global $listaProductos;
    $productos = $listaProductos;
    foreach($productos as &$valor)
    {
        if(isset($_POST[$valor->getCodigo()]))
        {
            pintarDetalles($valor->getCodigo());
        }

        if(isset($_POST[$valor->getCodigo()."C"]))
        {
            array_push($_SESSION['cesta'],$valor->getCodigo());
            pintaCesta();
        }

        if(isset($_POST[$valor->getCodigo()."Q"]))
        {
            quitarCesta($valor->getCodigo());
            if($_SESSION['cesta'])
            pintaCesta();
        }
    }
}

function pintaAñadirProducto()
{
    if(isset($_POST['añadirProducto']))
    {
        echo "<div id=\"detalles\">";
        echo "<form action=\"\" method=\"post\">";
        echo "Código: <input type=\"text\" name=\"codigo\" value=\"\"><br><br>";
        echo "Nombre: <input type=\"text\" name=\"nombre\" value=\"\"><br><br>";
        echo "Precio: <input type=\"text\" name=\"precio\" value=\"\"><br><br>";
        echo "<input type=\"submit\" name=\"añade\" value=\"AÑADIR\">";
        echo "</form>";
        echo "</div>";
    }
}

function añadir()
{
    if(isset($_POST['codigo']) && isset($_POST['nombre']) && isset($_POST['precio']))
    {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        
        //VALIDAR CAMPOS

        $prod = new Producto($codigo,$nombre,$precio);
    }
        

    if(isset($_POST['añade']) || isset($_POST['guardar']))
    {
        añadeProducto($prod);
        header('Location: index.php');
    }
}

function elimina()
{
    $codigo = "";
    if(isset($_POST['codigo']))
    {
        $codigo = $_POST['codigo'];
    }

    if(isset($_POST['eliminar']))
    {
        eliminaProducto($codigo);
        header('Location: index.php'); //recargamos la página
    }
    
}


function pintaCesta()
{
    
    //array_push($_SESSION['cesta'],$codigo);
    

    echo "<div id=\"cesta\">"; //pintamos la caja
    echo "<h2>CESTA:</h2>"; 
    echo "<br><br>";

    $valores = array_unique($_SESSION['cesta']);

    echo "<form action=\"\" method=\"post\">";
    $total=0;
    foreach($valores as &$valor)
    {
        $producto = obtenProducto($valor);
        $codigo = $valor;
        $nombre = $producto->getNombre();
        $precio = $producto->getPrecio();

        $cantidad=array_count_values($_SESSION['cesta'])[$codigo];

        echo "<br><br><strong>Código:</strong> ".$codigo."<br>";
        echo "<strong>Nombre:</strong> ".$nombre;
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cant: ".$cantidad;
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $cod = $codigo."Q";
        echo "<input type=\"submit\" name=\"$cod\" value=\"QUITAR\">"."<br>";
        echo "<strong>Precio:</strong> ".$precio."€";
        $total = $total+($precio*$cantidad);
    }
    echo "<br><br>TOTAL:".$total."€";
    echo "<br><br><input type=\"submit\" name=\"finCompra\" value=\"PAGAR TODO\">"."<br>";
    echo "</form>";

    echo "</div>";
}

function quitarCesta($codigo)
{
    $i = array_search($codigo, $_SESSION['cesta']);
    unset($_SESSION['cesta'][$i]);
}

function finalizar()
{
    if(isset($_POST['finCompra']))
    {
        header('Location: paginas/finCompra.php'); //fin de la compra
    }
}

function botonCesta()
{
    if(isset($_POST['mostrarCesta']))
    {
        pintaCesta();
    }
}