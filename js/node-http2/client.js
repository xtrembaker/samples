const http2 = require('http2');
const client = http2.connect('http://localhost:8002');
const { StringDecoder } = require('string_decoder');

const decoder = new StringDecoder('utf8');

/** req Http2Session */
const req = client.request({ ':method': 'GET', ':path': '/' });

req.on('connect', () => {
    console.log('connect ');
});

req.on('frameError', () => {
    console.log('frameError');
});

req.on('localSettings', () => {
    console.log('localSettings');
});

req.on('remoteSettings', () => {
    console.log('remoteSettings');
});

req.on('error', (error) => {
    console.log('caught error ', error);
});

req.on('socketError', (error) => {
    console.log('socketError ', error);
});

req.on('close', () => {
    console.log('connection closed ');
});

req.on('goaway', () => {
    console.log('goaway');
});

req.on('stream', () => {
   console.log('stream');
});

req.on('timeout', () => {
    console.log('timeout');
});

req.on('response', (responseHeaders) => {
    console.log('HEY !');
    console.log(responseHeaders);
    // do something with the headers
});
let data = '';
req.on('data', (chunk) => {
    console.log(decoder.write(chunk));
    // do something with the data
});
req.on('end', () => {
    console.log('end');
    client.destroy()
});
req.end();