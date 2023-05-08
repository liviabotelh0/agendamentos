<?php
$host = 'localhost';
$dbname = 'crud_agendamentos';
$username = 'root';
$password = '';

try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname;
charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
echo 'Erro ao conectar ao banco de dados:'
    . $e->getMessage();
    exit;
}

?>