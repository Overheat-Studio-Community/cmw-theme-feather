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

    <ul class="flex space-x-4">
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

    <div class="flex items-center gap-4">
        <?php if (UsersController::isUserLogged() && UsersController::isAdminLogged()): ?>
            <div>
                <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>cmw-admin" target="_blank"
                   class="bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded">
                    Panel Admin
                </a>
            </div>
        <?php else: ?>
            <div>
                <a href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login"
                   class="bg-blue-500 hover:bg-blue-600 py-2 px-4 rounded">
                    Connexion
                </a>
            </div>
        <?php endif; ?>
    </div>
</nav>
