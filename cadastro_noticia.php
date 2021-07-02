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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO noticias (`data`, titulo, resumo, texto, destaque) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['titulo'], "text"),
                       GetSQLValueString($_POST['resumo'], "text"),
                       GetSQLValueString($_POST['texto'], "text"),
                       GetSQLValueString($_POST['destaque'], "text"));

  mysql_select_db($database_conecta_teste, $conecta_teste);
  $Result1 = mysql_query($insertSQL, $conecta_teste) or die(mysql_error());

  $insertGoTo = "altera_exclui_noticia.php";
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
<title>Noticias</title>
<link href="cad_noticia.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="top">
    	<h1>Administração</h1>
	</div>
    <div class="cadastro">
    	
    	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form">
         <p>Titulo:<input name="titulo" type="text"></p>
         <p>Data:
            <input type="text" name="data" id="data">
         </p>
         <p>Destaque:
           <input type="text" name="destaque" id="destaque">
<label for="destaque"></label>
         </p>
         <p>Resumo:
           <br><textarea type="text" name="resumo" class="msg" cols="35" rows="8"></textarea><br>
         </p>
		  </p>
          <p>Texto:
           <br><textarea type="text" name="texto" class="msg" cols="35" rows="8"></textarea><br>
         </p>
           <input type="submit" name="inserir" id="inserir" value="Cadastrar">
           <input type="hidden" name="MM_insert" value="form">
         </p>
      </form>
    </div>  
    <div class="rodape">
        <p>Economia LTDA<p>
</body>
</html>