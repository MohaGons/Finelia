<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'/>
        <title> Finelia </title>
    </head>

    <body>
	    <section>
            <h1> Finelia </h1>
            <h3> Ajouter une note et son coefficient </h3>

            <?php
                //Connexion à la base de données
	            $bdd = new PDO('mysql:host=localhost;dbname=finelia;charset=utf8', 'root', '');

                //Récupération de tous les étudiants de la base de données
	            $getEtudiants = $bdd->prepare("SELECT * FROM etudiant");
	            $getEtudiants->execute();

                //Récupération de toutes les matières de la base de données
                $getMatieres = $bdd->prepare("SELECT * FROM matiere");
                $getMatieres->execute();
            ?>
			
            <form id="gestionNotes" method="POST">
                <select name="etudiant" id="etudiant">
                    <?php foreach ($getEtudiants as $etudiant) { ?>
                        <option value="<?php echo $etudiant['etudiantID']; ?>">
                            <?php echo $etudiant['nom']; echo $etudiant['prenom'] ?>
                        </option> 
                    <?php }  ?>		
                </select>

                <select name="matiere" id="matiere">
                    <?php foreach ($getMatieres as $matiere) { ?>
                        <option value="<?php echo $matiere['matiereID']; ?>">
                        <?php echo $matiere['intitule']; ?>
                        </option> 
                    <?php }  ?>     
                </select>
             
                <label for="note">* Note : </label>
                <input type="text" id="note" placeholder="Entrez la note" name="note" required/>

                <label for="prenom">* Coefficient :</label>
                <input type="text" id="coefficient" placeholder="Entrez le coefficient" name="coefficient" required/>

                <input type="submit" value="Ajouter" name="ajoutNote"/>        
            </form>

            <br/><br/>
            <a href="moyenne.php" target="_blank"> <input type="button" value="Calculer la moyenne"> </a> 


            <?php
                if (isset($_POST["ajoutNote"])) {
                    //Récupération des données
                    $note = $_POST['note'];
                    $coefficient = $_POST['coefficient'];
                    $etudiant = $_POST['etudiant'];
                    $matiere = $_POST['matiere'];
                    
                    //Ajoute des notes et des coefficients
                    $insertNote = $bdd->prepare("INSERT INTO note (note,coefficient,matiereID,etudiantID) VALUES (?,?,?,?)");
                    $insertNote->bindParam(1, $note);
                    $insertNote->bindParam(2, $coefficient);
                    $insertNote->bindParam(3, $matiere);
                    $insertNote->bindParam(4, $etudiant);

                    //Execution de la requête
                    $insertNote->execute();
                                
                    echo "<p> L'ajout de la note a été réalisé avec succès, vous allez être redirigé vers la page d'accueil </p>";
                    header('refresh:3;url=formulaire.php');
                }
            ?>

	    </section>
    </body>
</html>
