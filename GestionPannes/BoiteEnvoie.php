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
	
	$sql1 = "SELECT * FROM `messagerieinterne` WHERE `EMMETEUR`='".$_SESSION['idUser']."'";

	$result1 = mysqli_query($con,$sql1);
	
	$sql2 = "SELECT * FROM `messagerie` WHERE `MATRICULE_UTILIS`='".$_SESSION['idUser']."'";

	$result2 = mysqli_query($con,$sql2);
	
	/**************************************/
	
	$nbMsg1 = mysqli_query($con,"SELECT COUNT(*) as nbMsg FROM messagerieinterne WHERE messagerieinterne.EMMETEUR='".$_SESSION['idUser']."'");

	$NbrMsg1 = mysqli_fetch_assoc($nbMsg1);
	
	$nbMsg2 = mysqli_query($con,"SELECT COUNT(*) as nbMsg FROM messagerie WHERE messagerie.MATRICULE_UTILIS='".$_SESSION['idUser']."'");

	$NbrMsg2 = mysqli_fetch_assoc($nbMsg2);
	
	$NbrMsg = intval($NbrMsg1['nbMsg']) + intval($NbrMsg2['nbMsg']);
	
	/**************************************/
	
	$NonLuu = mysqli_query($con,"SELECT COUNT(*) as nonLu FROM `messagerieinterne`, message WHERE `messagerieinterne`.`RECEPTEUR`='".$_SESSION['idUser']."' AND message.`ID_MSG`=messagerieinterne.`ID_MSG` AND message.VU_MSG=0");

	$NonLu = mysqli_fetch_assoc($NonLuu);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MESSAGE | Boite d'envoie</title>

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
								<strong>Boite d'Envoie</strong>
							</li>
						</ol>
					</div>
					<div class="col-lg-2">

					</div>
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
											<li><a href="BoiteReception.php"> <i class="fa fa-inbox "></i> Boite Récéption <span class="label label-warning pull-right"><?php echo $NonLu['nonLu'];?></span> </a></li>
											<li><a href="BoiteEnvoie.php"> <i class="fa fa-envelope-o"></i> Messages Envoyés</a></li>
										</ul>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-10 animated fadeInRight">
							<div class="mail-box-header">

								<h2>
								   <?php echo "Messages Envoyés (".$NbrMsg.")"; ?> 
								</h2>
								<div class="mail-tools tooltip-demo m-t-md">
									<div class="btn-group pull-right">
										<button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
										<button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
									</div>
								</div>
							</div>
							<div class="mail-box">
								<table class="table table-hover table-mail">
									<tbody>
										<?php

											while($roww = mysqli_fetch_array($result2))
											{

												$fournisseur = mysqli_query($con,"SELECT * FROM `fournisseur` WHERE `ID_FOURNIS`=".$roww['ID_FOURNIS']."");
												$fournis = mysqli_fetch_array($fournisseur);

												$message = mysqli_query($con,"SELECT * FROM `message` WHERE `ID_MSG`=".$roww['ID_MSG']." ORDER BY DATE_MSG");
												$row2 = mysqli_fetch_array($message);

												$read = "read";
												
												$lien = "DetailsMessage.php?Message=".$roww['ID_MSG']."&fournis=".$roww['ID_FOURNIS'];

												echo "<tr class=".$read.">";
												echo "<td class='mail-ontact'><a href='"; echo $lien;
												echo "'>".$fournis['NOM_FOURNIS']."</a></td>";
												echo "<td class='mail-ontact'><span class='label label-danger'>Fournisseur</span></td>";
												echo "<td class='mail-subject'><a href='"; echo $lien;
												echo "'>".$row2['OBJET_MSG']."</a></td>";
												echo "<td class=''	></td>";
												echo "<td class='text-right mail-date'>".$row2['DATE_MSG']."</td>";
												echo "</tr>";
											}
											
											while($row = mysqli_fetch_array($result1))
											{

												$TypeRecepteur = mysqli_query($con,"SELECT * FROM `utilisateur` WHERE `MATRICULE_UTILIS`='".$row['RECEPTEUR']."'");
												$recepteur = mysqli_fetch_array($TypeRecepteur);

												$message = mysqli_query($con,"SELECT * FROM `message` WHERE `ID_MSG`=".$row['ID_MSG']." ORDER BY DATE_MSG");
												$row2 = mysqli_fetch_array($message);

												$read = "read";

												$lien = "DetailsMessage.php?Message=".$row['ID_MSG']."&agent=".$row['RECEPTEUR'];
												
												echo "<tr class=".$read.">";
												echo "<td class='mail-ontact'><a href='"; echo $lien;
												echo "'>".$recepteur['NOM_UTILIS']." ".$recepteur['PRENOM_UTILIS']."</a></td>";
												echo "<td class='mail-ontact'><span class='label label-primary'>Agent</span></td>";
												echo "<td class='mail-subject'><a href='"; echo $lien;
												echo "'>".$row2['OBJET_MSG']."</a></td>";
												echo "<td class=''	></td>";
												echo "<td class='text-right mail-date'>".$row2['DATE_MSG']."</td>";
												echo "</tr>";
											}
										?>
									</tbody>
								</table>
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