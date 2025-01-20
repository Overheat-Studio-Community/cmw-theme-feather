<?php

use CMW\Controller\Users\UsersSessionsController;
use CMW\Manager\Env\EnvManager;
use CMW\Utils\Website;

Website::setTitle('Accueil');
Website::setDescription("page d'accueil de CraftMyWebsite");
?>
<div class="mt-20 sm:mt-0 hero-section relative">
    <div class="mx-auto shadow-md rounded-lg overflow-hidden relative">
        <img class="w-full object-cover aspect-square sm:aspect-auto object-center"
             alt="Background"
             height="768"
             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/photo-background.png' ?>">
        <div class="absolute bottom-5 left-5 text-white text-shadow-lg flex flex-col items-start ">
            <h2 class="text-2xl font-bold z-[1]">Mon dressing</h2>
            <p class="leading-4 text-base mt-0 sm:ml- md:max-w-80 xl:max-w-96 sm:mt-2 sm:ml-0 z-[1]">Découvrez mon
                dressing sous tous ses
                ensembles</p>
            <div class="absolute inset-0 bg-black/25 blur-xl"></div>
        </div>
    </div>
</div>


<h2 class="mt-6 text-3xl">
    Blog
</h2>
<h3 class="text-xl mt-3 text-gray-600">
    Vous trouverez ici les 9 derniers blogs disponibles et mis en ligne.
</h3>
<nav class="z-30 flex my-2 items-center">
    <?php
    $categories = ['All', 'Destination', 'Culinary', 'Lifestyle', 'Tips & Hacks'];
    ?>
    <a href="#"
       class="hidden md:block rounded mr-2 bg-gray-100 px-4 py-2 text-black">Cuisine</a>
    <?php foreach ($categories as $category) : ?>
        <a href="#"
           class="hidden md:block rounded mr-2 bg-white px-4 py-2 text-black"><?php echo htmlspecialchars($category); ?></a>
    <?php endforeach; ?>
    <div class="flex-col items-center md:flex md:flex-row md:items-center md:ml-auto">
        <div class="flex items-center md:mr-4">
            <span class="md:hidden text-gray-500 mr-2">Catégories :</span>
            <div class="md:hidden flex items-center">
                <select class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black">
                    <?php foreach ($categories as $category) : ?>
                        <option><?php echo htmlspecialchars($category); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex items-center mt-3 md:mt-0">
            <span class="text-gray-500 mr-2">Sort by:</span>
            <select class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black">
                <option>Récent</option>
                <option>Ancien</option>
                <option>Populaires</option>
            </select>
        </div>
    </div>
</nav>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto">
    <?php foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9] as $article) : ?>
        <div class="flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5 ">
            <div class="w-[90%] rounded-lg overflow-hidden mx-auto relative ">
                <div class="absolute bg-gray-300 opacity-90 text-white text-xs rounded-2xl px-2 py-2 top-2 left-2">
                    Mode
                </div>
                <img class="w-full h-48 object-cover"
                     src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/vetements.png' ?>"
                     alt="Packing Tips">
                <div class="p-4">
                <span
                    class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded"><?= date('z-M-Y') ?></span>
                    <h2 class="text-lg font-semibold text-gray-800 mt-2">
                        Mon dressing
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">
                        Découvrez mon dressing sous tous ses ensembles
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="flex-shrink-0 w-5 h-5">
                            <img class="rounded-full"
                                 src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/pp-basic.jpg' ?>"
                                 alt="Author">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800 ">Some1</p>
                            <p class="text-sm text-gray-500"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<div class="flex items-center gap-5 mx-auto my-4 font-medium">
    <i class="border rounded px-3 py-2 fa-solid fa-chevron-left"></i>
    <div class="flex items-center gap-5">
        <div class="bg-gray-100 px-3 py-1 rounded w-8 text-center">1</div>
        <p class="w-8 text-center">2</p>
        <p class="w-8 text-center">3</p>
        <div class="hidden gap-5 items-center sm:flex">
            <p class="w-8 text-center">4</p>
            <p class="w-8 text-center">5</p>
        </div>
    </div>
    <i class="border rounded px-3 py-2 fa-solid fa-chevron-right"></i>
</div>
