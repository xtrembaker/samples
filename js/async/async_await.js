var i = 0;
var max = 10;

/**
 * ASYNC / AWAIT are "iterator decorator"
 *
 * @see https://babeljs.io/docs/plugins/preset-stage-2/
 * @returns {Promise}
 * @todo This script is not implemented yet, need to install babel preset to make async/await working
 */
function fetch(){
    return new Promise(function(resolve, reject){
        setTimeout(function(){

        }, 3000);
    })
}


async function trigger(){
    await fetch().then(function(){
        if(i < max){
            trigger();
        }
    });
}

trigger();