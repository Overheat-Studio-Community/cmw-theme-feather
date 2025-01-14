<?php

use CMW\Controller\Users\UsersController;
use CMW\Controller\Users\UsersSessionsController;
use CMW\Manager\Env\EnvManager;
use CMW\Model\Core\MenusModel;
use CMW\Utils\Website;


$subfolder = EnvManager::getInstance()->getValue('PATH_SUBFOLDER');
$usersession =UsersSessionsController::getInstance()->getCurrentUser();
$userlog = UsersController::isUserLogged();
$menus = MenusModel::getInstance();
?>

<nav class="z-50 text-white absolute w-full top-0 left-0">
    <div class="absolute inset-0 bg-black/25 blur-xl"></div>
    <!-- Titre & différentes Catégories -->
    <div class="flex justify-between items-center mt-3 mx-4 relative">
        <div id="navbar-elements" class="text-sm sm:text-lg text-black sm:text-white font-bold text-nowrap">
            <?= Website::getWebsiteName() ?>
        </div>
        <ul class="hidden lg:flex space-x-4">
            <?php foreach ($menus->getMenus() as $menu): ?>
                <?php if ($menu->isUserAllowed()): ?>
                    <li>
                        <a href="<?= $menu->getUrl() ?>" <?= !$menu->isTargetBlank() ?: "target='_blank'" ?>
                           class="hover:text-gray-300"><?= $menu->getName() ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <!-- Recherche -->
        <div class="sm:bg-white max-w-[400px] justify-center flex items-center rounded-lg overflow-hidden"
             id="search-container">

            <input type="search"
                class="hidden sm:flex sm:flex-grow px-4 py-2 text-black focus:outline-none transition-all duration-300 max-w-[200px] w-full"
                placeholder="Search" aria-label="Search" id="search-input" aria-describedby="button-addon2"/>
            <span class="hidden sm:flex items-center justify-center px-4 cursor-pointer">
                <i class="fa-solid fa-magnifying-glass text-black"></i>
            </span>

            <span class="sm:hidden flex items-center justify-center px-4 cursor-pointer" id="button-addon2" onclick="toggleSearchBar()">
                <i class="fa-solid fa-magnifying-glass text-black"></i>
            </span>
            <!-- Croix de fermeture -->
            <span
                class="hidden flex items-center justify-center px-4 cursor-pointer text-black"
                id="close-search-btn"
                onclick="closeSearchBar()"
            >
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>

        <!-- Profile -->
        <?php if ($userlog): ?>
            <div class="flex flex-col gap-4 relative">
                <div class="flex items-center gap-2 cursor-pointer" id="profile-toggle">
                    <span class="text-white hidden sm:flex" id="navbar-elements">
                        <?= $usersession->getPseudo(); ?>
                    </span>
                    <img id="navbar-elements" class="w-8 h-8 rounded-full"
                         src="<?= $usersession?->getUserPicture()?->getImage(); ?>"
                         alt="User Profile">
                </div>
            </div>
            <!-- Menu Profile -->
            <div class="w-full sm:transform absolute mt-20 right-0">
                <div id="profile-menu"
                     class="z-50 hidden flex w-full sm:max-w-[16rem] sm:ml-auto flex-col bg-white shadow-lg rounded mt-20 right-0
                     transition duration-300 ease-in-out transform scale-95 opacity-0">
                    <a href="<?= $subfolder ?>profile"
                       class="block px-4 py-2 text-black hover:bg-gray-100">
                        <i class="fa-regular fa-address-card"></i> Profile
                    </a>
                    <a href="<?= $subfolder ?>cmw-admin"
                       class="block px-4 py-2 text-black hover:bg-gray-100">
                        <i class="fa-solid fa-screwdriver-wrench"></i> Administration
                    </a>
                    <a href="<?= $subfolder ?>logout"
                       class="block px-4 py-2 text-newred hover:bg-gray-100">
                        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="hidden md:flex gap-2">
                <a href="<?= $subfolder ?>register"
                   class="bg-white hover:bg-white text-blue-500 py-2 px-4 rounded">
                    Sign Up
                </a>
                <a href="<?= $subfolder ?>login"
                   class="bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded">
                    Connexion
                </a>
            </div>
        <?php endif; ?>

        <div class="z-50 flex lg:hidden flex-col justify-center">
            <div>
                <nav>
                    <!-- Bouton burger -->
                    <button id="burger-toggle"
                            class="text-gray-500 sm:text-white w-10 h-10 relative focus:outline-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <!-- Menu -->
                    <div id="burger-menu" class="hidden w-full sm:transform absolute top-15 right-0">
                        <ul class="w-full sm:flex-row sm:max-w-[16rem] sm:ml-auto flex-col space-y-4 bg-white p-4 shadow-lg rounded right-0">
                            <div class="justify-center justify-content-center gap-2 text-black">
                                <a href="<?= $menu->getUrl() ?>" <?= !$menu->isTargetBlank() ?: "target='_blank'" ?>
                                   class="hover:text-gray-300"><?= $menu->getName() ?></a>
                                <?php if (!$userlog): ?>
                                    <div class="flex mt-4 gap-2 md:hidden">
                                        <a href="<?= $subfolder ?>register"
                                           class="bg-white/50 text-blue-500 py-2 px-4 rounded">
                                            Sign Up
                                        </a>
                                        <a href="<?= $subfolder ?>login"
                                           class="bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded">
                                            Connexion
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Gestion de l'affichage du menu avec animation
        const toggle = document.getElementById('profile-toggle');
        const menu = document.getElementById('profile-menu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('scale-95');
            menu.classList.toggle('opacity-0');
        });

        // Cacher le menu lorsque l'utilisateur clique ailleurs
        document.addEventListener('click', (event) => {
            if (!toggle.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden', 'scale-95', 'opacity-0');
            }
        });

        // Afficher/masquer le menu burger
        const burgerToggle = document.getElementById('burger-toggle');
        const burgerMenu = document.getElementById('burger-menu');

        burgerToggle.addEventListener('click', () => {
            burgerMenu.classList.toggle('hidden');
        });

        // Cacher le menu burger si l'utilisateur clique ailleurs
        document.addEventListener('click', (event) => {
            if (!burgerToggle.contains(event.target) && !burgerMenu.contains(event.target)) {
                burgerMenu.classList.add('hidden');
            }
        });

        // Fonction pour afficher la barre de recherche
        const searchToggle = document.getElementById('button-addon2');
        const searchInput = document.getElementById('search-input');
        const closeBtn = document.getElementById('close-search-btn');
        const navbarElements = document.getElementById('navbar-elements');
        const searchContainer = document.getElementById('search-container');

        // Afficher la barre de recherche et cacher les boutons profile-toggle et burger-toggle
        searchToggle.addEventListener('click', () => {
            searchInput.classList.remove('hidden');
            searchInput.focus();
            closeBtn.classList.remove('hidden');
            searchContainer.classList.add('absolute', 'top-0', 'left-0', 'w-full', 'bg-white', 'opacity-100');
            navbarElements.classList.add('hidden');
            burgerMenu.classList.add('hidden');
            toggle.classList.add('hidden');
            burgerToggle.classList.add('hidden');
        });

        // Fermer la barre de recherche et réafficher les boutons profile-toggle et burger-toggle
        closeBtn.addEventListener('click', () => {
            searchInput.classList.add('hidden');
            closeBtn.classList.add('hidden');
            searchContainer.classList.remove('absolute', 'top-0', 'left-0', 'w-full', 'bg-white', 'opacity-100');
            navbarElements.classList.remove('hidden');
            burgerMenu.classList.remove('hidden');
            toggle.classList.remove('hidden');
            burgerToggle.classList.remove('hidden');
        });
    });
</script>