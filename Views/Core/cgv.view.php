<?php

use CMW\Utils\Website;

/* @var CMW\Entity\Core\ConditionEntity $cgv */

Website::setTitle('CGV');
Website::setDescription(Website::getWebsiteName() . ' CGV');
?>

<?= $cgv->getContent() ?><br>
<?= $cgv->getLastEditor()->getPseudo() ?>
<?= $cgv->getUpdate() ?>
