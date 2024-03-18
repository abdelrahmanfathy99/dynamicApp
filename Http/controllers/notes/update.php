<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

//find the corresponding note
$note = $db->query("select * from notes where id=?", [$_POST['id']])->findOrFail();

// authorize that the current user can edit the note 
authorize($note['user_id'] === $currentUserId);

// Validate the form
$errors = [];

if (!Validator::string($_POST['about'], 1, 1000)) {
    $errors['about'] = "A body of no morethan 1,000 characters is required.";
}

// if no validation errors, update the record in the notes database table.
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query("update notes set body=? where id=?", [$_POST['about'], $_POST['id']]);


// Redirect the user
header('location: /notes');
die();
