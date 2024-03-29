<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;


$note = $db->query("select * from notes where id=?", [$_GET['id']])->findOrFail();

// if the note id is not authorized to be viewed.
authorize($note['user_id'] === $currentUserId);


view('notes/show.view.php', [
    'heading' => 'Note',
    'note'   => $note
]);
