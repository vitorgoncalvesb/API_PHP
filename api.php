<?php
header("Content-Type: application/json");

$metodo = $_SERVER["REQUEST_METHOD"];

//echo "Método de requisição: " . $metodo;

// $usuarios = [
//     ["id" => 1, "nome" => "Fulano", "email" => "fulano@gmail"],
//     ["id" => 2, "nome" => "Ciclano", "email" => "ciclano@gmail"]
// ];

// echo json_encode($usuarios);

switch ($metodo) {
    case "GET":
        echo "AQUI AÇÕES DO MÉTODO GET";
        break;
    case "POST":
        echo "AQUI AÇÕES DO MÉTODO POST";
        break;
    default:
        echo "MÉTODO NÃO ENCONTRADO!";
        break;
}
?>