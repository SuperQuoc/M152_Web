<?php

session_start();

include 'php/models/medias.php';
require_once __DIR__ . '/inc/flash.php';
require_once __DIR__ . '/inc/functions.php';

const UPLOAD_DIR = __DIR__ . '/uploads';

$idPost = filter_input(INPUT_POST, 'idPost');


// Get all names from a post id
$fileFromPostId = mediaSelectAllByPostId($idPost);

$filenamesById = array();

foreach ($fileFromPostId as $key => $value) {
    array_push($filenamesById, $value['nomMedia']);
}



// Update data in the DB and file uploads
try {
    db()->beginTransaction();

    // Update files from uplodas by name from the DB (by post id)
    foreach ($filenamesById as $filename) {
        $filepath = UPLOAD_DIR . '/' . $filename;
        unlink($filepath);
    }

    // Update post and media in the DB by Id
    mediaDeleteById($idPost);
    postDeleteById($idPost);

    db()->commit();
} catch (Exception $e) {
    db()->rollBack();
    throw $e;
}

redirect_with_message_index('Le poste a été modifié.', FLASH_SUCCESS);