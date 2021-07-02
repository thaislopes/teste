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

$colname_noticia = "-1";
if (isset($_GET['id_noticias'])) {
  $colname_noticia = $_GET['id_noticias'];
}
mysql_select_db($database_conecta_teste, $conecta_teste);
$query_noticia = sprintf("SELECT * FROM noticias WHERE id_noticias = %s", GetSQLValueString($colname_noticia, "int"));
$noticia = mysql_query($query_noticia, $conecta_teste) or die(mysql_error());
$row_noticia = mysql_fetch_assoc($noticia);
$totalRows_noticia = mysql_num_rows($noticia);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Noticias</title>
<link href="style.css" type="text/css" rel="stylesheet">
<link href="noticia.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="topo"><!--vai ser a div que vai alojar a div menu -->
	 	<a href="index.php"> <img src="imagens/logo.png" width="94" height="89"></a>	
        Giro da Economia
        <div class="menu">  
   	 	<a href="contato.php">Contato</a>
   	  	<a href="login.php">Administração</a>
   	  	<a href="https://www.facebook.com/"><img src="imagens/face.png" width="30" height="30"></a>
      	<a href="https://www.instagram.com/"><img src="imagens/insta.png"  width="30" height="30"></a>
        </div>
 	</div>
    <div class="noticias">
	<form name="desta" method="post" action="">
   	   	<h1><?php echo $row_noticia['titulo']; ?></h1>
      	<p><?php echo $row_noticia['data']; ?></p>
      	<p><?php echo $row_noticia['texto']; ?></p>
    </form>      
    </div>
    <div class="rodape">
        <h1>Para mais informações acesse nossas redes sociais</h1>	
   </div>
</body>
</html>
<?php
mysql_free_result($noticia);
?>
