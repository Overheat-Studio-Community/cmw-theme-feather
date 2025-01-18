<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Model\Core\ThemeModel;
use CMW\Utils\Website;

Website::setTitle('Connexion - 2FA');
Website::setDescription('Double authentification');
?>

<div id="contact" class="page-section flex items-center justify-center min-h-screen">
    <div class="flex flex-col border border-gray-200 rounded p-6 w-full max-w-md">
        <h1 class="text-xl font-semibold text-center mb-4">Double facteur d'authentification</h1>
        <form action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') . 'login/validate/tfa' ?>" method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Code d'authentification</label>
                <input id="code"
                       name="code"
                       type="text"
                       maxlength="6"
                       placeholder="123456"
                       required
                       class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2">
            </div>
            <div class="mt-6">
                <button type="submit"
                        class="mb-2 flex items-center justify-center bg-black text-white rounded-lg pl-2 py-2 w-full">
                    Connexion
                </button>
            </div>
        </form>
    </div>
</div>
