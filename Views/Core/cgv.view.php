<?php

use CMW\Utils\Website;

/* @var CMW\Entity\Core\ConditionEntity $cgv */

Website::setTitle('CGV');
Website::setDescription(Website::getWebsiteName() . ' CGV');
?>
<div class="mt-20 rounded px-2 py-1" style="background-color: <?= ThemeModel::getInstance()->fetchConfigValue('news-bg-color') ?>; color: <?= ThemeModel::getInstance()->fetchConfigValue('news-text-color') ?>">
    <div class="font-bold text-lg text-center">Condition générale de Vente<br></div>

    <?= $cgv->getContent() ?><br>
    <?= $cgv->getLastEditor()->getPseudo() ?>
    <?= $cgv->getUpdate() ?>
</div>
