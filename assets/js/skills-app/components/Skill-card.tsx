import {Component} from "react";
import Techno from "../models/Techno";
import * as React from "react";
import Skill from "../models/Skill";

type SkillCardProps = {
    selectedSkill: Skill;
    hover: Function,
    mouseOut: Function
};

export default class SkillCard extends Component<SkillCardProps> {

    render() {
        return(
            <div className="blury cursor-pointer w-50 h-50 p-12 flex flex-row items-center justify-center border border-golden rounded-lg bg-light" onMouseLeave={() => this.props.mouseOut()} onMouseOver={() => this.props.hover(this.props.selectedSkill)}>
                <div className="p-1 h-full flex flex-col w-full items-center justify-center">
                    <img className="h-24" src={`http://${window.location.host}/uploads/images/${this.props.selectedSkill.image}`} alt=""/>
                    <h5 className="text-golden mt-4">{this.props.selectedSkill.name}</h5>
                </div>
            </div>
        )
    }

}