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

$maxRows_destaque = 3;
$pageNum_destaque = 0;
if (isset($_GET['pageNum_destaque'])) {
  $pageNum_destaque = $_GET['pageNum_destaque'];
}
$startRow_destaque = $pageNum_destaque * $maxRows_destaque;

mysql_select_db($database_conecta_teste, $conecta_teste);
$query_destaque = "SELECT * FROM noticias WHERE destaque = 'sim' ORDER BY `data` ASC";
$query_limit_destaque = sprintf("%s LIMIT %d, %d", $query_destaque, $startRow_destaque, $maxRows_destaque);
$destaque = mysql_query($query_limit_destaque, $conecta_teste) or die(mysql_error());
$row_destaque = mysql_fetch_assoc($destaque);

if (isset($_GET['totalRows_destaque'])) {
  $totalRows_destaque = $_GET['totalRows_destaque'];
} else {
  $all_destaque = mysql_query($query_destaque);
  $totalRows_destaque = mysql_num_rows($all_destaque);
}
$totalPages_destaque = ceil($totalRows_destaque/$maxRows_destaque)-1;$maxRows_destaque = 3;
$pageNum_destaque = 0;
if (isset($_GET['pageNum_destaque'])) {
  $pageNum_destaque = $_GET['pageNum_destaque'];
}
$startRow_destaque = $pageNum_destaque * $maxRows_destaque;

mysql_select_db($database_conecta_teste, $conecta_teste);
$query_destaque = "SELECT * FROM noticias WHERE destaque = 'sim' ORDER BY `data` DESC";
$query_limit_destaque = sprintf("%s LIMIT %d, %d", $query_destaque, $startRow_destaque, $maxRows_destaque);
$destaque = mysql_query($query_limit_destaque, $conecta_teste) or die(mysql_error());
$row_destaque = mysql_fetch_assoc($destaque);

if (isset($_GET['totalRows_destaque'])) {
  $totalRows_destaque = $_GET['totalRows_destaque'];
} else {
  $all_destaque = mysql_query($query_destaque);
  $totalRows_destaque = mysql_num_rows($all_destaque);
}
$totalPages_destaque = ceil($totalRows_destaque/$maxRows_destaque)-1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Economia</title>
<link href="style.css" type="text/css" rel="stylesheet">
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
      <?php do { ?>
        <div class="destaque"><!--Aqui vai estar todas as noticias que estiverem cadastradas como destaque-->
          <h1><a href="noticias.php?id_noticias=<?php echo $row_destaque['id_noticias']; ?>"><?php echo $row_destaque['titulo']; ?></a></h1>
          <p><?php echo $row_destaque['data']; ?> </p>
          <p>&nbsp;<?php echo $row_destaque['resumo']; ?></p>
        </div>
        <?php } while ($row_destaque = mysql_fetch_assoc($destaque)); ?>
	<div class="rodape">
        <h1>Para mais informações acesse nossas redes sociais</h1>
	</div>
</body>
</html>
<?php
mysql_free_result($destaque);
?>
