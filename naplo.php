<?php
session_start();
require "class/dbconnect.php";
require "class/login.php";
require "class/select.php";

$db=new Dbconnect();
$log=new login();
$sel=new Select();

$db->Connection("kisokos");
$load=false;
if(isset($_POST["alogin"]))
{
	$load=true;
	$logged=false;
	$user=$_POST["aname"];
	$pwd=sha1($_POST["apwd"]);
	if($log->Acheck($user,$pwd))
	{
		$logged=true;
		$_SESSION["user"]=$user;
		header("location: admin.php");
	}
}

$load2=false;
if(isset($_POST["tlogin"]))
{
	$load2=true;
	$logged=false;
	$user=$_POST["tname"];
	$pwd=sha1($_POST["tpwd"]);
	if($log->Tcheck($user,$pwd))
	{
		$logged=true;
		$_SESSION["user"]=$user;
		header("location: tech.php");
	}
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="utf-8">
<title>Kisokos</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body class="bg-info">
<div class="container-fluid">
	<div class="row text-center">
		<div class="m-auto bg-dark rounded p-5">
			<div class="form-group">
			<span class="font-weight-bold text-danger">
					<?php 
						if($load && !$logged) echo "Hibás bejelentkezés!";
						if($load2 && !$logged) echo "Hibás bejelentkezés!";	
					?>
				</span>
			<h2 class="text-warning">Kisokos</h2>
			<input type="button" name="technikus" value="Technikus" class="btn btn-success" data-toggle="modal" data-target="#login" />
			<input type="button" name="admin" value="Admin" class="btn btn-warning" data-toggle="modal" data-target="#admin"/>
			</div>
</div>
	</div>
</div>

<!-- technikusi login -->
<div class="modal" id="login">
  <div class="modal-dialog">
  <form method="post" action="">
    <div class="modal-content m-auto bg-dark rounded p-5">

      
      <div class="modal-header">
        <h4 class="modal-title text-warning">Technikus bejelentkezés</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <div class="form-group">
	  <p class="text-left text-warning">Technikus neve:</p>
	  <div class="form-group">
				<input type="text" name="tname" placeholder="Név..." />
			</div>
			</div>
			<div class="form-group">
			<p class="text-left text-warning">Jelszó:</p>
				<input type="password" name="tpwd" placeholder="Jelszó..." />
			</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="submit" name="tlogin" value="Belépés" class="btn btn-success" />
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

	</div>
</form>
  </div>
</div>

<!-- admin login -->
<div class="modal" id="admin">
  <div class="modal-dialog">
  <form method="post" action="">
    <div class="modal-content m-auto bg-dark rounded p-5">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-warning">Admin bejelentkezés</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <div class="modal-body">
	  <div class="form-group">
	  <p class="text-left text-warning">Felhasználónév:</p>
				<input type="text" name="aname" placeholder="Név..." />
			</div>
			<div class="form-group">
			<p class="text-left text-warning">Jelszó:</p>
				<input type="password" name="apwd" placeholder="Jelszó..." />
			</div>
      </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="submit" name="alogin" value="Belépés" class="btn btn-success" />
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
    </form>
  </div>
</div>
</body>