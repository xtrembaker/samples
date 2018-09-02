const http2 = require('http2');
const fs = require('fs');

const server = http2.createServer({
    // key: fs.readFileSync('localhost.key'),
    // cert: fs.readFileSync('localhost.cert'),
    // allowHTTP1: true
})

server.on('stream', (stream, headers) => {
    // stream is a Duplex
    stream.respond({
        'content-type': 'text/html',
        ':status': 200
    });
    // stream.end();
    stream.write('ueiueueu');
    stream.end('<h1>Hello World !!!</h1>');
});

server.listen(8002);

//const http = require('http');

//create a server object:
// http.createServer(function (req, res) {
//     res.write('Hello World!'); //write a response to the client
//     res.end(); //end the response
// }).listen(8002); //the server object listens on port 8080