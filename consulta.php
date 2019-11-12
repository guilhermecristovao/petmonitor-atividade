<?php
include("mapa.php")
?>
<?php

$tipo = $_POST['Tipo'];
$data_inicial = $_POST['DATA_INICIAL'];
$data_final = $_POST['DATA_FINAL'];
$strcon = mysqli_connect('localhost', 'root', '', 'petmonitor') or die('Erro ao conectar ao banco de dados');
$sql = "INSERT INTO dados VALUES ";
$sql .= "('','$tipo', '$data_inicial', '$data_final')";
mysqli_query($strcon, $sql) or die("Erro ao tentar cadastrar registro");
mysqli_close($strcon);
echo "";

?>

<center>

     <h1>Sistema de Monitoramento PETMonitor</h1>

     <table border="2" cellpadding="10" cellspacing="3">
          <tr bgcolor="#f5f5f5">

               <td>Data </td>
               <td>Hora</td>
               <td>Endereço</td>
               <td>Latitude</td>
               <td>Longitude</td>

          </tr>

          <?php
          $sqlSelectdados = mysqli_query($con, "SELECT  localização.address,localização.lat,localização.lng from localização  ") or die("Erro ao retornar dados");
          while ($row = mysqli_fetch_assoc($sqlSelectdados)) { ?>

               <tr>
                    <td><?php date_default_timezone_set('America/Sao_Paulo');
                              $date = date('d:m:Y');
                              echo $date; ?></td>
                    <td><?php date_default_timezone_set('America/Sao_Paulo');
                              $date = date('H:i:s');
                              echo $date; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['lat']; ?></td>
                    <td><?php echo $row['lng']; ?></td>
               </tr>

          <?php } ?>
     </table>

</center>

<br>
<br>

</body>

</html>