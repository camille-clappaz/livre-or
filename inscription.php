<?php
// session_start();
$mysqli=new mysqli('localhost', 'root', '', 'livreor');
if( $mysqli->connect_error ) {
    echo "erreur de connexion a MySQL:" .$mysqli -> connect_error;
    exit();
}
// $request=$mysqli->query("SELECT * FROM utilisateurs");
// $result=$request->fetch_all(MYSQLI_ASSOC);
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
<?php include("header_include.php");?>
<body>
    <main>
        <?php
        if (isset($_POST['submit'])) { // Permet de verifier la suite UNIQUEMENT si on appuie sur Submit
            //if(empty($_POST["login"]))  Si l'input est vide
            if (!empty($_POST["login"])  && !empty($_POST["password"])) {
                $login = $_POST['login'];
                $password = $_POST['password'];
                if ($_POST['password'] == $_POST['confirmpassword']) {
                    $request = $mysqli->query("INSERT INTO utilisateurs ( login, password) VALUES ( '$login','$password')");
                    header('Location:index.php');
                } else {
                    echo "<p class='erreur'>Les mots de passe sont différents!</p>";
                }
            } 
        }
        ?>

<div class="login-box">
  <h2>Inscription</h2>
  <form method="POST">
    <div class="user-box">
      <input placeholder="Login" type="text" name="login" required="">
    </div>
    <div class="user-box">
      <input placeholder="Password" type="password" name="password" required="">
    </div>
    <div class="user-box">
      <input placeholder="Confirmation password" type="password" name="confirmpassword" required="">
    </div><br><br>
      <button type="submit" name="submit" >S'inscrire</button>
  </form>
</div>

    </main>
    <footer>
    <?php include("footer_include.php");?>
    </footer>

</body>

</html>