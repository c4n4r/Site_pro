import Techno from "./Techno";

export default interface Category {
    id: number;
    name: string;
    Technos: Array<Techno>;
}