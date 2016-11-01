var nock = require('nock');
var http = require('http');
var querystring = require('querystring');

//!\ Pour un POST, il faut que les données passés dans le payload mocké, correspondent à celle passés dans le payload
// réel. Sinon : Got error: Nock: No match for request POST http://domainName/path DATA
var couchdb = nock('http://localhost:8080')
    .post('/api/v1/me/passwordrecover/send', querystring.stringify({
        email: 'toto@gmail.com'
    }))
    .reply(200, {
         _id: '123ABC',
         _rev: '946B7D1C',
         username: 'pgte',
         email: 'pedro.teixeira@gmail.com'
    });

var options = {
    hostname: 'localhost',
    port: 8080,
    path: '/api/v1/me/passwordrecover/send',
    method: 'POST',
};
var req = http.request(options, (res) => {
    res.setEncoding('utf8');
    let rawData = '';
    res.on('data', (chunk) => rawData += chunk);
    res.on('end', () => {
        try {
            let parsedData = JSON.parse(rawData);
            console.log(parsedData);
        } catch (e) {
            console.log(e.message);
        }
    });
}).on('error', (e) => {
    console.log(`Got error: ${e.message}`);
});

req.write(querystring.stringify({
    email: 'toto@gmail.com'
}));
req.end();