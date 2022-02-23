<?php
/**
 * General purposes database functions
 * This work was largely inspired from https://phpdelusions.net/pdo/pdo_wrapper
 * @author Nicolas Wanner, CFPT
 * @version 1.0, 2021-04-16, initial revision
 */
require_once 'php/models/config.php';

function db() {
    // La variable est "static" pour qu'elle continue d'exister
    // même quand la fonction db() se termine.
    static $myDb = null;

    // On doit rentrer dans le if seulement au premier appel de la fonction
    if ( $myDb === null ) {
        $myDb = new PDO(
            "mysql:host=". DB_HOST .";dbname=". DB_NAME .";charset=utf8",
            DB_USER, DB_PASS
        );

        // On configure le fonctionnement de PDO
        $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // Retourne l'objet PDO pour accéder à la base
    return $myDb;
}

function dbRun($sql, $args = NULL) {
    //echo "<p>$sql</p>";
    //var_dump($args);

    // Exécuter la commande SQL directement s'il n'y a pas d'arguments
    if (!$args) {
        return db()->query($sql);
    }

    // Préparer la requête et l'exécuter avec les arguments
    $statement = db()->prepare($sql);
    $statement->execute($args);

    // Retourner le résultat de l'exécution. On peut l'utiliser pour faire un fetch avec
    return $statement;
}
