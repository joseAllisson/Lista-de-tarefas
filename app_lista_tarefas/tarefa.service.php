<?php

//CRUD
class TarefaService{

    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao,Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function Inserir(){//create
        $query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();

    } 
    public function recuperar(){//read
        $query = '
                    select t.id, s.status, t.tarefa 
                from 
                    tb_tarefas as t
                    left join tb_status as s on (t.id_status = s.id)
                ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } 

    public function atualizar(){//update
        // query do myslq
        $query = 'update tb_tarefas set tarefa = :tarefa where id = :id';
        // PDOStatement prepare para preparar a query para tratar sqlinjection
        $stmt = $this->conexao->prepare($query);
        // passar os valores das : para evitar SQLinjection 
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        // executar a query 
        return $stmt->execute();
    } 

    public function delete(){//delete
        $query = 'delete from tb_tarefas where id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        return $stmt->execute();
    } 

    public function marcarRealizada(){//update
        // query do myslq
        $query = 'update tb_tarefas set id_status = ? where id = ?';
        // PDOStatement prepare para preparar a query para tratar sqlinjection
        $stmt = $this->conexao->prepare($query);
        // passar os valores das : para evitar SQLinjection 
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        // executar a query 
        return $stmt->execute();
    } 

    public function recuperarTarefasPendentes(){
        $query = '
                    select t.id, s.status, t.tarefa 
                from 
                    tb_tarefas as t
                    left join tb_status as s on (t.id_status = s.id)
                where
                    t.id_status = :id_status
                ';
        $stmt = $this->conexao->prepare($query);
        
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


}



?>