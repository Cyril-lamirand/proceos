import React, {useContext, useEffect, useState} from "react"
// Axios
import axios from "axios"
// Context
import {UserContext} from "../../contexts/UserContext"
// Assets
import Square from "../../assets/fake/fake-square.jpg"
import {useNavigate} from "react-router-dom"

export default function Login() {

    const [form, setForm] = useState({})
    const [user, setUser] = useContext(UserContext)
    const navigate = useNavigate()

    function handleChange(event) {
        const target = event.target
        setForm({
            ...form,
            [target.name]: target.value,
        })
    }

    function handleSubmit(event) {
        event.preventDefault()
        const cfg = {
            headers: { "Content-Type": "application/json" },
            method: "post"
        }
        try{
            axios
                .post("http://localhost:8000/api/login", form, cfg)
                .then((response) => {
                    if(response.data.request.status === 200) {
                        setUser({...response.data.user})
                    } else {
                        console.log("Error somewhere")
                    }
                })
                .then(()=>{
                    navigate("/dashboard")
                })

        } catch (error) {
            console.log("Axios : " + error)
        }
    }

    useEffect(() => {
        if (user) {
            window.localStorage.setItem('user', JSON.stringify(user));
        }
    }, [user])

    return(
        <>
            <div className="container">
                <div className="d-flex justify-content-center">
                    <div className="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div className="card shadow w-100 mt-5 mb-5">
                            <img src={Square} className="card-img-top" height="264" alt="Illustration de l'image"/>
                            <div className="card-body">
                                <h5 className="card-title mt-2">Authentification</h5>
                                <hr/>
                                <form onSubmit={handleSubmit} autoComplete="off">
                                    <div className="col-12">
                                        <label htmlFor="input-email" className="form-label">Votre adresse e-mail</label>
                                        <input
                                            type="email"
                                            className="form-control"
                                            id="input-email"
                                            placeholder="Ex : prenom.nom@devinci.fr"
                                            name="email"
                                            onChange={handleChange}
                                            autoComplete="off"
                                            required
                                        />
                                    </div>
                                    <div className="col-12 mt-3">
                                        <label htmlFor="input-password" className="form-label">Mot de passe d'accès</label>
                                        <input
                                            type="password"
                                            className="form-control"
                                            id="input-password"
                                            placeholder="Saisir..."
                                            name="password"
                                            onChange={handleChange}
                                            autoComplete="off"
                                            required
                                        />
                                    </div>
                                    <div className="d-flex justify-content-center mt-4 mb-2">
                                        <button type="submit" className="btn btn-primary">
                                            Connexion
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-12 d-flex justify-content-center">
                    <h6>Pas encore inscrit(e) ? Cliquez ici pour s'<a href="/register">inscrire</a>.</h6>
                </div>
            </div>
        </>
    )
}