//#########################
//
// NOT DONE YET !
//
//#########################
var Sequelize = require('sequelize');

// Version using Promise
  var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});

var User = sequelize.define('User', {
  User: {
    type: Sequelize.STRING(100),
    allowNull: false,
    comment: 'user name',
    primaryKey : true
  },
  Host: {
    type: Sequelize.STRING(64),
    allowNull: false,
    comment: 'user last request ip',
    primaryKey : true
  },
}, {
  tableName: 'user',
  // comment: 'user base info',
  // indexes: [
  //   {
  //     unique: true,
  //     fields: ['name']
  //   },
  //   {
  //     fields: ['gmt_modified']
  //   }
  // ],
  createdAt: false,
  updatedAt: false
});

var toto = function* toto(){
  // var results_ = [];
  var user = yield User.find().then(function* (results){
    console.log('RESULTS :',results);
    yield results;
    gen.next();
  });
  // console.log('shoud go here !');
  // yield results_;
  // return user.then(function())
  //console.log('after fetch');
  //console.log(user);
};

var gen = toto();
gen.next();
// console.log(gen.next().value);
// gen.next();
// console.log('after fetch !');
// gen.next();


// Create Generator
// var query = function* query(){
//   // Generator would stop here when execute, until "next" in the "then" is called
//   var results_ = [];
//
//   yield sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).
//   spread(function(results, metadata){
//     return results;
//   });
//   // then(function(results){
//   //   console.log('RESULTS !');
//   //
//   //   var queryResult = function* queryResult(results){
//   //     yield results;
//   //   };
//   //   queryResult();
//   //
//   //   // return results;
//   //   // results;
//   //   // yield results;
//   //   // console.log('Result from callback', results);
//   //   gen.next();
//   // }).catch(function(err){
//   //   console.log(err);
//   //   // reject(err);
//   // });
//   // sequelize.close();
//   // return results_;
// };

//var p1 = new Promise(query);

//p1.then(function(count){
  //console.log('Count equal :'+count);
  // sequelize.close();
// });
// Instanciate generator (query function is not yet executed)
// var gen = query();
//console.log('la !');
// Start Generator (start executing the query function)
// gen.next();
// console.log(gen.next());
// console.log('NEXT :');
// console.log(gen.next());
// sequelize.close();
// console.log(gen.next().value);
// console.log(gen.next().value.then((results) => {
//   console.log('RESULT !');
//   console.log(results);
//   return results;
// }));
// console.log(gen.next());





//
// var http = require('http');
//
//
// function request(url) {
//   setTimeout(function(){
//     console.log('request end !');
//     it.next();
//   }, 3000);
//     // Note: nothing returned here!
// }

// This is a "Generator" function. When simply call, it does nothing, we need to
// call "next()" for it to start
// function *main() {
//   console.log('la ?');
//   yield request();
//   console.log('after request !');
    // var result1 = yield request( "http://some.url.1" );
    // var data = JSON.parse( result1 );
    // console.log(data);

    // var result2 = yield request( "http://some.url.2?id=" + data.id );
    // var resp = JSON.parse( result2 );
    // console.log( "The value you asked for: " + resp.value );
// }
// Instanciate Generator (do nothing except returning )
// var it = main();
// console.log(it);
//it.next();

//var it = main();
//it.next(); // get it all started




// var async = function *async(){
//   var index = 99;
//   yield function(){
//     //return
//     setTimeout(function(){
//        index++;
//     }, 3000);
//   }
// };
//
// var gen = async();
//
// console.log(gen.next().value);
