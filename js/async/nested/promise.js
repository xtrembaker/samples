/**
 * THIS EXAMPLE SHOWS NESTED CALL. IT CALL CONTINUSLY THE FUNCTION UNTIL WE DECIDE TO STOP.
 * HERE, WE DECIDE TO STOP IT ONCE "i" REACH "max" VALUE, BUT IT COULD BE ANYTHING, LIKE THE MAX PAGE WHEN PAGINATED
 * @type {number}
 */

var i = 0;
var max = 10;

function fetch(){
    return new Promise(function(resolve, reject){
        setTimeout(function(){
            i++;
            resolve(i);
        }, 3000);
    });
}

function trigger(){
    console.log('trigger called with ', i);
    // result = i
    fetch().then(function(result){
        if(result < max){
            trigger();
        }
    });
}

trigger();