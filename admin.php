<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administração</title>
<link href="admin.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="top">
    	<h1>Administração</h1>
	</div>
    <div class="menu">
    	<a href="cadastro_noticia.php">Cadastrar Noticias</a>
        <a href="cad_funcionario.php">Cadastrar Funcionário</a>
        <a href="func_altera_exclui.php">Funcionários</a>
       	<a href="altera_exclui_noticia.php">Noticias</a>
      	<a href="<?php echo $logoutAction ?>">Sair</a>
    </div>
    <div class="rodape">
        <p>Economia LTDA</p>
    </div> 
</body>
</html>