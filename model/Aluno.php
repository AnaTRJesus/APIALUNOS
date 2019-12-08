<?php

class Aluno {

    private $conexao;
    private $tabela = 'tbl_aluno';

    // Propriedades do aluno
    public $id;
    public $nome;
    public $nota1;
    public $nota2;

    // Contrutor do objeto Aluno
    public function __construct($con){
        $this->conexao = $con;
    }

    // Método retornar lista de alunos do banco
    public function getAlunos(){
        // Query de consulta na tabela alunos
        $sql = 'SELECT * FROM ' . $this->tabela;

        // Criar o statement
        $stmt = $this->conexao->prepare($sql);

        // Executar o comando sql no banco
        $stmt->execute();

        return $stmt;
    }

    // Método para retornar um aluno
    public function getAluno(){
        // Query de consulta na tabela alunos
        $sql = 'SELECT * FROM ' . $this->tabela . ' WHERE id = ?';

        // Criar o statement
        $stmt = $this->conexao->prepare($sql);

        // Carregar o id
        $stmt->bindParam(1, $this->id);

        // Executar o comando sql no banco
        $stmt->execute();

        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->nome = $aluno["nome"];
        $this->nota1 = $aluno["nota1"];
        $this->nota2 = $aluno["nota2"];
        
    }

    // gravar novo aluno no banco
    public function gravar(){
        // Query SQL para inserir um novo aluno
        $sql = 'INSERT INTO ' . $this->tabela .
        ' SET nome = :nome, nota1 = :nota1, nota2 = :nota2';

        // criar o statement
        $stmt = $this->conexao->prepare($sql);

        // popular os dados (sanitização)
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->nota1 = htmlspecialchars(strip_tags($this->nota1));
        $this->nota2 = htmlspecialchars(strip_tags($this->nota2));

        // Bind (Carregar) os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nota1', $this->nota1);
        $stmt->bindParam(':nota2', $this->nota2);

        if ($stmt->execute()){
            return true;
        } 

        printf("Ocorreu um erro na gravação! %s.\n" . $stmt->error);

        return false;

    }

        // Método para excluir um aluno
        public function deleteAluno(){
            // Query de exclusão na tabela alunos
            $sql = 'DELETE FROM ' . $this->tabela . ' WHERE id = ?';
    
            // Criar o statement
            $stmt = $this->conexao->prepare($sql);
    
            // Carregar o id
            $stmt->bindParam(1, $this->id);
    
            // Executar o comando sql no banco          
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }

    // atualizar aluno no banco
    public function atualizarAluno(){
   // Query SQL para atualizar um aluno
    $sql = 'UPDATE ' . $this->tabela .
    ' SET nome = :nome, nota1 = :nota1, nota2 = :nota2 WHERE id = :id ';

    // criar o statement
    $stmt = $this->conexao->prepare($sql);

    // popular os dados (sanitização)
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->nota1 = htmlspecialchars(strip_tags($this->nota1));
    $this->nota2 = htmlspecialchars(strip_tags($this->nota2));

    // Bind (Carregar) os parâmetros
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':nota1', $this->nota1);
    $stmt->bindParam(':nota2', $this->nota2);

        // Executar o comando sql no banco          
        if($stmt->execute()){
            return true;
        }
            return false;
        }   
}
