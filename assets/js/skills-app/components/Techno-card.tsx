import {Component} from "react";
import Techno from "../models/Techno";
import * as React from "react";

type TechnoCardProps = {
    selectedTechno: Techno
    clicked: Function
}

export default class TechnoCard extends Component<TechnoCardProps> {

    render() {
        return(
            <div className="blury cursor-pointer w-32 p-4 flex flex-row items-center justify-center border border-golden rounded-lg bg-light" onClick={ () => this.props.clicked(this.props.selectedTechno)}>
                <div className="p-1 flex flex-col w-full items-center justify-center">
                    <img className="h-24 object-cover rounded-full" src={`http://${window.location.host}/uploads/images/${this.props.selectedTechno.image}`} alt=""/>
                    <h5 className="text-golden">{this.props.selectedTechno.name}</h5>
                </div>
            </div>
        )
    }

}
