var React = require('react');

var RatePage = React.createClass({
   render : function(){
     console.log(this);
       return (<div><p>Hello, {this.props.name}</p></div>);
   }
});




module.exports = RatePage;
