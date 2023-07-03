<?php 

include "./functions.php";

$pdo = pdo_connect_mysql();
$stmt = $pdo->query("SELECT * FROM images ORDER BY uploaded_date desc");

$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?= template_header('Gallary') ?>
    <div class="content home">
        <p>Welcome to the gallery page! You can view the list of uploaded images below.</p>
        <a href="upload.php" class="upload-image">Upload Image</a>

        <div class="images">
            <?php foreach($images as $image): ?>
                <?php if(file_exists($image['filepath'])): ?>
                    <a href="#">
                        <img 
                            src="<?= $image['filepath'] ?>" 
                            alt="<?= $image['description'] ?>" 
                            data-id="<?= $image['id'] ?>"
                            data-title="<?= $image['title'] ?>"
                            width="300"
                            height="200"
                            >
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>

        <div class="image-popup"></div>
    </div>

    <script src="app.js"></script>

<?= template_footer() ?>