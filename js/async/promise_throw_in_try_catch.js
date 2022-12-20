const asyncThatThrow = async function(){
    return Promise.reject('promise was rejected');
}

async function main(){
    try{
        return asyncThatThrow(); // this will throw an UnhandledPromiseRejection (we must await in that case, event without response needed)
    }catch(err) {
        console.log('error', err);
    }finally {
        console.log('finally should be called');
    }
}

(async function(){
    const result = await main();
    console.log(result);
})()
