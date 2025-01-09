<?php
use CMW\Utils\Website;
?>
</body>

<footer class="mt-auto z-50 bg-black rounded py-2 text-left align-center">
    <div class="ml-2 columns-3">
    <span class="text-white">Copyright © <?= date('Y') ?> -
        Par <a href="https://craftmywebsite.fr"
               class="text-white hover:text-blue-500"
               target="_blank">CraftMyWebsite</a>
        /
        <a href="https://overheat.studio"
           class="text-white hover:text-blue-500"
           target="_blank">Overheat Studio</a>
        <p> <?= Website::getWebsiteName() ?></p>
        <p> <?= Website::getDescription() ?></p>
    </span>
    </div>
    <div class="columns-3">

    </div>
</footer>
</html>