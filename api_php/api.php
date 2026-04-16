<?php

//CABEÇALHO
header("Content-Type: application/json; charset=UTF-8"); 

$metodo = $_SERVER['REQUEST_METHOD'];
//echo "Método da requisição: " . $metodo;

$arquivo = 'usuarios.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// LÊ O CONTEÚDO DO ARQUIVO JSON
$usuarios = json_decode(file_get_contents($arquivo), true);

//CONTEÚDO
// $usuarios = [
//     ["id" => 1, "nome" => "Maria Souza", "email" => "maria@email.com"],
//     ["id" => 2, "nome" => "João Silva", "email" => "joao@email.com"]
// ];

switch ($metodo) {
    case 'GET':
        //echo "AQUI AS AÇÕES DO METODO GET";
        echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;
    case 'POST':
        //echo "AQUI AS AÇÕES DO METODO POST";
        $dados = json_decode(file_get_contents('php://input'), true);
        // print_r($dados);

        if (!isset($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])) {
            http_response_code(400);
            echo json_encode(["erro" => "Dados incompletos."], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $novo_usuario = [
            "id" => $dados["id"],
            "nome" => $dados["nome"],
            "email" => $dados["email"],
        ];

        $usuarios[] = $novo_usuario;

        file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        echo json_encode(["mensagem" => "Usuário inserido com sucesso!", "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
        break;

        // array_push($usuarios, $novo_usuario);
        // echo json_encode('Usuário inserido com sucesso!', JSON_UNESCAPED_UNICODE);
        // print_r($usuarios);

    default:
        // echo "MÉTODO NÃO ENCONTRADO!";
        // break;
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido!"], JSON_UNESCAPED_UNICODE);
        break;
}
