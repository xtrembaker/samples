var Sequelize = require('sequelize');

// Version of callback
var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});

// Do the query
var query = function query(){
    sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function (results){
      // As soon as results are found, pass it to the iterator as next value
      it.next(results);
    });
};

var afterQuery = function afterQuery(count){
  console.log('Count equal :' + count);
  sequelize.close();
};

function* main(){
  // Wait for the "next" to be call
  var results = yield query();
  afterQuery(results);
}
// Start, main return a generator
var it = main();
// Process until the first "yield"
it.next();

//-------------------
// TO SUMMARY : Yield wait until the "next" function is called to processing the program
