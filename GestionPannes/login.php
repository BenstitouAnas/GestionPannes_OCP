<?php
	session_start();
	
	include('config.php');
	
	if(isset($_POST['connecter'])){
		//username and password sent from Form
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		$records = $conn->prepare('SELECT * FROM `utilisateur` WHERE `MATRICULE_UTILIS` =:username AND CONFIRM_UTILIS=1');
		$records->bindParam(':username', $username);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		if(count($results) > 0 && password_verify($password, $results['MDPS_UTILIS'])){
			
			$_SESSION['typeUser'] = $results['TYPE_UTILIS'];
			$_SESSION['idUser'] = $results['MATRICULE_UTILIS'];
			$_SESSION['prenomUser'] = $results['PRENOM_UTILIS'];
			$_SESSION['emailUser'] = $results['EMAIL_UTILIS'];
			
			if($_SESSION['typeUser'] == "agent")
			{
				$_SESSION['nomUserAgent'] = $results['NOM_UTILIS'];
			
				header('Location: declarerDemande.php');
			}
			else
			{
				$_SESSION['nomUser'] = $results['NOM_UTILIS'];
				
				header('Location: index.php');
			}
			
			exit;
		}else{
			header('Location: login.php?add=false');
		}
	}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OCP | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h2 class="logo-name">OCP</h2>

            </div>
            <h3>Bienvenue  à votre espace membre</h3>
            <p>Application web de gestion des pannes des matérielles informatiques.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Connectez-vous !</p>
			<?php
										if(isset($_GET['add']))
										{
											$nombre = $_GET['add'];
											if($nombre == "true")
											{
											 echo '
											 <div class="alert alert-success fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>Success!</strong> Connnexion avec succes.
											</div>';
											}
											
											else if($nombre == "false")
											{
												echo '
											 <div class="alert alert-warning fade in">
												<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
												<strong>ََAttention!</strong> Matrécule ou Mot de passe incorrecte ou bien le compte n\'est pas encore avtivé.
											  </div>';
											}
										}
									?>
			
			
            <form class="m-t" role="form" action="" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Matrécule"  required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Mot de Passe"  required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" name="connecter">Connecter</button>

                <a href="forgot_password.php"><small>Mot de passe oublié?</small></a>
                <p class="text-muted text-center"><small>Vous n'avez pas du compte?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.php?add=non">Créer un Compte</a>
            </form>
            <p class="m-t"> <small>Ce site est basé sur Bootstrap 3</small> </p>
            <p class="m-t"> <small>Par BENSTITOU Anas et BOUSLAMA Reda &copy; OCP 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
