<?php 

include "./functions.php";

// if POST request and form is valid
if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title']) && !empty($_POST['description'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    $query = $query = "UPDATE `images`SET title=:title, description=:description WHERE id=:id"; // without image
    // data to execute
    $attributes = [
        ':title' => $title,
        ':description' => $description,
        ':id' => $id,
    ];

    // if there is image and with no error
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img = getImageById($id);
        $filename = $_FILES['image']['name'];
        $filepath = "images/" . uniqid() . $filename;

        // delete exisiting one
        unlink($img['filepath']);
        // store image in storage
        move_uploaded_file($_FILES['image']['tmp_name'], $filepath);

        $query = "UPDATE `images` SET title=:title, description=:description, filepath=:filepath WHERE id=:id"; // with image
        $attributes['filepath'] = $filepath;
    }

    // save to database
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare($query);
    $stmt->execute($attributes);

    header("Location:/");
    exit;
}

header("Location:{$_SERVER['HTTP_REFERER']}");
exit;
