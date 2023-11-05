<?php 
define("URL", "http://localhost:81/GestionPersonnel/");

 

?>
<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://cdn.tailwindcss.com"></script>
                <!-- <script src="Assets/Js/tailwind.js" ></script> -->
                <script src="Assets/Js/swiper-bundle.min.js" defer></script>
                <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                <script src="Assets/Js/script.js"defer ></script>
                <link rel="stylesheet" href="Assets/Css/swiper-bundle.min.css">
                <link rel="stylesheet" href="Assets/Css/style.css">
                <title> <?=$titre?></title>
            </head>
            <body>
            <!-- component -->


<header >
    <nav
    class="fixed inset-x-0 top-0 z-10 w-full px-4 py-1 bg-white shadow-md border-slate-500 dark:bg-[#0c1015] transition duration-700 ease-out"
	>
		<div class="flex justify-between p-4">
            <div class="text-[2rem] leading-[3rem] tracking-tight font-bold text-black dark:text-white">
				Gestion
			</div>
			<div class="flex items-center space-x-4 text-lg font-semibold tracking-tight">
                <?php if($_SERVER["PHP_SELF"] == "/GestionPersonnel/index.php"):?>
                   <a href="view/Ajouter/insertion.php"  class=" px-6 text-black transition duration-700 ease-out bg-white border border-black rounded-lg hover:bg-black hover:border hover:text-white dark:border-white dark:bg-inherit dark:text-white dark:hover:bg-white dark:hover:text-black">Nouvelle personne</a>
                <?php else : ?>
                   <a href=""  class=" px-6 text-black transition duration-700 ease-out bg-white border border-black rounded-lg hover:bg-black hover:border hover:text-white dark:border-white dark:bg-inherit dark:text-white dark:hover:bg-white dark:hover:text-black">Acceuil</a>
			     <?php endif ?>
            </div>
		</div>
	</nav>
    
    
    
	
</header>