<?php
session_start(); 
include('config.php');
if(isset($_SESSION['nomUser']) || isset($_SESSION['nomUserAgent']))
{
	$to='';
	$subject='';
	
	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}
	
	/*Recuperer les information du demandeur*/
	if(isset($_GET['demandeur']))
	{
		//Le demandeur
		$demandeur = mysqli_query($con,"SELECT * FROM `utilisateur` WHERE `MATRICULE_UTILIS`='".$_GET['demandeur']."'");

		$demandeurr = mysqli_fetch_array($demandeur);
		
		$to = $demandeurr['EMAIL_UTILIS'];
		$subject='Votre demande de panne';
	}
	
	/*Recuperer les information du fournisseur*/
	if(isset($_GET['fournisseur']))
	{
		//Le fournisseur
		$fournisseur = mysqli_query($con,"SELECT * FROM `fournisseur` WHERE `ID_FOURNIS`='".$_GET['fournisseur']."'");

		$fournis = mysqli_fetch_array($fournisseur);
		
		$to = $fournis['EMAIL_FOURNIS'];
		$subject='Demande de reparation';
	}
		
		
	if(isset($_POST['envoyer']))
	{
		$stmt = $conn->prepare("INSERT INTO `message`(`CONTENUE_MSG`, `OBJET_MSG`, `DATE_MSG`) VALUES (:message, :sujet, :dateMsg)");

		$stmt->bindParam(':message', $_POST['message']);
		$stmt->bindParam(':sujet', $_POST['sujet']);
		$stmt->bindParam(':dateMsg', date('Y-m-d H:i:s'));
		$stmt->execute();
		
		$idMessage = $conn->lastInsertId();
		
		if(isset($_GET['demandeur']))
		{
			//Envoyer message au demandeur
			$stmt2 = $conn->prepare("INSERT INTO `messagerieinterne`(`EMMETEUR`, `RECEPTEUR`, `ID_MSG`) VALUES (:emmeteur, :recepteur, :idMessage)");

			$stmt2->bindParam(':emmeteur', $_SESSION['idUser']);
			$stmt2->bindParam(':recepteur', $_GET['demandeur']);
			$stmt2->bindParam(':idMessage', $idMessage);
			$stmt2->execute();
		}
		
		else if(isset($_GET['fournisseur']))
		{
			//Envoyer message au demandeur
			$stmt2 = $conn->prepare("INSERT INTO `messagerie`(`ID_FOURNIS`, `ID_MSG`, `MATRICULE_UTILIS`) VALUES (:fournisseur, :idMessage, :emetteur)");

			$stmt2->bindParam(':emetteur', $_SESSION['idUser']);
			$stmt2->bindParam(':fournisseur', $_GET['fournisseur']);
			$stmt2->bindParam(':idMessage', $idMessage);
			$stmt2->execute();
		}
		
		else
		{
			$records = $conn->prepare('SELECT * FROM `utilisateur` WHERE `EMAIL_UTILIS` =:to');
			$records->bindParam(':to', $_POST['to']);
			$records->execute();
			
			$results = $records->fetch(PDO::FETCH_ASSOC);
			
			//Envoyer message au demandeur
			$stmt2 = $conn->prepare("INSERT INTO `messagerieinterne`(`EMMETEUR`, `RECEPTEUR`, `ID_MSG`) VALUES (:emmeteur, :recepteur, :idMessage)");

			$stmt2->bindParam(':emmeteur', $_SESSION['idUser']);
			$stmt2->bindParam(':recepteur', $results['MATRICULE_UTILIS`']);
			$stmt2->bindParam(':idMessage', $idMessage);
			$stmt2->execute();
		}
		
		header('Location: BoiteEnvoie.php?add=true');
	}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MESSAGE | Envoyer Message</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

</head>

<body>

    <div id="wrapper">

		<?php include("menu.php"); ?>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			<?php include('notification.php'); ?>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Oui C'est Possible !</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a>Admin</a>
                        </li>
                        <li>
                            <a>Message</a>
                        </li>
                        <li class="active">
                            <strong>Envoyer Message</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content">

            <div class="row">
                <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="demande.php" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> Annuler</a>
                </div>
                <h2>
                    Envoyer un message
                </h2>
            </div>
                <div class="mail-box">
                <div class="mail-body">

                    <form class="form-horizontal" method="post" action="">
						<div class="form-group"><label class="col-sm-2 control-label">To :</label>
							<div class="col-sm-10"><input id="country_id" onkeyup="autocomplet()" type="email" class="form-control" value="<?php echo $to; ?>" name="to" required>
							
							<select class="form-control" multiple="" id="country_list_id">
								</select></div>

								
                    </div>
						
						<div class="form-group"><label class="col-sm-2 control-label">Objet :</label>
							<div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $subject; ?>" name="sujet" required></div>
						</div>
						
						<div class="form-group"><label class="col-sm-2 control-label">Contenue :</label>
							<div class="col-sm-10"><textarea type="text" class="form-control" value="" name="message" rows="8" required></textarea></div>
						</div>
						
						<div class="mail-body text-right tooltip-demo">
							<a href="demande.php" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Annuler email"><i class="fa fa-times"></i> Annuler</a>
							<input href="mailbox.html" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Envoyer" type="submit" value="Envoyer" name="envoyer"></input>
						</div>
						
						<div class="clearfix"></div>
					</form>
				</div>

                </div>
            </div>
            </div>

            </div>
        <div class="footer">
			</div>

				<?php include('footer.php'); ?>
			</div>
        </div>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	
	<script>
	$('#country_list_id').hide();
	</script>

</body>

</html>

<?php
}
else
{
	header('Location: login.php');	
}
?>