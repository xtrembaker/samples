var RatePage = React.createClass({
   render : function(){
     console.log(this);
       return (<div><p>Hello, {this.props.name}</p></div>);
   }
});

var CriteriaSlider = React.createClass({
  render : function(){
    return (<input type="range" />);
  }
});

ReactDOM.render(<RatePage />, document.getElementById('app'));
