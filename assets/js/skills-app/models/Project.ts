import Skill from "./Skill";

export default interface Project {
    id:number
    name:string
    Skills: Array<Skill>
    image: string;
}