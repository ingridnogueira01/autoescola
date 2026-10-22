<?php

require "config.php";

$rota = $_GET["rota"] ?? "teste";

function teste() {
    echo json_encode([
        "mensagem" => "Back-end respondendo"
    ]);
}

function listarAlunos($con) {
    $stmt = $con->query("SELECT * FROM Alunos");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC),
        JSON_UNESCAPED_UNICODE
    );
}

function cadastrarAluno($con) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data_nascimento = $_POST["data_nascimento"];

    $stmt = $con->prepare("INSERT INTO Alunos (nome, email, telefone, data_nascimento) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $telefone, $data_nascimento,]);

    echo json_encode(
        ["mensagem" => "Aluno cadastrado com sucesso!"],
        JSON_UNESCAPED_UNICODE
    );
}
function listarinstrutor($con) {
    $stmt = $con->query("SELECT * FROM Instrutores");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC),
        JSON_UNESCAPED_UNICODE
    );
}
    switch ($rota) {
    case "alunos":
        listarAlunos($con);
        break;
    case "alunos/create":
        cadastrarAluno($con);
        break;
    case "instrutores":
        listarinstrutor($con);
        break;
    default:
        teste();
        break;
}
