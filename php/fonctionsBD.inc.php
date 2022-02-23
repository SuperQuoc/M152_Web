<?php

require_once 'php/models/database.php';

function getActivites() {
    $param = [];
    $sql   = "SELECT idActivite, nomActivite FROM ACTIVITE";

    // Get the genres as an associative array ['id' => 'genre']
    return dbRun($sql, $param)->fetchAll(PDO::FETCH_KEY_PAIR);

}

function getClasses() {
    $param = [];
    $sql   = "SELECT idClasse, nomClasse FROM CLASSE";

    return dbRun($sql, $param)->fetchAll(PDO::FETCH_KEY_PAIR);

}

/**
 * Insert the activite's in the database
 */
function activiteInsert($nomActivite) {
    dbRun(
        "INSERT INTO ACTIVITE (nomActivite) VALUES (?);",
        [ $nomActivite ]
    );
}

/**
 * Insert the classe's in the database
 */
function classeInsert($nomClasse) {
    dbRun(
        "INSERT INTO CLASSE (nomClasse) VALUES (?);",
        [ $nomClasse ]
    );
}

/**
 * Select a list of activites in the database
 */
//function activiteSelectAll($search = '', $orderBy='', $offset = 0, $limit = PHP_INT_MAX) {
//    $sql   = "SELECT ACTIVITE.idActivite, nomActivite
//                FROM ACTUVUTE
//               WHERE nomActivite
//               $orderBy
//               LIMIT ? OFFSET ?";
//
//    return dbRun($sql,
//        [$limit, $offset])->fetchAll(PDO::FETCH_ASSOC);
//}

/**
 * Select an activite in the database given its ID
 */
function activiteSelectById($id) {
    $param = [ ':id' => $id ];
    $sql   = "SELECT idActivite, nomActivite
                FROM ACTIVITE
               WHERE ACTIVITE.idActivite = :id";
    return dbRun($sql, $param)->fetch(PDO::FETCH_ASSOC);
}

/**
 * Select an classe in the database given its ID
 */
function classeSelectById($id) {
    $param = [ ':id' => $id ];
    $sql   = "SELECT idClasse, nomClasse
                FROM CLASSE
               WHERE CLASSE.idClasse = :id";
    return dbRun($sql, $param)->fetch(PDO::FETCH_ASSOC);
}

/**
 * Update the activite's data
 */
function activiteUpdate($id, $nomActivite) {
    dbRun(
        "UPDATE ACTIVITE SET nomActivite = ? WHERE idActivite = ?",
        [ $nomActivite, $id ]
    );
}

/**
 * Update the classe's data
 */
function classeUpdate($id, $nomClasse) {
    dbRun(
        "UPDATE CLASSE SET nomClasse = ? WHERE idClasse = ?",
        [ $nomClasse, $id ]
    );
}

/**
 * Delete activite by its id
 */
function activiteDeleteById($id) {
    dbRun( "DELETE FROM ACTIVITE WHERE idActivite = ?", [$id] );
}

/**
 * Delete classe by its id
 */
function classeDeleteById($id) {
    dbRun( "DELETE FROM CLASSE WHERE idClasse = ?", [$id] );
}


function inscrireEleveActivite($nom, $prenom, $classe, $choixActivite1, $choixActivite2, $choixActivite3){

    dbRun(
        "INSERT INTO ELEVE (nom, prenom, idClasse) VALUES (?,  ?, ?);",
        [ $nom, $prenom, $classe ]
    );

    $stmt = dbRun(
        "SELECT MAX(idEleve) from ELEVE;"
    );

    $lastId = $stmt->fetchColumn();

    dbRun(
        "INSERT INTO INSCRIRE (idActivite, idEleve, ordrePref) VALUES (?,  ?, ?);",
        [ $choixActivite1, $lastId, 1 ]
    );

    dbRun(
        "INSERT INTO INSCRIRE (idActivite, idEleve, ordrePref) VALUES (?,  ?, ?);",
        [ $choixActivite2, $lastId, 2 ]
    );

    dbRun(
        "INSERT INTO INSCRIRE (idActivite, idEleve, ordrePref) VALUES (?,  ?, ?);",
        [ $choixActivite3, $lastId, 3 ]
    );



}

?>