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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['login'])) {
  $loginUsername=$_POST['login'];
  $password=$_POST['senha'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admin.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conecta_teste, $conecta_teste);
  
  $LoginRS__query=sprintf("SELECT cpf, senha FROM cad_funcionario WHERE cpf=%s AND senha=%s",
    GetSQLValueString($loginUsername, "int"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conecta_teste) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="style.css" type="text/css" rel="stylesheet">
<link href="login.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="topo"><!--vai ser a div que vai alojar a div menu -->
	 	<a href="index.php"> <img src="imagens/logo.png" width="94" height="89"></a>	  
   	 	<a href="noticias.php">Noticias </a>
      	<a href="contato.php">Contato</a>
   	  	<a href="login.php">Administração</a>
   	  	<a href="https://www.facebook.com/"><img src="imagens/face.png" width="30" height="30"></a>
      	<a href="https://www.instagram.com/"><img src="imagens/insta.png"  width="30" height="30"></a>
     </div>
     <div class="login">
     	<form action="<?php echo $loginFormAction; ?>" method="POST">
        	<h1>Login</h1>
        	<p>CPF: 
        	  <input type="text" name="login" id="login"></p> 
            <p>Senha: <input type="password" name="senha" id="senha"></p>
            <div class="btn">
   	      <input type="submit" name="entrar" id="entrar" value="Entrar">
          </div>
     	</form>	
     </div>
     <div class="rodape">
        <h1>Para mais informações acesse nossas redes sociais</h1>
     
</body>
</html>