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
        .container {
            position: relative;
        }
    </style>

    <img alt="Background" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/vetements.png' ?>"
<h2 class="text-3xl mt-6">
    Blog
</h2>
<h3 class="text-xl mt-3 text-gray-600">
    Vous trouverez ici les 9 derniers blogs disponibles et mis en ligne.
</h3>
        <nav class="flex justify-between p-4 rounded-lg shadow-md">
            <a href="#" class="rounded-lg bg-gray-300 px-4 py-2 text-black">All</a>
        </nav>
    </div>
<?php for ($j = 1; $j <= 3; $j++): ?>
    <div class="flex justify-between gap-4">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="max-w-sm bg-white shadow-md rounded-lg overflow-hidden mx-auto container">
                <div class="bubble">Mode</div>
                <img class="w-full h-48 object-cover" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/vetements.png'?>" alt="Packing Tips">
                <div class="p-4">
                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded"><?= date('z-M-Y') ?> . 6 minutes read </span>
                    <h2 class="text-lg font-semibold text-gray-800 mt-2">
                        Mon dressing
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">
                        Découvrez mon dressing sous tous ses ensembles
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="flex-shrink-0 w-10 h-10">
                            <img class="w-10 h-10 rounded-full" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/pp-basic.jpg'?>" alt="Author">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800 ">Some1</p>
                            <p class="text-sm text-gray-500"></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
<?php endfor; ?>