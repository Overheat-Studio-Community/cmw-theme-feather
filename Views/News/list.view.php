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
<h2 class="mt-10 text-3xl">
    Blog
</h2>
<h3 class="text-xl mt-3 text-gray-600">
    Vous trouverez ici les derniers blogs disponibles et mis en ligne.
</h3>
<nav class="z-30 flex my-2 items-center">
    <a href="#" class="tag-filter hidden md:block rounded mr-2 px-4 py-2 text-black">All</a>
    <?php foreach ($tags as $tag) : ?>
        <a href="#" class="tag-filter hidden md:block rounded mr-2 px-4 py-2 bg-white text-black"
           data-tag="<?= $tag->getId() ?>">
            <?= $tag->getName() ?>
        </a>
    <?php endforeach; ?>
    <div class="flex-col items-center md:flex md:flex-row md:items-center md:ml-auto">
        <div class="flex items-center md:mr-4">
            <span class="md:hidden text-gray-500 mr-2">Catégories :</span>
            <div class="md:hidden flex items-center">
                <select class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black"
                        id="tagSelect">
                    <option value="all">All</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option
                            value="<?= $tag->getName() ?>"><?= htmlspecialchars($tag->getName()); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex items-center mt-3 md:mt-0">
            <span class="text-gray-500 mr-2">Sort by:</span>
            <select id="sortOrder" class="rounded bg-white border-solid border border-gray-100 px-2 py-1 text-black"
                    onchange="sortNews()">
                <option value="DESC" selected>Récent</option>
                <option value="ASC">Ancien</option>
            </select>
        </div>
    </div>
</nav>

<div id="newsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl w-full mx-auto"></div>
<div class="flex pagination justify-center gap-8 mt-4">
    <button id="prevPage" class="prev bg-gray-300 px-4 py-2 rounded" onclick="changePage('prev')">Précédent</button>
    <span id="currentPage" class="px-4 py-2"></span>
    <button id="nextPage" class="next bg-gray-300 px-4 py-2 rounded" onclick="changePage('next')">Suivant</button>
</div>
<script>
    let currentPage = 1;
    const limit = 9;
    let activeTag = null;

    const getArticles = async (page = 1, order = 'DESC', tag = null) => {
        const container = document.getElementById('newsContainer');
        container.innerHTML = `
    <div class="mx-auto w-full max-w-sm rounded-md border border-gray-500 p-4">
        <div class="flex animate-pulse space-x-4">
            <div class="flex-1 space-y-6 py-2">
                <div class="h-48 rounded bg-gray-200"></div>
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1 h-2 rounded bg-gray-200"></div>
                        <div class="col-span-2 h-2 rounded bg-gray-200"></div>
                    </div>
                    <div class="w-10 h-2 rounded bg-gray-200"></div>
                </div>
            </div>
        </div>
    </div>
    `;

        let url = `<?= EnvManager::getInstance()->getValue('PATH_URL') ?>api/news/page/${page}/?limit=${limit}&order=${order}`;
        if (tag !== null) {
            url += `&tag=${tag}`;
        }

        const req = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const res = await req.json();
        container.classList.remove('animate-pulse');
        container.innerHTML = '';

        if (res.news === undefined || res.news.length === 0) {
            if (page > 1) {
                currentPage--;
                getArticles(currentPage, order, tag);
            } else {
                container.appendChild(document.createTextNode('Aucun article trouvé'));
            }
            return;
        }

        const articles = res.news;
        articles.forEach((article) => {
            let articleElement = document.createElement('div');
            articleElement.className = 'flex news-item flex gap-0 justify-center sm:gap-4 md:gap-4 mb-5 w-full';
            articleElement.setAttribute('data-tags', article.tags.map(tag => tag.name).join(','));

            let tagOffset = 1;
            let tagsHTML = article.tags.map(tag => {
                let tagHTML = `
            <div class="absolute bg-gray-300 opacity-90 text-white text-xs rounded-2xl px-2 py-1" style="top: ${tagOffset}rem; left: 0.5rem;">
                ${tag.name}
            </div>
        `;
                tagOffset += 2;
                return tagHTML;
            }).join('');
            articleElement.innerHTML = `
        <a href="${article.articleLink}" class="block w-[90%] rounded-lg relative">
            <div class="mx-auto w-full object-cover">
                ${tagsHTML}
                <img class="mx-auto w-full h-48 rounded object-cover" src="${article.imageLink}" alt="Image de l'article">
                <div class="p-4">
                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                        ${article.dateCreated}
                    </span>
                    <h2 class="text-lg font-semibold text-gray-800 mt-2">
                        ${article.title}
                    </h2>
                    <p class="text-sm text-gray-600 mt-2">
                        ${article.description}
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="flex-shrink-0 w-5 h-5">
                            <img class="rounded-full" src="${article.authorImageLink}" alt="Auteur">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">
                                ${article.authorPseudo}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    `;

            if (tag === null || article.tags.some(t => t.id === parseInt(tag))) {
                container.appendChild(articleElement);
            }
        });

        document.getElementById('currentPage').textContent = `Page ${page}`;
    };

    const changePage = (direction) => {
        const sortOrder = document.getElementById('sortOrder').value;
        if (direction === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (direction === 'next') {
            currentPage++;
        }

        getArticles(currentPage, sortOrder, activeTag);
    };

    const setActiveTag = (tag) => {
        activeTag = tag;
        currentPage = 1; // Reset to the first page when the tag changes
        document.querySelectorAll('.tag-filter').forEach(el => {
            el.classList.remove('font-semibold');
            if (el.getAttribute('data-tag') === tag) {
                el.classList.add('font-semibold');
            }
        });
        getArticles(currentPage, document.getElementById('sortOrder').value, tag);
    };

    document.addEventListener('DOMContentLoaded', () => {
        getArticles(currentPage);

        const sortOrder = document.getElementById('sortOrder');
        sortOrder.addEventListener('change', () => {
            getArticles(currentPage, sortOrder.value, activeTag);
        });

        document.querySelectorAll('.tag-filter').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                setActiveTag(el.getAttribute('data-tag'));
            });
        });

        document.getElementById('tagSelect').addEventListener('change', (e) => {
            setActiveTag(e.target.value);
        });
    });
</script>