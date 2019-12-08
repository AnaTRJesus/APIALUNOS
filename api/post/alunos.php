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

// Obter lista de alunos
 $lista = $aluno->getAlunos();

// Verificar se a lista possui alunos
if ($lista->rowCount() > 0){
    $alunos_arr = array();
    //$alunos_arr['data'] = array();

    while($linha = $lista->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $aluno_item = array(
            'id' => $id,
            'nome' => $nome,
            'nota1' => $nota1,
            'nota2' => $nota2
        );
        //alunos_arr.push(aluno_item);
        array_push($alunos_arr, $aluno_item);
    }

    echo json_encode($alunos_arr);
}