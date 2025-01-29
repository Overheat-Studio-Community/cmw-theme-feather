<?php

use CMW\Controller\Users\UsersController;
use CMW\Entity\News\NewsEntity;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;
use CMW\Controller\Users\UsersSessionsController;
use CMW\Model\News\NewsModel;
use CMW\Model\News\NewsTagsModel;

$subfolder = EnvManager::getInstance()->getValue('PATH_SUBFOLDER');

/* TITRE ET DESCRIPTION */
Website::setTitle($news->getTitle());
Website::setDescription($news->getDescription());
?>
<section class="pb-1 mt-20 flex justify-center">
    <section class="flex w-full max-w-5xl flex-col gap-6 text-black">
        Blog / <?= $news->getTitle() ?>
        <p class="text-3xl text-black"><?= $news->getTitle() ?></p>
        <div class="flex justify-center">
            <img src="<?= $news->getImageLink() ?>" class="rounded-lg w-auto" alt="<?= $news->getTitle() ?>">
        </div>
        <div class="flex flex-col md:flex-row">
            <!-- Contenu principal -->
            <article class="flex-1 flex flex-col space-y-4">
                <div class="article-content break-words overflow-hidden text-wrap max-w-xl">
                    <p class="text-wrap"><?= $news->getContent() ?></p>
                </div>

                <!-- Section des likes -->
                <div>
                    <?php if ($news->isLikesStatus()): ?>
                        <span class="flex items-center gap-2 text-gray-700">
                            <span class="like-count whitespace-nowrap"><?= $news->getLikes()->getTotal() ?></span>
                            <?php if (UsersController::isUserLogged()): ?>
                                <?php if ($news->getLikes()->userCanLike()): ?>
                                    <a href="#" class="like-button text-gray-500 whitespace-nowrap"><i
                                            class="fa-solid fa-thumbs-up"></i></a>
                                <?php else: ?>
                                    <a href="<?= $news->getLikes()->getSendLike() ?>"
                                       class="like-button text-gray-500 whitespace-nowrap"><i
                                            class="fa-regular fa-thumbs-up"></i></a>
                                <?php endif; ?>
                            <?php else: ?>

                                <a class="text-gray-500"
                                   href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login"><i
                                        class="fa-regular fa-thumbs-up"></i></a>
                            <?php endif; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </article>

            <!-- Barre latérale sticky -->
            <aside class="top-20">
                <div class=" mt-2 fixed py-2 px-6 rounded max-h-10">
                    <h3 class="text-md font-semibold mb-2">À propos de l'auteur</h3>
                    <div class="flex text-gray-600 items-center gap-2 text-sm">
                        <img class="w-8 h-8 rounded-full"
                             src="<?= $news->getAuthor()?->getUserPicture()?->getImage() ?: EnvManager::getInstance()->getValue("DEFAULT_PROFILE_PICTURE") ?>"
                             alt="Image de profil de <?= $news->getAuthor()->getPseudo() ?>">
                        <?= $news->getAuthor()->getPseudo() ?>
                    </div>
                </div>
            </aside>
        </div>

        <?php if ($news->isCommentsStatus()): ?>
            <hr>
            <h5 class="text-center">Espace commentaire</h5>

            <?php foreach ($news->getComments() as $comment): ?>
                <div class="bg-white border border-gray-100 p-4 rounded-lg">
                    <div class="flex align-center items-center gap-2">
                        <img class="flex items-center w-8 h-8 rounded-full"
                             src="<?= $comment->getUser()->getUserPicture()->getImage() ?>"
                             alt="...">
                        <div class="flex align-center flex-col">
                            <span class="font-bold"><?= $comment->getUser()->getPseudo() ?></span>
                            <span class="text-xs text-gray-500">Le : <?= $comment->getDate() ?></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-col items-left mt-2">
                            <article
                                class="break-words text-wrap whitespace-normal text-sm"><?= $comment->getContent() ?></article>
                            <div class="mt-2">
                                <span class="text-base"><?= $comment->getLikes()->getTotal() ?>

                                    <?php if (UsersController::isUserLogged()): ?>
                                        <?php if ($comment->userCanLike()): ?>
                                            <a href="#" class="text-gray-500 whitespace-nowrap"><i
                                                    class="fa-solid fa-thumbs-up"></i></a>
                                        <?php else: ?>
                                            <a href="<?= $comment->getSendLike() ?>"
                                               class="text-gray-500 whitespace-nowrap"><i
                                                    class="fa-regular fa-thumbs-up"></i></a>
                                        <?php endif; ?>
                                    <?php else: ?>

                                        <a class="text-gray-500"
                                           href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login"><i
                                                class="fa-regular fa-thumbs-up"></i></a>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <form method="post" action="<?= $news->sendComments() ?>" class="mt-10">
                <?php SecurityManager::getInstance()->insertHiddenToken() ?>
                <div class="flex flex-col">
                    <label for="message">Votre commentaire :</label>
                    <textarea minlength="20" name="comments" id="message"
                              class="border border-gray-100 text-black rounded-lg"
                              placeholder="Bonjour," required></textarea>
                </div>
                <div class="text-center mt-4">
                    <?php if (UsersController::isUserLogged()): ?>
                        <button class="bg-black text-white rounded-lg py-1 px-2 " type="submit">Commenter</button>
                    <?php else: ?>
                        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login">Connectez-vous pour
                            commenter</a>
                    <?php endif; ?>
                </div>
            </form>
        <?php endif; ?>

        Vous aimerez peut-être aussi :
        <?php
        // Récupérer le premier tag de l'article
        $firstTag = $news->getTags()[0] ?? null;

        // Initialiser un tableau pour les articles associés
        $relatedNews = [];
        if ($firstTag) {
            // Récupérer tous les articles liés à ce tag
            $allRelatedNews = NewsTagsModel::getInstance()->getNewsForTagById($firstTag->getId(), 4, 'DESC');

            // Trier les articles par date décroissante
            usort($allRelatedNews, function ($a, $b) {
                return strtotime($b->getDateCreated()) - strtotime($a->getDateCreated());
            });

            // Exclure l'article actuellement affiché
            $filteredNews = array_filter($allRelatedNews, function ($related) use ($news) {
                return $related->getSlug() !== $news->getSlug();
            });

            // Ne garder que les 3 premiers articles après l'exclusion
            $relatedNews = array_slice($filteredNews, 0, 3);
        }
        ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto">
            <?php foreach ($relatedNews as $related): ?>
                <div class="flex gap-0 justify-between sm:gap-4 md:gap-4 mb-5">
                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>news/<?= $related->getSlug() ?>"
                       class="block w-[90%] rounded-lg overflow-hidden mx-auto relative">
                        <img class="w-full h-48 object-cover"
                             src="<?= $related->getImageLink() ?>"
                             alt="<?= $related->getTitle() ?>">
                        <div class="p-4">
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                <?= $related->getDateCreated() ?>
                            </span>
                            <h2 class="text-lg font-semibold text-gray-800 mt-2">
                                <?= $related->getTitle() ?>
                            </h2>
                            <p class="text-sm text-gray-600 mt-2">
                                <?= $related->getDescription() ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const aside = document.querySelector('aside');
        const article = document.querySelector('article');
        const mdBreakpoint = 768; // Assuming 'md' breakpoint is 768px

        function updateAsidePosition() {
            const articleRect = article.getBoundingClientRect();
            const asideRect = aside.getBoundingClientRect();

            if (window.innerWidth >= mdBreakpoint) {
                if (articleRect.bottom <= 0) {
                    aside.style.display = 'none';
                } else {
                    aside.style.display = 'block';
                    if (articleRect.top < 0) {
                        aside.style.position = 'fixed';
                        aside.style.top = '20px';
                    } else {
                        aside.style.position = 'absolute';
                        aside.style.top = 'initial';
                    }
                    aside.style.right = `${window.innerWidth - articleRect.right + 20}px`;
                }
            } else {
                aside.style.position = 'absolute';
                aside.style.top = 'initial';
                aside.style.right = 'initial';
                aside.style.display = 'block';
            }
        }

        if (window.innerWidth >= mdBreakpoint) {
            window.addEventListener('scroll', updateAsidePosition);
            window.addEventListener('resize', updateAsidePosition);
            updateAsidePosition();
        }
    });
</script>