<?php
  session_start();
  if(isset($_SESSION['admin'])){
    header('location:home.php');
  }
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition login-page">
<div class="login-box">
	<style>
		.login-page, .register-page {
    	background-image: url('../images/fondo1.jpeg');
		}
		
      	.login-box-body, .register-box-body {
          background: #f44336;
          padding: 20px;
          border-top: 0;
          color: #fff;
      	} 
      	a {
      		color: #fff709;
      	}     
		body {
			color:#000
		}
    </style>
  	<div class="login-logo", style ="background-color:#ffffff">
  		<b>Ingreso Administrador</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Ingresa para iniciar tu sesión</p>

    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="Ingresar Usuario" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Ingresar Contraseña" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="lockscreen-footer text-center">
            <a href="http://localhost/controlasistenciaynomina-master/">Registrar Asistencia</a>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Ingresar</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>