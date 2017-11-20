<?php

	$con=mysqli_connect("localhost","root","","gestionpannes");
	if (mysqli_connect_errno())
	{
		echo "Impossible de connecter a mysql " . mysqli_connect_error();
	}
	/**************************************/

	$nbMsg11 = mysqli_query($con,"SELECT COUNT(*) as nbMsg FROM messagerieinterne WHERE messagerieinterne.RECEPTEUR='".$_SESSION['idUser']."'");

	$NbrMsg11 = mysqli_fetch_assoc($nbMsg11);

	$NbrMsg00 =intval($NbrMsg11['nbMsg']);
	
	/**************************************/

	$NonLuu0 = mysqli_query($con,"SELECT COUNT(*) as nonLu FROM `messagerieinterne`, message WHERE `messagerieinterne`.`RECEPTEUR`='".$_SESSION['idUser']."' AND message.`ID_MSG`=messagerieinterne.`ID_MSG` AND message.VU_MSG=0");

	$NonLu0 = mysqli_fetch_assoc($NonLuu0);
	
	$NonLuuu =intval($NonLu0['nonLu']);
	
	if($NonLuuu == '0')
		$msag = "";
	else
		$msag = "<span class='label label-warning pull-right'>".$NonLuuu."/".$NbrMsg00."</span>";
?>   

   <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
		<?php 
			if($_SESSION['typeUser'] == "IT")
			{
		?>
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle"

							<?php
									echo "src='img/it.png'";

							?> />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['nomUser']." ".$_SESSION['prenomUser']; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_SESSION['typeUser']; ?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Profile</a></li>
                            <li><a href="BoiteReception.php">Messages</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        OCP
                    </div>
                </li>
				
				<li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Messages </span><?php echo $msag; ?></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="BoiteReception.php">Boite de Récéption</a></li>
                        <li><a href="BoiteEnvoie.php">Boite d'Envoie</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="demande.php"><i class="fa fa-file-text-o"></i> <span class="nav-label">Demandes</span></a>
                </li>
                
                <li>
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Matérielles</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ajouterMaterielle.php">Ajouter Matériel</a></li>
                        <li><a href="listeMaterielle.php">Liste Matérielles</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="ajouterFournisseur.php"><i class="fa fa-bus"></i> <span class="nav-label">Fournisseurs</span></a>
                </li>
				
				<li>
                    <a href="ajouterType.php"><i class="fa fa-plug"></i> <span class="nav-label">Types</span></a>
                </li>

				<li>
                    <a href="ajouterMarque.php"><i class="fa fa-globe"></i> <span class="nav-label">Marques</span></a>
                </li>
				
				<li>
                    <a href="ajouterService.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Services</span></a>
                </li>
            </ul>
			
		<?php 
			}
			else if($_SESSION['typeUser'] == "agent")
			{
		?>
			<ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle"

							<?php
									echo "src='img/agent.jpg'";
							?> />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['nomUserAgent']." ".$_SESSION['prenomUser']; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_SESSION['typeUser']; ?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Profile</a></li>
                            <li><a href="BoiteReception.php">Messages</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        OCP
                    </div>
                </li>
				
				<li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Messages </span><?php echo $msag; ?></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="BoiteReception.php">Boite de Récéption</a></li>
                        <li><a href="BoiteEnvoie.php">Boite d'Envoie</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="declarerDemande.php"><i class="fa fa-file-text-o"></i> <span class="nav-label">Demandes</span></a>
                </li>
            </ul>
		<?php
			}
			else if($_SESSION['typeUser'] == "admin")
			{
		?>
			<ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle"

							<?php
									echo "src='img/admin.png'";

							?> />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['nomUser']." ".$_SESSION['prenomUser']; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $_SESSION['typeUser']; ?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Profile</a></li>
                            <li><a href="BoiteReception.php">Messages</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        OCP
                    </div>
                </li>
				
				<li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Messages </span><?php echo $msag; ?></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="BoiteReception.php">Boite de Récéption</a></li>
                        <li><a href="BoiteEnvoie.php">Boite d'Envoie</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Comptes</span></a>
					<ul class="nav nav-second-level collapse">
                        <li><a href="demandesCompte.php">Demandes Confirmation</a></li>
                        <li><a href="listeComptes.php">Liste Des Comptes</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Matérielles</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ajouterMaterielle.php">Ajouter Matériel</a></li>
                        <li><a href="listeMaterielle.php">Liste Matérielles</a></li>
                    </ul>
                </li>
				
				<li>
                    <a href="ajouterFournisseur.php"><i class="fa fa-bus"></i> <span class="nav-label">Fournisseurs</span></a>
                </li>
				
				<li>
                    <a href="ajouterType.php"><i class="fa fa-plug"></i> <span class="nav-label">Types</span></a>
                </li>

				<li>
                    <a href="ajouterMarque.php"><i class="fa fa-globe"></i> <span class="nav-label">Marques</span></a>
                </li>
				
				<li>
                    <a href="ajouterService.php"><i class="fa fa-sitemap"></i> <span class="nav-label">Services</span></a>
                </li>
				
				<li class="landing_link">
                    <a href="statistique.php"><i class="fa fa-signal"></i> <span class="nav-label">Statistiques</span> <span class="label label-warning pull-right">NEW</span></a>
                </li>
				
            </ul>
		<?php
			}
		?>

        </div>
    </nav>