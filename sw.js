const staticCacheName = "static-cache-v1";
const dynamicCacheName = "dynamic-cache-v1";
const assets = [
  "/Portfolio/",
  "/Portfolio/index.php",
  "/Portfolio/layout/fonts/ar.css",
  "/Portfolio/layout/fonts/index.css",
  "/Portfolio/layout/dist/css/main.css",
  "/Portfolio/layout/dist/js/index-min.js",
  "https://fonts.gstatic.com/s/almarai/v12/tssoApxBaigK_hnnS_antnqWow.woff2",
  "https://fonts.gstatic.com/s/quicksand/v24/6xKtdSZaM9iE8KbpRA_hJFQNcOM.woff2",
  "/Portfolio/includes/language/ar.php",
  "/Portfolio/includes/language/en.php",
  "/Portfolio/includes/templates/header.php",
  "/Portfolio/includes/templates/footer.php",
  "/Portfolio/includes/functions/functions.php",
  "/Portfolio/fallback.php"
];

self.addEventListener("install", e => {
  /* e.waitUntil(
    caches.open(staticCacheName).then(cache => cache.addAll(assets)).then(err => console.log(err))
  ); */
});

self.addEventListener("activate", e => {
  /* e.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys.filter(key => key !== staticCacheName && key !== dynamicCacheName).map(key => caches.delete(key))
      );
    })
  ) */
});

self.addEventListener("fetch", e => {
  /* e.respondWith(
    caches.match(e.request).then(res => {
      return res || fetch(e.request).then(fetchres => {
        caches.open(dynamicCacheName).then(cache => {
          cache.put(e.request.url, fetchres.clone())
          return fetchres;
        })
      })
    }).catch(() => caches.match("/Portfolio/fallback.php"))
  ) */
});