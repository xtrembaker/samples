//#########################
//
// NOT DONE YET !
//
//#########################
// var Sequelize = require('sequelize');
// var Promise = require("bluebird");
//
// function PingPong() {
//
// }
//
// PingPong.prototype.ping = function(val){
//   var self = this;
//   function* ping(val){
//     console.log("Ping?", val)
//     yield Promise.delay(500).then(function() {
//         p.next();
//     })
//     self.pong(val+1);
//   };
//   var p = ping(val);
//   p.next();
//   //p.next();
// };
//
// // PingPong.prototype.ping = Promise.coroutine(function* (val) {
// //     console.log("Ping?", val)
// //     yield Promise.delay(500)
// //     this.pong(val+1);
// // });
//
// PingPong.prototype.pong = Promise.coroutine(function* (val) {
//     console.log("Pong!", val)
//     yield Promise.delay(500);
//     this.ping(val+1)
// });
//
// var a = new PingPong();
// a.ping(0);



var Sequelize = require('sequelize');
var Promise = require('bluebird');
// Version of callback
var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});

// Do the query
var query = function query(){
    sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function (results){
      // As soon as results are found, pass it to the iterator as next value
      // it.next(results);
      Promise.resolve(results);
    });
};

var afterQuery = function afterQuery(count){
  console.log('Count equal :' + count);
  sequelize.close();
};

var main = Promise.coroutine(function* (val) {
  yield sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function (results){
    // As soon as results are found, pass it to the iterator as next value
    // it.next(results);
    Promise.resolve(results);
  });
  // var results = yield query();
  // afterQuery(results);
});

// function main(){
//   // Wait for the "next" to be call
//   var results = yield query();
//   afterQuery(results);
// }

main();

//-------------------
// TO SUMMARY : Yield wait until the "next" function is called to processing the program
