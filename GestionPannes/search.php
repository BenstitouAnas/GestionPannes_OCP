<?php
    define('_HOST_NAME', 'localhost');
	define('_DATABASE_USER_NAME', 'root');
	define('_DATABASE_PASSWORD', '');
	define('_DATABASE_NAME', 'gestionpannes');
	
     $dbConnection = new mysqli(_HOST_NAME, _DATABASE_USER_NAME, _DATABASE_PASSWORD, _DATABASE_NAME);
     if ($dbConnection->connect_error) {
          trigger_error('Connection Failed: '  . $dbConnection->connect_error, E_USER_ERROR);
     }
	 
	 
if(isset($_POST['search_keyword']))
{
	$search_keyword = $dbConnection->real_escape_string($_POST['search_keyword']);
	
	$sqlCountries="SELECT EMAIL_UTILIS FROM utilisateur WHERE EMAIL_UTILIS LIKE '%$search_keyword%'";
    $resCountries=$dbConnection->query($sqlCountries);
    if($resCountries === false) {
        trigger_error('Error: ' . $dbConnection->error, E_USER_ERROR);
    }else{
        $rows_returned = $resCountries->num_rows;
    }
	$bold_search_keyword = '<strong>'.$search_keyword.'</strong>';
	if($rows_returned > 0){
		while($rowCountries = $resCountries->fetch_assoc()) {		
			echo '<div class="show" align="left"><span class="country_name">'.str_ireplace($search_keyword,$bold_search_keyword,$rowCountries['countries_name']).'</span></div>'; 	
		}
	}else{
		echo '<div class="show" align="left">No matching records.</div>'; 	
	}
}	
?>