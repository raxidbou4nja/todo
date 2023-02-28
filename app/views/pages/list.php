<?php require APPROOT . '/views/inc/header.php'; ?>
</head>
<body>
  
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container col-md-10">
    <div class="container">
      <div class="h3">
        ToDo List
      </div>
      <div class="m-3">
        <label>Add an item</label>
        <div class="row">
            <input type="text" class="form-control col-md-9 mr-2 new-task-content" placeholder="Add An Item Here">
          <button class="btn btn-primary col-md-2 add_task" type="button">ADD</button>
        </div>
      </div>
    </div>
      <div class="container tasks p-3">
<?php foreach ($data as $task): ?>
        <div class="row justify-content-between m-3 border-bottom pb-2" id="task-<?php echo $task->id ?>">
          <div class="task-content col-md-6 text-left row"><label class="fa fa-check-circle-o p-1"></label >
            <span id="content-<?php echo $task->id ?>"><?php echo $task->content ?></span>
        </div>
          <div class="task-options col-md-6 text-right">
            <button class="btn btn-sm btn-primary edit-task" task_id="<?php echo $task->id ?>"><i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger delete-task" task_id="<?php echo $task->id ?>"><i class="fa fa-trash"></i></button>
          </div>
        </div>
        
<?php endforeach ?>

  <center class="text-center empty-tasks m-3 pb-2" count='<?php echo count($data); ?>'>
    <?php echo (count($data) == 0)? 'You Have No Tasks' : ''; ?>
    </center>

    </div>

  </div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>
  <script>
    var  root_url = '<?php echo URLROOT ?>';

    $('body').on('click', '.edit-task', function(){
        var task_id = $(this).attr('task_id');
        var content = $('#content-'+task_id).html();
        
        $(this).replaceWith('<button class="btn btn-sm btn-success update" task_id="'+task_id+'"><i class="fa fa-check"></i></button>');
        
        $('#content-'+task_id).replaceWith('<input type="text" class="form-control col-sm-10" id="content-'+task_id+'" value="'+content+'">');
    });


    $('body').on('click', '.add_task', function(){
        

        var btn = $(this);
        var tasks = $('.tasks').html();
        var content = $('.new-task-content').val();

        $.ajax({
          url: root_url+"/pages/addtask",
          type: 'POST',
          dataType: 'json',
          data: {content: content},
          success: function (data) {
           if (data.error) 
           {
              alert(data.error);
           }
           else
           {  
              $('.tasks').html(data.result+''+tasks);
              $('.new-task-content').val('');
              $('.empty-tasks').html('').attr('count', parseInt($('.empty-tasks').attr('count'))+1);
           }
          }
        })

    });


    $('body').on('click', '.update', function(){
        var btn = $(this);

        var task_id = $(this).attr('task_id');
        var content = $('#content-'+task_id).val();

          $.ajax({
            url: root_url+"/pages/updatetask",
            type: 'POST',
            data: {content: content,task_id:task_id},
            success: function (data) {
              if (data == 'done') 
              {
               btn.replaceWith('<button class="btn btn-sm btn-primary edit-task" task_id="'+task_id+'"><i class="fa fa-edit"></i></button>');
               $('#content-'+task_id).replaceWith('<span id="content-'+task_id+'">'+content+'</span>');
             }
             else{
              alert(data);
             }
            }
          })

    });


    $('body').on('click', '.delete-task', function(){
        var btn = $(this);

        var empty = $('.empty-tasks');

        var task_id = $(this).attr('task_id');

        $.ajax({
          url: root_url+"/pages/deletetask",
          type: 'POST',
          data: {task_id:task_id},
          success: function (data) {
            if (data == 'done') 
            {
             $('#task-'+task_id).remove();

              empty.attr('count', parseInt(empty.attr('count'))-1);
              if (empty.attr('count') == '0') {
                  empty.html('You have no tasks');
              }
           }
           else{
            alert(data);
           }
          }
        })
    });

  </script>
</body>
</html>