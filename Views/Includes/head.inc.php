<?php

use CMW\Controller\Core\CoreController;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Uploads\ImagesManager;
use CMW\Manager\Views\View;
use CMW\Utils\Website;
use CMW\Model\Core\ThemeModel;

/* @var CoreController $core */
/* @var string $title */
/* @var string $description */
/* @var array $includes */

$siteName = Website::getWebsiteName();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta property="og:title" content=<?= $siteName ?>>
    <meta property="og:site_name" content="<?= $siteName ?>">
    <meta property="og:description" content="<?= Website::getDescription() ?>">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= EnvManager::getInstance()->getValue('PATH_URL') ?>">

    <title><?= Website::getTitle() ?></title>
    <meta name="description" content="<?= Website::getDescription() ?>">

    <meta name="author" content="CraftMyWebsite, <?= $siteName ?>">
    <meta name="publisher" content="<?= $siteName ?>">
    <meta name="copyright" content="CraftMyWebsite, <?= $siteName ?>">
    <meta name="robots" content="follow, index, all"/>


    <!-- Theme style -->
    <link rel="stylesheet" type="text/css"
          href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>Public/Themes/Feather/Assets/Css/animations.css">
    <link rel="stylesheet" type="text/css"
          href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>Public/Themes/Feather/Assets/Css/style.css">
    <link rel="stylesheet"
          href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>Admin/Resources/Vendors/Fontawesome-free/Css/fa-all.min.css">

    <?= ImagesManager::getFaviconInclude() ?>

    <?php View::loadInclude($includes, 'styles'); ?>
</head>
<body class="text-color font-lato flex flex-col min-h-screen mx-2 mt-2" style="background-color: <?= ThemeModel::getInstance()->fetchConfigValue('background-color') ?>">

<?php
View::loadInclude($includes, 'beforeScript');
print CoreController::getInstance()->cmwWarn();
?>
