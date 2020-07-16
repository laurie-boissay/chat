<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini chat</title>
    </head>
    
    <body>
        <!-- Formulaire : Envoie à la page post_chat.php -->

        <form action="post_chat.php" method="post"> <!-- method="GET" ou method="POST" -->
        
            <!-- Pseudo -->
            <p><label>Pseudo : <input action="text" name="pseudo"></label></p>

            <!-- Message -->
            <p><label>Message : <input action="text" name="message"></label></p>

            <!-- Submit -->
            <p><input type="submit"></p>

        </form>

        <?php

            // Se connecter à la base de données essai + config erreur.
            $bdd = new PDO('mysql:host=localhost;dbname=essai', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            // Afficher les 10 derniers messages.
            $reponse = $bdd->query('SELECT UPPER(pseudo) AS pseudo_maj , message,  DATE_FORMAT(Date_creation, \'Le %d/%m à %Hh%i\') AS moment FROM mini_chat ORDER BY ID DESC limit 0, 10');


            // Fonctions scalaires :
            // UPPER() LOWER() LENGTH() ROUND()
                // SELECT ROUND(prix, 2) AS prix_arrondi FROM jeux_video

            // Fonctions d'agrégat :
            // AVG() moyenne sur une colonne
            // SUM() somme
            // MAX() le plus haut
            // MIN() le plus bas
            // COUNT(*) :
                // nbre de ligne SELECT COUNT(*) FROM message WHERE pseudo='Jaenne'
            // GROUP BY :
                // SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console
            // HAVING :
                // SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console HAVING prix_moyen <= 10 ORDER BY prix_moyen
            // DISTINCT :
                // SELECT COUNT(DISTINCT possesseur) AS nbpossesseurs FROM jeux_video
            // BETWEEN :
                //SELECT pseudo, message, Date_creation FROM minichat WHERE date BETWEEN '2010-04-02 00:00:00' AND '2010-04-18 00:00:00'
            // DATE_FORMAT():
                // DATE_FORMAT(Date_creation, '%d/%m/%Y %Hh%imin%ss')

            while ($donnes = $reponse ->fetch())
            {
                // Verifier que     - le message ne contient pas de characteres spéciaux.
                //                  - le pseudo ne contient pas de characteres spéciaux.
                echo '<p>' . htmlspecialchars($donnes['moment']) . ' :<br/>' . htmlspecialchars($donnes['pseudo_maj']) . ' a écrit :<br/>' . htmlspecialchars($donnes['message']) . '</p>';  
            }

            // Se deconnecter de la base de données.
            $reponse->closeCursor();

        ?>
    </body>
</html>