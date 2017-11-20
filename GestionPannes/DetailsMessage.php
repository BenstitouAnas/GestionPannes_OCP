<?php
session_start();
include('config.php');
if(isset($_SESSION['nomUser']) || isset($_SESSION['nomUserAgent']))
{

	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}
	
	
	mysqli_query($con,"UPDATE `message` SET `VU_MSG`=1 WHERE `ID_MSG`=".$_GET['Message']."");
	

	$NonLuu = mysqli_query($con,"SELECT COUNT(*) as nonLu FROM `messagerieinterne`, message WHERE `messagerieinterne`.`RECEPTEUR`='".$_SESSION['idUser']."' AND message.`ID_MSG`=messagerieinterne.`ID_MSG` AND message.VU_MSG=0");

	$NonLu1 = mysqli_fetch_assoc($NonLuu);

	$result = mysqli_query($con,"SELECT * FROM `message` WHERE `ID_MSG`=".$_GET['Message']."");
	
	$row = mysqli_fetch_array($result);
	
	if(isset($_GET['agent']))
	{
		$TypeRecepteur = mysqli_query($con,"SELECT * FROM `utilisateur` WHERE `MATRICULE_UTILIS`='".$_GET['agent']."'");
		$recepteur = mysqli_fetch_array($TypeRecepteur);
		
		$nomEmet = $recepteur['NOM_UTILIS'];
		$prenomEmet = $recepteur['PRENOM_UTILIS'];
		$mailEmet = $recepteur['EMAIL_UTILIS'];
		
		$lien = "Message.php?demandeur=".$_GET['agent'];
	}
	
	if(isset($_GET['fournis']))
	{
		$fournisseur = mysqli_query($con,"SELECT * FROM `fournisseur` WHERE `ID_FOURNIS`=".$_GET['fournis']."");
		$fournis = mysqli_fetch_array($fournisseur);
		
		$nomEmet = $fournis['NOM_FOURNIS'];
		$prenomEmet = "(".$fournis['TELE_FOURNIS'].")";
		$mailEmet = $fournis['EMAIL_FOURNIS'];
		
		$lien = "Message.php?fournisseur=".$_GET['fournis'];
	}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MESSAGE | Detailles Message</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

		<?php include("menu.php"); ?>

        <div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<?php include('notification.php'); ?>
			</div>

        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="Message.php">Nouveau Message</a>
                            <div class="space-25"></div>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li><a href="BoiteReception.php"> <i class="fa fa-inbox "></i> Boite Récéption <span class="label label-warning pull-right"><?php echo $NonLu1['nonLu'];?></span> </a></li>
                                <li><a href="BoiteEnvoie.php"> <i class="fa fa-envelope-o"></i> Messages Envoyés</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="<?php echo $lien; ?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Répondre</a>
                </div>
                <h2>
                    Voir Message
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">


                    <h3>
                        <span class="font-noraml">Nom : </span><?php echo $nomEmet." ".$prenomEmet; ?>
                    </h3>
                    <h5>
                        <span class="pull-right font-noraml"><?php echo $row['DATE_MSG']; ?></span>
                        <span class="font-noraml">Adresse Mail : </span><?php echo $mailEmet; ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <?php echo $row['CONTENUE_MSG']; ?>
                </div>
                        <div class="clearfix"></div>
                </div>
            </div>
        </div>
        </div>
			<?php include('footer.php'); ?>

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
</body>

</html>

<?php
mysqli_close($con);

}
else
{
	header('Location: login.php');	
}
?>
