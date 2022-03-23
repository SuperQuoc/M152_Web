<?php
session_start();

require_once 'php/models/medias.php';

$postList = postSelectAll();
$mediaList = mediaSelectAll();

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
                            <li class="uk-active">
                                <a href="index.php" uk-icon="home"></a>
                            </li>
                            <li class="">
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

            <button class="uk-button uk-button-primary uk-float-right contact-button">Nous contacter</button>

        </div>

        <hr>

        <div class="uk-container">

            <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center" uk-grid>

                <?php if (isset($postList)) { ?>

                    <?php foreach ($postList as $post) { ?>

                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    <div class="uk-card-badge"><a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a>
                                        <a href="#modal-delete-id<?= $post['idPost']?>" class="uk-icon-link" uk-toggle uk-icon="trash"></a>
                                    </div>
                                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                                        <div class="uk-width-auto">
                                            <img class="uk-border-circle" width="40" height="40" src="images/CFPT Profile.png">
                                        </div>
                                        <div class="uk-width-expand">
                                            <h3 class="uk-card-title uk-margin-remove-bottom">Id Post : <?= $post['idPost'] ?></h3>
                                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="<?= $post['creationDate'] ?>"><?= $post['creationDate'] ?></time></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-card-body">
                                    <div class="uk-card-media-bottom">
                                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>

                                            <ul class="uk-slideshow-items">
                                                <?php foreach ($mediaList as $media) {
                                                    if ($media['idPost'] == $post['idPost']) {
                                                ?>
                                                        <li>
                                                            <?php if (strpos($media['typeMedia'], "image") !== false) { ?>
                                                                <img src="uploads/<?= $media['nomMedia'] ?>" alt="" uk-cover>
                                                            <?php } else if (strpos($media['typeMedia'], "video") !== false) { ?>
                                                                <video src="uploads/<?= $media['nomMedia'] ?>" loop muted playsinline uk-video="autoplay: inview"></video>
                                                            <?php } else if (strpos($media['typeMedia'], "audio") !== false) { ?>
                                                                <audio src="uploads/<?= $media['nomMedia']?>" controls></audio>
                                                            <?php } ?>
                                                        </li>

                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>

                                            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                                            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                                        </div>
                                    </div>

                                </div>
                                <div class="uk-card-footer">
                                    <p><?= $post['commentaire'] ?></p>
                                </div>
                            </div>

                            <div id="modal-delete-id<?=$post['idPost']?>" uk-modal>
                                <div class="uk-modal-dialog uk-modal-body">
                                    <h2 class="uk-modal-title">êtes vous sur ?</h2>
                                    <p>Voulez vous réelement supprimer ce poste ?</p>
                                    <p class="uk-text-right">

                                    <form action="delete.php" method="post">
                                        <input type="hidden" id="idPost" name="idPost" value="<?= $post['idPost'] ?>">
                                        <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
                                        <input class="uk-button uk-button-primary" type="submit" value="Confirmer" name="delete">
                                    </form>
                                    </p>
                                </div>
                            </div>

                        </div>

                    <?php } ?>

                <?php } ?>

            </div>

        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit.min.js" integrity="sha512-OZ9Sq7ecGckkqgxa8t/415BRNoz2GIInOsu8Qjj99r9IlBCq2XJlm9T9z//D4W1lrl+xCdXzq0EYfMo8DZJ+KA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit-icons.min.js" integrity="sha512-hcz3GoZLfjU/z1OyArGvM1dVgrzpWcU3jnYaC6klc2gdy9HxrFkmoWmcUYbraeS+V/GWSgfv6upr9ff4RVyQPw==" crossorigin="anonymous"></script>
</body>

</html>