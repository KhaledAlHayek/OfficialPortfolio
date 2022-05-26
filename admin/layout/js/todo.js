// let searchToDoForm = document.forms['search-to-do'];
// let searchField    = searchToDoForm.querySelector(".search");
// let thePlaceholder = searchToDoForm.querySelector(".placeholder");
// searchField.onfocus = replacePlaceholder;

// function replacePlaceholder() {
//   thePlaceholder.classList.add("above-input");
// }
// searchField.onblur = managePlaceholder;
// function managePlaceholder() {
//   let value = searchField.value.length;
//   if(value == 0){
//     thePlaceholder.classList.remove("above-input");
//   }
//   else{
//     searchField.classList.add("has-chars");
//   }
// }
let addToDoBox = document.querySelector(".new-todo .new");
let closeToDoPopups = document.querySelectorAll(".todo-popup .box .close-box");
closeToDoPopups.forEach(icon => {
  icon.addEventListener("click", e => {
    let boxClassName = e.currentTarget.dataset.target;
    if(boxClassName != ""){
      let targetBox = document.querySelector(`.${boxClassName}`);
      targetBox.classList.add("hide-popup");
    }
    else{
      let theTarget = e.currentTarget.parentElement.parentNode;
      theTarget.classList.add("hide-popup");
    }
  })
});

addToDoBox.onclick = showAddBox;
let formAddToDo = document.forms['add-todo'];
let formAddElements = Array.from(formAddToDo.children);
let tasksBox = document.querySelector(".todo-list .list-body .the-todo");
let tasks = [];
if(localStorage.getItem("tasks")){
  tasks = JSON.parse(localStorage.getItem("tasks"));
}
get();
formAddToDo.addEventListener("submit", e => {
  e.preventDefault();
  let toDoSubject = formAddToDo.querySelector(".subject").value;
  let toDoText = formAddToDo.querySelector(".text").value;
  if(toDoSubject == ""){
    formAddToDo.querySelector(".subject").focus();
  }
  if(toDoText == ""){
    formAddToDo.querySelector(".text").focus();
  }
  if(toDoSubject != "" && toDoText != ""){
    let loading = document.querySelector(".loading");
    loading.classList.add("show");
    setTimeout(() => {
      loading.classList.remove("show");
    }, 3000);
    removeAddBox();
    add(toDoSubject, toDoText);
    refresh();
  }
})
function showAddBox() {
  document.querySelector(".add-new-todo").classList.remove("hide-popup");
}
function removeAddBox() {
  document.querySelector(".add-new-todo").classList.add("hide-popup");
}

