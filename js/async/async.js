var Sequelize = require('sequelize');
var async = require('async');

// Version using Async
var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});
//
var query = function query(callback){
  return sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function(results){
    callback(null, results[0].count);
  }).catch(function(err){
    callback(err);
  });
};

var afterQuery = function afterQuery(err, results){
  if(err){
    console.log('Error :', err);
  }else{
    console.log('Count is : '+results[0]);
  }
  sequelize.close();
};

// Don't know how to async only one function, so series needs an array of function
// /!\ Do not use ".each" since we want to get results in the final callback
async.series([query], afterQuery);
