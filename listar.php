<?php include 'db.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="style.css">
   <title>Agendamentos Médicos</title>
</head>
<body class="listar">
<h1>Agendamentos</h1>

<?php
$stmt = $pdo->query('SELECT * FROM agendamentos ORDER BY data, hora');
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($agendamentos) == 0) {
    echo '<p>Nenhum compromisso.</p>';
} else {
    echo '<table border="1">';
    echo '<thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Data</th><th>Horário</th><th colspan="2">Opções</th></tr>
</thead>';
echo '<tbody>';

foreach ($agendamentos as $agendamento) {
    echo '<tr>';
    echo '<td>' . $agendamento['nome'] . '</td>';
    echo '<td>' . $agendamento['email'] . '</td>';
    echo '<td>' . $agendamento['telefone'] . '</td>';
    echo '<td>' . date('d/m/y', strtotime($agendamento['data'])) . '</td>';
    echo '<td>' . date('H:i', strtotime($agendamento['hora'])) . '</td>';
    echo '<td><a style="color: black;" href="atualizar.php?id=' . $agendamento['id'] . '">Atualizar</a></td>';
    echo '<td><a style="color: black;" href="deletar.php?id=' . $agendamento['id'] . '">Deletar</a></td>';
}

echo '</tbody>';
echo '<table>';

}
?>
</body>
</html>