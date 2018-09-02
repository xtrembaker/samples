const http2 = require('http2');
const fs = require('fs');

const server = http2.createServer({
    // key: fs.readFileSync('localhost.key'),
    // cert: fs.readFileSync('localhost.cert'),
    // allowHTTP1: true
})

/** stream Http2Stream */
server.on('stream', (stream, headers) => {
    if(headers[':path'] === '/init'){
        console.log('try to push');
        stream.pushStream({ ':path': '/init' }, (pushStream) => {
            pushStream.respond({ ':status': 200 });
            pushStream.end('some pushed data');
        });

        // stream is a Duplex
        stream.respond({
            'content-type': 'text/html',
            ':status': 200
        });
        // Must be a string to be trigger by "data" on client side
        stream.end(JSON.stringify({
            'status' : 'success'
        }));
    }
});

server.listen(8002);