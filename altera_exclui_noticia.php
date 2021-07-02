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
$query_seleciona_registro = "SELECT * FROM noticias";
$seleciona_registro = mysql_query($query_seleciona_registro, $conecta_teste) or die(mysql_error());
$row_seleciona_registro = mysql_fetch_assoc($seleciona_registro);
$totalRows_seleciona_registro = mysql_num_rows($seleciona_registro);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Noticias</title>
<link href="alt_excl_noticia.css" type="text/css" rel="stylesheet">
</head>

<body>
<div class="top">
    	<h1>Administração</h1>
        <a href="admin.php">Voltar para o menu</a>
	</div>
    <div class="noti">
   	  <h1>Noticias</h1>
        <?php do { ?>
        <table width="466" height="85" border="1">
            <tr>
              <th width="80">id_noticia</th>
              <td width="162">titulo</td>
              <td width="102">data</td>
              <td width="49">alterar</td>
              <td width="39">excluir</td>
            </tr>
            <tr>
              
              <td><?php echo $row_seleciona_registro['id_noticias']; ?></td>
              <td><?php echo $row_seleciona_registro['titulo']; ?></td>
              <td><?php echo $row_seleciona_registro['data']; ?></td>
              <td><a href="noticia_altera.php?id_noticias=<?php echo $row_seleciona_registro['id_noticias']; ?>">SIM</a></td>
              <td><a href="noticia_exclui.php?id_noticias=<?php echo $row_seleciona_registro['id_noticias']; ?>">SIM</a></td>
            </tr>
          </table>
          <?php } while ($row_seleciona_registro = mysql_fetch_assoc($seleciona_registro)); ?>

    </div>
	<div class="rodape">
        <p>Economia LTDA</p>
    </div>
</body>
</html>
<?php
mysql_free_result($seleciona_registro);
?>
