import axios from 'axios'
import Category from "../models/Category";
import * as React from "react";
import {Component} from "react";
import Techno from "../models/Techno";
import TechnoCard from "../components/Techno-card";
import Skill from "../models/Skill";
import SkillCard from "../components/Skill-card";

type SkillsState = {
    categories: Array<Category>,
    technos: Array<Techno>,
    skills: Array<Skill>,
    selectedSkill: Skill
}


export default class Skills extends Component<{}, SkillsState> {

    state: SkillsState = {
        selectedSkill: undefined,
        categories: undefined,
        technos: undefined,
        skills: undefined
    }

    constructor(props) {
        super(props);
        this.state = {
            categories: [],
            technos: [],
            skills: [],
            selectedSkill: null
        }
    }

    async componentDidMount() {
        const response = await axios.get(`http://${window.location.host}/api/categories`);
        this.setState({categories: response.data['hydra:member'], technos: response.data['hydra:member'][0].Technos})
    }

    selectCategory = (event) => {
        const selectedId = event.target.value;
        const selectedCategory = this.state.categories.find((category: Category) => category.id == selectedId);
        this.setState({technos: selectedCategory.Technos, skills: [], selectedSkill: null});
    }

    selectTechno = async (event: Techno) => {
        const response = await axios.get(`${window.location.protocol}/api/skills?techno=${event.id}`);
        this.setState({skills: response.data['hydra:member']});
    }

    skillHover = (skill: Skill) => {
        this.setState({selectedSkill: skill});
    }

    skillOut = () => {
        this.setState({selectedSkill: null})
    }

    render() {
        let selectedSkill = this.state.selectedSkill;
        return (
            <div className="h-screen w-full flex flex-col mt-12 p-12 text-light overflow-y-scroll">
                <h3 className="text-golden mb-10">Les technologies et Frameworks avec lesquels j'aime travailler</h3>
                <select onChange={this.selectCategory}
                        className="appearance-none rounded-lg mb-6 px-2 h-12 text-darken w-1/12 border-golden focus:outline-none focus:border-1 focus:border-golden"
                        name="categories" id="categories">
                    {this.state.categories.map((category: Category) => (
                        <option className="px-4 text-center" key={category.id}
                                value={category.id}>{category.name}</option>
                    ))}
                </select>

                <div className="w-5/6 flex flex-row self-center border-b border-golden my-4"/>

                <div className="flex flex-row justify-around w-full my-2">
                    {this.state.technos.map((techno: Techno) => {
                        return (<TechnoCard key={techno.id} clicked={this.selectTechno} selectedTechno={techno}/>)
                    })}
                </div>
                <div className="w-4/6 flex flex-row self-center border-b border-golden my-4"/>
                <div className="flex flex-row justify-around w-2/3 self-center my-4">
                    {this.state.skills.map((skill: Skill) => {
                        return (<SkillCard hover={this.skillHover} mouseOut={this.skillOut} key={skill.id}
                                           selectedSkill={skill}/>)
                    })}
                </div>
                <div className="h-50 flex items-center justify-center mt-6">
                    {selectedSkill ?
                        <div
                            className="my-6 w-1/3 p-4 text-golden flex flew-row self-center text-center items-center justify-center border border-golden rounded-lg">
                            <p className="m-2 flex items-center justify-center">{this.state.selectedSkill.description}</p>
                        </div>
                        : <div className="h-50"/>
                    }
                </div>
            </div>
        )
    }
}
