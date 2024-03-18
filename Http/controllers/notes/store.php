<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);


$errors = [];


if (!Validator::string($_POST['about'], 1, 1000)) {
    $errors['about'] = "A body of no morethan 1,000 characters is required.";
}

if (!empty($errors)) {
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query("INSERT INTO notes (body, user_id) VALUES (?, ?)", [$_POST['about'], 1]);


header('location: /notes');
die();
