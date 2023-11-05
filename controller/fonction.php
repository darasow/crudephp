<?php
require_once "../../controller/controller.php";
function miseAjour($nom, $dateEmbauche, $dateNaissance, $salaire, $adresse,  $telephone, $email, $genre, $poste, $idPersonne):int
{
    $base = new Model();
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return 0;
    $teste = $base->getConnexion()->prepare("SELECT COUNT(*) from personnes where email =:email and id != :id");
    $teste->bindParam(":email", $email);
    $teste->bindParam(":id", $idPersonne);
    $teste->execute();
    $count = $teste->fetchColumn();
    if($count > 0) return -1;
    if(!empty($_FILES['image']['name']))
    {
        $repertoir = "C:\laragon\www\GestionPersonnel\Assets\image/";
        $file = $_FILES['image'];
        $req = $base->getConnexion()->prepare("SELECT image From personnes where id =:id");
        $req->bindParam(":id", $idPersonne);
        $req->execute();
        $image = $req->fetch(PDO::FETCH_COLUMN);
        unlink("C:\laragon\www\GestionPersonnel\Assets\image/".$image);
        $req->closeCursor();

        $req = "UPDATE personnes set nom = :nom, dateEmbauche = :dateEmbauche, salaire = :salaire, adresse = :adresse, telephone = :telephone, email = :email, dateNaissance = :dateNaissance, genre = :genre,  poste = :poste, image = :image  where id = :id";
        $prepare = $base->getConnexion()->prepare($req);
        $prepare->bindValue(":nom", securise($nom), PDO::PARAM_STR);
        $prepare->bindValue(":dateEmbauche", securise($dateEmbauche), PDO::PARAM_STR);
        $prepare->bindValue(":salaire", securise($salaire), PDO::PARAM_INT);
        $prepare->bindValue(":adresse", securise($adresse), PDO::PARAM_STR);
        $prepare->bindValue(":telephone", securise($telephone), PDO::PARAM_STR);
        $prepare->bindValue(":email", securise($email), PDO::PARAM_STR);
        $prepare->bindValue(":dateNaissance", securise($dateNaissance), PDO::PARAM_STR);
        $prepare->bindValue(":genre", securise($genre), PDO::PARAM_STR);
        $prepare->bindValue(":poste", securise($poste), PDO::PARAM_INT);
        $prepare->bindValue(":id", $idPersonne, PDO::PARAM_INT);
        try {
            $prepare->bindValue(":image", securise(controleImage($file, $repertoir)), PDO::PARAM_STR);
        } catch (\Throwable $th) {
            return 2;
        }
    }else
    {
        $req = "UPDATE personnes set nom = :nom, dateEmbauche = :dateEmbauche, salaire = :salaire, adresse = :adresse, telephone = :telephone, email = :email, dateNaissance = :dateNaissance, genre = :genre,  poste = :poste  where id = :id";
        $prepare = $base->getConnexion()->prepare($req);
        $prepare->bindValue(":nom", securise($nom), PDO::PARAM_STR);
        $prepare->bindValue(":dateEmbauche", securise($dateEmbauche), PDO::PARAM_STR);
        $prepare->bindValue(":salaire", securise($salaire), PDO::PARAM_INT);
        $prepare->bindValue(":adresse", securise($adresse), PDO::PARAM_STR);
        $prepare->bindValue(":telephone", securise($telephone), PDO::PARAM_STR);
        $prepare->bindValue(":email", securise($email), PDO::PARAM_STR);
        $prepare->bindValue(":dateNaissance", securise($dateNaissance), PDO::PARAM_STR);
        $prepare->bindValue(":genre", securise($genre), PDO::PARAM_STR);
        $prepare->bindValue(":poste", securise($poste), PDO::PARAM_INT);
        $prepare->bindValue(":id", $idPersonne, PDO::PARAM_STR);
    }
    
    $resultat = $prepare->execute();
    $prepare->closeCursor();
    return 1;
}
 