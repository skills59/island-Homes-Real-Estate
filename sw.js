self.addEventListener('install', function(e) {
    e.waitUntil(
        caches.open('static').then(function(cache) {
            return cache.addAll([
                "./", 
                "./index.html", 
                "./assets/css/skillfulstyleone.css", 
                "./assets/css/skillfulstyletwo.css", 
                "./assets/css/skills.css", 
                "./assets/css/search.css", 
                "./assets/images/logo.png", 
                "./assets/images/favicon.ico", 
                "./assets/images/logo512.png",
                "./assets/images/index-bg.jpg"
            ]);
        })
  );
});

self.addEventListener('fetch', function(e) {
    console.log(e.request.url);
    e.respondWith(
      caches.match(e.request).then(function(response) {
        return response || fetch(e.request);
      })
    );
  });