<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$host   = 'localhost';
$db     = 'testespassu';
$user   = 'TesteSpassu';
$pass   = '@Teste$passu';

$token = $_REQUEST['token'];

if ($token == "fd95a640525ffa9b4842dabdf4709cd1136ab5eb54b1917d278efe39e48561ae1b6927bf3704b6cd7d63b48222c8911b63e2df0e04ede23b7a15a5bc97e92dd9cd3e321a7e994fb8281039a9460d82c976cc34130d33ef787cdc18eeb8e65c13") {

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500); // Erro interno do servidor
    echo json_encode(['message' => 'Erro ao conectar ao banco de dados']);
    exit;
}

$sql = "SELECT * from vw_lista_livros";

    $stmt = $pdo->query($sql);

    $livros = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $livros[] = $row;
    }

    echo json_encode($livros);

} else {

    $resp = '[
  {
    "Mensagem": "Credenciais Invalidas",
  }]';

}

?>