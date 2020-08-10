import {Component} from 'react'
import ReactDOM from 'react-dom';
import Projects from "./pages/Projects";
import * as React from 'react';
export default class App extends Component{

    constructor(props) {
        super(props);
    }

    render(){
        return(<Projects/>)
    }

}
const domContainer = document.querySelector('#app');
ReactDOM.render(<App/>, domContainer);