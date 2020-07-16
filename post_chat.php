<?php


	// Verifier que : 	- pseudo est configuré
	//					- message est configuré
	//					- message n'est pas vide
	if (isset($_POST['pseudo']) AND isset($_POST['message']) AND $_POST['message'] != '')
	{
		// Si pseudo est vide :
		if ($_POST['pseudo'] == '')
		{
			// afficher pseudo = Anonyme.
			$_POST['pseudo'] = 'Anonyme';
		}

			// Se connecter à la base de données essai + config erreur.
			$bdd = new PDO('mysql:host=localhost;dbname=essai', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		
			// Enregistrer dans la base de donnees.
			$requete = $bdd->prepare('INSERT INTO mini_chat(pseudo, message) VALUES(?, ?)');
			$requete ->execute(array($_POST['pseudo'], $_POST['message']));
		
		
			// Se déconnecter de la base de données.
			$requete->closeCursor(); // Fermer la requête.
	}


	// Retour vers la page mini_chat.
	header('Location: mini_chat.php');

?>