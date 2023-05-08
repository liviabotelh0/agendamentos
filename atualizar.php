<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM agendamentos WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listar.php');
    exit;
}
$nome = $appointment['nome'];
$email = $appointment['email'];
$telefone = $appointment['telefone'];
$data = $appointment['data'];
$hora = $appointment['hora'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Atualizar Compromisso</title>
</head>
<body>
    <h1>Atualizar Compromisso</h1>
    <form method="post">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo $nome; ?>" required><br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required><br>

    <label for="telefone">Telefone:</label>
    <input type="tel" name="telefone" value="<?php echo $telefone; ?>" required><br>

    <label for="data">Data:</label>
    <input type="data" name="data" value="<?php echo $data; ?>" required><br>

    <label for="hora">Horário:</label>
    <input type="hora" name="hora" value="<?php echo $hora; ?>" required><br>

    <button type="submit">Atualizar</button>
    </form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];


    // validação dos dados do formulário aqui
    $stmt = $pdo->prepare('UPDATE agendamentos SET nome = ?, email = ?, telefone = ?, data = ?, hora = ? WHERE id= ?');
    $stmt->execute([$nome, $email, $telefone, $data, $hora, $id]);
    header('Location: listar.php');
    exit;
}
?>