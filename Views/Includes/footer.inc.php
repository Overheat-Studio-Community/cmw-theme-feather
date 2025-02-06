<?php

use CMW\Utils\Website;
use CMW\Manager\Uploads\ImagesManager;
use CMW\Manager\Env\EnvManager;
use CMW\Model\Core\ThemeModel;

$primarycolor = ThemeModel::getInstance()->fetchConfigValue('color-primary');
$secondarycolor = ThemeModel::getInstance()->fetchConfigValue('color-secondary');

$hoverprimarycolor = adjustBrightness($primarycolor, 50);
$hoversecondarycolor = adjustBrightness($secondarycolor, 50);

?>
</body>
<div class="max-h-screen flex bottom-2 flex-col">
    <footer class=" mt-10 bg-black rounded-xl mb-2 text-left max-w-full max-h-full" style="background-color: <?= ThemeModel::getInstance()->fetchConfigValue('footer-color') ?>">
        <div class="mt-4 mx-4 text-white">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <div class="grid row-cols-3 flex flex-col gap-2 col-span-2 md:col-span-1">
                    <div>
                        <div class="font-bold text-2xl" style="color: <?= $primarycolor ?>">
                            <?= ImagesManager::getFaviconInclude(), Website::getWebsiteName() ?></div>
                        <div class="mt-2 text-sm text-[#afafaf]" style="color: <?= $secondarycolor ?>"><?= Website::getWebsiteDescription() ?></div>

                    </div>
                </div>
                <div class="space-y-2">
                    <div class="font-medium" style="color: <?= $primarycolor ?>">About</div>
                    <div class="text-sectionGray space-y-2">
                        <p style="color: <?= $secondarycolor ?>">About Us</p>
                        <p style="color: <?= $secondarycolor ?>">Blog</p>
                        <p style="color: <?= $secondarycolor ?>">Career</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="font-medium" style="color: <?= $primarycolor ?>">Support</div>
                    <div class="text-sectionGray space-y-2">
                        <p style="color: <?= $secondarycolor ?>">Contact Us</p>
                        <p style="color: <?= $secondarycolor ?>">Return</p>
                        <p style="color: <?= $secondarycolor ?>">FAQ</p>
                    </div>
                </div>
                <div class="grid row-cols-4 col-span-2 md:col-span-1 lg:grid-cols-subgrid lg:col-start-2 xl:col-span-1">
                    <div class="font-medium" style="color: <?= $primarycolor ?>">Get Updates</div>
                    <div class="w-[90%] justify-center items-center">
                        <div
                            class="w-full backdrop-blur-sm flex items-center rounded-lg overflow-hidden mt-4" style="background-color: <?= ThemeModel::getInstance()->fetchConfigValue('footer-social-color') ?>">
                            <input
                                type="search"
                                class="flex-grow py-2 bg-transparent opacity-75 text-white focus:outline-none"
                                placeholder="    Enter your email"/>
                            <button class="rounded-md bg-white text-black text-sm px-3 py-2 font-semibold mr-1" style="background-color:<?= ThemeModel::getInstance()->fetchConfigValue('subscribe-bg-color') ?>;color:<?= ThemeModel::getInstance()->fetchConfigValue('subscribe-text-color') ?>">
                                Subscribe
                            </button>
                        </div>


                        <div class="flex justify-items-center justify-between gap-1 sm:grid-cols-5 mt-4">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: <?= $secondarycolor ?>">
                                <i class="fa-brands fa-instagram" style="color: <?= ThemeModel::getInstance()->fetchConfigValue('social-color')?>"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: <?= $secondarycolor ?>">
                                <i class="fa-brands fa-twitter" style="color: <?= ThemeModel::getInstance()->fetchConfigValue('social-color')?>"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: <?= $secondarycolor ?>">
                                <i class="fa-brands fa-facebook" style="color: <?= ThemeModel::getInstance()->fetchConfigValue('social-color')?>"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: <?= $secondarycolor ?>">
                                <i class="fa-brands fa-discord" style="color: <?= ThemeModel::getInstance()->fetchConfigValue('social-color')?>"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full" style="background-color: <?= $secondarycolor ?>">
                                <i class="fa-brands fa-tiktok" style="color: <?= ThemeModel::getInstance()->fetchConfigValue('social-color')?>"></i>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="flex sm:flex-row flex-col-reverse justify-between items-center my-4">
                <div class="sm:flex font-medium items-end text-sm" style="color: <?= $secondarycolor ?>">
                    ©<?= date('Y'), " ", Website::getWebsiteName() ?>. All rights reserved.
                </div>
                <div class=""  style="color: <?= $secondarycolor ?>">
                    Conditions Générales
                    <b>
                        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cgu"
                           style="color: inherit; text-decoration: none; transition: color 0.3s;"
                           onmouseover="this.style.color='<?= $hoversecondarycolor ?>'"
                           onmouseout="this.style.color='<?= $secondarycolor ?>'">Utilisation</a>
                    </b>
                    /
                    <b>
                        <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cgv"
                           style="color: inherit; text-decoration: none; transition: color 0.3s;"
                           onmouseover="this.style.color='<?= $hoversecondarycolor ?>'"
                           onmouseout="this.style.color='<?= $secondarycolor ?>'">Vente</a>
                    </b>
                </div>

                <div class="flex items-center justify-end font-medium gap-5 text-sectionGray">
                    <p style="color: <?= $secondarycolor ?>">Privacy Policy</p>
                    <p style="color: <?= $secondarycolor ?>">Terms of Service</p>
                </div>
            </div>
        </div>
    </footer>
</div>
</html>