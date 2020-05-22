import Project from "./Project";

export default interface Skill {
    id: number;
    name: string;
    image: string;
    Techno: string;
    Projects: Array<Project>;
    description: string;
}