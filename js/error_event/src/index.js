window.addEventListener('error', function(error){
    console.log('error trigger', error);
});

throw new Error('toto');
