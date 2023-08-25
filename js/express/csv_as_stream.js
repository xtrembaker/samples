const express = require('express')
const app = express()

const csvLines = function* () {

    for (let i = 0; i < 1000; i++) {
        yield* [
            `${i};firstName${i};lastName${i}\n`,
        ];
    }

}

app.get('/', function async(req, res) {
    res.write("id;first_name;last_name\n")
    for (const csvLine of csvLines()){
        res.write(csvLine)
    }
    res.end();
})

app.listen(3000)