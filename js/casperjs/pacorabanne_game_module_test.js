var page = require('webpage').create();
// var casper = require('casper').create();

page.viewportSize = { width: 768, height: 1024 };
var steps = [
   function (callback){
       // First step : Open admin page
       page.open('http://pacorabanne.arnaud.orleans.adfab.fr/admin',function() {
           var result = page.evaluate(function(){
               document.getElementById('username').value = 'adfab';
               document.getElementById('login').value = 'Lveen2016';
               // POST page
               document.getElementById('loginForm').submit();
           });
           // Form has been submit, but we have to wait few seconds before return
           setTimeout(function(){
               callback(result);
           }, 10000);
       });
   },
   function(callback){
       // Once logged in, search and click on "list game" menu
       var result = page.evaluate(function(){
           var event = new Event('click');
           var li = document.getElementById('nav').children[6];
           var a = li.getElementsBySelector('ul')[0].children[1].getElementsBySelector('a')[0];
           a.dispatchEvent(event);
       });
       // Link has been clicked, wait few seconds before return
       setTimeout(function(){
           callback(result);
       }, 10000);
   },
   function(callback){
       // Once on "List game", search and click on the first game found
       var result = page.evaluate(function(){
           var table = document.getElementById('adfab_game_game_grid_table');
           var tr = table.getElementsBySelector('tbody')[0].getElementsBySelector('tr')[0];
           var event = new Event('click');
           tr.dispatchEvent(event);
       });
       // Link has been clicked, wait few seconds before return
       setTimeout(function(){
           callback(result);
       }, 10000);
   },
   function(callback){
       // Once on "Edit game", search and click on the "Field" Tab
       var result = page.evaluate(function(){
           var li = document.getElementById('game_tabs_form_field_section');
           var event = new Event('click');
           li.dispatchEvent(event);
       });
       setTimeout(function(){
           callback(result);
       }, 10000);
   },
   function(callback){
       casper.test.begin('Add game_firstname', 2, function(test) {
           // Make sure there is no "game_firstname" before added
           test.assert(null === document.getElementById('game_firstname'));
           var select = document.getElementById('game_field_select_type');
           for(var i = 0; i < select.options.length; i++){
               if(select.options[i].value === 'firstname'){
                   select.selectedIndex = i;
                   break;
               }
           }
           var event = new Event('change');
           select.dispatchEvent(event);
           test.assert(null !== document.getElementById('game_firstname'));
           test.done();
       });
       callback('');
   }
];
var i = 0;
function next(i){
   var callback = function(result){
       console.log('result '+i+':', result);
       if(i < steps.length - 1){
           i++;
           next(i);
       }else{
           phantom.exit();
       }
   };
   steps[i](callback);
}

next(i);