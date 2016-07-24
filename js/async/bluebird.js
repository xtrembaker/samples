//#########################
//
// NOT DONE YET !
//
//#########################
var Sequelize = require('sequelize');
var Promise = require('bluebird');
// Version using Promise
var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});

// var query = function *query () {
//     console.log("Query !");
//     var result = [];
//     return sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function(results){
//       result = results[0].count;
//     }).catch(function(err){
//       //reject(err);
//     });
//     console.log('result :',result);
//     return result;
// };
// //
// var afterQuery = function afterQuery(count){
//   console.log('Count equal :' + count);
//   sequelize.close();
// };
//
// var response = yield query();
// response.next();
// console.log(count);
// afterQuery(count);
//console.log('right after !');



function *main() {
    var result1 = yield request( "http://some.url.1" );
    var data = JSON.parse( result1 );

    var result2 = yield request( "http://some.url.2?id=" + data.id );
    var resp = JSON.parse( result2 );
    console.log( "The value you asked for: " + resp.value );
}

var it = main();
it.next();
