<?php
/**
 * Provides general purposes functions
 * @author Nicolas Wanner, CFPT
 * @version 1.0, 2021-05-02, Initial revision
 */

initSession();

/**
 * Force the browser to open the given page and exit the script.
 */
function gotoPage($destination) {
    header("Location: $destination");
    exit();
}

/**
 * Display a SELECT OPTION html tag from the given list
 */
function displaySelect($list, $currentValue, $selectName) {
    $html = "";

    foreach($list as $id => $text) {
        $selected = $id == $currentValue ? 'selected' : '';
        $html .= "<option value=\"$id\" $selected>$text</option>\n";
    }

    return "<select name=\"$selectName\">\n$html\n</select>";
}

/**
 * Démarrer la session et initialise les champs lors du 1er appel
 */
function initSession() {
    session_start();

    if (!isset($_SESSION['user'])) {
        $_SESSION = [
            'user' => false,
        ];
    }
}

/**
 * Lire la valeur correspondante à l'utilisateur connecté
 * @return Les infos de l'utilisateur connecté ou false si anonyme.
 */
function getUser() {
    return $_SESSION['user'];
}

/**
 * Modifier la valeur de l'utilisateur (false ou array)
 */
function setUser($user) {
    $_SESSION['user'] = $user;
}

/**
 * Indique si un utilisateur est connecté ou non.
 * @return true quand connecté, false quand déconnecté
 */
function userIsConnected() {
    return getUser() !== false;
}
