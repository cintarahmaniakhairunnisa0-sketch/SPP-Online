<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <style>
        body {
            background: rgb(48, 18, 8);
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }

        fieldset {
            margin: 100px auto;
            width: 320px;
            height: 400px;
            border: 2px solid white;
            background-color: white;
        }

        label {
            font-family: tahoma;
            color: red;
        }

        input, select {
            margin: 5px;
            padding: 10px;
            width: 300px;
            height: 40px;
            border: 1px solid white;
            border-radius: 10px;
        }

        #submit {
            color: white;
            background-color: #428df5;
            cursor: pointer;
        }

        #input {
            background-color: #c6cfc7;
        }

        .alert {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1 align="center"><b>SPP ONLINE</b></h1>
    <form action="login_validasi.php" method="post">
        <fieldset>
            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                    echo "<div class='alert'>Username dan Password tidak sesuai!</div>";
                }
            }
            ?>

            <legend align="center">
                <img src="profile.jpg" width="75" height="75" alt="Profile">
            </legend>

            <p align="center"><b>LOGIN</b></p>
            <table align="center">
                <tr>
                    <td><input name="username" type="text" placeholder="Username" id="input"></td>
                </tr>
                <tr>
                    <td><input name="password" type="password" placeholder="Password" id="input"></td>
                </tr>
                <tr>
                    <td><input name="login" type="submit" value="LOGIN" id="submit"></td></tr>

                <tr><td> </tr></td> 
                <tr><td> </tr></td> 
                    <tr><td align="center">
                        <a href="bayar.php">CEK PEMBAYARAN</a>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</body>
</html>
