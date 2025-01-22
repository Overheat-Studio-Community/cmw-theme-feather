<?php

use CMW\Controller\Users\UsersSessionsController;
use CMW\Manager\Env\EnvManager;
use CMW\Utils\Website;
use CMW\Model\News\NewsTagsModel;
use CMW\Model\News\NewsModel;


$newsLists = new newsModel;
$newsList = $newsLists->getSomeNews(9, 'DESC');

$tagsLists = new NewsTagsModel;
$tags = $tagsLists->getTags();

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

    <a href="#"
       class="hidden md:block rounded mr-2 bg-gray-100 px-4 py-2 text-black">All</a>
    <!-- Tag sélectif -->
    <?php foreach ($tags as $tag) : ?>
        <a href="#"
           class="hidden md:block rounded mr-2 bg-white px-4 py-2 text-black"><?php echo htmlspecialchars($tag->getName()); ?></a>
    <?php endforeach; ?>
    <!-- Tag sélectif mobile -->
    <div class="flex-col items-center md:flex md:flex-row md:items-center md:ml-auto">
        <div class="flex items-center md:mr-4">
            <span class="md:hidden text-gray-500 mr-2">Catégories :</span>
            <div class="md:hidden flex items-center">
                <select class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black">
                    <?php foreach ($tags as $tag) : ?>
                        <option><?php echo htmlspecialchars($tag->getName()); ?></option>
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
    <?php foreach ($newsList as $article) : ?>
        <div class="flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5">
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>news/<?= htmlspecialchars($article->getSlug()) ?>"
               class="block w-[90%] rounded-lg overflow-hidden mx-auto relative">
                <div class="w-[90%] rounded-lg overflow-hidden mx-auto relative">
                    <?php
                    $tagOffset = 1; // Départ initial pour la position des tags
                    foreach ($article->getTags() as $tag): ?>
                        <div class="absolute bg-gray-300 opacity-90 text-white text-xs rounded-2xl px-2 py-1"
                             style="top: <?= $tagOffset ?>rem; left: 0.5rem;">
                            <?= htmlspecialchars($tag->getName()); ?>
                        </div>
                        <?php $tagOffset += 2; // Incrémenter pour espacer chaque tag ?>
                    <?php endforeach; ?>

                    <img class="w-full h-48 object-cover"
                         src="<?= $article->getImageLink() ?: EnvManager::getInstance()->getValue("DEFAULT_IMAGE_PATH") ?>"
                         alt="Image de l'article">

                    <div class="p-4">
                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                        <?= date('d-M-Y', strtotime($article->getDateCreated())) ?>
                    </span>
                        <h2 class="text-lg font-semibold text-gray-800 mt-2">
                            <?= htmlspecialchars($article->getTitle()); ?>
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            <?= htmlspecialchars($article->getDescription()); ?>
                        </p>
                        <div class="flex items-center mt-4">
                            <div class="flex-shrink-0 w-5 h-5">
                                <img class="rounded-full"
                                     src="<?= $article->getAuthor()?->getUserPicture()?->getImage() ?: EnvManager::getInstance()->getValue("DEFAULT_PROFILE_PICTURE") ?>"
                                     alt="Auteur">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">
                                    <?= $article->getAuthor()?->getPseudo() ?: 'Auteur inconnu'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
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
