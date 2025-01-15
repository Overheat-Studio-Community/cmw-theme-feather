<?php

use CMW\Controller\Core\SecurityController;
use CMW\Interface\Users\IUsersOAuth;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Model\Core\ThemeModel;
use CMW\Utils\Website;

/* @var IUsersOAuth[] $oAuths */
$subfolder = EnvManager::getInstance()->getValue('PATH_SUBFOLDER');

Website::setTitle('Connexion');
Website::setDescription('Connectez-vous à votre compte ' . Website::getWebsiteName());
?>
<style>
    /* Appliquer le border-radius uniquement à la checkbox */
    #login_keep_connect {
        border-radius: 0.375rem;;
        width: 16px; /* Ajustez la taille si nécessaire */
        height: 16px;
        appearance: none; /* Supprime le style par défaut */
        background-color: #fff; /* Couleur de fond */
        border: 1px solid #000000; /* Bordure personnalisée */
        cursor: pointer;
    }

    /* Style pour l'état coché */
    #login_keep_connect:checked {
        background-color: #000000; /* Couleur de fond lorsqu'elle est cochée */
        border-color: #000000;
    }

    /* Optionnel : Ajouter un effet au survol */
    #login_keep_connect:hover {
        border-color: #000000;
    }
</style>
<div class="mt-20 mb-2 grid grid-cols-1 lg:grid-cols-2 gap-4">
    <!-- Colonne 1 : Image -->
    <div class="hidden lg:block max-h-full relative">
        <img class="w-full rounded object-cover aspect-square lg:aspect-auto h-full"
             alt="Background"
             src="<?= EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'Public/Themes/Feather/Assets/Img/photo-background.png' ?>">
        <div class="absolute bottom-5 left-5 text-white text-shadow-lg flex flex-col items-start z-10">
            <h2 class="text-2xl font-bold">Mon dressing</h2>
            <p class="leading-4 text-base mt-2 max-w-md">Découvrez mon dressing sous tous ses ensembles</p>
        </div>
        <div class="absolute inset-0 bg-black/25"></div>
    </div>

    <!-- Colonne 2 : Formulaire -->
    <div>
        <form class="min-w-full flex my-1 justify-center flex-col" action="" method="post">
            <div class="flex align-center justify-center text-4xl font-extrabold">Se connecter</div>
            <div class="mt-4 flex align-center justify-center items-center text-sm text-gray-400">
                Entrez votre adresse mail et votre mot de passe pour accéder à votre compte
            </div>
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <input hidden name="previousRoute" type="text"
                   value="<?= $_SERVER['HTTP_REFERER'] ?? (EnvManager::getInstance()->getValue('PATH_SUBFOLDER') . 'login') ?>">
            <div class="relative w-full max-w-sm mx-auto mt-4 my-2">
                <label for="login_email">Email</label>
                <input class="relative w-full bg-gray-100 rounded-lg pl-2 py-2 my-2"
                       id="login_email" name="login_email" type="email"
                       placeholder="Enter your email" required>

                <div class="relative w-full rounded-lg mx-auto py-2">
                    <label for="login_password" class="mb-1">Password</label>
                    <div class="relative w-full">
                        <input
                            class="bg-gray-100 rounded-lg w-full pr-10 pl-2 py-2 my-2"
                            id="login_password"
                            type="password"
                            name="login_password"
                            placeholder="Enter your password"
                            required
                        >
                        <button
                            type="button"
                            id="toggle_password"
                            class="absolute inset-y-0 right-0 flex items-center px-2 focus:outline-none"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mx-2">
                    <div class="flex my-2 items-center sm:justify-around flex-col sm:flex-row gap-2">
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                id="login_keep_connect"
                                name="login_keep_connect">
                            <label for="login_keep_connect">Remember me</label>
                        </div>
                        <a class="text-blue-500 sm:ml-auto"
                           href="<?= EnvManager::getInstance()->getValue('PATH_SUBFOLDER') ?>login/forgot">
                            Forgot password
                        </a>
                    </div>
                </div>

                <?php foreach ($oAuths as $oAuth): ?>
                    <div>
                        <a href="oauth/<?= $oAuth->methodIdentifier() ?>"
                           aria-label="<?= $oAuth->methodeName() ?>">
                            <img src="<?= $oAuth->methodeIconLink() ?>"
                                 alt="<?= $oAuth->methodeName() ?>" width="32" height="32"/>
                        </a>
                    </div>
                <?php endforeach; ?>
                <?php SecurityController::getPublicData(); ?>
                <button
                    class="flex items-center justify-center bg-black text-white rounded-lg py-2 mx-auto w-full"
                    type="submit">
                    Sign In
                </button>
                <div class="flex justify-center gap-2 mt-10">
                    Don't have an account?
                    <a href="<?= $subfolder ?>register"
                       class="font-bold">
                        Sign Up
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('login_password');
    const togglePasswordButton = document.getElementById('toggle_password');

    togglePasswordButton.addEventListener('click', () => {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the button's icon
        togglePasswordButton.innerHTML = type === 'password'
            ? '<i class="fa-regular fa-eye"></i>'
            : '<i class="fa-regular fa-eye-slash"></i>';
    });
</script>
