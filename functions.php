<?php 

function pdo_connect_mysql() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'php_gallary';

    $dsn = "mysql:host={$host};dbname={$db_name};charset=utf8";

    try {
        return new PDO($dsn, $user, $pass);
    }catch(\PDOException $e) {
        echo $e->getMessage();
    }
}

function getImageById(string $id) {
    $pdo = pdo_connect_mysql();
    $query = "SELECT * FROM `images` WHERE id=?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);

    $img = $stmt->fetch(PDO::FETCH_ASSOC);

    return $img;
}


function template_header(string $title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>{$title}</title>
            <link href="style.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        </head>
        <body>
        <nav class="navtop">
            <div>
                <h1>Gallery System</h1>
                <a href="index.php"><i class="fas fa-image"></i>Gallery</a>
            </div>
        </nav>
    EOT;
}

function template_footer() {
    echo <<<EOT
            </body>
        </html>
    EOT;
}