import axios from 'axios'
import * as React from "react";
import {Component} from "react";
import Skill from "../models/Skill";
import Project from "../models/Project";
import {ProjectCard} from "../components/Project-card";
import {ProjectScreenshot} from "../components/Project-screenshot";
import Screenshot from "../models/Screenshot";

type ProjectsState = {
    skills: Array<Skill>,
    projects: Array<Project>
    selectedProject: Project
    selectedScreenshot: Screenshot
}

export default class Projects extends Component<{}, ProjectsState> {

    state: ProjectsState = {
        projects: undefined,
        selectedProject: undefined,
        skills: undefined,
        selectedScreenshot: undefined
    }

    constructor(props) {
        super(props);
        this.state = {
            projects: [],
            selectedProject: null,
            skills: [],
            selectedScreenshot: null
        }
    }

    async componentDidMount(){
        const response = await axios.get(`${window.location.protocol}/api/projects`);
        this.setState({projects: response.data['hydra:member']});
        console.log(this.state);
    }


    projectClicked = (project: Project) => {
        this.setState({selectedProject: project, skills: project.skills});
        console.log(this.state.selectedProject)
    }

    render(){
        return(
            <div className="h-screen w-full flex flex-col mt-12 p-12 text-light ">
                <h3 className="text-golden mb-10">Projets effectués :</h3>
                <div className="w-10/12 flex flex-row self-center border-b border-golden my-6" />

                <div className="flex flex-row self-center justify-around w-1/3 my-2">
                    {this.state.projects.map((project:Project) => {
                        return (
                            <ProjectCard clicked={this.projectClicked} key={project.id} selectedProject={project}/>
                        )
                    })}
                </div>
                <div className="w-10/12 flex flex-row self-center border-b border-golden my-6" />
                {this.state.selectedProject?
                    <div className="w-full flex flex-row px-12">
                        <div className="w-7/12">
                           <ProjectScreenshot image={this.state.selectedScreenshot? this.state.selectedScreenshot.path: this.state.selectedProject.screenShots[0].path}/>
                        </div>
                        <div className="w-5/12">
                        </div>
                    </div>
                : <div/>}

            </div>
        )
    }
};
