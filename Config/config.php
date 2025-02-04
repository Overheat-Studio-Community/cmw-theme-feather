<?php

use CMW\Manager\Security\SecurityManager;
use CMW\Model\Core\ThemeModel;
use CMW\Controller\Core\PackageController;

?>
<!-- Doc: https://craftmywebsite.fr/docs/fr/technical/creer-un-theme/config -->
<div class="tab-menu">
    <ul class="tab-horizontal" data-tabs-toggle="#tab-content-1">
        <button data-tabs-target="#tab1" role="tab">Global</button>
        <button data-tabs-target="#tab5" role="tab">Haut de page</button>
        <button data-tabs-target="#tab4" role="tab">Pied de page</button>
        <button data-tabs-target="#tab2" role="tab">HomePage</button>
        <button data-tabs-target="#tab3" role="tab">News</button>
        <button data-tabs-target="#tab6" role="tab">Blog</button>


    </ul>
</div>

<div id="tab-content-1">
</div>
<!--
En tête et Global
-->
<div class="tab-content" id="tab1">
    <?php SecurityManager::getInstance()->insertHiddenToken(); ?>
    <h1>Global ( S'applique sur toutes les pages )</h1>
    <h5>Couleur de fond</h5>
    <input
        type="color" name="background-color" id="background-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('background-color') ?>">

    <h5>Logo</h5>
    <div class="form-group">
        <label>Logo global</label>
        <img class="w-25" src="<?= ThemeModel::getInstance()->fetchImageLink("logo-global") ?>"
             alt="Image introuvable !">
    </div>
</div>
<div class="tab-content" id="tab2">
    <h1>Titre</h1>
    <div class="items-center">
        <h5>Couleur du titre</h5>
        <input class=""
               type="color" name="title-color" id="title-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('title-color') ?>">

        <h5>Texte du titre</h5>
        <input type="text" name="title-text" id="title-text"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('title-text') ?>">
    </div>

    <div>
        <h1>Description</h1>
        <h5>Couleur de la description</h5>

        <input class=""
               type="color" name="description-color" id="description-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('description-color') ?>">
        <h5>Texte de la description</h5>

        <input type="text" name="description-text" id="description-text"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('description-text') ?>">

    </div>
    <div>
        <h5>Image de fond</h5>
        <div class="grid-2">
            <div class="flex justify-center">
                <img class="w-25" src="<?= ThemeModel::getInstance()->fetchImageLink("img-hero") ?>"
                     alt="Image introuvable !">
            </div>
            <div class="drop-img-area mt-4" data-input-name="img-hero"></div>
        </div>
    </div>
</div>
<div class="tab-content" id="tab3">
    <h1>News</h1>
    <h5>Couleur de fond du texte</h5>
    <input class=""
           type="color" name="news-bg-color" id="news-bg-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('news-bg-color') ?>">
    <h5>Couleur du texte</h5>
    <input class=""
           type="color" name="news-text-color" id="news-text-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('news-text-color') ?>">

</div>

<div class="tab-content" id="tab4">
    <h1>Pied de page</h1>
    <h5>Couleur de fond du pied de page</h5>
    <input class=""
           type="color" name="footer-color" id="footer-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-color') ?>">
    <h5> Couleur des titres du pied de page</h5>
    <input class=""
           type="color" name="footer-title-color" id="footer-title-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-title-color') ?>">
    <h5>Couleur des textes du pied de page</h5>
    <input class=""
           type="color" name="footer-text-color" id="footer-text-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-text-color') ?>">
    <h5>Couleur des textes au survol</h5>
    <input class=""
           type="color" name="footer-clickable-text" id="footer-clickable-text"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-clickable-text') ?>"
    >
    <h5>Couleur de fond des réseaux sociaux</h5>
    <input class=""
           type="color" name="footer-social-color" id="footer-social-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-social-color') ?>">

    <h5>Couleur des réseaux sociaux</h5>
    <input class=""
           type="color" name="social-color" id="social-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('social-color') ?>">

    <h5>Couleur de fond du bouton subscribe ( newsletter )</h5>
    <input class=""
           type="color" name="subscribe-bg-color" id="subscribe-bg-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('subscribe-bg-color') ?>">

    <h5>Couleur du texte du bouton subscribe ( newsletter )</h5>
    <input class=""
           type="color" name="subscribe-text-color" id="subscribe-text-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('subscribe-text-color') ?>">
</div>
<div class="tab-content" id="tab6">
    <h1>Blog</h1>
</div>
<div class="tab-content" id="tab5">
    <h1>Haut de page</h1>
    <h5>Couleur de fond de la navbar</h5>
    <input class=""
           type="color" name="header-bg-color" id="header-bg-color"
           value="<?= ThemeModel::getInstance()->fetchConfigValue('header-bg-color') ?>">

    <h5>Couleur de la searchbar</h5>
    <input
        type="color" name="search-bar-color" id="search-bar-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('search-bar-color') ?>">

    <h5>Couleur des textes dans la navbar</h5>
    <input
        type="color" name="navbar-text-color" id="navbar-text-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('navbar-text-color') ?>">

    <h5>Couleur des textes dans la navbar au survol</h5>
    <input
        type="color" name="navbar-text-hover-color" id="navbar-text-hover-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('navbar-text-hover-color') ?>">


    <h5>Couleur des titres de la searchbar</h5>
    <input
        type="color" name="element-search-title-color" id="element-search-title-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('element-search-title-color') ?>">
    <h5>Couleur des textes de la searchbar</h5>
    <input
        type="color" name="element-search-text-color" id="element-search-text-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('element-search-text-color') ?>">

    <h5>Couleur de background au survol</h5>
    <input
        type="color" name="element-search-hover-color" id="element-search-hover-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('element-search-hover-color') ?>">

    <h5>Couleur de fond lors du clique sur le profile</h5>
    <input
        type="color" name="profile-bg-color" id="profile-bg-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('profile-bg-color') ?>">

    <h5>
        Couleur du texte du profile
    </h5>
    <input
        type="color" name="profile-text-color" id="profile-text-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('profile-text-color') ?>">

    <h5>
        Couleur de fond du profile au survol
    </h5>
    <input
        type="color" name="profile-hover-color" id="profile-hover-color"
        value="<?= ThemeModel::getInstance()->fetchConfigValue('profile-hover-color') ?>">

    <div class="grid-3">
        <div class="col card me-2">
            <div class="icon-picker" data-id="feature_img_1" data-name="feature_img_1" data-label="Icon :"
                 data-placeholder="Sélectionner un icon"
                 data-value="<?= ThemeModel::getInstance()->fetchConfigValue("feature_img_1") ?>"></div>
            <div class="form-group">
                <label>Titre :</label>
                <input class="input text-center" type="text" id="feature_title_1"
                       name="feature_title_1"
                       value="<?= ThemeModel::getInstance()->fetchConfigValue('feature_title_1') ?>">
            </div>
        </div>
        <div class="col card me-2">
            <div class="icon-picker" data-id="feature_img_2" data-name="feature_img_2" data-label="Icon :"
                 data-placeholder="Sélectionner un icon"
                 data-value="<?= ThemeModel::getInstance()->fetchConfigValue("feature_img_2") ?>"></div>
            <div class="form-group">
                <label>Titre :</label>
                <input class="input text-center" type="text" id="feature_title_2"
                       name="feature_title_2"
                       value="<?= ThemeModel::getInstance()->fetchConfigValue('feature_title_2') ?>">
            </div>
        </div>
        <div class="col card me-2">
            <div class="icon-picker" data-id="feature_img_3" data-name="feature_img_3" data-label="Icon :"
                 data-placeholder="Sélectionner un icon"
                 data-value="<?= ThemeModel::getInstance()->fetchConfigValue("feature_img_3") ?>"></div>
            <div class="form-group">
                <label>Titre :</label>
                <input class="input text-center" type="text" id="feature_title_3"
                       name="feature_title_3"
                       value="<?= ThemeModel::getInstance()->fetchConfigValue('feature_title_3') ?>">
            </div>
        </div>
    </div>
</div>