// Local Storage
function add(subject, content){
  const task = {
    id: Date.now(),
    subject: subject,
    content: content,
    completed: false
  };
  tasks.push(task);
  addToLocalStorage(tasks);
  fill(tasks);
}
function addToLocalStorage(arr) {
  localStorage.setItem("tasks", JSON.stringify(arr))
}
function get() {
  if(localStorage.getItem("tasks")){
    let task = JSON.parse(localStorage.getItem("tasks"));
    fill(task);
  }
}
function fill(arr) {
  tasksBox.innerHTML = "";
  arr.forEach(task => {
    // Main Div
    let mainDiv = document.createElement("div");
    mainDiv.className = "todo-box";
    // Children Div [.check]
    let checkDiv = document.createElement("div");
    checkDiv.className = "check";
    // Children Div [.todo-text]
    let textDiv = document.createElement("div");
    textDiv.className = "todo-text";
    // The Input
    let theCheckBox = document.createElement("input");
    theCheckBox.setAttribute("type", "checkbox");
    theCheckBox.setAttribute("id", `i${task.id}`);
    theCheckBox.className = "single-checkbox";
    // Append Input For its Corresponding Parent
    checkDiv.appendChild(theCheckBox);
    // Subject Label
    let theSubjectLabel = document.createElement("label");
    theSubjectLabel.className = task.completed ? "act-as-header completed" : "act-as-header";
    theSubjectLabel.appendChild(document.createTextNode(task.subject));
    theSubjectLabel.setAttribute("for", `i${task.id}`);
    // Content Label
    let theContentLabel = document.createElement("label");
    theContentLabel.setAttribute("for", `i${task.id}`);
    theContentLabel.appendChild(document.createTextNode(task.content));
    // Append Labels For Their Corresponding Parent
    textDiv.appendChild(theSubjectLabel);
    textDiv.appendChild(theContentLabel);
    // Append All Children To Their Parent
    mainDiv.appendChild(checkDiv)
    mainDiv.appendChild(textDiv);
    // Append Div To The DOM
    tasksBox.appendChild(mainDiv);
  })
}
function getTaskByID(id) {
  return tasks.filter(task => task.id == id)
}
function deleteTask(id){
  tasks = tasks.filter(task => task.id != id);
  updateTodoBox(tasks);
}
function finished(id){
  let theTask = tasks.filter( task => task.id == id);
  theTask[0].completed = true;
  updateTodoBox(tasks);
}
function notFinsihed(id){
  let theTask = tasks.filter(task => task.id == id);
  theTask[0].completed = false;
  updateTodoBox(tasks);
}
function finishedMultiple(...id){
  id.forEach(id => {
    let tasksChecked = tasks.filter(task => task.id == id);
    tasksChecked.forEach(task => {
      task.completed = true;
    })
    updateTodoBox(tasks);
  })
}
function notFinsihedMultiple(...id){
  id.forEach(id => {
    let tasksChecked = tasks.filter(task => task.id == id);
    tasksChecked.forEach(task => {
      task.completed = false;
    })
    updateTodoBox(tasks);
  })
}
function updateTodoBox(arr) {
  addToLocalStorage(arr);
  tasksBox.innerHTML = "";
  refresh();
  fill(arr);
}
function refresh(){
  location.href = "todo.php";
}
let singleTaskCheckbox = document.querySelectorAll(".todo-list .list-body .the-todo input[type='checkbox']");
let toDoActions = document.querySelector(".list-header .todo-action");
function showActions() {
  toDoActions.classList.add("show-actions");
}
function hideActions(){
  toDoActions.classList.remove("show-actions");
}
document.addEventListener("change", e => {
  if(e.target.classList.contains("check-all-inputs")){
    let checked = e.target.checked;
    if(checked){
      singleTaskCheckbox.forEach(checkbox => {
        checkbox.setAttribute("checked", "true");
      })
      showActions();
    }
    else{
      singleTaskCheckbox.forEach(checkbox => {
        checkbox.removeAttribute("checked");
      })
      hideActions();
    }
  }
})
let completedAction = document.querySelector(".completed-todo");
let notCompletedAction = document.querySelector(".not-completed");
// completedAction.onclick = function() {
//   singleTaskCheckbox.forEach(checkbox => {
//     if(checkbox.checked){
//       let doneTasks = [];
//       let taskID = checkbox.getAttribute("id");
//       doneTasks.push(taskID.substring(1));
//       finishedMultiple(doneTasks);
//     }
//   })
// }
// notCompletedAction.onclick = function() {
//   singleTaskCheckbox.forEach(checkbox => {
//     if(checkbox.checked){
//       let notDoneTasks = [];
//       let taskID = checkbox.getAttribute("id");
//       notDoneTasks.push(taskID.substring(1));
//       notFinsihedMultiple(notDoneTasks);
//     }
//   })
// }
let counter = 0;
for(let i = 0; i < singleTaskCheckbox.length; i++){7
  singleTaskCheckbox[i].addEventListener("change", e => {
    if(singleTaskCheckbox[i].checked){
      counter++;
    }
    else{
      counter--;
    }
    let taskId = e.currentTarget.getAttribute("id");
    let id = taskId.substring(1);
    let theActionBox = document.querySelector(".todo-action");
    console.log(counter);
    // if(counter == 1){
      // showActions();
      // theActionBox.addEventListener("click", e => {
      //   if(e.target.classList.contains("completed-todo")){
      //     finished(id);
      //   }
      //   else if(e.target.classList.contains("not-completed")){
      //     notFinsihed(id);
      //   }
      // else if(e.target.classList.contains("delete-todo")){
      //   deleteTask(id);
      // }
      // })
    // }
    if(counter > 0){
      showActions();
      theActionBox.addEventListener("click", e => {
        let arr = [];
        singleTaskCheckbox.forEach(checkbox => {
          if(checkbox.checked){
            arr.push(checkbox.getAttribute("id").substring(1));
          }
        });
        if(e.target.classList.contains("completed-todo")){
          for(let id of arr){
            let currentTask = tasks.filter(task => task.id == id);
            currentTask[0].completed = true;
          }
          updateTodoBox(tasks);
        }
        if(e.target.classList.contains("not-completed")){
          for(let id of arr){
            let currentTask = tasks.filter(task => task.id == id);
            currentTask[0].completed = false;
          }
          updateTodoBox(tasks);
        }
        if(e.target.classList.contains("delete-todo")){
          for(let id of arr){
            tasks = tasks.filter(task => task.id != id);
          }
          updateTodoBox(tasks);
        }
        if(e.target.classList.contains("edit-todo")){

        }
      })
    }
    else{
      hideActions();
    }
  })
}

