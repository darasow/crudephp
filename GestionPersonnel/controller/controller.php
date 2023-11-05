<?php
require_once dirname(__DIR__)."/Database/database.php";
$error = "";
$succes = "";
$vide = false;
define("URL", "http://localhost:81/GestionPersonnel/");


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
 

function supperssion($id)
{
    suprimeImage($id);
    $base = new Model();
    $req = "Delete from personnes where id =:id";
    $prepare = $base->getConnexion()->prepare($req);
    $prepare->bindValue(":id", $id);
    $resultat = $prepare->execute();
    $prepare->closeCursor();

    /*********   Supression de l'image  ***********/   
    

}

function suprimeImage($id)
{
    $base = new Model();
    $req = $base->getConnexion()->prepare("SELECT image From personnes where id =:id");
    $req->bindParam(":id", $id);
    $req->execute();
    $image = $req->fetch(PDO::FETCH_COLUMN);
    unlink("C:\laragon\www\GestionPersonnel\Assets\image/".$image);
    $req->closeCursor();
}
function listePersonne()
{
    $base = new Model();
    $req = $base->getConnexion()->prepare("SELECT * From personnes order by id asc");
    $req->execute();
    $resultat =  $req->fetchAll(PDO::FETCH_CLASS);
    $req->closeCursor();
    return $resultat;
}
 function listePost()
{
    $base = new Model();
    $req = $base->getConnexion()->prepare("SELECT * From post order by id asc");
    $req->execute();
    $resultat =  $req->fetchAll(PDO::FETCH_CLASS);
    $req->closeCursor();
    return $resultat;
}
 function post(int $id)
{
    $base = new Model();
    $req = $base->getConnexion()->prepare("SELECT * From personnes where id =:id");
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $resultat =  $req->fetchAll(PDO::FETCH_CLASS);
    $req->closeCursor();
    return $resultat;
}

 function personne(int $id)
{
    $base = new Model();
    $req = $base->getConnexion()->prepare("SELECT * From personnes where id =:id");
    $req->bindParam(":id", $id, PDO::PARAM_INT);
    $req->execute();
    $resultat =  $req->fetchAll(PDO::FETCH_CLASS);
    $req->closeCursor();
    return $resultat;

}

function securise($date)
{
    
   return htmlentities($date);
}
function controlleVide($nom, $dateEmbauche, $dateNaissance, $salaire, $adresse,  $telephone, $email)
{
    return (empty($nom) || empty($dateEmbauche) || empty($dateNaissance) || empty($salaire) || empty($adresse) || empty($telephone) || empty($email));
}


 function enrigistrePersonne($nom, $dateEmbauche, $dateNaissance, $salaire, $adresse,  $telephone, $email, $genre, $poste) :  int
    {   

        $base = new Model();
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return 0;
        $teste = $base->getConnexion()->prepare("SELECT COUNT(*) from personnes where email =:email");
        $teste->bindParam(":email", $email);
        $teste->execute();
        $count = $teste->fetchColumn();
        if($count > 0) return -1;

        $file = $_FILES['image'];
        $repertoir = "C:\laragon\www\GestionPersonnel\Assets\image/";
        $req = "INSERT INTO personnes(nom, dateEmbauche, salaire, adresse, telephone, email, dateNaissance, genre,  poste, image)
            values(:nom, :dateEmbauche, :salaire, :adresse, :telephone, :email, :dateNaissance, :genre, :poste, :image)";
        $prepare = $base->getConnexion()->prepare($req);
        $prepare->bindValue(":nom", securise($nom), PDO::PARAM_STR);
        $prepare->bindValue(":dateEmbauche", securise($dateEmbauche), PDO::PARAM_STR);
        $prepare->bindValue(":salaire", securise($salaire), PDO::PARAM_INT);
        $prepare->bindValue(":adresse", securise($adresse), PDO::PARAM_STR);
        $prepare->bindValue(":telephone", securise($telephone), PDO::PARAM_STR);
        $prepare->bindValue(":email", securise($email), PDO::PARAM_STR);
        $prepare->bindValue(":dateNaissance", securise($dateNaissance), PDO::PARAM_STR);
        $prepare->bindValue(":genre", securise($genre), PDO::PARAM_STR);
        $prepare->bindValue(":poste", securise($poste), PDO::PARAM_STR);
        try {
            $prepare->bindValue(":image", securise(controleImage($file, $repertoir)), PDO::PARAM_STR);

        } catch (\Throwable $th) {
            return 2;
        }
        $resultat = $prepare->execute();
        $prepare->closeCursor();
        return 1;
       
    }

   
    function controleImage($file, $dir)
    {
      if(!isset($file['name']) || empty($file['name'])) throw new Exception("Vous devez indiquer une image");
      if(!file_exists($dir)) mkdir($dir, 0777);
      $extension =  strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
      $random = rand(0, 99999);
      $nomUnique = $dir.$random."_".$file['name'];
      if(!getimagesize($file["tmp_name"])) throw new Exception("Le fichier n'est pas une image");
      if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif") throw new Exception("L'extention du fichier n'est pas reconnu");
      if(file_exists($nomUnique)) throw new Exception("Le fichier existe deja");
      if($file["size"] > 50000000) throw new Exception("Le fichier est trop gros");
      if(!move_uploaded_file($file['tmp_name'], $nomUnique)) throw new Exception("L'ajout de l'image n'a pas fonctionner");
      else return ($random."_".$file['name']);
    }
