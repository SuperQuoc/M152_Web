<?php
/**
 * Provides access to the medias table in the database
 * @author Nicolas Wanner, CFPT
 * @version 1.0, 2020-10-17, Initial revision
 */

require_once 'php/models/database.php';

/**
 * Insert the media's in the database
 */
function mediaInsert($typeMedia, $nomMedia) {
    dbRun(
        "INSERT INTO M152db.MEDIA (typeMedia, nomMedia, idPost) VALUES (?,  ?, (SELECT MAX(idPost) FROM POST ));",
        [ $typeMedia, $nomMedia ]
    );
}

/**
 * Insert the post's in the database
 */
function postInsert($commentaire) {
    dbRun(
        "INSERT INTO M152db.POST (commentaire) VALUES (?);",
        [ $commentaire ]
    );
}

/**
 * Select a list of MEDIAS in the database
 */
function mediaSelectAll() {
    $sql   = "SELECT *
                FROM M152db.MEDIA ";

    return dbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function postSelectAll() {
    $sql = "SELECT *
    FROM M152db.POST";
    return dbRun($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function mediaSelectAllByPostId($id) {
    $param = [ ':id' => $id ];
    $sql   = "SELECT nomMedia
                FROM MEDIA
               WHERE MEDIA.idPost = :id";
    return dbRun($sql, $param)->fetchAll(PDO::FETCH_ASSOC);
}

function postDeleteById($id) {
    dbRun( "DELETE FROM POST WHERE idPost = ?", [$id] );
}

function mediaDeleteById($id) {
    dbRun( "DELETE FROM MEDIA WHERE idPost = ?", [$id] );
}




function bookSelectAll($search = '', $orderBy='', $offset = 0, $limit = PHP_INT_MAX) {
    $sql   = "SELECT books.id, author, title, publicationYear, idGenre,  genres.genre
                FROM books
                JOIN genres ON books.idGenre = genres.id
               WHERE author LIKE ? OR title  LIKE ? OR publicationYear LIKE ?
               $orderBy
               LIMIT ? OFFSET ?";

    return dbRun($sql,
        ["%$search%", "%$search%", "%$search%", $limit, $offset])->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Update the book's data
 */
function bookUpdate($id, $author, $title, $publicationYear, $idGenre) {
    dbRun(
        "UPDATE books SET author = ?, title = ?, publicationYear = ?, idGenre = ? WHERE id = ?",
        [ $author, $title, $publicationYear, $idGenre, $id ]
    );
}

/**
 * Delete book by its id
 */
function bookDeleteById($id) {
    dbRun( "DELETE FROM books WHERE id = ?", [$id] );
}

/**
 * Check the data in a book associative array
 */
function checkBookData($book) {
    return $book['author'] && $book['title'] && $book['publicationYear'] && $book['idGenre'];
}