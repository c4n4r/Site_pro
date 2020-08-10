import Project from "./Project";
import Techno from "./Techno";

export default interface Skill {
    id: number;
    name: string;
    image: string;
    Techno: string;
    Projects: Array<Project>;
    Technos: Array<Techno>;
    description: string;
}