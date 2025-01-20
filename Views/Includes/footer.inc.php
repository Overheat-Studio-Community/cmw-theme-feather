<?php

use CMW\Utils\Website;
use CMW\Manager\Uploads\ImagesManager;
use CMW\Manager\Env\EnvManager;


?>
</body>
<div class="max-h-screen flex bottom-2 flex-col">
    <footer class=" mt-10 bg-black rounded-xl mb-2 text-left max-w-full max-h-full">
        <div class="mt-4 mx-4 text-white">
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <div class="grid row-cols-3 flex flex-col gap-2 col-span-2 md:col-span-1">
                    <div>
                        <div class="font-bold text-2xl">
                            <?= ImagesManager::getFaviconInclude(), Website::getWebsiteName() ?></div>
                        <div class="mt-2 text-sm text-[#afafaf]"><?= Website::getWebsiteDescription() ?></div>

                    </div>
                </div>
                <div class="space-y-2">
                    <div class="font-medium">About</div>
                    <div class="text-sectionGray space-y-2">
                        <p>About Us</p>
                        <p>Blog</p>
                        <p>Career</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="font-medium">Support</div>
                    <div class="text-sectionGray space-y-2">
                        <p>Contact Us</p>
                        <p>Return</p>
                        <p>FAQ</p>
                    </div>
                </div>
                <div class="grid row-cols-4 col-span-2 md:col-span-1 lg:grid-cols-subgrid lg:col-start-2 xl:col-span-1">
                    <div class="font-medium ">Get Updates</div>
                    <div class="w-[90%] justify-center items-center">
                        <div
                            class="w-full backdrop-blur-sm flex items-center rounded-lg overflow-hidden mt-4 bg-customGray border border-[#3d3d3d]">
                            <input
                                type="search"
                                class="flex-grow py-2 bg-transparent opacity-75 text-white focus:outline-none"
                                placeholder="    Enter your email"/>
                            <button class="rounded-md bg-white text-black text-sm px-3 py-2 font-semibold mr-1">
                                Subscribe
                            </button>
                        </div>


                        <div class="flex justify-items-center justify-between gap-1 sm:grid-cols-5 mt-4">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-customGray">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-customGray">
                                <i class="fa-brands fa-twitter"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-customGray">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-customGray">
                                <i class="fa-brands fa-discord"></i>
                            </div>
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-customGray">
                                <i class="fa-brands fa-tiktok"></i>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="flex sm:flex-row flex-col-reverse justify-between items-center my-4">
                <div class="sm:flex font-medium items-end text-sm">
                    ©<?= date('Y'), " ", Website::getWebsiteName() ?>. All rights reserved.
                </div>
                <div class="flex items-center justify-end font-medium gap-5 text-sectionGray">
                    <p>Privacy Policy</p>
                    <p>Terms of Service</p>
                </div>
            </div>
        </div>
    </footer>
</div>
</html>