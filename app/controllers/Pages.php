<?php
  class Pages extends Controller {
    public function __construct(){
        $this->todoModel = $this->model('Todo');
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('comptes');
      }
      $this->view('pages/index');
    }

    public function todolist(){
      $data = $this->todoModel->getTodos();
      $this->view('pages/list', $data);
    }

    public function updatetask(){
      if ($_SERVER["REQUEST_METHOD"] == 'POST') 
      {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (empty(@$_POST['content']) OR empty(@$_POST['task_id'])) {
          echo "Empty Content";
          return false;
        }

        $task_content =  $_POST['content'];
        $task_id      =  $_POST['task_id'];

        if($data = $this->todoModel->updateTask($task_id,$task_content)){
          echo "done";
          return false;
        }

      }
      else
      {
        echo "Error";
        retrun;
      }
      
    }

    public function addtask(){
      if ($_SERVER["REQUEST_METHOD"] == 'POST') 
      {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (empty(@$_POST['content'])) {
          $data['error'] = 'Empty Field. Enter Task Content';
          echo json_encode($data);
          return false;
        }

        $task_content =  $_POST['content'];

        if($this->todoModel->addTask($task_content)){

          $last = $this->todoModel->getLastTodo();

          $data['result'] = '
            <div class="row justify-content-between m-3 border-bottom pb-2" id="task-'.$last->id.'">
                <div class="task-content col-md-6 text-left group-form row"><i class="fa fa-check-circle-o p-1"></i> 
                  <span id="content-'.$last->id.'">'.$last->content.'</span>
                </div>
                <div class="task-options col-md-6 text-right">
                  <button class="btn btn-sm btn-primary edit-task" task_id="'.$last->id.'"><i class="fa fa-edit"></i></button>
                  <button class="btn btn-sm btn-danger delete-task" task_id="'.$last->id.'"><i class="fa fa-trash"></i></button>
                </div>
            </div>';

          echo json_encode($data);
          return false;
        }
      }
      else
      {
          $data['error'] = "error";
          echo json_encode($data);
          return false;
      }
      
    }
  


      public function deletetask(){
      if ($_SERVER["REQUEST_METHOD"] == 'POST') 
      {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (empty(@$_POST['task_id'])) {

          echo  'error';
          return false;
        }

        $task_content =  $_POST['task_id'];

        if($this->todoModel->SoftDeleteTask($task_content)){

          echo 'done';
          return false;
        }
      }
      else
      {
          echo "error";
          return false;
      }
      
    }
  }