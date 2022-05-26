<?php 
  $page_title = "To Do List";
  $header_title = "To Do List";
  $js_file = "todo-min.js";
  include_once "init.php";
  include_once $template . "header.php";
  include_once $template . "pageheader.php";
  ?>
  <div class="new-todo">
    <div class="new">
      <i class="fas fa-plus"></i>
      <span>New Todo</span>
    </div>
  </div>
  <div class="todo-list">
    <div class="list-header">
      <div class="header-title">
        <h2>My ToDo List</h2>
      </div>
      <div class="todo-action">
        <ul>
          <li class="completed-todo">
            <i class="fas fa-check completed-todo"></i>
            <div class="action-tooltip expand">Mark as completed</div>
          </li>
          <li class="delete-todo">
            <i class="fas fa-trash delete-todo"></i>
            <div class="action-tooltip delete">Delete</div>
          </li>
          <li class="edit-todo">
            <i class="fas fa-edit edit-todo"></i>
            <div class="action-tooltip edit">Edit</div>
          </li>
          <li class="not-completed">
            <i class="fas fa-ban not-completed"></i>
            <div class="action-tooltip expand">Mark as not completed</div>
          </li>
        </ul>
      </div>
    </div>
    <div class="list-body">
      <div class="check-all">
        <div class="check">
          <input type="checkbox" id="checkall" class="check-all-inputs">
          <label for="checkall">Check All</label>
        </div>
        <div class="mark-all">
          <span>Mark All As Completed</span>
        </div>
      </div>
      <div class="the-todo">
        <?php 
          /* 
          <div class="todo-box">
            <div class="check">
              <input type="checkbox" id="input-1">
            </div>
            <div class="todo-text">
              <label for="input-1" class="act-as-header completed">Subject Here</label>
              <label for="input-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, architecto? Et atque amet soluta. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate cupiditate quis aut unde eum architecto quisquam natus, numquam, a harum voluptatibus quaerat. Totam esse accusantium quod nesciunt dicta quas perferendis?</label>
            </div>
          </div>
          */
        ?>
      </div>
    </div>
  </div>
  <div class="todo-popup hide-popup add-new-todo">
    <div class="new-box box">
      <div class="close-box" data-target="add-new-todo">
        <i class="fas fa-times"></i>
      </div>
      <div class="add-icon">
        <i class="fas fa-plus"></i>
      </div>
      <div class="add-todo">
        <div class="add-title">
          <h2>Add New Todo</h2>
        </div>
        <form action="" id="add-todo">
          <div class="input">
            <label for="subject">Subject</label>
            <input type="text" id="subject" class="subject">
          </div>
          <div class="input">
            <label for="text">ToDo Text</label>
            <input type="text" id="text" class="text">
          </div>
          <div class="submit">
            <span class="cancel">Cancel</span>
            <button class="submit-todo">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="todo-popup hide-popup edit-todo-box">
    <div class="new-box">
      <div class="add-icon for-edit">
        <i class="fas fa-edit"></i>
      </div>
      <form action="" id="submit-multiples">
        <div class="edit-box submit-form">
          <button>Save Changes</button>
        </div>
      </form>
    </div>
  </div>
  <div class="loading">
    <div class="bouncing-balls">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <?php
  include_once $template . "footer.php";
?>