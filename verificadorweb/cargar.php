<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador Web - Lectura</title>
    <style>
        div {
            height: 200px;
            position: relative;
        }

        img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h2 {
            text-align: center;
            font-size: 36px;
        }
		
		
    </style>

    <script type="text/javascript">
		var codigo = "<?php echo $codigo = $_GET["codigo"]; ?>";
		setTimeout(function() {
            window.location.href = "http://localhost:80/verificadorweb/mostrar_producto.php?codigo=" + codigo;
        }, 1000);
    </script>
</head>

<body>
	<body style="background-color:rgb(213,232,212);">
	<div><br></div>
    <div>
        <img src="img/loading.gif" alt="" width="200px" height="200px">
    </div>
    <p style="text-align: center; font-size: 36px;">Buscando...<p>
</body>

</html>