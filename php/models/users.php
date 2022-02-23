<?php
/**
 * Provides access to the users table in the database
 * @author Nicolas Wanner, CFPT
 * @version 1.0, 2020-10-17, Initial revision
 */

require_once 'php/models/database.php';

/**
 * Effectuer une requête à la DB par rapport au informations fournies.
 */
function readUserByLogin($name, $password) {
    // Hacher le mot de passe avec sha-1
    $hashPassword = sha1($password);

    // Rechercher dans DB l'utilisateur avec name et password
    $sql = "SELECT `idUtilisateurs`, `Pseudo`
              FROM `UTILISATEURS`
             WHERE `Pseudo` = ? AND `motDePasse` = ?";
    $param = [$name, $hashPassword];
 
    // Retourner le résultat de la recherche
    return dbRun($sql, $param)->fetch(PDO::FETCH_ASSOC);
}

/**
* Connecte l'utilisateur si les informations sont correctes.
*/
function userLogin($name, $password) {
    // Lire l'utilisateur dans la base de données
    $user = readUserByLogin($name, $password);

    // Enregistrer le resultat dans la session
    setUser($user);

    // Retourne l'état de connexion
    return userIsConnected();
}