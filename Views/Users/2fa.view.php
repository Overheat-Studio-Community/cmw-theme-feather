<?php

use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Connexion - 2FA');
Website::setDescription('Double authentification');
?>


<form action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') . 'login/validate/tfa' ?>" method="post">
    <?php SecurityManager::getInstance()->insertHiddenToken() ?>
    <input id="code" class="form-control" name="code" type="text" placeholder="123456" maxlength="7" required>
    <label for="code">Code d'authentification</label>
    <button type="submit">Connexion</button>
</form>
