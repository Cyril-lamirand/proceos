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

    function addQuestionBloc() {
        const question_form = `<div className="form-group mt-3">
        <label>Question :</label>
        <input type='text' placeholder="Lorem Impsum" className="form-control"></input>
        <label>Réponse :</label>
        <input type='text' placeholder="Lorem Impsum" className="form-control"></input>
        </div>`
        let el = document.getElementsByClassName('test')
        let createDiv = document.createElement('p')
        createDiv.innerHTML = question_form
        el[0].appendChild(createDiv)
    }

    function sendForm() {
        console.log("form send")
    }

    return(
        <>
        <div>
            <form className="form-group" onSubmit={sendForm}>
                <label>Choix du module</label>
                <select className="form-control mb-3" name="module">
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
                <div className="test"></div>
                <button className="btn btn-secondary m-3" onClick={addQuestionBloc} type="button">Ajouter une question</button>
                <button className="btn btn-success m-3" type="submit">Valider le formulaire</button>
            </form>
        </div>
        </>
    )
}