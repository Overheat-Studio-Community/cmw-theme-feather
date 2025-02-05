<?php

use CMW\Utils\Website;

/* @var CMW\Entity\Core\ConditionEntity $cgu */

Website::setTitle('CGU');
Website::setDescription(Website::getWebsiteName() . ' CGU');
?>
<div class="mt-20 bg-gray-100 rounded px-2 py-1 ">
    <div class="font-bold text-lg text-center">Condition générale d'utilisation<br></div>
    <?= $cgu->getContent() ?><br>
    <?= $cgu->getLastEditor()->getPseudo() ?>
    <?= $cgu->getUpdate() ?>
</div>

