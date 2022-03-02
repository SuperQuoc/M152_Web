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