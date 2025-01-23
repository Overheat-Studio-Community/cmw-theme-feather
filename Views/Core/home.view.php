<?php

use CMW\Manager\Env\EnvManager;
use CMW\Utils\Website;
use CMW\Model\News\NewsTagsModel;
use CMW\Model\News\NewsModel;

$newsLists = new NewsModel;
$tagsLists = new NewsTagsModel;

$allNews = $newsLists->getNews(); // Charge tous les articles
$tags = $tagsLists->getTags(); // Charge tous les tags

$order = $_GET['order'] ?? 'DESC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9;
$selectedTag = $_GET['tag'] ?? 'all';

// Filtrer les articles par tag si nécessaire
if ($selectedTag !== 'all') {
    $allNews = array_filter($allNews, function($article) use ($selectedTag) {
        $articleTags = array_map(fn($tag) => $tag->getName(), $article->getTags());
        return in_array($selectedTag, $articleTags);
    });
}

// Trier les articles après le filtrage
usort($allNews, function($a, $b) use ($order) {
    if ($order === 'ASC') {
        return strtotime($a->getDateCreated()) - strtotime($b->getDateCreated());
    } else {
        return strtotime($b->getDateCreated()) - strtotime($a->getDateCreated());
    }
});

// Calculer la pagination après le tri
$totalNews = count($allNews);
$totalPages = ceil($totalNews / $limit);
$offset = ($page - 1) * $limit;

// Découper les articles pour la page courante
$newsList = array_slice($allNews, $offset, $limit);

// Récupérer la dernière news
$latestNews = $newsLists->getSomeNews(1, 'DESC')[0];

Website::setTitle('Accueil');
Website::setDescription("page d'accueil de CraftMyWebsite");
?>
<div class="mt-20 sm:mt-0 hero-section relative">
    <div class="mx-auto shadow-md rounded-lg overflow-hidden relative">
        <img class="max-w-52 max-h-52 object-cover aspect-square sm:aspect-auto object-center"
             alt="Background"
             src="<?= $latestNews->getImageLink() ?: EnvManager::getInstance()->getValue("DEFAULT_IMAGE_PATH") ?>">
        <div class="absolute bottom-5 left-5 text-white text-shadow-lg flex flex-col items-start ">
            <h2 class="text-2xl font-bold z-[1]"><?= htmlspecialchars($latestNews->getTitle()) ?></h2>
            <p class="leading-4 text-base mt-0 sm:ml- md:max-w-80 xl:max-w-96 sm:mt-2 sm:ml-0 z-[1]"><?= htmlspecialchars($latestNews->getDescription()) ?></p>
            <div class="absolute inset-0 bg-black/25 blur-xl"></div>
        </div>
    </div>
</div>
<h2 class="mt-6 text-3xl">
    Blog
</h2>
<h3 class="text-xl mt-3 text-gray-600">
    Vous trouverez ici les derniers blogs disponibles et mis en ligne.
</h3>
<nav class="z-30 flex my-2 items-center">
    <a href="#" class="tag-filter hidden md:block rounded mr-2 px-4 py-2 bg-gray-100 text-black" data-tag="all">All</a>
    <?php foreach ($tags as $tag) : ?>
        <a href="#" class="tag-filter hidden md:block rounded mr-2 px-4 py-2 bg-white text-black" data-tag="<?= htmlspecialchars($tag->getName()) ?>">
            <?= htmlspecialchars($tag->getName()); ?>
        </a>
    <?php endforeach; ?>
    <div class="flex-col items-center md:flex md:flex-row md:items-center md:ml-auto">
        <div class="flex items-center md:mr-4">
            <span class="md:hidden text-gray-500 mr-2">Catégories :</span>
            <div class="md:hidden flex items-center">
                <select class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black" id="tagSelect">
                    <option value="all">All</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?= htmlspecialchars($tag->getName()) ?>"><?= htmlspecialchars($tag->getName()); ?></option>
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

<div id="newsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto">
    <?php foreach ($newsList as $article) : ?>
        <div class="news-item flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5 w-full" data-tags="<?= implode(',', array_map(fn($tag) => htmlspecialchars($tag->getName()), $article->getTags())) ?>">
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
    <a href="?order=<?= $order ?>&page=<?= max(1, $page - 1) ?>&tag=<?= htmlspecialchars($selectedTag) ?>"
       class="border rounded px-3 py-2 fa-solid fa-chevron-left"></a>
    <div class="flex items-center gap-5">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?order=<?= $order ?>&page=<?= $i ?>&tag=<?= htmlspecialchars($selectedTag) ?>"
               class="w-8 text-center <?= $i === $page ? 'bg-gray-100 rounded py-1' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <a href="?order=<?= $order ?>&page=<?= min($page + 1, $totalPages) ?>&tag=<?= htmlspecialchars($selectedTag) ?>"
       class="border rounded px-3 py-2 fa-solid fa-chevron-right"></a>
</div>
<script>
    function sortNews() {
        const order = document.getElementById('sortOrder').value;
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('order', order);
        window.location.search = urlParams.toString();
    }

    document.addEventListener('DOMContentLoaded', () => {
        const tagFilters = document.querySelectorAll('.tag-filter');
        const newsItems = document.querySelectorAll('.news-item');
        const tagSelect = document.getElementById('tagSelect');

        tagFilters.forEach(filter => {
            filter.addEventListener('click', (e) => {
                e.preventDefault();
                const tag = filter.getAttribute('data-tag');
                filterNews(tag);
                tagFilters.forEach(f => f.classList.remove('bg-gray-300'));
                filter.classList.add('bg-gray-300');
                updateURL(tag);
            });
        });

        if (tagSelect) {
            tagSelect.addEventListener('change', () => {
                const tag = tagSelect.value;
                filterNews(tag);
                updateURL(tag);
            });
        }

        function filterNews(tag) {
            newsItems.forEach(item => {
                const tags = item.getAttribute('data-tags').split(',');
                if (tag === 'all' || tags.includes(tag)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function updateURL(tag) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('tag', tag);
            window.history.replaceState(null, null, "?" + urlParams.toString());
        }
    });
</script>