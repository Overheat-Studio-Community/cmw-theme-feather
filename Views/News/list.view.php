<?php

use CMW\Entity\News\NewsEntity;
use CMW\Manager\Env\EnvManager;
use CMW\Utils\Website;
use CMW\Controller\Users\UsersSessionsController;
use CMW\Model\News\NewsTagsModel;
use CMW\Model\News\NewsModel;

$newsLists = new NewsModel;
$tagsLists = new NewsTagsModel;

// Filtre des tags
$tags = $tagsLists->getTags();

$tagFilter = $_GET['tag'] ?? 'all';
$order = $_GET['order'] ?? 'DESC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

if ($tagFilter === 'all') {
    $allNews = $newsLists->getNews();
} else {
    $tag = $tagsLists->getTagByName($tagFilter);
    if ($tag) {
        $allNews = $tagsLists->getNewsForTagById($tag->getId());
    } else {
        $allNews = [];
    }
}

usort($allNews, function($a, $b) use ($order) {
    if ($order === 'ASC') {
        return strtotime($a->getDateCreated()) - strtotime($b->getDateCreated());
    } else {
        return strtotime($b->getDateCreated()) - strtotime($a->getDateCreated());
    }
});

$totalNews = count($allNews);
$newsList = array_slice($allNews, $offset, $limit);

$newsTags = NewsTagsModel::getInstance()->getTags();
/* @var NewsEntity [] $newsList */
/* @var NewsTagsModel [] $newsTags */
Website::setTitle('News');
Website::setDescription('Consultez les dernières actualités');
?>
<h2 class="mt-6 text-3xl">
    Blog
</h2>
<h3 class="text-xl mt-3 text-gray-600">
    Vous trouverez ici les derniers blogs disponibles et mis en ligne.
</h3>
<nav class="z-30 flex my-2 items-center">
    <a href="?tag=all" class="hidden md:block rounded mr-2 bg-gray-100 px-4 py-2 text-black">All</a>
    <?php foreach ($tags as $tag) : ?>
        <a href="?tag=<?= urlencode($tag->getName()) ?>" class="hidden md:block rounded mr-2 bg-white px-4 py-2 text-black">
            <?= htmlspecialchars($tag->getName()); ?>
        </a>
    <?php endforeach; ?>
    <div class="flex-col items-center md:flex md:flex-row md:items-center md:ml-auto">
        <div class="flex items-center md:mr-4">
            <span class="md:hidden text-gray-500 mr-2">Catégories :</span>
            <div class="md:hidden flex items-center">
                <select class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black" onchange="location = this.value;">
                    <option value="?tag=all">All</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="?tag=<?= urlencode($tag->getName()) ?>"><?= htmlspecialchars($tag->getName()); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex items-center mt-3 md:mt-0">
            <span class="text-gray-500 mr-2">Sort by:</span>
            <select id="sortOrder" class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black" onchange="sortNews()">
                <option value="DESC" <?= $order === 'DESC' ? 'selected' : '' ?>>Récent</option>
                <option value="ASC" <?= $order === 'ASC' ? 'selected' : '' ?>>Ancien</option>
            </select>
        </div>
    </div>
</nav>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto">
    <?php foreach ($newsList as $article) : ?>
        <div class="flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5 w-full">
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>news/<?= htmlspecialchars($article->getSlug()) ?>"
               class="block w-[90%] rounded-lg relative">
                <div class="rounded-lg overflow-hidden mx-auto">
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
    <a href="?tag=<?= urlencode($tagFilter) ?>&order=<?= $order ?>&page=<?= max(1, $page - 1) ?>" class="border rounded px-3 py-2 fa-solid fa-chevron-left"></a>
    <div class="flex items-center gap-5">
        <?php for ($i = 1; $i <= ceil($totalNews / $limit); $i++): ?>
            <a href="?tag=<?= urlencode($tagFilter) ?>&order=<?= $order ?>&page=<?= $i ?>" class="w-8 text-center <?= $i === $page ? 'bg-gray-100' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <a href="?tag=<?= urlencode($tagFilter) ?>&order=<?= $order ?>&page=<?= min($page + 1, ceil($totalNews / $limit)) ?>" class="border rounded px-3 py-2 fa-solid fa-chevron-right"></a>
</div>
<script>
    function sortNews() {
        const order = document.getElementById('sortOrder').value;
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('order', order);
        window.location.search = urlParams.toString();
    }
</script>