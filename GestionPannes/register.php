<?php
	
	if(isset($_POST['matrUtlis']) && isset($_POST['nomUtlis']) && isset($_POST['prenomUtlis']) && isset($_POST['mdpsUtlis']) && isset($_POST['naissanceUtlis']) && isset($_POST['adresseUtlis']) && isset($_POST['teleUtlis']) && isset($_POST['mailUtlis']) && isset($_POST['typeUtlis']) )
	{
		$conn = new PDO("mysql:host=localhost;dbname=gestionpannes", "root", "");

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$demandeur = $conn->query("SELECT COUNT(*) FROM `utilisateur` WHERE `MATRICULE_UTILIS`='".$_POST['matrUtlis']."'");
		//$demandeur->bindValue(':matrUtilis', $_POST['matrUtlis']);
		//$demandeur->execute();
		//$nombre = $demandeur->rowCount();
		
		
		if($demandeur->fetchColumn() > 0)
			header('Location: register.php?add=false');
		
		else{
			
			$time = strtotime($_POST["naissanceUtlis"]);
			$naissance = date('Y-m-d',$time);
			
			$new_password = password_hash($_POST['mdpsUtlis'], PASSWORD_DEFAULT);
			
			$stmt = $conn->prepare("INSERT INTO `utilisateur`(`MATRICULE_UTILIS`, `ID_SERVICE`, `NOM_UTILIS`, `PRENOM_UTILIS`, `DATENAISSANCE_UTILIS`, `ADRESSE_UTILIS`, `TELE_UTILIS`, `EMAIL_UTILIS`, `TYPE_UTILIS`, `MDPS_UTILIS`, `CONFIRM_UTILIS`) VALUES (:matrUtlis,:serviceUtilis,:nomUtlis,:prenomUtlis,:naissanceUtlis,:adresseUtlis,:teleUtlis,:mailUtlis,:typeUtlis,:mdpsUtlis,:0)");
			
			$stmt->bindParam(':matrUtlis', $_POST['matrUtlis']);
			$stmt->bindParam(':nomUtlis', $_POST['nomUtlis']);
			$stmt->bindParam(':prenomUtlis', $_POST['prenomUtlis']);
			$stmt->bindParam(':mdpsUtlis', $new_password);
			$stmt->bindParam(':naissanceUtlis', $naissance);
			$stmt->bindParam(':adresseUtlis', $_POST['adresseUtlis']);
			$stmt->bindParam(':teleUtlis', $_POST['teleUtlis']);
			$stmt->bindParam(':mailUtlis', $_POST['mailUtlis']);
			$stmt->bindParam(':typeUtlis', $_POST['typeUtlis']);
			$stmt->bindParam(':serviceUtilis', $_POST['ServiceUtlis']);

			$stmt->execute();
			
			header('Location: register.php?add=true');
			
		}
	}
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OCP | Register</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
	
</head>

<body class="gray-bg">



	<script type="text/javascript">
		function valideConfPass(inputText)
		{
			if (inputText.rMdpsUtlis.value == '') {
				document.getElementById('errComdps').innerHTML = "<span style='color:red;'>Champ obligatoire !</span>";
			}
			else
			{
				if (inputText.rMdpsUtlis.value == inputText.mdpsUtlis.value )
					document.getElementById('errComdps').innerHTML = "";
				else
					document.getElementById('errComdps').innerHTML = "<span style='color:red;'>Les mots de passe ne correspondent pas !</span>";
			}
		}
	</script>

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h2 class="logo-name">OCP</h2>

            </div>
            <h3>S'inscrire</h3>
            <p>Créer votre compte membre.</p>
			
			<?php
				if(isset($_GET['add']))
				{
					$nombre = $_GET['add'];
					if($nombre == "true")
					{
					 echo '
					 <div class="alert alert-success fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> Votre compte est ajouté avec succes et sera activer dans un délai de 24h.
					</div>';
					}
					
					else if($nombre == "false")
					{
						echo '
					 <div class="alert alert-warning fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>ََAttention!</strong> Ce matricule existe déja dans la base des données.
					  </div>';
					}
				}
			?>

						
            <form class="m-t" role="form" action="" name="register" method="POST">
			
                <div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-user"></i>
					</span>
					<input type="text" class="form-control" placeholder="Matrécule" name="matrUtlis" required="">
                </div>
				
				<div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-font"></i>
					</span>
					<input type="text" class="form-control" placeholder="Nom" name="nomUtlis" required="">
                </div>
				
				<div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-font"></i>
					</span>
					<input type="text" class="form-control" placeholder="Prénom" name="prenomUtlis" required="">
                </div>
				
				<div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<input type="password" class="form-control" placeholder="Mot de Passe" name="mdpsUtlis" required="">
                </div>
				
				<div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-lock"></i>
					</span>
					<input type="password" class="form-control" placeholder="Répétez le Mot de Passe" name="rMdpsUtlis" onblur="valideConfPass(document.register)" required="">
					<p id="errComdps" class="error"></p>
                </div>
				
				<div class="form-group" id="data_3">
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="naissanceUtlis" placeholder="Date Naissance">
					</div>
				</div>
							
				<div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-home"></i>
					</span>
					<input type="text" class="form-control" placeholder="Adresse" name="adresseUtlis" required="">
                </div>
				
				<div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-phone"></i>
					</span>
					<input type="text" class="form-control" placeholder="Téléphone" name="teleUtlis" required="">
                </div>
				
                <div class="form-group input-group date">
                    <span class="input-group-addon">
						<i class="fa fa-at"></i>
					</span>
					<input type="email" class="form-control" placeholder="Email" name="mailUtlis" required="">
                </div>
				
				<div class="form-group">
                    <select class="form-control m-b" name="typeUtlis">
						<option value="service" selected hidden >Vous etes un ...</option>
						<option value="agent">Agent</option>
						<option value="IT">IT</option>
					</select>
                </div>
				
				<?php
				
					$con = mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
					mysql_select_db("gestionpannes", $con) or die('Could not select database.');

					
					$sql = "SELECT * FROM `service`";

					$service = mysql_query($sql) or die(mysql_error()); //note: use mysql_error() for development only

					echo '<div class="form-group">
						<select class="form-control m-b" name="ServiceUtlis" >
						<option value="service" selected hidden >Choisir votre Service</option> ';
					
					while($row = mysql_fetch_assoc($service)) {
					 echo '<option   value="'.$row['ID_SERVICE'].'">'.$row['NOM_SERVICE'].'</option>';
					 }
					
					echo '</select>
					</div>';
				?>
				
				
				
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Accepter les contrats et licences.</label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">S'inscrire</button>

                <p class="text-muted text-center"><small>Vous avez déja un compte?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Connectez-Vous</a>
            </form>
            <p class="m-t"> <small>Ce site est basé sur Bootstrap 3</small> </p>
			<p class="m-t"> <small>Par BENSTITOU Anas et BOUSLAMA Reda &copy; OCP 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
	

	
   <!-- Data picker -->
   <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
	
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
		
		
		$('#data_3 .input-group.date').datepicker({
			startView: 2,
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			autoclose: true
        });
			
		$("#form").validate({
			 rules: {
				 password: {
					 required: true,
					 minlength: 3
				 },
				 url: {
					 required: true,
					 url: true
				 },
				 number: {
					 required: true,
					 number: true
				 },
				 min: {
					 required: true,
					 minlength: 6
				 },
				 max: {
					 required: true,
					 maxlength: 4
				 }
			 }
		 });
    </script>
</body>

</html>


