import Skill from "./Skill";

export default interface Techno {
    id: number;
    name: string;
    image: string;
    Skills: Array<Skill>;
    Category: string;
}