var Sequelize = require('sequelize');
var async = require('async');

// Version using Promise
var Sequelize = require('sequelize');
var sequelize = new Sequelize('mysql', 'root', '', {
  'dialect' : 'mysql'
});

var query = function query(resolve, reject){
  sequelize.query('SELECT 1+1 as count', { type: sequelize.QueryTypes.SELECT}).then(function(results){
    resolve(results[0].count);
  }).catch(function(err){
    reject(err);
  });
};

var p1 = new Promise(query);

p1.then(function(count){
  console.log('Count equal :'+count);
  sequelize.close();
});
