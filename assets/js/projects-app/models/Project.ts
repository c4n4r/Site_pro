import Skill from "./Skill";
import Screenshot from "./Screenshot";

export default interface Project {
    id:number
    name:string
    skills: Array<Skill>
    image: string;
    screenShots: Array<Screenshot>
}