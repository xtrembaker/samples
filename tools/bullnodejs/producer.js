var Queue = require('bull');

var videoQueue = Queue('video transcoding', 6379, '127.0.0.1');

//videoQueue.add({name: 'coucou !'});
videoQueue.add({name: 'toto'});

//process.exit();