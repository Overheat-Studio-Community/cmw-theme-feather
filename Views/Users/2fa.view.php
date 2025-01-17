<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Connexion - 2FA');
Website::setDescription('Double authentification');
?>

<div class="flex-grow flex items-center justify-center">
    <div class="my-2 flex flex-col border border-gray-100 rounded w-full max-w-md">
        <h1 class="mt-2 flex justify-center">Connexion en double authentification</h1>
        <form class="flex flex-col" action=""
              action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') . 'login/validate/tfa' ?>"
              method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <div class="relative w-full max-w-sm w-full mx-auto mt-4 my-2">
                <label for="mt-4 my-2">Code d'authentification</label>
                <input class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2"
                       id="code"
                       name="code"
                       type="text"
                       placeholder="123456"
                       maxlength="7"
                       required>

                <button class="mb-2 flex items-center justify-center bg-black text-white rounded-lg pl-2 py-2 w-full"
                        type="submit">Connexion
                </button>
            </div>
        </form>
    </div>
</div>
