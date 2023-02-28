<?php
class Todo {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTodos(){
        $this->db->query('SELECT *
                            FROM list 
                            WHERE deleted_at IS NUll
                            ORDER BY id DESC');
        $result = $this->db->resultSet();
        return $result;
    }


    public function getLastTodo(){
        $this->db->query('SELECT *
                            FROM list 
                            ORDER BY id DESC LIMIT 1');
        $result = $this->db->single();
        return $result;
    }


    public function addTask($task_content){

        $this->db->query('INSERT INTO list (content,created_at) VALUES (:content,now())');

        $this->db->bind(':content', $task_content);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function updateTask($task_id, $task_content){

        $this->db->query('UPDATE list SET content = :content WHERE id = :id');

        $this->db->bind(':content', $task_content);
        $this->db->bind(':id', $task_id);


        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    //delete a task
    public function SoftDeleteTask($id){
        $this->db->query('UPDATE list SET deleted_at = now() WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

}


}