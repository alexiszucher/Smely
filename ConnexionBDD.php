<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=alexis1099_smely', 'alexis1099_jpod', '=d!ibkh2Z#xN');
	}
	catch(Exception $e)
	{
		die('Erreur : ' .$e->getMessage());
	}
?>