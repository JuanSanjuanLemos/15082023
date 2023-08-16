<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST["modelo"];
    $lancamento = $_POST["lancamento"];

    if (!empty($modelo)) {
        $dados = "Modelo: $modelo\nAno de Lançamento: $lancamento\n\n";
        $arquivo = fopen("./dados.txt", "a");
        fwrite($arquivo, $dados);
        fclose($arquivo);
        $_SESSION["mensagem"] = "Modelo Adicionado com sucesso!";
    } else {
        $_SESSION["mensagem"] = "Favor informe um modelo!";
    }

    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
}
?>

<h1>Cadastro de modelo de carros</h1>
<form method="post">
  <label for="modelo">Modelo:</label>
  <input type="text" name="modelo">
  <br>
  <br>
  <label for="lancamento">Ano de Lançamento:</label>
  <select name="lancamento" id="lancamento"> 
    <?php
    for ($i = date("Y"); $i > date("Y") - 80; $i--) { 
      echo "<option value=$i>$i</option>";
    };
    ?>
  </select>
  <br>
  <br>
  <button type="submit">Adicionar</button>
</form>
<div id="mensagem">
  <?php
  if(isset($_SESSION["mensagem"])) {
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
    echo "
    <script>
      setTimeout(
        function(){ 
          document.getElementById('mensagem').innerText = '';
        }
      , 3000); 
    </script>";
  }
  ?>
</div>
