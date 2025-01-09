<?php

use CMW\Controller\Users\UsersController;
use CMW\Manager\Env\EnvManager;
use CMW\Model\Core\MenusModel;
use CMW\Utils\Website;

$menus = MenusModel::getInstance();
?>

<nav class="bg:transparent text-white dark:text-gray-300 absolute w-full">
    <div class="flex justify-between items-center mt-2 mr-6">
        <div class="text-lg text-black sm:text-white font-bold ">
            <?= Website::getWebsiteName() ?>
        </div>

        <ul class="hidden lg:flex space-x-4">
            <?php foreach ($menus->getMenus() as $menus): ?>
                <?php if ($menus->isUserAllowed()): ?>
                    <li <?php if ($menus->urlIsActive()) {
                        echo 'text-blue-500';
                    } ?>>
                        <a href="<?= $menus->getUrl() ?>" <?= !$menus->isTargetBlank() ?: "target='_blank'" ?>
                           class="hover:text-gray-300"><?= $menus->getName() ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <div class="hidden md:flex items-center border border-gray-300 rounded-lg overflow-hidden">
            <input
                type="search"
                class="flex-grow px-4 py-2 text-white bg-gray-100 focus:outline-none"
                placeholder="Search destination..."
                aria-label="Search"
                id="exampleFormControlInput2"
                aria-describedby="button-addon2"
            />
            <span
                class="flex items-center justify-center px-4 bg-gray-200"
                id="button-addon2"
            >
        <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
    </span>
        </div>

        <div class="hidden lg:flex flex items-center gap-4">
            <div>
                <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin"
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
        </div>
        <div class="flex lg:hidden flex flex-col justify-center bg-white">
            <div class="relative">
                <nav x-data="{ open: false }">
                    <!-- Bouton burger -->
                    <button class="text-gray-500 w-10 h-10 relative focus:outline-none" @click="open = !open">
                        <span class="sr-only">Open main menu</span>
                        <div class="block w-5 absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <span aria-hidden="true"
                              class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                              :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
                            <span aria-hidden="true"
                                  class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                  :class="{'opacity-0': open }"></span>
                            <span aria-hidden="true"
                                  class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out"
                                  :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
                        </div>
                    </button>
                    <!-- Menu -->
                    <ul x-show="open"
                        x-transition
                        class="absolute text-center	flex-col space-y-4 mt-4 bg-gray-300 transform transition-transform duration-500 ease-in-out"
                        :class="{'-translate-x-12': open, 'translate-x-0': !open}">


                        <li><a href="#" class="text-gray-500">Home</a></li>
                        <li><a href="#" class="text-gray-500">About</a></li>
                        <li><a href="#" class="text-gray-500">Services</a></li>
                        <li>
                            <div>
                                <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin"
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
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</nav>
