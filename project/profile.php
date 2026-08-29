<?php
include("vendor/autoload.php");

use Helpers\Auth;

$user = Auth::check();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4" style="max-width: 600px">
        <h1 class="h3 mb-3">Profile</h1>

        <?php if($user->photo): ?>
            <img src="actions/photos/<?= $user->photo ?>" width="300" class="img-thumbnail">
        <?php endif ?>

        <form action="actions/upload.php" method="post" 
            class="my-3 input-group" enctype="multipart/form-data">
            <input type="file" class="form-control" name="photo">
            <button class="btn btn-secondary">Upload</button>
        </form>

        <ul class="list-group mb-2">
            <li class="list-group-item">Name: <?= $user->name ?></li>
            <li class="list-group-item">Email: <?= $user->email ?></li>
            <li class="list-group-item">Phone: <?= $user->phone ?></li>
            <li class="list-group-item">Address: <?= $user->address ?></li>
        </ul>

        <a href="actions/logout.php" class="text-danger">Logout</a>
    </div>
</body>

</html>