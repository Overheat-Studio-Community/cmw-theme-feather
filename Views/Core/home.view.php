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
        <img class="max-w-52 max-h-52 object-cover aspect-square sm:aspect-auto object-center"
             alt="Background"
             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/photo-background.png' ?>">
        <div class="absolute bottom-5 left-5 text-white text-shadow-lg flex flex-col items-start ">
            <h2 class="text-2xl font-bold z-[1]"><?= Website::getWebsiteName() ?></h2>
            <p class="leading-4 text-base mt-0 sm:ml- md:max-w-80 xl:max-w-96 sm:mt-2 sm:ml-0 z-[1]"><?= Website::getWebsiteDescription() ?></p>
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
    <a href="#" class="tag-filter hidden md:block rounded mr-2 px-4 py-2 text-black" data-tag="all">All</a>
    <?php foreach ($tags as $tag) : ?>
        <a href="#" class="tag-filter hidden md:block rounded mr-2 px-4 py-2 bg-white text-black"
           data-tag="<?= $tag->getName() ?>">
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

<div id="newsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto">
    <?php foreach ([] as $article) : ?>
        <div class="news-item flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5 w-full"
             data-tags="<?= implode(',', array_map(static fn($tag) => $tag->getName(), $article->getTags())) ?>"
             data-date="<?= $article->getDateCreated() ?>">
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>news/<?= $article->getSlug() ?>"
               class="block w-[90%] rounded-lg relative">
                <div class="rounded-lg overflow-hidden mx-auto">
                    <?php
                    $tagOffset = 1; // Départ initial pour la position des tags
                    foreach ($article->getTags() as $tag): ?>
                        <div class="absolute bg-gray-300 opacity-90 text-white text-xs rounded-2xl px-2 py-1"
                             style="top: <?= $tagOffset ?>rem; left: 0.5rem;">
                            <?= $tag->getName(); ?>
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
                            <?= $article->getTitle(); ?>
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            <?= $article->getDescription(); ?>
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
<!--<div class="flex pagination justify-center gap-8">
    <?php /*if ($page > 1): */ ?>
        <a href="?page=<?php /*= $page - 1 */ ?>&order=<?php /*= $order */ ?>&tag=<?php /*= $selectedTag */ ?>" class="prev"><i
                class="fa-solid fa-chevron-left"></i></a>
    <?php /*endif; */ ?>

    <?php /*for ($i = 1; $i <= $totalPages; $i++): */ ?>
        <a href="?page=<?php /*= $i */ ?>&order=<?php /*= $order */ ?>&tag=<?php /*= $selectedTag */ ?>"
           class="<?php /*= $i == $page ? 'bg-gray-500 font-bold' : '' */ ?>"><?php /*= $i */ ?></a>
    <?php /*endfor; */ ?>

    <?php /*if ($page < $totalPages): */ ?>
        <a href="?page=<?php /*= $page + 1 */ ?>&order=<?php /*= $order */ ?>&tag=<?php /*= $selectedTag */ ?>" class="next"><i
                class="fa-solid fa-chevron-right"></i></a>
    <?php /*endif; */ ?>
</div>-->
<script>
    const getArticles = async () => {
        const req = await fetch('<?= EnvManager::getInstance()->getValue('PATH_URL') ?>api/news', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            }
        );

        const res = await req.json();

        const container = document.getElementById('newsContainer');
        container.innerHTML = ''; // Clear the container

        if (res.news === undefined) {
            container.appendChild(document.createTextNode('Aucun article trouvé'));
            return;
        }

        const articles = res.news;
        articles.forEach((article) => {
            const articleElement = document.createElement('div');
            articleElement.className = 'news-item flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5 w-full';
            articleElement.setAttribute('data-tags', article.tags.join(','));
            articleElement.setAttribute('data-date', article.dateCreated);

            articleElement.innerHTML = `
            <a href="${article.articleLink}" class="block w-[90%] rounded-lg relative">
                <div class="rounded-lg overflow-hidden mx-auto">
                    ${article.tags.map(tag => `
                        <div class="absolute bg-gray-300 opacity-90 text-white text-xs rounded-2xl mt-2 ml-0 px-2 py-1">
                            ${tag}
                        </div>
                    `).join('')}
                    <img class="w-full h-48 object-cover" src="${article.imageLink}" alt="Image de l'article">
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

            container.appendChild(articleElement);
        });
    };

    getArticles();

    function sortNews() {
        const order = document.getElementById('sortOrder').value;
        const newsContainer = document.getElementById('newsContainer');
        const newsItems = Array.from(newsContainer.getElementsByClassName('news-item'));

        newsItems.sort((a, b) => {
            const dateA = new Date(a.getAttribute('data-date'));
            const dateB = new Date(b.getAttribute('data-date'));

            if (order === 'ASC') {
                return dateA - dateB;
            } else {
                return dateB - dateA;
            }
        });

        newsItems.forEach(item => newsContainer.appendChild(item));
    }

    document.addEventListener('DOMContentLoaded', () => {
        const tagFilters = document.querySelectorAll('.tag-filter');
        const newsItems = document.querySelectorAll('.news-item');
        const tagSelect = document.getElementById('tagSelect');

        const urlParams = new URLSearchParams(window.location.search);
        const initialTag = urlParams.get('tag') || 'all';
        filterNews(initialTag);
        updateTagFilterUI(initialTag);

        tagFilters.forEach(filter => {
            filter.addEventListener('click', (e) => {
                e.preventDefault();
                const tag = filter.getAttribute('data-tag');
                filterNews(tag);
                updateTagFilterUI(tag);
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

        function updateTagFilterUI(tag) {
            tagFilters.forEach(f => {
                f.classList.remove('font-bold');
            });
            const activeFilter = document.querySelector(`.tag-filter[data-tag="${tag}"]`);
            if (activeFilter) {
                activeFilter.classList.add('font-bold');
            }
        }
    });
</script>