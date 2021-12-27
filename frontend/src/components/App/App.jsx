import React, {useEffect, useState} from 'react'
import './App.css'
import {BASE_URL, getRandomQuestions} from "../../api";
import QuestionCard from "../../container/QuestionCard";



const pageHeaderStyle = {background: 'black', color: 'white', position: 'sticky', top: 0, zIndex: 100}

function App() {
    const [questions, setQuestions] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {

        setLoading(true);

        getRandomQuestions(BASE_URL).then(answers => {
            setQuestions(answers);
            setLoading(false);
        })

    }, [])

    return (
        <>
            <section className="section py-4" style={pageHeaderStyle}>
                <div className="container is-fullhd">
                    <div className="columns">
                        <div className="column">
                            <h1 className="title has-text-light is-size-4">
                                Генератор вопросов
                            </h1>
                        </div>
                        <div className="column is-flex is-justify-content-end">
                            <div className="select">
                                <select id="voice_type">
                                    <option value="51_14">Елена</option>
                                    <option value="132_55">Дед Мороз</option>
                                    <option value="8_12">Татьяна</option>
                                    <option defaultValue={true} value="47_19">Валерий</option>
                                    <option value="48_13">Андрей</option>
                                    <option value="70_54">Девочка</option>
                                    <option value="49_18">Савелий</option>
                                    <option value="126_59">Ленин</option>
                                    <option value="15_17">Роман</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section className="section">

                {loading ?
                <div className="container is-centered">
                    Вопросы загружаются...
                </div>
                    :
                <div className="container is-fullhd">
                    <div className="columns is-multiline">
                        {questions.length > 0 && questions.map(question => (
                            <div className="column is-4" key={question.id}>
                                <QuestionCard {...question} />
                            </div>
                        ))}
                    </div>
                </div>}

            </section>
        </>
    )
}

export default App
