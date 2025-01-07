<?php

use CMW\Controller\Users\UsersController;
use CMW\Manager\Env\EnvManager;
use CMW\Model\Core\MenusModel;
use CMW\Utils\Website;

$menus = MenusModel::getInstance();
?>

<nav class="bg-gray-300 dark:bg-gray-800 text-gray-800 dark:text-gray-300 p-4 flex justify-between items-center">
    <div class="text-lg font-bold">
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
                <ul x-show="open" x-transition class="flex flex-col space-y-4 mt-4">

                    <li><a href="#" class="text-gray-500">Home</a></li>
                    <li><a href="#" class="text-gray-500">About</a></li>
                    <li><a href="#" class="text-gray-500">Services</a></li>
                    <li><div>
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
                        </div></li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <div class="hidden lg:flex lg:gap-x-12">
        <input
            type="search"
            class="relative m-0 block flex-auto rounded border border-solid border-neutral-200 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-surface outline-none transition duration-200 ease-in-out placeholder:text-neutral-500 focus:z-[3] focus:border-primary focus:shadow-inset focus:outline-none motion-reduce:transition-none dark:border-white/10 dark:text-white dark:placeholder:text-neutral-200 dark:autofill:shadow-autofill dark:focus:border-primary"
            placeholder="Search"
            aria-label="Search"
            id="exampleFormControlInput2"
            aria-describedby="button-addon2"/>
        <span
            class="flex items-center whitespace-nowrap px-3 py-[0.25rem] text-surface dark:border-neutral-400 dark:text-white [&>svg]:h-5 [&>svg]:w-5"
            id="button-addon2">
   <i class="fa-solid fa-magnifying-glass"></i>
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
</nav>
