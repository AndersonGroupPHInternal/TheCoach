<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php include("../Layout/CssReference.php"); ?> 
    <?php include("../Layout/JsReference.php"); ?> 
    <?php include("../Layout/AngularJsReference.php"); ?> 
</head>

<body>
<div class="container">
	<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 loginbox"> 
		<div class="panel panel-info" > 
			<div class="panel-heading"> 
				<div class="panel-title"> Sign In </div>
			</div> 
			<div class="panel-body panel-pad"> 
				<div id="login-alert" class="alert alert-danger col-sm-12 login-alert"></div> 
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
						<div class="input-group margT25"> 
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</span> 
							<input type="text" class="form-control" name="username" placeholder="Username" required> 
						</div> 
						<div class="input-group margT25"> 
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> 
							<input type="password" class="form-control" name="password" placeholder="Password" required> 
						</div>
						<div class="form-group margT10"> 
						<!-- Button --> 
							<div class="col-sm-12 controls"> 
								<input type="submit" name="btn-login" value="Login" class="btn btn-block btn-success">
							</div> 
						</div>
					</form> 
				</div> 
			</div> 
		</div> 
	</div>

		<?php
	        
			require_once ('../config/config.php');

			if(isset($_POST['btn-login'])){
				$userName = trim($_POST['username']);
				$passWord = trim($_POST['password']);
				// $options = array('cost'=>8);
				// $hashPassword = password_hash($passWord,PASSWORD_BCRYPT,$options);
				$sql = "SELECT * FROM credentials WHERE username = '".$userName."' ";
				$rs = $pdo->prepare($sql);
				$rs->execute();
				$verify = $rs->fetch();

				if ($verify){
					// $row = $rs->fetchColumn();
					if(password_verify($passWord, $verify['Password'])){ // "Password" is db table name
						session_start();
					    $_SESSION['loggedin'] = true;
					    $_SESSION['username'] = $userName;
						header ('Location: ../public/dashboard.php');
					}else{
						echo "<center>Wrong password</center>";
					}
				}else{
					echo '<center>No credentials found.</center>';
				}

				unset($sql);
				unset($pdo);
			}

		?>
</body>
</html>