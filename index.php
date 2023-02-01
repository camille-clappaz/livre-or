<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'livreor');
if ($mysqli->connect_error) {
    echo "erreur de connexion a MySQL:" . $mysqli->connect_error;
    exit();
}
$request = $mysqli->query("SELECT * FROM utilisateurs");
$result = $request->fetch_all(MYSQLI_ASSOC);
// var_dump($result);
?>
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
    <?php include("header_include.php"); ?>
    <main>
        <?php
        if (empty($_SESSION)) {
          if (isset($_POST['submit'])) {
            if (empty($_POST["login"])) {
              echo "<p class='erreur'>Il faut écrire votre login</p>";
            } elseif (empty($_POST["password"])) {
              echo "<p class='erreur'>Il faut renseigner votre mot de passe</p>";
            }
     
       
            foreach ($result as $element) {
                if ($_POST["password"] == $element["password"] && $_POST["login"] == $element["login"]) {
                  $login = $_POST['login'];
                  $request2 = $mysqli->query("SELECT * FROM utilisateurs WHERE login LIKE'$login'");
                  $results = $request2->fetch_all(MYSQLI_ASSOC);
                  $_SESSION = $results[0];
                  
                  header("Location: index.php");
              }
            }
          }
        }

        ?>
        <?php
        if (empty($_SESSION)) : ?>

            <div class="login-box">
                <h2>Connexion</h2>
                <form method="POST">
                    <div class="user-box">
                        <input placeholder="Login" type="text" name="login" required="">
                    </div>
                    <div class="user-box">
                        <input placeholder="Password" type="password" name="password" required="">
                    </div>
                    <br><br>
                    <button type="submit" name="submit">Se connecter</button>
                </form>
            </div>
        <?php endif ?>

        <div class="bonjour">
            <?php
            if (!empty($_SESSION)) :
                $user = $_SESSION['login']; ?>
                <p>Bonjour <?= $user ?></p>
                <p>:)</p>
                

        </div>
    <?php endif ?>

    </main>
    <?php include("footer_include.php"); ?>
</body>

</html>