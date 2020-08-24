import axios from 'axios';
export default class ImagesManager {
    static previewImage(event){
        document.getElementsByName('no-img-span')[0].setAttribute('hidden', true);
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('preview').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
    static guessEntity(){
        let name = '';
        document.forms.forEach((element) => {
            name = element.name;
        });
        return name;
    }
}
if(!window.location.href.includes('add')){
    const entity = ImagesManager.guessEntity().charAt(0).toLocaleUpperCase() + ImagesManager.guessEntity().slice(1);
    const entityId = window.location.href.slice(-1);
    const url = `http://${window.location.host}/api/${entity}/get-image/${entityId}`
    axios.get(url, { headers: '' }).then((response)=>{
        const element = document.getElementById('preview');
        document.getElementsByName('no-img-span')[0].setAttribute('hidden', true);
        element.setAttribute('src', `/uploads/images/${response.data.body.data}`)
    });
}
const element = document.getElementsByClassName('image-input');
element[0].addEventListener('change', ImagesManager.previewImage);