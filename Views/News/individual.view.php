<?php

use CMW\Controller\Users\UsersController;
use CMW\Entity\News\NewsEntity;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;
use CMW\Controller\Users\UsersSessionsController;
use CMW\Model\News\NewsModel;
use CMW\Model\News\NewsTagsModel;

/* @var NewsEntity $news */
$firstTag = $news->getTags()[0] ?? null;

$newsLists = new newsModel;
$newsList = $newsLists->getSomeNews(3, 'DESC');

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
        <div class="w-full flex flex-col md:flex-row">
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
                <?php if ($news->getLikes()->userCanLike()): ?>
                    <a href="#" class="like-button text-red-500 whitespace-nowrap"><i class="fa-solid fa-heart"></i></a>
                <?php else: ?>
                    <a href="<?= $news->getLikes()->getSendLike() ?>"
                       class="like-button text-gray-500 whitespace-nowrap"><i
                            class="fa-regular fa-heart"></i></a>
                <?php endif; ?>
            </span>
                    <?php endif; ?>
                </div>
            </article>


            <!-- Barre latérale sticky -->
            <aside class="flex sticky top-8 w-1/4 bg-gray-50 py-2 px-6 md:right-0">
                <div class="mt-2">
                    <h3 class="text-md font-semibold mb-2">À propos de l'auteur</h3>
                    <p class="flex text-gray-600 text-sm">
                        Auteur :
                        <?= $news->getAuthor()->getPseudo() ?>
                    </p>
                    <img class="w-10 h-10 rounded-full" src="
        <?= UsersSessionsController::getInstance()->getCurrentUser()->getUserPicture()?->getImage(); ?>"
                         alt="Image de profil de <?= $news->getAuthor()->getPseudo() ?>">
                </div>
            </aside>
        </div>
        <?php if ($news->isCommentsStatus()): ?>
            <hr>
            <h5 class="text-center">Espace commentaire</h5>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto gap-4">
                <?php foreach ($news->getComments() as $comment): ?>
                    <div class="bg-white border border-gray-100 p-4 rounded-lg">
                        <div>
                            <img class="flex items-center w-8 h-8 rounded-full"
                                 src="<?= $comment->getUser()->getUserPicture()->getImage() ?>"
                                 alt="...">
                        </div>
                        <div class="mt-2">
                            <span class="font-bold"><?= $comment->getUser()->getPseudo() ?></span>
                            <div class="flex flex-col items-center mt-2">
                                <p class="text-sm"><?= $comment->getContent() ?></p>
                                <span class="text-xs text-gray-500">Le : <?= $comment->getDate() ?></span>
                                <div class="mt-2">
                        <span class="text-base"><?= $comment->getLikes()->getTotal() ?>
                            <?php if ($comment->userCanLike()): ?>
                                <a href="#"><i class="fa-solid fa-heart"></i></a>
                            <?php else: ?>
                                <a href="<?= $comment->getSendLike() ?>"><i class="fa-regular fa-heart"></i></a>
                            <?php endif; ?>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>



            <form method="post" action="<?= $news->sendComments() ?>" class="mt-10">
                <?php SecurityManager::getInstance()->insertHiddenToken() ?>
                <div class="flex flex-col">
                    <label for="message">Votre commentaire :</label>
                    <textarea minlength="20" name="comments" id="message"
                              class="border border-gray-100 text-black rounded-lg"
                              placeholder="Bonjour," required>

            </textarea>
                </div>
                <div class="text-center mt-4">
                    <?php if (UsersController::isUserLogged()): ?>
                        <button class="bg-black text-white rounded-lg py-1 px-2 " type="submit">Commenter</button>
                    <?php else: ?>
                        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login">Commenter</a>
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
            $allRelatedNews = NewsTagsModel::getInstance()->getNewsForTagById($firstTag->getId());

            // Trier les articles par date décroissante
            usort($allRelatedNews, function ($a, $b) {
                return strtotime($b->getDateCreated()) - strtotime($a->getDateCreated());
            });

            // Ne garder que les 3 premiers articles
            $relatedNews = array_slice($allRelatedNews, 0, 3);
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