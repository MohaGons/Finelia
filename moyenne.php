<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'/>
        <title> Finelia </title>
    </head>

    <body>
	    <section>
			<h1> Finelia Moyenne </h1>

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

                 <input type="submit" value="Calculer" name="calculeNote"/>
            </form>

            <br/><br/>
            <a href="formulaire.php" target="_blank"> <input type="button" value="Ajouter une note et son coefficient"> </a> 

            <?php

            if (isset($_POST["calculeNote"])) {
                $etudiant = $_POST['etudiant'];
                $matiere = $_POST['matiere'];

                //Récupération des notes et des coefficients en fonction de l'étudiant et de la matière sélectionnée
                $getNotesAndCoefficients = $bdd->prepare("SELECT note,coefficient from note where etudiantID = ? and matiereID = ?");
                //Execution de la requête
                $getNotesAndCoefficients->execute(array($etudiant,$matiere));

                //Récupération de la moyenne des coefficient en fonction de l'étudiant et de la matière sélectionnée
                 $getMoyenneCoefficient = $bdd->prepare("SELECT sum(coefficient) as moyenneCoefficient from note where etudiantID = ? and matiereID = ?");
                //Execution de la requête
                $getMoyenneCoefficient->execute(array($etudiant,$matiere));
                $resultMoyenneCoeff = $getMoyenneCoefficient->fetch();

                $resultMoyenne = null;
                foreach ($getNotesAndCoefficients as $noteAndCoefficient) { 
                    $resultMoyenne = $resultMoyenne + ($noteAndCoefficient['note'] * $noteAndCoefficient['coefficient']);
                }   
                echo "La moyenne pondérée est de : "; echo $resultMoyenne / $resultMoyenneCoeff['moyenneCoefficient'];
            }
            ?>

	    </section>
    </body>
</html>
