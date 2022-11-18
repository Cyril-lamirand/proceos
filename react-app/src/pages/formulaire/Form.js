import React, {useEffect, useState} from "react"
import axios from "axios"

export default function From(){

    const [modules, setModules] = useState(null)
    let userId = localStorage.getItem("userId");
    useEffect(() => {
        if (modules === null) {
            axios.get(`https://localhost:8000/api/modules/intervenant/${userId}`)
                .then(function (response) {
                    setModules(response.data)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        }
    }, [modules])

    // increment questions
    let i = 0;
    function addQuestionBloc() {
        i+=1
        const question_div = `<div className="form-group">
        <label>Question ${i}:</label>
        <input type='text' placeholder="Votre question" className="form-control" id="question${i}"></input>
        <label>Réponse ${i}:</label>
        <input type='text' placeholder="Votre réponse" className="form-control" id="reponse${i}"></input>
        </div>`
        let el = document.getElementsByClassName('new_question')
        let createDiv = document.createElement('div')
        createDiv.classList.add('mb-3')
        createDiv.innerHTML = question_div
        el[0].appendChild(createDiv)
    }

    function sendForm(){
        let module = document.getElementsByClassName('module') //id
        let moduleName = document.getElementsByClassName('moduleName') //module name
        let nbFrom = document.querySelectorAll('.new_question > div') //nb of question

        let questions = [] //table questions list
        for (let x = 1; x <= nbFrom.length; x++){
            let question = document.getElementById(`question${x}`).value
            let reponse = document.getElementById(`reponse${x}`).value
            questions.push(
                {
                    'question' : question,
                    'réponse' : reponse
                }
            )
        }
        const result = {
            label : moduleName[0].value,
            module : module[0].value,
            questions
        }

        console.log(result)
    }

    return(
        <>
        <div>
            <form className="form-group" onSubmit={sendForm}>
                <label className="mt-3">Nom du quizz</label>
                <input className="form-control mb-3 mt-3 moduleName" placeholder="Nom du quizz"></input>
                <label>Choix du module</label>
                <select className="form-control mb-3 mt-3 module" name="module">
                <option defaultValue>Veuillez choisir...</option>
                    {modules ?
                        <>
                            {modules.map((mod, index) => {
                                return(
                                    <option key={index} value={mod.id}>{mod.name}</option>
                                    )
                            })}
                        </>
                        :
                        ""
                    }
                </select>
                <div className="new_question"></div>
                <button className="btn btn-secondary m-3" onClick={addQuestionBloc} type="button">Ajouter une question</button>
                <button className="btn btn-success m-3" type="submit" onClick={sendForm}>Valider le formulaire</button>
                {/* <button onClick={test} type="button">Générer l'objet dans la console</button> */}
            </form>
        </div>
        </>
    )
}