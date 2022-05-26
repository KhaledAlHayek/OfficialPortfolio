// let shortcuts = [];
// const data = localStorage.getItem("shortcuts");
// if(data){
//   shortcuts = JSON.parse(data);
// }

// // add shortcuts to page
// const shortcutsBox = document.querySelector(".setting .sh-for-you .sh");
// const totalShortcuts = document.querySelector(".setting .sh-for-you .total-sh");

// window.onload = () => {
//   const total = shortcuts.length;
//   totalShortcuts.innerHTML = `<strong>${total}</strong> shortcuts found.`
//   shortcuts.map(shortcut => {
//     const name = shortcut.pageName;
//     const desc = shortcut.description;
//     const link = shortcut.pageLink;
//     let html = `
//       <div class="the-shortcut">
//         <div class="sh-info">
//           <i class="fas fa-clone"></i>
//           <h3 class="sh-name">${name}</h3>
//           <span class="sh-desc">${desc}</span>
//         </div>
//         <div class="add">
//           <form action="shortcuts.php?shortcut=new" method="POST">
//             <input type="hidden" value="${name}" name="name" />
//             <input type="hidden" value="${link}" name="link" />
//             <input type="hidden" value="${desc}" name="desc" />
//             <button name="add-sh"><i class="fas fa-plus"></i></button>
//           </form>
//         </div>
//       </div>
//     `
//     shortcutsBox.innerHTML += html;
//   });
// };
