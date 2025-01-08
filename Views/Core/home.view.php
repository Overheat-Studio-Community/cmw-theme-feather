<?php

use CMW\Controller\Users\UsersSessionsController;
use CMW\Manager\Env\EnvManager;
use CMW\Utils\Website;

Website::setTitle('Accueil');
Website::setDescription("page d'accueil de CraftMyWebsite");
?>
<style>
    body {
        margin: 10px;
        padding: 0;
        background-color: white;
        background-size: cover;
    }

    img {
        max-height: 768px;
    }

    .bubble {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: gray;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
    }
    nav {
        z-index: 1000;
    }
    .container {
        position: relative;
    }
    .hero-section {
        margin-top: -65px;
    }
    .hero-section .text-content h2 {
        font-size: 2.5rem;
        margin: 0;
    }

    .hero-section .text-content p {
        font-size: 1rem;
        margin-top: 10px;
    }
</style>
<div class="hero-section relative">
    <div class="mx-auto shadow-md rounded-lg overflow-hidden relative">
        <img class="w-full object-cover"
             alt="Background"
             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/vetements.png' ?>">
        <div class="absolute bottom-5 left-5 text-white text-shadow-lg">
            <h2 class="text-2xl font-bold">Mon dressing</h2>
            <p class="text-base mt-2 max-w-40 md:max-w-80 xl:max-w-96">Découvrez mon dressing sous tous ses ensembles</p>
        </div>
    </div>
</div>


<h2 class="text-3xl mt-6">
    Blog
</h2>
<h3 class="text-xl mt-3 text-gray-600">
    Vous trouverez ici les 9 derniers blogs disponibles et mis en ligne.
</h3>
<nav class="flex justify-between p-4 rounded-lg shadow-md">
    <a href="#" class="rounded-lg bg-gray-300 px-4 py-2 text-black">All</a>
</nav>

<div class="grid gap-5 grid-cols-1 md:grid-cols-2  xl:grid-cols-3">
    <?php foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9] as $article) : ?>
        <div class="flex justify-between sm:gap-4 md:gap-4 xl:gap-2 ">
            <div class="max-w-sm bg-white shadow-md rounded-lg overflow-hidden mx-auto container">
                <div class="bubble">Mode</div>
                <img class="w-full h-48 object-cover"
                     src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/vetements.png' ?>"
                     alt="Packing Tips">
                <div class="p-4">
                <span
                    class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded"><?= date('z-M-Y') ?> . 6 minutes read </span>
                    <h2 class="text-lg font-semibold text-gray-800 mt-2">
                        Mon dressing
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">
                        Découvrez mon dressing sous tous ses ensembles
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="flex-shrink-0 w-10 h-10">
                            <img class="w-10 h-10 rounded-full"
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