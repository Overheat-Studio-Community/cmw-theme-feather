<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Mot de passe oublié');
Website::setDescription('Retrouvez votre mot de passe');
?>
<div class="flex-grow flex items-center justify-center">
    <div class="my-2 flex flex-col border border-gray-100 rounded w-full max-w-md">
        <h1 class="mt-2 flex justify-center">Mot de passe oublié</h1>
        <form class="flex flex-col" action="" method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <div class="relative w-full max-w-sm w-full mx-auto mt-4 my-2">
                <label for="email">Email</label>
                <input
                    class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2"
                    type="email"
                    name="mail"
                    id="mail"
                    placeholder="<?= LangManager::translate('users.users.mail') ?>"
                />

                <button
                    class="mb-2 flex items-center justify-center bg-black text-white rounded-lg pl-2 py-2 w-full"
                    type="submit">Envoyer
                </button>
            </div>
        </form>
    </div>
</div>
