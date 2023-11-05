<?php
$titre = "Acceuil";
require_once "./View/Header/header.php";
require_once "./controller/controller.php";
?>






<div class="swiper mySwiperGrid">
        <div class="swiper-wrapper h-[600px] text-white">
                   <?php foreach (listePersonne() as $personne) : ?>
                    <div class=" cardprodfil overflow-hidden  swiper-slide text-lg flex items-center flex-col  group   w-[100%]    ">
                                        <div class="  absolute rounded-lg left-0 right-0 bottom-0 top-0  bg-gradient-to-tl from-amber-500 to-gray-800 flex flex-col h-full ">
                                            <img src="./Assets/image/<?=$personne->image?>" alt="" class="rounded-lg ">
                                            <p class="py-5 font-thin text-xl flex flex-col">
                                                <span class="font-semibold text-sm md:text-lg">Email : <?=$personne->email?></span>
                                                <span class="font-bold text-lg md:text-2lg" >Nom: <?=$personne->nom?></span>
                                                <span class="font-bold text-lg md:text-2lg" >Adresse : <?=$personne->adresse?></span>
                                                <span class="font-bold text-lg md:text-2lg" >Telephone : <?=$personne->telephone?></span>
                                                <span class="font-bold text-lg md:text-2lg" >Salaire : <?=$personne->salaire?></span>
                                                <span class="font-bold text-lg md:text-2lg" >Poste : <?= ($personne->poste)?></span>
                                            </p>
                                            <p class="flex justify-between">
                                                <a href="./View/Modification/modifier.php?id=<?=$personne->id?>" class=" hover:bg-green-600 hover:duration-500 p-2 bg-green-500">Modifier</a>
                                                <a  href="./View/Suppression/supprimer.php?id=<?=$personne->id?>" class="supprimer hover:bg-red-600 hover:duration-500 p-2 bg-red-500">Supprimer</a>
                                            </p>       
                                        </div>
                                
                        </div>
                   <?php endforeach ?>
               

    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>







<?php
require_once "./View/Footer/footer.php";
?>