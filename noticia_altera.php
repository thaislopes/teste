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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE noticias SET `data`=%s, titulo=%s, resumo=%s, texto=%s, destaque=%s WHERE id_noticias=%s",
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['resumo'], "text"),
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['destaque'], "text"),
                       GetSQLValueString($_POST['id_noticias'], "int"));

  mysql_select_db($database_conecta_teste, $conecta_teste);
  $Result1 = mysql_query($updateSQL, $conecta_teste) or die(mysql_error());

  $updateGoTo = "altera_exclui_noticia.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_seleciona_registro = "-1";
if (isset($_GET['id_noticias'])) {
  $colname_seleciona_registro = $_GET['id_noticias'];
}
mysql_select_db($database_conecta_teste, $conecta_teste);
$query_seleciona_registro = sprintf("SELECT * FROM noticias WHERE id_noticias = %s", GetSQLValueString($colname_seleciona_registro, "int"));
$seleciona_registro = mysql_query($query_seleciona_registro, $conecta_teste) or die(mysql_error());
$row_seleciona_registro = mysql_fetch_assoc($seleciona_registro);
$totalRows_seleciona_registro = mysql_num_rows($seleciona_registro);

$colname_seleciona_registro = "-1";
if (isset($_GET['id_noticias'])) {
  $colname_seleciona_registro = $_GET['id_noticias'];
}
mysql_select_db($database_conecta_teste, $conecta_teste);
$query_seleciona_registro = sprintf("SELECT * FROM noticias WHERE id_noticias = %s", GetSQLValueString($colname_seleciona_registro, "int"));
$seleciona_registro = mysql_query($query_seleciona_registro, $conecta_teste) or die(mysql_error());
$row_seleciona_registro = mysql_fetch_assoc($seleciona_registro);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Noticias</title>
<link href="cad_noticia.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="top">
    	<h1>Administração</h1>
	</div>
    <div class="cadastro">
    	
   	  <form action="<?php echo $editFormAction; ?>" method="POST" name="form">
        <p>Titulo:<input value="<?php echo $row_seleciona_registro['titulo']; ?>" name="titulo" type="text">
         </p>
         <p>Data:
            <input name="data" type="text" id="data" value="<?php echo $row_seleciona_registro['data']; ?>">
         </p>
         <p>Destaque:
           <input name="destaque" type="text" id="destaque" value="<?php echo $row_seleciona_registro['destaque']; ?>">
<label for="destaque"></label>
         </p>
         <p>IResumo:
           <br>
           <textarea type="text" name="resumo" class="msg" cols="35" rows="8"><?php echo $row_seleciona_registro['resumo']; ?></textarea>
           <br>
         </p>
		  </p>
          <p>Texto:
           <br><textarea type="text" name="texto" class="msg" cols="35" rows="8"><?php echo $row_seleciona_registro['texto']; ?></textarea>
           <input name="id_noticias" type="hidden" id="id_noticias" value="<?php echo $row_seleciona_registro['id_noticias']; ?>">
           <br>
         </p>
           <input type="submit" name="inserir" id="inserir" value="Alterar">
           <input type="hidden" name="MM_update" value="form">
        </p>
    	</form>
    </div>  
    <div class="rodape">
        <p>Economia LTDA<p>
</body>
</html>
<?php
mysql_free_result($seleciona_registro);
?>
