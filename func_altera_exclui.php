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

mysql_select_db($database_conecta_teste, $conecta_teste);
$query_seleciona_registro = "SELECT * FROM cad_funcionario";
$seleciona_registro = mysql_query($query_seleciona_registro, $conecta_teste) or die(mysql_error());
$row_seleciona_registro = mysql_fetch_assoc($seleciona_registro);
$totalRows_seleciona_registro = mysql_num_rows($seleciona_registro);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Funcionários</title>
<link href="fun_altera_exclui.css" type="text/css" rel="stylesheet">
</head>

<body>
<div class="top">
    	<h1>Administração</h1>
        <a href="admin.php">Voltar para o menu</a>
	</div>
<div class="func">
  <h1>Funcionários</h1>
  <table width="1094" height="72" border="1">
    <tr>
      <th width="97">id_funcionário</th>
      <td width="173">Nome</td>
      <td width="182">Sobrenome</td>
      <td width="131">Data de Nascimento</td>
      <td width="125">CPF</td>
      <td width="141">Email</td>
      <td width="72">Senha</td>
      <td width="53">Alterar</td>
      <td width="62">Excluir</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_seleciona_registro['id_funcionario']; ?></td>
        <td><?php echo $row_seleciona_registro['nome']; ?></td>
        <td><?php echo $row_seleciona_registro['sobrenome']; ?></td>
        <td><?php echo $row_seleciona_registro['data']; ?></td>
        <td><?php echo $row_seleciona_registro['cpf']; ?></td>
        <td><?php echo $row_seleciona_registro['email']; ?></td>
        <td><?php echo $row_seleciona_registro['senha']; ?></td>
        <td><a href="func_altera.php?id_funcionario=<?php echo $row_seleciona_registro['id_funcionario']; ?>">SIM</a></td>
        <td><a href="func_exclui.php?id_funcionario=<?php echo $row_seleciona_registro['id_funcionario']; ?>">SIM</a></td>
      </tr>
      <?php } while ($row_seleciona_registro = mysql_fetch_assoc($seleciona_registro)); ?>
  </table>
</div>
<div class="rodape">
        <p>Economia LTDA</p>
    </div>
</body>
</html>
<?php
mysql_free_result($seleciona_registro);
?>
