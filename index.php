<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agendamento Médico</title>
</head>
<body>
 <div class="container-formulario">
    <h1>Agendamento Médico</h1>
    <?php
    if(isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
    
        $stmt=$pdo->prepare('SELECT COUNT(*)
        FROM agendamentos WHERE data = ?
        AND hora = ?');
        $stmt->execute([$data, $hora]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $error = 'Já existe um agendamento para essa data e horário.';
        } else {

            $stmt = $pdo->prepare('INSERT INTO agendamentos
            (nome, email, telefone, data, hora)
            VALUES(:nome, :email, :telefone, :data, :hora)');
            $stmt->execute(['nome' => $nome,
            'email'=> $email,
            'telefone'=> $telefone, 'data' =>$data, 'hora'=>$hora]);
        
            if($stmt->rowCount()){
                echo '<span>Compromisso agendado com sucesso!</span>';
            } else {
                echo '<span>Erro ao agendar compromisso. Tente novamente mais tarde</span>';
            }
        }
        if (isset($error)) {
            echo '<span>' . $error.'</span>';
        }
    }  

        ?>

        <form method="post">

             <label for="nome">Nome:</label>
             <input type="text" name="nome" required><br>

             <label for="email">E-mail:</label>
             <input type="email" name="email"required><br>

             <label for="telefone">Telefone:</label>
             <input type="text" name="telefone" maxlenght="11"required><br>

             <label for="data">Data:</label>
             <input type="date" name="data"required><br>

             <label for="hora">horário:</label>
             <input type="time" name="hora"required><br>

             <div>
                <button type="submit" name="submit" value="Agendar">Agendar</button>
                <button><a href="listar.php">listar</a></button>
             </div>
        </form>
 </div>
</body>
</html>