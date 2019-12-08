<?php

// "Import" das classes que serão utilizadas aqui
include_once '../config/Database.php';
include_once '../../model/Aluno.php';

// Cabeçalho da conexão HTTP "HEADERS"
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Instanciar o banco de dados
$banco = new Database();
$conexao = $banco->getConexao();

// Instanciar um objeto aluno
$aluno = new Aluno($conexao);

// Obter o ID da URL
$aluno->id = $_GET['id'];

// Obter o aluno do banco
$aluno->getAluno();

// Criar um array para gerar o json
$aluno_arr = array(
    'id'=>$aluno->id,
    'nome'=>$aluno->nome,
    'nota1'=>$aluno->nota1,
    'nota2'=>$aluno->nota2
);

// Gerar o Json
echo json_encode($aluno_arr);

