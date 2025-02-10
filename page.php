<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Ler usuários
$result = $conn->query("SELECT * FROM usuarios");

// Atualizar usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["email"])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id";
        $conn->query($sql);
        header("Location: page.php");
        exit;
    }
}

// Deletar usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $sql = "DELETE FROM usuarios WHERE id=$id";
        $conn->query($sql);
        header("Location: page.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body class="Pagina-usuario">
    
    <h2>Usuários</h2>
    <main>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["nome"] ?></td>
            <td><?= $row["email"] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <input type="text" name="nome" value="<?= $row["nome"] ?>" required>
                    <input type="email" name="email" value="<?= $row["email"] ?>" required>
                    <button type="submit" name="update">Atualizar</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <button type="submit" name="delete">Deletar</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="index.php">Voltar</a>
    </main>
    
</body>
</html>

<?php
$conn->close();
?>