let checkAll = document.querySelector(".list-body .check-all-inputs");
checkAll.addEventListener("change", e => {
  let markAllButton = checkAll.parentElement.nextElementSibling;
  if(checkAll.checked){
    markAllButton.style.display = "block";
    markAllButton.addEventListener("click", markAllAsCompleted)
  }
  else{
    markAllButton.style.display = "none";
  }
})
function markAllAsCompleted(){
  singleTaskCheckbox.forEach(checkbox => {
    if(checkbox.checked){
      let doneTasks = [];
      let taskID = checkbox.getAttribute("id");
      doneTasks.push(taskID.substring(1));
      finishedMultiple(doneTasks);
    }
  })
}
let toDoEditPopup = document.querySelectorAll(".todo-popup .new-box form .edit-box");
toDoEditPopup.forEach(box => {
  box.addEventListener("click", e => {
    toDoEditPopup.forEach(box => {
      box.classList.remove("current-expanded");
      box.classList.remove("active-one");
    })
    e.currentTarget.classList.toggle("active-one");
    if(e.currentTarget.classList.contains("active-one")){
      e.currentTarget.classList.add("current-expanded");
    }
    else{
      e.currentTarget.classList.remove("current-expanded");
    }
  });
})

let editToDoButton = document.querySelector(".edit-todo");
let toDoEditBox = document.querySelector(".edit-todo-box");
let formSubmitEdit = document.forms['submit-multiples'];
editToDoButton.addEventListener("click", () => {
  toDoEditBox.classList.remove("hide-popup");
  let toBeEdited = [];
  singleTaskCheckbox.forEach(input => {
    if(input.checked){
      let id = input.getAttribute("id").substring(1);
      toBeEdited.push(id);
    }
  })
  generateEditForms(toBeEdited);
});
function generateEditForms(arr){
  let totals = arr.length;
  for(let i = 0; i < totals; i++){
    // Main Div
    let mainDiv = document.createElement("div");
    mainDiv.className = "edit-box";
    // Div Heading
    let divHead = document.createElement("div");
    divHead.className = "edit-head";
    // Div Heading Title
    let titleDiv = document.createElement("div");
    titleDiv.className = "title";
    // Div Heading Title H3
    let heading = document.createElement("h3");
    heading.appendChild(document.createTextNode("Subject"));
    titleDiv.appendChild(heading);
    // Div Heading Arrow
    let arrowDiv = document.createElement("div");
    arrowDiv.className = "arrow";
    // Div Heading Arrow i
    let icon = document.createElement("i");
    icon.className = "fas fa-arrow-down";
    arrowDiv.appendChild(icon);
    divHead.appendChild(titleDiv);
    divHead.appendChild(arrowDiv);
    // Div Body
    let divBody = document.createElement("div");
    divBody.className = "edit-body";
    // Input Box 1 ************
    let inputBoxOne = document.createElement("div");
    inputBoxOne.className = "input";
    let labelOne = document.createElement("label");
    labelOne.setAttribute("for", `subject-${arr[i]}`)
    labelOne.appendChild(document.createTextNode("Subject"));
    // Input Box 2 ************
    let inputBoxTwo = document.createElement("div");
    inputBoxTwo.className = "input";
    let labelTwo = document.createElement("label");
    labelTwo.setAttribute("for", `subject-${arr[i]}`)
    labelTwo.appendChild(document.createTextNode("Subject"));
    divBody.appendChild(inputBoxOne)
    divBody.appendChild(inputBoxTwo)
    mainDiv.appendChild(divHead);
    mainDiv.appendChild(divBody);
    formSubmitEdit.prepend(mainDiv);
  }
}