const http2 = require('http2');
const { StringDecoder } = require('string_decoder');

const decoder = new StringDecoder('utf8');


const http2Session = http2.connect('http://localhost:8002');
//
const http2Stream = http2Session.request({
    ':method': 'GET',
    ':path': '/init'
});
//
// // Listen to headers
// http2Stream.on('response', (headers, flags) => {
//    console.log('headers', headers);
//    console.log('flags', flags);
// });
//
// // Listen to payload
http2Stream.on('data', (chunk) => {
    console.log(decoder.write(chunk));
});

// http2Stream.on('push', (headers) => {
//     console.log('push event received !');
// });