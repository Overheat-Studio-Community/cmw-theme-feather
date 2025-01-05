<?php

/* @var UserEntity $user */

use CMW\Entity\Users\UserEntity;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Double facteur obligatoire');
Website::setDescription("Merci d'activer le 2fa !");
?>


<img width="50%" src='<?= $user->get2Fa()->getQrCode(250) ?>'
     alt="QR Code double authentification">
<span><?= $user->get2Fa()->get2FaSecretDecoded() ?></span>

<form action="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>profile/2fa/toggle"
      method="post">
    <?php SecurityManager::getInstance()->insertHiddenToken() ?>
    <input type="text" hidden="" name="enforce_mail" value="<?= $user->getMail() ?>">
    <div>
        <label for="secret">Code d'authentification</label>
        <input type="text" name="secret" id="secret" required>
    </div>
    <button type="submit">Activer</button>
</form>