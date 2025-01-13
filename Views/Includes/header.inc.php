<?php

use CMW\Controller\Users\UsersController;
use CMW\Controller\Users\UsersSessionsController;
use CMW\Manager\Env\EnvManager;
use CMW\Model\Core\MenusModel;
use CMW\Utils\Website;

$menus = MenusModel::getInstance();
?>
<!-- <i class="fa-solid fa-gear"></i> -->
<!--  -->
<nav class="z-50 text-white absolute w-full top-0 left-0">
    <div class="absolute inset-0 bg-black/25 blur-xl"></div>
    <div class="flex justify-between items-center mt-3 mx-4 relative">
        <div class="text-lg text-black sm:text-white font-bold">
            <?= Website::getWebsiteName() ?>
        </div>

        <ul class="hidden lg:flex space-x-4">
            <?php foreach ($menus->getMenus() as $menus): ?>
                <?php if ($menus->isUserAllowed()): ?>
                    <li>
                        <a href="<?= $menus->getUrl() ?>" <?= !$menus->isTargetBlank() ?: "target='_blank'" ?>
                           class="hover:text-gray-300"><?= $menus->getName() ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <div
            class="backdrop-blur-sm flex items-center rounded-lg overflow-hidden"
            style="background-color: rgba(211,199,188,0.15);">
            <input
                type="search"
                class="flex-grow px-4 py-2 bg-transparent opacity-100 text-white focus:outline-none"
                placeholder="Search destination..."
                aria-label="Search"
                id="exampleFormControlInput2"
                aria-describedby="button-addon2"
            />
            <span class="flex items-center justify-center px-4 bg-transparent"
                  id="button-addon2">
            <i class="fa-solid fa-magnifying-glass text-white"></i>
            </span>
        </div>
        <div class="hidden lg:flex flex items-center gap-4">
            <?php if (UsersController::isAdminLogged()) : ?>
                <div>
                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin"
                       class="gap-2 select-none inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background 2 disabled:pointer-events-none  h-10 mt-2 text-black rounded-lg transition-all px-3 py-2 w-full text-center bg-amber-50/10 hover:bg-amber-50/20">
                        <i class="fa-solid fa-screwdriver-wrench"> </i>
                        Administration
                    </a>
                </div>
            <?php endif; ?>
            <?php if (!UsersController::isUserLogged()): ?>
                <div>
                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>register"
                       class="bg-white hover:bg-white text-blue-500 py-2 px-4 rounded">
                        Sign Up
                    </a>
                </div>
                <div>
                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login"
                       class="bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded">
                        Connexion
                    </a>
                </div>
            <?php endif; ?>
            <?php if (UsersController::isUserLogged()):
                echo(UsersSessionsController::getInstance()->getCurrentUser()->getPseudo());
                ?>
                <img class="w-8 h-8 rounded-full"
                     src="<?= UsersSessionsController::getInstance()->getCurrentUser()?->getUserPicture()?->getImage() ?>"
            <?php endif; ?>
        </div>
        <?php if (UsersController::isUserLogged()): ?>
            <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>profile"
               class="gap-2 select-none inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 mt-2 text-amber-50 hover:text-amber-200 rounded-lg transition-all px-3 py-2 w-full text-center bg-amber-50/10 hover:bg-amber-50/20">
                <i class="fa-regular fa-address-card"></i>
                Profile
            </a>
            <div
                class="gap-2 items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 mt-2 rounded-lg transition-all px-3 py-2 w-full text-center bg-amber-50/10">
                <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>logout"
                   class="bg-transparent text-black rounded align-center items-center">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Déconnexion
                </a>
            </div>
        <?php endif; ?>

        <?php if (UsersController::isUserLogged()): ?>
    </div>
    <?php endif ?>
        <div class="z-50 flex lg:hidden flex-col justify-center">

            <div>
                <nav x-data="{ open: false }">
                    <!-- Bouton burger -->
                    <button class="text-gray-500 sm:text-white  w-10 h-10 relative focus:outline-none"
                            @click="open = !open">
                        <span class="sr-only">Open main menu</span>
                        <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <span aria-hidden="true"
                          class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                          :class="{'rotate-45': open, '-translate-y-1.5': !open}"></span>
                            <span aria-hidden="true"
                                  class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                  :class="{'opacity-0': open}"></span>
                            <span aria-hidden="true"
                                  class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                  :class="{'-rotate-45': open, 'translate-y-1.5': !open}"></span>
                        </div>
                    </button>
                    <!-- Menu -->
                    <div class="w-full sm:transform absolute top-15 right-0">
                        <ul x-show="open"
                            x-transition:enter="transition transform ease-out duration-300"
                            x-transition:enter-start="-translate-y-full opacity-0"
                            x-transition:enter-end="translate-y-0 opacity-100"
                            x-transition:leave="transition transform ease-in duration-300"
                            x-transition:leave-start="translate-y-0 opacity-100"
                            x-transition:leave-end="-translate-y-full opacity-0"
                            class="w-full sm:flex-row sm:max-w-[16rem] sm:ml-auto flex-col space-y-4 bg-white p-4 shadow-lg rounded right-0">
                            <div class="justify-center justify-content-center gap-2 text-black">
                                <a href="<?= $menus->getUrl() ?>" <?= !$menus->isTargetBlank() ?: "target='_blank'" ?>
                                   class="hover:text-gray-300"><?= $menus->getName() ?></a>
                            </div>
                            <!--
                            <div class="justify-center justify-content-center gap-2">
                                <div class="flex items-center justify-center gap-2 text-black">
                                    <?php if (UsersController::isUserLogged()):
                                        echo(UsersSessionsController::getInstance()->getCurrentUser()->getPseudo());
                                        ?>
                                        <img class="w-8 h-8 gap-3 rounded-full"
                                             src="<?= UsersSessionsController::getInstance()->getCurrentUser()?->getUserPicture()?->getImage() ?>"
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php if (UsersController::isAdminLogged()) : ?>
                                <li>

                                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin"
                                       class="gap-2 select-none inline-flex items-center whitespace-nowrap text-sm font-medium ring-offset-background 2 disabled:pointer-events-none  h-10 mt-2 text-black rounded-lg transition-all px-3 py-2 w-full bg-amber-50/10 hover:bg-amber-50/20">
                                        <i class="fa-solid fa-screwdriver-wrench"> </i>
                                        Administration
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (UsersController::isUserLogged()): ?>
                                <li>
                                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>profile"
                                       class="gap-2 select-none inline-flex items-center whitespace-nowrap text-sm font-medium ring-offset-background 2 disabled:pointer-events-none  h-10 mt-2 text-black rounded-lg transition-all px-3 py-2 w-full bg-amber-50/10 hover:bg-amber-50/20">
                                        <i class="fa-regular fa-address-card"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>logout"
                                       class="gap-2 select-none inline-flex items-center whitespace-nowrap text-sm font-medium ring-offset-background 2 disabled:pointer-events-none  h-10 mt-2 text-black rounded-lg transition-all px-3 py-2 w-full bg-amber-50/10 hover:bg-amber-50/20">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            Déconnexion
                                        </a>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if (!UsersController::isUserLogged()): ?>
                                <li>
                                    <div>
                                        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>register"
                                           class="bg-white hover:bg-white text-blue-500 py-2 px-4 rounded">
                                            Sign Up
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login"
                                           class="bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded">
                                            Connexion
                                        </a>
                                    </div>
                                </li>
                            <?php endif; ?>
                            -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
</nav>
