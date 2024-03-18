<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];


// validate the form inputs.
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'please provide a password of at least 7 characters.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);


// check if the account already exists
$user = $db->query('select * from users where email = ?', [$email])->find();



if ($user) {
    // then someone with that email already exists and has an account.
    // If yes, redirect to the login the page.
    header('location: /');
    exit();
} else {
    // If not, save it to the database, and then log the user in, and redirect.
    $db->query('insert into users (email,password) values (?, ?)', [
        $email,
        password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark that the user has logged in
    (new Authenticator)->login($user);

    header('location: /');
    exit();
}
