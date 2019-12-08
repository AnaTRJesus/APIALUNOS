<?php

class Database {
    private $servidor = 'localhost';
    private $banco = 'db_escola';
    private $usuario = 'root';
    private $senha = '';
    private $conexao;

    public function getConexao(){
        $this->conexao = null;
        
        // Obter a conexão com o banco
        try {
            $this->conexao = new PDO('mysql:host=' . $this->servidor . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo 'Erro de conexão ' . $e->getMessage();
        }

        return $this->conexao;
    }
}