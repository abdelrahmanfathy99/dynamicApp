<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 1;


$note = $db->query("select * from notes where id=?", [$_POST['id']])->findOrFail();

// if the note id is not authorized to be viewed.
authorize($note['user_id'] === $currentUserId);

$db->query("delete from notes where id = ?", [$_POST['id']]);

header('location: /notes');
exit();
