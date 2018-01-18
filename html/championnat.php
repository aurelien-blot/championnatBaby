<?php session_start(); ?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Championnat de babyfoot</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>
    <body>
        <header>
            <?php include'banniere.php' ?>
        </header>

        <div id="content">
            <nav>
                <?php include'navChamp.php'?>
            </nav>
            <p>Bonjour <?php echo($_SESSION['nom']); ?></p>
        </div>
        <footer>
            <?php include'footer.php' ?>
        </footer>
    </body>
</html>
