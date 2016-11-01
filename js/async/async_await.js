var i = 0;
var max = 10;

/**
 * ASYNC / AWAIT are "iterator decorator"
 *
 * @see https://babeljs.io/docs/plugins/preset-stage-2/
 * @returns {Promise}
 */
function fetch(){
    throw Error('toto');
    return new Promise(function(resolve, reject){
        setTimeout(function(){
            resolve();
        }, 3000);
    })
}


/**
 * /!\ CAN'T throw error in async / await : (node:23852) UnhandledPromiseRejectionWarning: Unhandled promise rejection (rejection id: 1): ##ERROR##
 */
async function trigger(){
    throw "erreur";
    try {
        //var result = await fetch();
        console.log('i : ', i);
        if(i < max){
            i++;
            trigger();
        }
    }catch (err){
        console.log('log');

    }

}

//trigger()
    //.catch(function () {
    //console.log('caught !');
//});


async function asyncFun () {
    var value = await Promise
        .resolve(1)
        .then(x => x * 3)
        .then(x => x + 5)
        .then(x => x / 2);
    return value;
}
asyncFun().then(x => console.log(`x: ${x}`));





