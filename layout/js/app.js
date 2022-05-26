if("serviceWorker" in navigator){
  navigator.serviceWorker.register("/Portfolio/sw.js").then(console.log("Serviceworker has been registered"));
}