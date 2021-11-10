<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador Web - Producto</title>
    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
            window.addEventListener("keydown", function (e) {
                if (e.keyCode == 13) {
                    window.location = "http://localhost:80/verificadorweb/cargar.php?codigo=" + codigo;
                    codigo = "";
                }
				else if (e.keyCode == 8) {
					if (codigo.length > 0) {
						codigo = codigo.substring(0, codigo.length - 1);
					}
				}
				else if (codigo.length < 5) {
					codigo += String.fromCharCode(e.keyCode);
				}
            }, true);
}
	</script>
	<div style="position:absolute; top: 20px; right: 20px;">
	<img src="img/logo.png">
	</div>
</head>
<body>
<body style="background-color:rgb(213,232,212);">
  <p>
    <?php
        include ("./inc/settings.php");
		
        $waitTime = 8000;		
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$codigo = $_GET["codigo"];
			if (!ctype_digit($codigo)) {
				$codigo = "-1";
            }
			
            $stmt = $conn->prepare("SELECT * FROM productos WHERE producto_codigo = ".$codigo);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
			  echo "<div style='display:flex; position:absolute; left:50%; top:50%; -webkit-transform: translate(-50%, -50%);transform: translate(-50%, -50%);'>
			  <div style='background: rgba(249, 247, 237, 1); border: 2px solid #000;';><img src='{$result['producto_imagen']}' width='250px' height=auto style='margin-left: 20px; margin-right: 20px; margin-top: 20px; margin-bottom: 20px;';></div>
			  <div style='display:flex; align-items:center; text-align: left; padding-left:100px'>
			  <p style='font-size: 28px;'><b>Código: </b>{$result['producto_codigo']}<br>
              <b>Nombre: </b>{$result['producto_nombre']}<br>
			  <b>Stock: </b>{$result['producto_cantidad']}<br>
			  <b>Precio regular: </b>&dollar;{$result['producto_precio']}<br>
			  <b>Descuento: </b>0%<br>
			  <b>Precio final: </b>&dollar;{$result['producto_precio']}
			  </p></div>"; 
			  /*echo "<img src='".$result["producto_imagen"]."' width='250px' height='250px'><br>";
			  echo "Código: ".$result["producto_codigo"]."<br>";
              echo "Nombre: ".$result["producto_nombre"]."<br>";
              echo "Stock: ".$result["producto_cantidad"]."<br>";
			  echo "Precio regular: $".$result["producto_precio"]."<br>";
			  echo "Descuento: 0%<br>";
			  echo "Precio final: $".$result["producto_precio"]."<br>";*/
			  $waitTime = 12000;
            }
            else{
              echo "<div style='text-align: center;'><br><br><br><img src='img/warning.png' alt='' width='20%' height='20%'><br></div>";
			  echo "<p style='font-size: 36px; text-align: center;'><b>No se encuentró el producto</b><br></p>
			  <p style='font-size: 28px; text-align: center;'>Por favor pase a servicio al cliente para obtener ayuda.</p>";
			  $waitTime = 8000;
            }
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    ?>
  </p>
  <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, "<?php echo $codigo = $waitTime; ?>");
   </script>
</body>
</html>