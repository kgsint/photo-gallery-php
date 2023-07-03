<?php
    include "./functions.php";

    $id = $_GET['id'];

    $image = getImageById($id); // find or get image by id

    // if id is invalid, redirect and kill the script
    if(!$image) {
        header("Location:/");
        exit;
    }
?>


<?=template_header('Upload Image')?>

<div class="content upload">
    <h2>Upload Image</h2>
    <form action="update.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $image['id'] ?>">
        <label for="image">Update new Image</label>
        <input type="file" name="image" accept="image/*" id="image">

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value=<?= $image['title'] ?> />

        <label for="description">Description</label>
        <textarea name="description" id="description"><?= $image['description'] ?></textarea>
        <input type="submit" value="Update Image">
    </form>
    <p><?=$err_msg ?? "" ?></p>
</div>

<?=template_footer()?>
