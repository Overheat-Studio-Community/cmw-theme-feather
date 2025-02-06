<?php

use CMW\Manager\Security\SecurityManager;
use CMW\Model\Core\ThemeModel;
use CMW\Controller\Core\PackageController;

?>
<!-- Doc: https://craftmywebsite.fr/docs/fr/technical/creer-un-theme/config -->
<div class="tab-menu">
    <ul class="tab-horizontal" data-tabs-toggle="#tab-content-config">
        <!-- Php if -->
        <button type="button" data-tabs-target="#tab1" role="tab">Global</button>
        <button type="button" data-tabs-target="#tab2" role="tab">Haut de page</button>
        <button type="button" data-tabs-target="#tab3" role="tab">Pied de page</button>
        <button type="button" data-tabs-target="#tab4" role="tab">HomePage</button>
        <button type="button" data-tabs-target="#tab5" role="tab">News</button>
        <button type="button" data-tabs-target="#tab6" role="tab">Blog</button>


    </ul>
</div>

<div id="tab-content-config">

    <!--En tête et Global-->
    <div class="tab-content" id="tab1">
        <?php SecurityManager::getInstance()->insertHiddenToken(); ?>
        <h1>Global ( S'applique sur toutes les pages )</h1>
        <h5>Couleur de fond</h5>
        <input
            type="color" name="background-color" id="background-color"
            value="<?= ThemeModel::getInstance()->fetchConfigValue('background-color') ?>">

        <h5>Couleur primaire ( Titres / Textes à mettre en avant )</h5>
        <input
            type="color" name="color-primary" id="color-primary"
            value="<?= ThemeModel::getInstance()->fetchConfigValue('color-primary') ?>">

        <h5>Couleur secondaire ( Textes / Boutons )</h5>
        <input
            type="color" name="color-secondary" id="color-secondary"
            value="<?= ThemeModel::getInstance()->fetchConfigValue('color-secondary') ?>">

        <input type="hidden" name="hover-primary-color" id="hover-primary-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('hover-primary-color') ?>">

        <h5>Couleur des boutons primaires</h5>
        <input
            type="color" name="color-primary-button" id="color-primary-button"
            value="<?= ThemeModel::getInstance()->fetchConfigValue('color-primary-button') ?>">

        <h5>Couleur des boutons secondaires</h5>
        <input
            type="color" name="color-primary-button" id="color-secondary-button"
            value="<?= ThemeModel::getInstance()->fetchConfigValue('color-secondary-button') ?>">
    </div>


    <div class="tab-content" id="tab4">
        <h1>Titre</h1>
        <div class="items-center">

            <h5>Texte du titre</h5>
            <input type="text" name="title-text" id="title-text"
                   value="<?= ThemeModel::getInstance()->fetchConfigValue('title-text') ?>">
        </div>

        <div>
            <h1>Description</h1>
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


    <div class="tab-content" id="tab5">
        <h1>News</h1>
        <h5>Couleur de fond du texte ( S'applique sur les CGU & CGV )</h5>
        <input type="color" name="news-bg-color" id="news-bg-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('news-bg-color') ?>">
        <h5>Couleur du texte ( S'applique sur les CGU & CGV )</h5>
        <input type="color" name="news-text-color" id="news-text-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('news-text-color') ?>">
    </div>


    <div class="tab-content" id="tab3">
        <h1>Pied de page</h1>
        <h5>Couleur de fond du pied de page</h5>
        <input type="color" name="footer-color" id="footer-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-color') ?>">
        <h5> Couleur des titres du pied de page</h5>
        <input type="color" name="footer-title-color" id="footer-title-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-title-color') ?>">
        <h5>Couleur des textes du pied de page</h5>
        <input type="color" name="footer-text-color" id="footer-text-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-text-color') ?>">
        <h5>Couleur des textes au survol</h5>
        <input type="color" name="footer-clickable-text" id="footer-clickable-text"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-clickable-text') ?>">
        <h5>Couleur de fond des réseaux sociaux</h5>
        <input type="color" name="footer-social-color" id="footer-social-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('footer-social-color') ?>">
        <h5>Couleur des réseaux sociaux</h5>
        <input type="color" name="social-color" id="social-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('social-color') ?>">
        <h5>Couleur de fond du bouton subscribe ( newsletter )</h5>
        <input type="color" name="subscribe-bg-color" id="subscribe-bg-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('subscribe-bg-color') ?>">
        <h5>Couleur du texte du bouton subscribe ( newsletter )</h5>
        <input type="color" name="subscribe-text-color" id="subscribe-text-color"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('subscribe-text-color') ?>">
    </div>


    <div class="tab-content" id="tab6">
        <h1>Blog</h1>
        <h5>Titre de section</h5>
        <input type="text" name='title-page-blog' id='title-page-blog'
               value="<?= ThemeModel::getInstance()->fetchConfigValue('title-page-blog') ?>">
        <h5>Description de section</h5>
        <input type="text" name='description-text-blog' id='description-text-blog'
               value="<?= ThemeModel::getInstance()->fetchConfigValue('description-text-blog') ?>">
        <h5>Couleur de fond des articles</h5>
        <input type="color" name="bg-card" id="bg-card"
               value="<?= ThemeModel::getInstance()->fetchConfigValue('bg-card') ?>">
    </div>


    <div class="tab-content" id="tab2">
        <h1>Haut de page</h1>
        <h5>Logo</h5>
        <div class="grid-2">
            <div class="flex justify-center">
                <img class="w-25" src="<?= ThemeModel::getInstance()->fetchImageLink("header_img_logo") ?>"
                     alt="Image introuvable !">
            </div>
            <div class="drop-img-area mt-4" data-input-name="header_img_logo"></div>
        </div>
        <div>
            <label class="toggle">
                <p class="toggle-label">Titre : <i data-bs-toggle="tooltip"
                                                   title="Vous pouvez l'afficher ou le masqué"
                                                   class="fa-sharp fa-solid fa-circle-question"></i></p>
                <input type="checkbox" class="toggle-input" name="header_active_title"
                       id="header_active_title" <?= ThemeModel::getInstance()->fetchConfigValue('header_active_title') ? 'checked' : '' ?>>
                <div class="toggle-slider"></div>
            </label>
        </div>
        <div>
            <label class="toggle">
                <p class="toggle-label">Logo : <i data-bs-toggle="tooltip"
                                                  title="Vous pouvez l'afficher ou le masqué"
                                                  class="fa-sharp fa-solid fa-circle-question"></i></p>
                <input type="checkbox" class="toggle-input" id="header_active_logo"
                       name="header_active_logo" <?= ThemeModel::getInstance()->fetchImageLink('header_active_logo') ? 'checked' : '' ?>>
                <div class="toggle-slider"></div>
            </label>
        </div>
        <div class="grid-3">
            <div class="col card me-2">
                <div class="icon-picker" data-id="feature_img_1" data-name="feature_img_1" data-label="Icon :"
                     data-placeholder="Sélectionner un icon"
                     data-value="<?= ThemeModel::getInstance()->fetchConfigValue("feature_img_1") ?>"></div>
                <div class="form-group">
                    <label>Titre :</label>
                    <input class="input text-center" type="text" id="feature_title_1" name="feature_title_1"
                           value="<?= ThemeModel::getInstance()->fetchConfigValue('feature_title_1') ?>">
                </div>
            </div>
            <div class="col card me-2">
                <div class="icon-picker" data-id="feature_img_2" data-name="feature_img_2" data-label="Icon :"
                     data-placeholder="Sélectionner un icon"
                     data-value="<?= ThemeModel::getInstance()->fetchConfigValue("feature_img_2") ?>"></div>
                <div class="form-group">
                    <label>Titre :</label>
                    <input class="input text-center" type="text" id="feature_title_2" name="feature_title_2"
                           value="<?= ThemeModel::getInstance()->fetchConfigValue('feature_title_2') ?>">
                </div>
            </div>
            <div class="col card me-2">
                <div class="icon-picker" data-id="feature_img_3" data-name="feature_img_3" data-label="Icon :"
                     data-placeholder="Sélectionner un icon"
                     data-value="<?= ThemeModel::getInstance()->fetchConfigValue("feature_img_3") ?>"></div>
                <div class="form-group">
                    <label>Titre :</label>
                    <input class="input text-center" type="text" id="feature_title_3" name="feature_title_3"
                           value="<?= ThemeModel::getInstance()->fetchConfigValue('feature_title_3') ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hoveradjust(hex, steps) {
        // Convert HEX to RGB
        hex = hex.replace('#', '');
        let r = parseInt(hex.substring(0, 2), 16);
        let g = parseInt(hex.substring(2, 4), 16);
        let b = parseInt(hex.substring(4, 6), 16);

        // Adjust each channel
        r = Math.max(0, Math.min(255, r + steps));
        g = Math.max(0, Math.min(255, g + steps));
        b = Math.max(0, Math.min(255, b + steps));

        // Convert back to HEX
        return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase()}`;
    }

</script>

