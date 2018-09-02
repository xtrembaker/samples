var Queue = require('bull');

var videoQueue = Queue('video transcoding', 6379, '127.0.0.1');
// var audioQueue = Queue('audio transcoding', 6379, '127.0.0.1');
// var imageQueue = Queue('image transcoding', 6379, '127.0.0.1');
// var pdfQueue = Queue('pdf transcoding', 6379, '127.0.0.1');

videoQueue.on('completed', function(){
    console.log('Fin des jobs !');
});

videoQueue.process(function(job, done){

    console.log('process video', job.data);

    if(job.data.name === 'delay'){
        console.log('DELAY !!', job.jobId);
        job.timestamp = Date.now();
        job.delay = 5000;
        job.delayIfNeeded();


        done();
    }

    done();

    // job.data contains the custom data passed when the job was created
    // job.jobId contains id of this job.

    // transcode video asynchronously and report progress
    //job.progress(42);

    //videoQueue.add({video: 'http://example.com/video1.mov'}, {delay : 10000});

    // call done when finished
    //done();

    // or give a error if error


    // or pass it a result
    //done(null, {framerate: 29.5 /* etc... */});

    // If the job throws an unhandled exception it is also handled correctly
    //throw (Error('some unexpected error'));
});