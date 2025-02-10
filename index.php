<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Criar usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    if (isset($_POST["nome"]) && isset($_POST["email"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
        if ($conn->query($sql) === TRUE) {
            header("Location: page.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body class="Pagina-login">
    <header>
        <h2>Bem vindo!</h2>
    </header>

    <main>
    <h1>Adicionar Usuário</h1>
    
    <form method="POST">
        Nome: <input type="text" name="nome" required> <br> <br>
        Email: <input type="email" name="email" required> <br><br>
        <button type="submit" name="create"><p>Criar</p></button>
    </form>
    
</main>

</body>
</html>
<?php

$conn->close();
?>
