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
            <div
                uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent;">
                <nav class="uk-navbar-container uk-navbar-transparent navbar" uk-navbar="dropbar: false;"
                    style="height: 60px; background: white;">
                    <div class="uk-navbar-left">

                        <a class="uk-logo" href="#"><img class="uk-border-circle"
                                data-src="https://www.facebook.com/images/fb_icon_325x325.png" width="32" height="32"
                                alt="" uk-img></a>

                        <form class="uk-search uk-search-navbar uk-background-muted formSearch">
                            <span uk-search-icon></span>
                            <input class="uk-search-input uk-background-muted inputSearch" type="search"
                                placeholder="Rechercher sur Facebook">
                        </form>

                    </div>
                    <div class="uk-navbar-center">

                        <ul class="uk-navbar-nav">
                            <li class="uk-active">
                                <a href="index.php" uk-icon="home"></a>
                            </li>
                            <li class="navItem">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit.min.js"
        integrity="sha512-OZ9Sq7ecGckkqgxa8t/415BRNoz2GIInOsu8Qjj99r9IlBCq2XJlm9T9z//D4W1lrl+xCdXzq0EYfMo8DZJ+KA=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/js/uikit-icons.min.js"
        integrity="sha512-hcz3GoZLfjU/z1OyArGvM1dVgrzpWcU3jnYaC6klc2gdy9HxrFkmoWmcUYbraeS+V/GWSgfv6upr9ff4RVyQPw=="
        crossorigin="anonymous"></script>
</body>

</html>