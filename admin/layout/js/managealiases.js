let shortcuts = [];
let data = localStorage.getItem("shortcuts") 
if(data){
  shortcuts = JSON.parse(data);
}
// add to local storage
const setLocalStorage = arr => {
  localStorage.setItem("shortcuts", JSON.stringify(arr));
}

// add shortcut
const addShortcut = (name, link, desc) => {
  const shortcut = {
    id: Date.now(),
    pageName: name,
    pageLink: link,
    description: desc
  }
  shortcuts.push(shortcut);
  setLocalStorage(shortcuts);
}

// remove shortcut
const removeShortcut = id => {
  shortcuts = shortcuts.filter(sh => sh.id != id);
  setLocalStorage(shortcuts);
}

// edit shortcut
const updateShortcut = (shid, name, link, desc) => {
  for(let i = 0 ; i < shortcuts.length; i++){
    if(shortcuts[i].id == shid){
      shortcuts[i].pageName = name;
      shortcuts[i].pageLink = link;
      shortcuts[i].description = desc;
    }
  }
  setLocalStorage(shortcuts);
}
// shortcut info
const shortcutInfo = id => {
  return shortcuts.filter(shortcut => shortcut.id == id);  
}

// remove message alert
const removeAlert = el => {
  setTimeout(() => {
    el.style.display = "none";
  }, 5000);
}

// error message
const failureMessage = (el, msg) => {
  el.innerHTML = msg;
}

// success message
const successMessage = (el, msg) => {
  el.innerHTML = msg;
}

// process message
const processMessage = (error, el, msg) => {
  const icon = el.querySelector("i");
  const text = el.querySelector("span");
  if(error){
    el.style.display = "block";
    el.classList.add("error");
    icon.classList.add("fas", "fa-times");
    failureMessage(text, msg)
    removeAlert(el);
  }
  else{
    el.style.display = "block";
    el.classList.add("success");
    icon.classList.add("fas", "fa-check");
    successMessage(text, msg);
    removeAlert(el);
  }
}

// show shortcut
const shortcutBox = document.querySelectorAll(".setting .aliases > div .head");
shortcutBox.forEach(box => {
  box.addEventListener("click", () => {
    let infoBox = box.nextElementSibling; 
    box.classList.toggle("show-info");
    if(box.classList.contains("show-info")){
      infoBox.style.display = "block";
    }
    else{
      infoBox.style.display = "none";
    }
  });
});

// add shortcut form
const addShortcutForm = document.forms["add-shortcut"];
const addMessage = document.querySelector(".setting .aliases .add-alias .alias-action .msg");
addShortcutForm.addEventListener("submit", e => {
  e.preventDefault();
  let name = addShortcutForm.name.value;
  let link = addShortcutForm.link.value;
  let desc = addShortcutForm.desc.value;
  let pattern = /\w+/ig;
  if(name.match(pattern) && link.match(/(https?:\/\/)?(www.)?\w+\W+/ig) && desc.match(pattern)){
    console.log("passed");
    addShortcut(name, link, desc);
    processMessage(null, addMessage, "Page alias has been added and can be used by other managers.");
    addShortcutForm.reset();
  }
  else{
    console.log("not passed");
    // error
    processMessage("error", addMessage, "Page alias not added. Please try again");
  }
});

// edit shortcut form
const selectShortcut = document.querySelector(".setting .aliases .edit-alias .alias-action .select-shortcut select");
const editShortcutForm = document.forms["edit-shortcut"];
const editMessage = document.querySelector(".setting .aliases .edit-alias .alias-action .msg");
selectShortcut.addEventListener("change", () => {
  const id = selectShortcut.value;
  if(id){
    const info = shortcutInfo(id);
    editShortcutForm.style.display = "block";
    const shID = editShortcutForm.querySelector(".sh-id");
    const name = editShortcutForm.querySelector(".edit-name");
    const link = editShortcutForm.querySelector(".edit-link");
    const desc = editShortcutForm.querySelector(".edit-desc");
    info.map(shortcut => {
      name.value = shortcut.pageName;
      link.value = shortcut.pageLink;
      desc.value = shortcut.description;
      shID.value = shortcut.id;
    })
  }
});
editShortcutForm.addEventListener("submit", e => {
  e.preventDefault();
  const id = editShortcutForm.id.value;
  const name = editShortcutForm.name.value;
  const link = editShortcutForm.link.value;
  const desc = editShortcutForm.desc.value;
  let pattern = /\w+/ig;
  if(name.match(pattern) && link.match(/(https?:\/\/)?(www.)?\w+\W+/ig) && desc.match(pattern)){
    updateShortcut(id, name, link, desc);
    processMessage(null, editMessage, "Shortcut updated successfully.");
    editShortcutForm.reset();
  }
  else{
    processMessage("error", editMessage, "Something went wrong. Please try again.");
  }
});

// remove shortcut
const selectToRemove = document.querySelector(".setting .aliases .remove-alias .alias-action .select-shortcut select");
const deleteShortcutForm = document.forms["delete-shortcut"];
const deleteMessage = document.querySelector(".setting .aliases .remove-alias .alias-action .msg");
selectToRemove.addEventListener("change", () => {
  deleteShortcutForm.style.display = "block";
  const id = selectToRemove.value;
  deleteShortcutForm.querySelector(".sh-id").value = id;
});
deleteShortcutForm.addEventListener("submit", e => {
  e.preventDefault();
  const id = deleteShortcutForm.id.value;
  removeShortcut(id);
  processMessage(null, deleteMessage, "Shortcut has been deleted.")
});

// fill select options when window first time loads
window.onload = () => {
  fillSelectOptions(selectShortcut);
  fillSelectOptions(selectToRemove);
};

const fillSelectOptions = el => {
  shortcuts.forEach(shortcut => {
    const id = shortcut.id;
    const pageName = shortcut.pageName;
    const option = document.createElement("option");
    option.setAttribute("value", id);
    const optionText = document.createTextNode(pageName);
    option.appendChild(optionText);
    el.appendChild(option);
  });
}