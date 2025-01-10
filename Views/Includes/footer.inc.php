<?php

use CMW\Utils\Website;
use CMW\Manager\Uploads\ImagesManager;
use CMW\Manager\Env\EnvManager;


?>
</body>

<footer class="z-50 bg-black rounded mb-2 text-left max-w-full max-h-full">
    <div class="mx-4 text-white">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <div class="grid row-cols-3 flex flex-col gap-2">
                <div>
                    <div class="text-2xl">
                        <?= ImagesManager::getFaviconInclude(), Website::getWebsiteName() ?></div>
                    <div class="mt-2 text-sm"><?= Website::getWebsiteDescription() ?></div>

                </div>
                <div class="flex font-bold items-end mb-4 text-sm"">Copyright © <?= date('Y') ?></div>
            </div>
            <div class="space-y-4">
                <div class="font-medium">About</div>
                <div class="bg-transparent text-white opacity-75 space-y-4">
                    <p>About Us</p>
                    <p>Blog</p>
                    <p>Career</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="font-medium">Support</div>
                <div class="bg-transparent text-white opacity-75 space-y-4">
                    <p>Contact Us</p>
                    <p>Return</p>
                    <p>FAQ</p>
                </div>
            </div>
            <div class="grid row-cols-4">
                <div class="font-medium ">Get Updates</div>
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
                <div
                    class="backdrop-blur-sm flex items-center rounded-lg overflow-hidden mt-4"
                    style="background-color: rgba(211,199,188,0.15);">
                    <input
                        type="search"
                        class="flex-grow px-4 py-2 bg-transparent opacity-75 text-white focus:outline-none"
                        placeholder="Enter your email"
                        aria-label="Search"
                        id="exampleFormControlInput2"
                        aria-describedby="button-addon2"
                    />
                    <span class="flex items-center justify-center px-4 bg-transparent"
                          id="button-addon2">
            <i class="fa-solid fa-magnifying-glass text-white"></i>
            </span>
                </div>
                <div class="flex items-center grid grid-cols-2 sm:grid-cols-5 mt-4 space-x-4">
                    <div class="ml-4 flex items-center justify-center w-10 h-10 rounded-full bg-white opacity-50">
                        <img class="rounded-full w-6 h-6 filter grayscale"
                             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/X_logo_2023.svg.webp' ?>"
                             alt="Twitter">
                    </div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white opacity-50">
                        <img class="rounded-full w-6 h-6 filter grayscale"
                             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/ig-icon-template.webp' ?>"
                             alt="Instagram">
                    </div>

                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white opacity-50">
                        <img class="rounded-full w-6 h-6 filter grayscale"
                             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/2023_Facebook_icon.svg.webp' ?>"
                             alt="Facebook">
                    </div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white opacity-50">
                        <img class="rounded-full w-6 h-6 filter grayscale"
                             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/Discord_Logo_sans_texte.svg.png' ?>"
                             alt="Discord">
                    </div>
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white opacity-50">
                        <img class="rounded-full w-6 h-6 filter grayscale"
                             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/tiktok.png' ?>"
                             alt="TikTok">
                    </div>
                </div>
                <div class="flex items-center justify-end font-medium my-4 gap-5">
                    <p>Privacy Policy</p>
                    <p>Terms of Service</p>
                </div>

            </div>
        </div>
    </div>
</footer>
</html>