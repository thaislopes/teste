<?php require_once('Connections/conecta_teste.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "cadastro")) {
  $updateSQL = sprintf("UPDATE cad_funcionario SET nome=%s, sobrenome=%s, senha=%s, email=%s, cpf=%s WHERE id_funcionario=%s",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['cpf'], "int"),
                       GetSQLValueString($_POST['id_funcionario'], "int"));

  mysql_select_db($database_conecta_teste, $conecta_teste);
  $Result1 = mysql_query($updateSQL, $conecta_teste) or die(mysql_error());

  $updateGoTo = "func_altera_exclui.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_seleciona_dado = "-1";
if (isset($_GET['id_funcionario'])) {
  $colname_seleciona_dado = $_GET['id_funcionario'];
}
mysql_select_db($database_conecta_teste, $conecta_teste);
$query_seleciona_dado = sprintf("SELECT * FROM cad_funcionario WHERE id_funcionario = %s", GetSQLValueString($colname_seleciona_dado, "int"));
$seleciona_dado = mysql_query($query_seleciona_dado, $conecta_teste) or die(mysql_error());
$row_seleciona_dado = mysql_fetch_assoc($seleciona_dado);
$totalRows_seleciona_dado = mysql_num_rows($seleciona_dado);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Alterat Funcionários</title>
<link href="func_altera.css" type="text/css" rel="stylesheet">
<script src="cad_usuario.js" type="text/javascript"></script>
</head>

<body>
<div class="top">
    	<h1>Administração</h1>
	</div>
<div class="cad_func">
   	  <form action="<?php echo $editFormAction; ?>" method="POST" name="cadastro">
        	<p>Nome:<input name="nome" type="text" id="nome" value="<?php echo $row_seleciona_dado['nome']; ?>"></p>
            <p>Sobrenome:<input name="sobrenome" type="text" id="sobrenome" value="<?php echo $row_seleciona_dado['sobrenome']; ?>"></p>
            <p>Data de Nascimento:<input name="data" type="text" id="data" value="<?php echo $row_seleciona_dado['data']; ?>"></p>
            <p>Email:<input name="email" type="text" id="email" onBlur="checarEmail();" value="<?php echo $row_seleciona_dado['email']; ?>"></p>
            <p>CPF:<input name="cpf" type="text" id="cpf"  value="<?php echo $row_seleciona_dado['cpf']; ?>"></p>
            <p>Senha:<input name="senha" type="text" id="senha" value="<?php echo $row_seleciona_dado['senha']; ?>"></p>
            <p>
              <input name="id_funcionario" type="hidden" id="id_funcionario" value="<?php echo $row_seleciona_dado['id_funcionario']; ?>">
            </p>
            <p>
              <input type="submit" name="cadastrar" id="cadastrar" value="Alterar">
            </p>
<input type="hidden" name="MM_insert" value="cadastro">
<input type="hidden" name="MM_update" value="cadastro">
        </form>
    </div>
<div class="rodape">
      	 <p>Economia LTDA<p>
    </div>
</body>
</html>
<?php
mysql_free_result($seleciona_dado);
?>
