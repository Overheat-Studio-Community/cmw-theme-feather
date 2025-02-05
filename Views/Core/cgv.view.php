<?php

use CMW\Utils\Website;

/* @var CMW\Entity\Core\ConditionEntity $cgv */

Website::setTitle('CGV');
Website::setDescription(Website::getWebsiteName() . ' CGV');
?>
<div class="mt-20 bg-gray-100 rounded px-2 py-1 ">
    <div class="font-bold text-lg text-center">Condition générale de Vente<br></div>

    <?= $cgv->getContent() ?><br>
    <?= $cgv->getLastEditor()->getPseudo() ?>
    <?= $cgv->getUpdate() ?>
</div>
