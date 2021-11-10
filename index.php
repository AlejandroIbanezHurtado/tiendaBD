<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIENDA</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <?php include "clases/producto.php"; ?>
    <?php include "bd/bd.php"; ?>
    <?php include "lib/libVentanaLista.php"; ?>
    <?php 
        echo "<style type=\"text/css\">
        body{
            font-family: sans-serif;
        }
        #cesta { 
            background-color: lightgrey;
            width: 30%;
            float: right;
            margin-top: -12%;
            margin-right: 35%;
            border: solid black 3px;
            border-radius: 20px;
            padding: 10px;
        }

        .botonCesta{
            width: 50px;
            height: 50px;
            background-image: url(\"imagenes/cesta.png\");
            float: right;
            margin-right: 10%;
        }

        div h2{
            text-align: center;
        }

        h1{
            font-size: 200%;
            background-color: lightgrey;
        }
      </style>";
    ?>
</head>
<body>
    <h1 align="center">PRODUCTOS</h1>

    <form action="" method="post">
        <input type="submit" name="añadirProducto" value="AÑADIR PRODUCTO">
        <input type="submit" name="mostrarCesta" value="" class="botonCesta">
    </form>

    <br><br><br>
    <?php
        pintarProductos(); //pintamos la lista de productos
        saberBoton(); //vemos si se ha pulsado en algun producto
        elimina(); //vemos si se ha pulsado en el boton eliminar
        añadir(); //vemos si se ha pulsado en el boton añadir
        pintaAñadirProducto(); //vemos si se ha pulsado en el boton para mostrar formulario de añadir producto
        finalizar();//vemos si se ha pulsado el boton de finalizar
        botonCesta();//vemos si se ha pulsado el boton de la cesta
    ?>
    
</body>
</html>