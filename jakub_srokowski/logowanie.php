<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="./styl4.css">
</head>
<body>
        <?php 
            $conn = mysqli_connect('localhost', 'root', '',  'psy');
            $msg = "";

            if (isset($_POST['submit'])) {
                if ($_POST['login'] != "" && $_POST['haslo'] != "" && $_POST['powthaslo'] != "") {
                    $login = $_POST['login'];
                    $powthaslo = $_POST['powthaslo'];
                    $haslo = $_POST['haslo'];

                    $sql = "SELECT login FROM uzytkownicy WHERE login = '$login'";

                    $response = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($response) == 0) {
                        if ($haslo == $powthaslo) {
                            $hash_haslo = sha1($haslo);

                            $sql = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login', '$hash_haslo')";
                            $response = mysqli_query($conn, $sql);

                            if ($response) {
                                $msg = "Konto zostało dodane";
                            } else {
                                $msg = "Błąd tworzenia konta";
                            }

                        } else {
                            $msg = "hasła nie są takie same, konto nie zostało dodane";
                        }
                    } else {
                        $msg = "login występuje w bazie danych, konto nie zostało dodane";
                    }

                } else {
                    $msg = "wypełnij wszystkie pola";
                }
            } 

            mysqli_close($conn);
        ?>

    <div class="baner" name="baner">
        <h1>Forum wielbicieli psów</h1>
    </div>
    <div class="left" name="left">
        <img src="./zad1/obraz.jpg" alt="foksterier">
    </div>
    <div class="right1" name="right1">
        <h2>Zapisz się</h2>
        
        <div class="form" name="form">
            <form action="" method="post">
                login: <input type="text" name="login"> </br>
                hasło: <input type="text" name="haslo"> </br>
                powtórz hasło: <input type="text" name="powthaslo"> </br>
                <input type="submit" value="Zapisz" name="submit">
            </form>
        </div>

        <p name="efekt" class="efekt"><?php echo $msg; ?></p>

    </div>
    <div class="right2" name="right2">
        <h2>Zapraszamy wszystkich</h2>
        <ol>
            <li>właściceli psów</li>
            <li>weterynarzy</li>
            <li>tych, co chcą kupić psa</li>
            <li>tych, co lubią psy</li>
        </ol>
        <button><a href="./regulamin.html">Przeczytaj regulamin forum</a></button>
    </div>
    <footer>
        Stronę wykonał: Jakub Srokowski
    </footer>
</body>
</html>