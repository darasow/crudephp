<?php

use function PHPSTORM_META\type;

$titre = "Insertion";
require_once "../Header/header.php";
require_once "../../controller/controller.php";
if(isset($_POST['valider']))
{
    if(controlleVide($_POST['nom'], $_POST['dateEmbauche'], $_POST['dateNaissance'], $_POST["salaire"], $_POST["adresse"], $_POST['telephone'], $_POST['email']))
    {
       $vide = true;
    }else{
            $resultat = enrigistrePersonne($_POST['nom'], $_POST['dateEmbauche'], $_POST['dateNaissance'], $_POST["salaire"], $_POST["adresse"], $_POST['telephone'], $_POST['email'], $_POST["genre"], $_POST['post']);
            if($resultat == 1) $succes = "Enregistrement effectuez avec succes";
            else if($resultat == -1) $error = "Cet email existe deja";
            else if($resultat == 2) $error = "Image invalide selectionner une image (png, jpeg, gif, jpg)";
            else $error = "Email invalide";
        }
}
?>


<form action="" method="POST" enctype="multipart/form-data" class="px-10 mt-[100px]">
    <?php if(isset($error) and !empty($error)): ?>
    <h1 class="text-xl md:text-3xl text-center font-semibold bg-red-500 span-cols-2 border-b-8 border-yellow-400 py-5"><?=$error?></h1>
    <?php endif ?>
    
    <?php if(isset($succes) and !empty($succes)): ?>
    <h1 class="text-xl md:text-3xl text-center font-semibold bg-green-500 span-cols-2 border-b-8 border-yellow-400 py-5"><?=$succes?></h1>
    <?php endif ?>
                 <!--===================== Etat Civil =======================-->
                <div class="md:grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6 px-4 w-[80%] mx-auto md:w-full">
                    <!-- ***************** Nom ****************** -->
                    <div class="text-center py-2 relative">
                        <label for="nom" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Nom : </label>
                        <input type="text"  name="nom" id="nom" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Nom">
                    </div>
                  
                    <!-- *************** dateEmbauche **************** -->
                    <div class="text-center py-2 relative">
                        <label for="dateEmbauche" class=" text-sm md:text-lg<?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Date d'embauche : </label>
                        <input type="date"  name="dateEmbauche" id="dateEmbauche" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Date d'embauche">
                    </div>
                    <!-- *************** dateNaissance **************** -->
                    <div class="text-center py-2 relative">
                        <label for="dateNaissance" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Date de naissance : </label>
                        <input type="date"  name="dateNaissance" id="dateNaissance" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Date de naissance">
                    </div>
                    <!-- *************** Salaire **************** -->
                    <div class="text-center py-2 relative">
                        <label for="salaire" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Salaire : </label>
                        <input type="number"  name="salaire" id="salaire" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Salaire">
                    </div>
                    <!-- *************** Adresse **************** -->
                    <div class="text-center py-2 relative">
                        <label for="adresse" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Adresse : </label>
                        <input type="text"  name="adresse" id="adresse" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Adresse">
                    </div>
                    <!-- *************** Telephone **************** -->
                    <div class="text-center py-2 relative">
                        <label for="telephone" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Telephone : </label>
                        <input type="text"  name="telephone" id="telephone" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Telephone">
                    </div>
                    <!-- *************** image **************** -->
                    <div class="text-center py-2 relative">
                        <label for="image" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Image : </label>
                        <input type="file"  name="image" id="image" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10">
                    </div>
                    <!-- *************** email **************** -->
                    <div class="text-center py-2 relative">
                        <label for="email" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Email : </label>
                        <input type="email"  name="email" id="email" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10" placeholder="Email">
                    </div>
                   
                    <!-- ************* Genre ****************** -->
                    <div class="text-center py-2 relative">
                        <label for="genre" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Genre : </label>
                         <select name="genre" id="genre" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10">
                            <option value="Masculin">Masculin</option>
                            <option value="Feminin">Feminin</option>
                         </select>
                    </div>
                    <!-- ************* Post ****************** -->
                    <div class="text-center py-2 relative">
                        <label for="post" class=" text-sm md:text-lg <?= ($vide)? "after:content-['*'] after:text-red-500 after:text-2xl" : "" ?>">Post : </label>
                         <select name="post" id="post" class="text-2xl rounded-lg w-full  py-1 border-black bg-neutral-200 focus:scale-105 focus:delay-200 focus:duration-100 text-black pl-4 pr-10">
                           <?php foreach (listePost() as $post) : ?>
                           <option value="<?= $post->id ?>"><?=$post->nom?></option>
                           <?php endforeach ?>
                         </select>
                    </div>
              
                        
                </div>
                <!-- ********** Les boutons submit et reset -->
                <div class="w-[70%] mx-auto flex items-center justify-around">
                
                    <button type="submit" name="valider" class="text-sm md:text-lg my-4 flex items-center justify-center text-white block  uppercase bg-lime-600 rounded-md p-3 text-center">soumettre</button>
                    <button type="reset" class="text-sm md:text-lg my-4 flex items-center justify-center text-white block  uppercase bg-red-600 rounded-md p-3 text-center">Annuler</button>
                </div>
            </form>

 <?php

require_once "../Footer/footer.php";
?>