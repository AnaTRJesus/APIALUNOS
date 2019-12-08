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

// Obter o ID da URL
$aluno->id = $_GET['id'];

// Excluir o aluno
if($aluno->deleteAluno()){
 
    http_response_code(200);
     echo json_encode(array("message" => "Exclusão de aluno realizada com sucesso"));
}
 
else{
 
    http_response_code(503); 
    echo json_encode(array("message" => "A exclusão do aluno não foi efetuada."));
}