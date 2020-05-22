import {Component} from 'react'
import ReactDOM from 'react-dom';
import Skills from "./pages/Skills";
import * as React from 'react';
export default class App extends Component{

    constructor(props) {
        super(props);
    }

    render(){
        return(<Skills/>)
    }

}
const domContainer = document.querySelector('#app');
ReactDOM.render(<App/>, domContainer);