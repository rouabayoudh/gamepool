<?php
require_once('../config/function.php');

// Check if id parameter is provided
$id = Functions::checkParamId('id');

if ($id != 'no id given' && $id != 'no id found') {
    // Attempt to delete user
    $result = Functions::deleteQuery('users',$id);

    if ($result) {
        Functions::redirect('users.php', 'User deleted successfully.');
    } else {
        Functions::redirect('users.php', 'Failed to delete user.');
    }
} else {
    Functions::redirect('users.php', 'Invalid id provided.');
}
?>
