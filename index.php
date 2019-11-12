<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset UTF-8 />

<head>
  <title>Sistema de monitoramento | PETMonitor</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <h1>PETMonitor</h1>
  <h2>Página Inicial</h2>

  <div class="Config">
    <div class="Estilo">
      <form name="conexao" action="consulta.php" method="POST">

        <h3>Selecione o Pet que deseja rastrear</h3>

        <select name="Tipo">
          <option value="Cachorro">Cão</option>
          <option value="Gato">Gato</option>
        </select>

        <h3>Selecione a data para consulta</h3>
        <p>
          <labbel>Data inicial</labbel>
          <input type="date" name="DATA_INICIAL">
          <br>
          <br>

          <label>Data final</label>
          <input type="date" name="DATA_FINAL">
          <br>
          <br>
          <br>
          <input type="submit" name="verificar" value="Rastrear" />
      </form>
    </div>
  </div>

  <div class="Footer">
    <p>
      Desenvolvido por Guilherme Cristóvão 2019
    </p>
  </div>

</body>

</html>