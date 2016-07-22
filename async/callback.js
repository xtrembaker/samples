var Sequelize = require('sequelize');
var async = require('async');

// Version of callback
var Sequelize = require('sequelize');
var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});

var query = function query(callback){
  sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function(results){
    callback(results[0].count);
  });
};

var afterQuery = function afterQuery(count){
  console.log('Count equal :' + count);
  sequelize.close();
};
// Do query
query(afterQuery);
