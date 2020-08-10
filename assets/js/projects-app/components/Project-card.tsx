import * as React from "react";
import Project from "../models/Project";
type ProjectCardProps = {
    selectedProject: Project
    clicked: Function
};


export const ProjectCard = (props: ProjectCardProps) => {
    return (
        <div className="blury cursor-pointer w-34 p-2 flex flex-row items-center justify-center border border-golden rounded-lg bg-light" onClick={() => props.clicked(props.selectedProject)}>
            <div className="p-1 h-full flex flex-col w-full items-center justify-center">
                <img className="h-24 rounded-lg" src={`http://${window.location.host}/uploads/images/${props.selectedProject.image}`} alt=""/>
                <p className="text-golden mt-2">{props.selectedProject.name}</p>
            </div>
        </div>
    )
}