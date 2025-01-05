<?php

use CMW\Utils\Website;

/* @var CMW\Entity\Core\ConditionEntity $cgu */

Website::setTitle('CGU');
Website::setDescription(Website::getWebsiteName() . ' CGU');
?>

<?= $cgu->getContent() ?><br>
<?= $cgu->getLastEditor()->getPseudo() ?>
<?= $cgu->getUpdate() ?>
