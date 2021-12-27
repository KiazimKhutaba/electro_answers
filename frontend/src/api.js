
// export const BASE_URL = 'http://localhost:9977/api';
export const BASE_URL = '/api';


/**
 * @copyright; JUST AI Service
 *
 * @param {string} url Base url
 * @param {string} voiceType format 00_00
 * @param {string} text
 * @returns
 */
export async function generateAudio(text, url, voiceType = '47_19') {
    const [voice, model] = voiceType.split('_');

    if (text.length > 250) {
        alert('Длина текст не должна превышать 250 символов. У Вас ' + text.length);
        text = text.substring(0, 250);
    }

    const formData = new FormData();
    formData.set('text', text);
    formData.set('voice', voice);
    formData.set('model', model);


    const res = await fetch(url + '/getaudio', {
        method: 'POST',
        body: formData
    });

    const blob = await res.blob();

    const fileReader = new FileReader();
    fileReader.readAsDataURL(blob)

    fileReader.onload = () => {
        const audio = new Audio();
        audio.src = fileReader.result;
        audio.autoplay = true;
        // audio.addEventListener('playing', () => console.log('playing...'))
        // audio.addEventListener('ended', () => console.log('end...'))
    }
}



export async function getRandomQuestions(baseUrl) {

    const res =  await fetch(baseUrl + '/answers/random');
    return await res.json();
}