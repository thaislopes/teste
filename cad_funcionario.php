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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "cadastro")) {
  $insertSQL = sprintf("INSERT INTO cad_funcionario (nome, sobrenome, `data`, cpf, email, senha) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['sobrenome'], "text"),
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['senha'], "text"));

  mysql_select_db($database_conecta_teste, $conecta_teste);
  $Result1 = mysql_query($insertSQL, $conecta_teste) or die(mysql_error());

  $insertGoTo = "func_altera_exclui.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastro Funcionário</title>

<link href="cad_funcionario.css" type="text/css" rel="stylesheet">
<script src="cad_usuario.js" type="text/javascript"></script>
</head>

<body>
<div class="top">
    	<h1>Administração</h1>
	</div>
    <div class="cad_func">
   	  <form action="<?php echo $editFormAction; ?>" method="POST" name="cadastro" id="cadastro">
        	<p>Nome:<input type="text" name="nome" id="nome"></p>
            <p>Sobrenome:<input type="text" name="sobrenome" id="sobrenome"></p>
            <p>Data de Nascimento:<input type="text" name="data" id="data"></p>
            <p>Email:<input type="text" name="email" id="email" onBlur="checarEmail();"></p>
            <p>CPF:<input type="text" name="cpf" id="cpf"></p>
            <p>Senha:<input type="password" name="senha" id="senha"></p>
            <p><input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar"></p>
            <input type="hidden" name="MM_insert" value="cadastro">
            
      </form>
    </div>
 	<div class="rodape">
      	 <p>Economia LTDA<p>
    </div>
</body>
</html>