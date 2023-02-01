<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <img class="banniere" src="banniere.jpg" alt="nuages_roses">
        <div class="onglets">
            <?php if (empty($_SESSION)) : ?>
                <a href="index.php">Accueil</a>
                <a href="inscription.php">Inscription</a>
                <a href="livre-or.php">Livre d'or</a>
            <?php else : ?>
                <a href="index.php">Accueil</a>
                <a href="livre-or.php">Livre d'or</a>
                <a href="profil.php">Profil</a>
                <a href="deconnexion.php">Deconnexion</a>
            <?php endif ?>
        </div>
    </header>
</body>

</html>