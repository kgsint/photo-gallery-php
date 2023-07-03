<?php
    include "./functions.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        $img = getImageById($id);

        if(!$img) exit("Image doesn't exist");

        unlink($img['filepath']); // delete image from storage

        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare("DELETE FROM `images` WHERE id=?");

        $stmt->execute([$id]);

        header('Location:/');
        exit;
        
    }

    header('Location:/');
?>


<?=template_header('Delete')?>

<div class="content delete">
    <h2>Delete Image #<?=$img['id']?></h2>
    <p>Are you sure you want to delete <?=$img['title']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$img['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$img['id']?>&confirm=no">No</a>
    </div>
</div>

<?=template_footer()?>