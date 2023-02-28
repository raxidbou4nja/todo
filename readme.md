# Todo App with jQuery and PHP
This is a simple Todo app that uses jQuery and PHP to create, read, update, and delete tasks from a database. The app allows users to:

* Add a new task
* View existing tasks
* Update the status of a task
* Delete a task
## Getting Started
To use this app, you'll need to have a web server running PHP and a MySQL database. Here's how to get started:

* Clone or download the repository to your local machine.

* Create a new database in MySQL, and import the todo.sql file in the database directory to create the necessary table.

* Update the database configuration in the config.php file with your MySQL database credentials:

``` 
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASSWORD', 'your_database_password');
Upload the files to your web server.
``` 
Open the app in your web browser and start adding tasks!

## Usage
### Adding a New Task
To add a new task, enter a task name in the input field at the top of the page and click the "Add Task" button. The task will be added to the database and displayed in the task list.

### Viewing Tasks
All existing tasks are displayed in the task list on the main page. Tasks are sorted by status (completed tasks are displayed at the bottom of the list).

### Updating Task Status
To update the status of a task, click the checkbox next to the task name. The status of the task will be updated in the database and the task will be moved to the appropriate section of the task list.

### Deleting a Task
To delete a task, click the "x" icon next to the task name. The task will be removed from the database and from the task list.

## License
This app is licensed under the MIT License. See the LICENSE file for details.


