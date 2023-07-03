<?php 

include "./functions.php";

$err_msg = "";

if(isset($_FILES['image'], $_POST['title'], $_POST['description'])) {

    // if there is no file error, upload
    if($_FILES['image']['error'] === 0) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $filename = $_FILES['image']['name'];
        $image_path = "images/" . uniqid() . $filename;
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, $image_path);

        $query = "INSERT INTO `images`(title, description, filepath, uploaded_date) VALUES(?, ?, ?, NOW())";
        $pdo = pdo_connect_mysql();

        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description, $image_path]);

        header('Location:index.php');
        exit;
    }
    $err_msg = "Invalid image. Please reupload";
}

?>

<?=template_header('Upload Image')?>

<div class="content upload">
    <h2>Upload Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">Choose Image</label>
        <input type="file" name="image" accept="image/*" id="image">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <p><?=$err_msg ?? "" ?></p>
</div>

<?=template_footer()?>
