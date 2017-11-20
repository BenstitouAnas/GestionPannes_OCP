<?php

	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}

	$NonLuu00 = mysqli_query($con,"SELECT COUNT(*) as nonLu FROM `messagerieinterne`, message WHERE `messagerieinterne`.`RECEPTEUR`='".$_SESSION['idUser']."' AND message.`ID_MSG`=messagerieinterne.`ID_MSG` AND message.VU_MSG=0");

	$NonLu00 = mysqli_fetch_assoc($NonLuu00);
	
	if(isset($_SESSION['nomUserAgent']))
		$nomm = $_SESSION['nomUserAgent'];
	else
		$nomm = $_SESSION['nomUser'];


?>

<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
	<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
</div>

	<ul class='nav navbar-top-links navbar-left'>
		<li>
		<a style='color:#777' href='#'>OCP - Gestion des Pannes</a>
	  </li>
	</ul>
	
	<ul class="nav navbar-top-links navbar-right">
		<li>
			<span class="m-r-sm text-muted welcome-message">Bienvenue : <?php echo $nomm." ".$_SESSION['prenomUser']; ?></span>
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
				<i class="fa fa-envelope"></i>  <span class="label label-warning"><?php echo $NonLu00['nonLu']; ?></span>
			</a>
		</li>
		
		<?php
			if($_SESSION['typeUser'] == "IT")
			{
				$demandeur = $conn->query("SELECT COUNT(*) FROM `demande` WHERE `ETAT_DEMANDE`=0");
		?>
		
		<li class="dropdown">
			<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
				<i class="fa fa-bell"></i>  <span class="label label-primary"><?php echo $demandeur->fetchColumn();?></span>
			</a>
		</li>
		
		<?php
			}
			else if($_SESSION['typeUser'] == "admin")
			{
				$demandeur = $conn->query("SELECT COUNT(*) FROM `utilisateur` WHERE `CONFIRM_UTILIS`=0");
		?>
		
		<li class="dropdown">
			<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
				<i class="fa fa-bell"></i>  <span class="label label-primary"><?php echo $demandeur->fetchColumn();?></span>
			</a>
		</li>
		
		<?php
			}
		?>

		<li>
			<a href="logout.php">
				<i class="fa fa-sign-out"></i> Déconnexion
			</a>
		</li>
	</ul>

</nav>