<?php

// "Import" das classes que serão utilizadas aqui
include_once '../config/Database.php';
include_once '../../model/Aluno.php';

// Cabeçalho da conexão HTTP "HEADERS"
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Instanciar o banco de dados
$banco = new Database();
$conexao = $banco->getConexao();

// Instanciar um objeto aluno
$aluno = new Aluno($conexao);

// Obter os dados que estão vindo na conexão HTTP
$data = json_decode(file_get_contents("php://input"));

$aluno->nome = $data->nome;
$aluno->nota1 = $data->nota1;
$aluno->nota2 = $data->nota2;

// Chamar o método de gravação
if ($aluno->gravar()){
    echo json_encode(array('message' => 'Aluno cadastrado com sucesso'));
} else {
    echo json_encode(array('message' => 'Ocorreu um erro no cadastro'));
}