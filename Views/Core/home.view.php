<?php

use CMW\Manager\Env\EnvManager;
use CMW\Model\News\NewsTagsModel;
use CMW\Utils\Website;


$tags = NewsTagsModel::getInstance()->getTags();

Website::setTitle('Accueil');
Website::setDescription("page d'accueil de CraftMyWebsite");
?>
<div class="mt-20 sm:mt-0 hero-section relative">
    <div class="mx-auto shadow-md rounded-lg overflow-hidden relative">
        <img class="mx-auto w-full h-96 rounded object-cover"
             alt="Background"
             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/photo-background.png' ?>">
        <div class="absolute bottom-5 left-5 text-white text-shadow-lg flex flex-col items-start ">
            <h2 class="text-2xl font-bold z-[1]"><?= "Titre du dernier blog" ?></h2>
            <p class="leading-4 text-base mt-0 sm:ml- md:max-w-80 xl:max-w-96 sm:mt-2 sm:ml-0 z-[1]"><?="Description du dernier blog" ?></p>
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