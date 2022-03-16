<?php
session_start();
require_once __DIR__ . '/inc/flash.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/css/uikit.min.css" />
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php flash('upload') ?>
    <header>
        <div class="uk-card uk-card-body uk-box-shadow-small cardHeader" style="z-index: 980;">
            <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent;">
                <nav class="uk-navbar-container uk-navbar-transparent navbar" uk-navbar="dropbar: false;" style="height: 60px; background: white;">
                    <div class="uk-navbar-left">

                        <a class="uk-logo" href="#"><img class="uk-border-circle" data-src="https://www.facebook.com/images/fb_icon_325x325.png" width="32" height="32" alt="" uk-img></a>

                        <form class="uk-search uk-search-navbar uk-background-muted formSearch">
                            <span uk-search-icon></span>
                            <input class="uk-search-input uk-background-muted inputSearch" type="search" placeholder="Rechercher sur Facebook">
                        </form>

                    </div>
                    <div class="uk-navbar-center">

                        <ul class="uk-navbar-nav">
                            <li class="">
                                <a href="index.php" uk-icon="home"></a>
                            </li>
                            <li class="uk-active">
                                <a href="post.php" uk-icon="comment"></a>
                            </li>
                        </ul>

                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav">
                            <li class="">
                                <a href="" uk-icon="">Se connecter</a>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="uk-container">

        <div class="uk-cover-container uk-height-large">
            <img src="images/CFPT_Banner.jpg" alt="" class=" cfpt_banner" uk-cover>
        </div>

        <div class="uk-container">

            <img class="uk-border-circle profile" src="images/CFPT Profile.png" width="132" height="132" alt="">

            <span class="uk-text-bolder uk-text-left uk-text-middle uk-text-large uk-text-emphasis">Centre de Formation Professionnelle et Technique d'Informatique</span>

            <button class="uk-button uk-button-primary uk-float-right contact-button" uk-toggle="target: #post-modal-center">Publier</button>

            <div id="post-modal-center" class="uk-flex-top" uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical uk-card uk-card-default uk-width-1-2@m">
                    <button class="uk-modal-close-default uk-close-large" type="button" uk-close></button>
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="40" height="40" src="images/CFPT Profile.png">
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom">Créer une publication</h3>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">

                        <form action="upload.php" method="POST" enctype="multipart/form-data">
                            <fieldset class="uk-fieldset">

                                <div class="uk-margin">
                                    <textarea class="uk-textarea" rows="3" placeholder="Que voulez-vous dire ?" name="comment"></textarea>
                                </div>

                                <div class="uk-margin">
                                    <div uk-form-custom>
                                        <input type="file" multiple name="medias_uploads[]" id="medias_uploads" accept="image/*,video/*,audio/*">
                                        <button class="uk-button uk-button-default" type="button" tabindex="-1">Ajouter des médias <span uk-icon="upload"></span></button>

                                    </div>
                                </div>
                                <input class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" value="Publier" name="submit">
                            </fieldset>
                        </form>
                        
                    </div>

                </div>
            </div>

        </div>

        <hr>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit.min.js" integrity="sha512-OZ9Sq7ecGckkqgxa8t/415BRNoz2GIInOsu8Qjj99r9IlBCq2XJlm9T9z//D4W1lrl+xCdXzq0EYfMo8DZJ+KA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit-icons.min.js" integrity="sha512-hcz3GoZLfjU/z1OyArGvM1dVgrzpWcU3jnYaC6klc2gdy9HxrFkmoWmcUYbraeS+V/GWSgfv6upr9ff4RVyQPw==" crossorigin="anonymous"></script>
</body>

</html>