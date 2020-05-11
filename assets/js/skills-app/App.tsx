import React, {Component} from 'react'
import ReactDOM from 'react-dom';
export default class App extends Component{

    constructor(props) {
        super(props);
    }

    render(){
        return(
            <h2>lol</h2>
        )
    }

}
console.log('lalalala')
const domContainer = document.querySelector('#app');
ReactDOM.render(<App/>, domContainer);