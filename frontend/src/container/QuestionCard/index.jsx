import React, {useState} from 'react';
import {BASE_URL, generateAudio} from "../../api";
import "./QuestionCard.css";


const QuestionCard = ({id, atext, complexity}) => {

    const [loading, setLoading] = useState(false);

    const complexityPrefix = complexity < 1 ? 'балла' : 'балл';


    const handleClick = (e) => {

        const target = e.target;
        const action = e.target.dataset.action;
        const voiceType = document.getElementById('voice_type').value;
        //const voiceType = '47_19';

        if ('speak' === action) {

            const text = target.dataset.text;
            const complexity = target.dataset.complexity;
            console.log(text)

            setLoading(true);

            const phrase = `Сложность: ${complexity} ${complexityPrefix}. ${text}`;
            generateAudio(phrase, BASE_URL, voiceType).then(() => {
                setLoading(false)
            });
        }
    }

    return (
        <div className="card QuestionCard" id={"card_" + id} onClick={handleClick}>
            <div className="card-content">
                <div className="content">
                    {atext}
                </div>
            </div>
            <footer className="card-footer">
                <a href="#none" className="card-footer-item">Сложность: {complexity} {complexityPrefix} </a>
                <a href="#none" className="card-footer-item" data-action="speak" data-text={atext} data-complexity={complexity}>
                    {loading ? 'Загружается' : 'Озвучить'}
                </a>
            </footer>
        </div>
    )
}


export default QuestionCard;