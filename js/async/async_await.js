var i = 0;
var max = 10;

/**
 * ASYNC / AWAIT are "iterator decorator"
 *
 * @see https://babeljs.io/docs/plugins/preset-stage-2/
 * @returns {Promise}
 */
function fetch(){
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
    var result = await fetch();
    console.log('i : ', i);
    if(i < max){
        i++;
        trigger();
    }
}

trigger();



