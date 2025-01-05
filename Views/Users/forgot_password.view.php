<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Mot de passe oublié');
Website::setDescription('Retrouvez votre mot de passe');
?>

<h1>Mot de passe oublié</h1>
<form action="" method="post">
    <?php SecurityManager::getInstance()->insertHiddenToken() ?>
    <div>
        <label for="email">Email : </label>
        <input type="email" name="mail" id="mail" placeholder="<?= LangManager::translate('users.users.mail') ?>">
    </div>
    <button type="submit"><?= LangManager::translate('users.login.forgot_password.btn') ?></button>
</form>

