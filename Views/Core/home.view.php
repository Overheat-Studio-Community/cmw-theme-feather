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
        margin-top: -65px;
        padding: 0;
        max-height: 768px;

    }
</style>

<img alt="Background" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/Background.jpg' ?>">
<?php for ($j = 1; $j <= 3; $j++): ?>
    <div class="flex justify-between gap-4">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="max-w-sm bg-white shadow-md rounded-lg overflow-hidden mx-auto">
                <img class="w-full h-48 object-cover" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/vetements.png'?>" alt="Packing Tips">
                <div class="p-4">
                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">Showroom</span>
                    <h2 class="text-lg font-semibold text-gray-800 mt-2">
                        Mon dressing
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">
                        Découvrez mon dressing sous tous ses ensembles
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="flex-shrink-0">
                            <img class="w-10 h-10 rounded-full" src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/pp-texier.png'?>" alt="Author">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">Thomas Texier</p>
                            <p class="text-sm text-gray-500">7 Janvier 2025</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
<?php endfor; ?>








