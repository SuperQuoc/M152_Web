<?php

session_start();

include 'php/models/medias.php';
require_once __DIR__ . '/inc/flash.php';
require_once __DIR__ . '/inc/functions.php';

const ALLOWED_FILES = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg',
    'video/mp4' => 'mp4',
    'audio/mp4' => 'mp3'
];

const MAX_SIZE = 3 * 1024 * 1024; //  3MB

const UPLOAD_DIR = __DIR__ . '/uploads';

$comment = filter_input(INPUT_POST, 'comment');

$is_post_request = strtolower($_SERVER['REQUEST_METHOD']) === 'post';
$has_files = isset($_FILES['medias_uploads']);

if (!$is_post_request || !$has_files) {
    redirect_with_message_post('Invalid file upload operation', FLASH_ERROR);
}

$files = $_FILES['medias_uploads'];
$file_count = count($files['name']);

// validation
$errors = [];
for ($i = 0; $i < $file_count; $i++) {
    // get the uploaded file info
    $status = $files['error'][$i];
    $filename = $files['name'][$i];
    $tmp = $files['tmp_name'][$i];

    // an error occurs
    if ($status !== UPLOAD_ERR_OK) {
        $errors[$filename] = MESSAGES[$status];
        continue;
    }
    // validate the file size
    $filesize = filesize($tmp);

    if ($filesize > MAX_SIZE) {
        // construct an error message
        $message = sprintf(
            "The file %s is %s which is greater than the allowed size %s",
            $filename,
            format_filesize($filesize),
            format_filesize(MAX_SIZE)
        );

        $errors[$filesize] = $message;
        continue;
    }

    // validate the file type
    if (!in_array(get_mime_type($tmp), array_keys(ALLOWED_FILES))) {
        $errors[$filename] = "The file $filename is allowed to upload";
    }

}

if ($errors) {
    redirect_with_message_post(format_messages('The following errors occurred:', $errors), FLASH_ERROR);
}
// Add comment to the table POST
try {

    db()->beginTransaction();
    postInsert($comment);


    // move the files
    for ($i = 0; $i < $file_count; $i++) {
        $filename = strtolower("id_".uniqid()."_".$files['name'][$i]);
        $tmp = $files['tmp_name'][$i];
        $mime_type = get_mime_type($tmp);

        // set the filename as the basename + extension
        $uploaded_file = pathinfo($filename, PATHINFO_FILENAME) . '.' . ALLOWED_FILES[$mime_type];
        // new filepath
        $filepath = UPLOAD_DIR . '/' . $uploaded_file;


        // move the file to the upload dir



        $success = move_uploaded_file($tmp, $filepath);

        //Resize part : https://stackoverflow.com/questions/24227323/how-to-resize-image-using-gd-library-php

        // Add info to database (table Media)
        mediaInsert($mime_type, $filename);

        if (!$success) {
            $errors[$filename] = "The file $filename was failed to move.";
        }
    }

    db()->commit();
} catch (Exception $e) {
    db()->rollBack();
    throw $e;
}





$errors ?
    redirect_with_message_post(format_messages('The following errors occurred:', $errors), FLASH_ERROR) :
    redirect_with_message_post('All the files were uploaded successfully.', FLASH_SUCCESS);



