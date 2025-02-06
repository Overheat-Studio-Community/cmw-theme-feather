<?php

use CMW\Utils\Website;
use CMW\Model\Core\ThemeModel;

/* @var CMW\Entity\Core\ConditionEntity $cgu */

Website::setTitle('CGU');
Website::setDescription(Website::getWebsiteName() . ' CGU');
?>
<div class="mt-20 rounded px-2 py-1" style="background-color: <?= ThemeModel::getInstance()->fetchConfigValue('news-bg-color') ?>; color: <?= ThemeModel::getInstance()->fetchConfigValue('news-text-color') ?>">
    <div class="font-bold text-lg text-center">Condition générale d'utilisation<br></div>
    <?= $cgu->getContent() ?><br>
    <?= $cgu->getLastEditor()->getPseudo() ?>
    <?= $cgu->getUpdate() ?>
</div>

