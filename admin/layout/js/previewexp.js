const toggleBox = document.querySelectorAll(".request-successfullt-sent .preview-exp .preview-data .head");

toggleBox.forEach(box => {
  box.addEventListener("click", () => {
    box.classList.toggle("show");
    const bodyBox = box.nextElementSibling;
    if(box.classList.contains("show")){
      box.classList.add("toggle-info");
      bodyBox.style.display = "block";
    }
    else{
      box.classList.remove("toggle-info");
      bodyBox.style.display = "none";
    }
  });
});