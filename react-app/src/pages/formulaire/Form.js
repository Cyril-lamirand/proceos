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
        const question_div = `<div className="form-group mt-3">
        <label>Question ${i}:</label>
        <input type='text' placeholder="Votre question" className="form-control question ${i}"></input>
        <label>Réponse ${i}:</label>
        <input type='text' placeholder="Votre réponse" className="form-control reponse${i}"></input>
        </div>`
        let el = document.getElementsByClassName('new_question')
        let createDiv = document.createElement('div')
        createDiv.innerHTML = question_div
        el[0].appendChild(createDiv)
    }

    function sendForm() {
        console.log("form send")
        //faire le post 
    }

    function test(){
        let module = document.getElementsByClassName('module')
        console.log(module[0].value) //id
        
        let nbFrom = document.querySelectorAll('.new_question > div')
        console.log(nbFrom.length) //nb of question

        const result = {
            label : '',
                module : module[0].value,
                questions : []
        }
    }
    return(
        <>
        <div>
            <form className="form-group" onSubmit={sendForm}>
                <label>Choix du module</label>
                <select className="form-control mb-3 module" name="module">
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
                <button onClick={test} type="button">Générer l'objet dans la console</button>
            </form>
        </div>
        </>
    )
}