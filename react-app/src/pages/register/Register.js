import React, {useEffect, useState} from "react"
import { useNavigate } from 'react-router-dom'
import axios from "axios"
// Assets
import Square from "../../assets/fake/fake-square.jpg"

export default function Register() {

    // Manage Form
    const [form, setForm] = useState({})
    const [organization, setOrganization] = useState(null)

    // Manage Password
    const [password, setPassword] = useState({})
    const [samePassword, setSamePassword] = useState(false)
    const [require1, setRequire1] = useState(false)
    const [require2, setRequire2] = useState(false)
    const [require3, setRequire3] = useState(false)
    const [require4, setRequire4] = useState(false)

    // React DOM
    const navigate = useNavigate()

    function handleChange(event) {
        const target = event.target
        setForm({
            ...form,
            [target.name]: target.value,
        })
    }

    function handlePassword(event) {
        const target = event.target
        setPassword({
            ...password,
            [target.name]: target.value
        })
    }

    function handleSubmit(event) {
        event.preventDefault()
        const cfg = {
            headers: { "Content-Type": "application/json" },
            method: "post",
        }
        try {
            axios
                .post("http://localhost:8000/api/register", form, cfg)
                .then((r) => navigate("/success"));
        } catch (e) {
            console.log(e.message);
        }
    }

    useEffect(() => {
        const specialChars = /[\!\@\#\$\%\^\&\*\)\(\+\=\.\<\>\{\}\[\]\:\;\'\"\|\~\`\_\-]/g
        const upperCase = /[?=.*[A-Z]/g
        const integer = /[?=.*[0-9]/g
        if (password.password1) {
            if(password.password1.length >= 8) { setRequire1(true) } else ( setRequire1(false) )
            if(specialChars.test(password.password1)) { setRequire2(true) } else ( setRequire2(false) )
            if(upperCase.test(password.password1)) { setRequire3(true) } else ( setRequire3(false) )
            if(integer.test(password.password1)) { setRequire4(true) } else ( setRequire4(false) )
        } else {
            setRequire1(false)
            setRequire2(false)
            setRequire3(false)
            setRequire4(false)
        }
        if (password.password1 && password.password2) {
            if (password.password1 === password.password2) {
                setSamePassword(true)
            } else{
                setSamePassword(false)
            }
        }
    }, [password])

    useEffect(() => {
        if (samePassword) {
            setForm({
                ...form,
                "password": password.password1
            })
        }
    }, [samePassword])

    useEffect(() => {
        if (organization === null) {
            axios.get("http://localhost:8000/api/organization")
                .then(function (response) {
                    setOrganization(response.data)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        }
    }, [organization])

    // TODO / DEV : Have to be deleted
    useEffect(() => { console.log(organization) }, [organization])
    useEffect(() => { console.log(form) }, [form])

    return(
        <>
            <div className="container">
                <div className="pt-3">
                    <h2>Rejoignez Proceos !</h2>
                </div>
                <div className="row">
                    <div className="col-12 col-md-8 col-lg-6">
                        <div className="mt-4 mb-4">
                            <small>(*)<i> = champ obligatoire.</i></small>
                        </div>
                        <form onSubmit={handleSubmit} autoComplete="off">
                            <div className="col-12">
                                <label htmlFor="input-email" className="form-label">Adresse e-mail (*)</label>
                                <input
                                    type="email"
                                    className="form-control"
                                    id="input-email"
                                    placeholder="Ex : prenom.nom@devinci.fr..."
                                    name="email"
                                    onChange={handleChange}
                                    autoComplete="off"
                                    required
                                />
                            </div>
                            <div className="row">
                                <div className="col-12 col-md-6 mt-4">
                                    <label htmlFor="input-firstname" className="form-label">Prénom (*)</label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="input-firstname"
                                        placeholder="Ex : Lionel"
                                        name="firstname"
                                        onChange={handleChange}
                                        autoComplete="off"
                                        required
                                    />
                                </div>
                                <div className="col-12 col-md-6 mt-4">
                                    <label htmlFor="input-lastname" className="form-label">Nom de famille (*)</label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="input-lastname"
                                        placeholder="Ex : Messi"
                                        name="lastname"
                                        onChange={handleChange}
                                        autoComplete="off"
                                        required
                                    />
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-md-6 mt-4">
                                    <label htmlFor="input-password-1" className="form-label">Mot de passe (*)</label>
                                    <input
                                        type="password"
                                        className="form-control"
                                        id="input-password-1"
                                        placeholder="Minimum 8 charactères..."
                                        name="password1"
                                        onChange={handlePassword}
                                        autoComplete="off"
                                        minLength="8"
                                        required
                                    />
                                </div>
                                <div className="col-12 col-md-6 mt-4">
                                    <label htmlFor="input-password-2" className="form-label">Confirmation du mot de passe (*)</label>
                                    <input
                                        type="password"
                                        className="form-control"
                                        id="input-password-2"
                                        placeholder=""
                                        name="password2"
                                        onChange={handlePassword}
                                        autoComplete="off"
                                        minLength="8"
                                        required
                                    />
                                </div>
                            </div>
                            <div className="col-12">
                                {
                                    password.password1 ?
                                        <>
                                            {
                                                samePassword ?
                                                    <>
                                                        <div className="text-success pt-1">
                                                            <span>Les mots de passe sont identiques !</span>
                                                        </div>
                                                    </>
                                                    :
                                                    <>
                                                        <div className="text-danger pt-1">
                                                            <span>Les mots de passe ne sont pas identiques !</span>
                                                        </div>
                                                    </>
                                            }
                                        </>
                                        :
                                        ""
                                }
                                <div className="alert alert-info mt-2">
                                    <span><b>Pour votre sécurité</b>, votre mot de passe devrait contenir :</span>
                                    <ul className="pt-2">
                                        <li>{require1 ? "🟢" : "🔴"} Minimum 8 charactères (a-Z) (0-9)</li>
                                        <li>{require2 ? "🟢" : "🔴"} Un charactère spéciale (.!@#$%^&*()_+-=)</li>
                                        <li>{require3 ? "🟢" : "🔴"} Une lettre majuscule</li>
                                        <li>{require4 ? "🟢" : "🔴"} Au moins un chiffre (0-9)</li>
                                    </ul>

                                </div>
                            </div>
                            <div className="col-12 mt-4">
                                <label htmlFor="input-organization" className="form-label">Votre organisation</label>
                                <select
                                    className="form-select"
                                    aria-label="Organization Select"
                                    name="organization"
                                    autoComplete="off"
                                    onChange={handleChange}
                                >
                                    <option defaultValue>Veuillez choisir...</option>
                                    {organization ?
                                        <>
                                            {organization.map((org, index) => {
                                                return(
                                                    <option key={index} value={org.id}>{org.label}</option>
                                                )
                                            })}
                                        </>
                                        :
                                        ""
                                    }

                                </select>
                            </div>
                            <div className="col-12 mt-4">
                                <label htmlFor="select-roles" className="form-label">Vous êtes...</label>
                                <select
                                    id="select-roles"
                                    className="form-select"
                                    aria-label="Roles"
                                    name="roles"
                                    autoComplete="off"
                                    onChange={handleChange}
                                >
                                    <option defaultValue>Veuillez choisir...</option>
                                    <option value="Étudiant">Étudiant</option>
                                    <option value="Intervenant">Intervenant</option>
                                    <option value="Organisation Administrateur">Administrateur d'organisation</option>
                                </select>
                            </div>
                            <div className="d-flex justify-content-center mt-4 mb-4">
                                <button type="submit" className="btn btn-primary">
                                    S'enregistrer
                                </button>
                            </div>

                        </form>
                    </div>
                    <div className="col-12 col-md-4 col-lg-6">
                        <div className="d-flex justify-content-center mt-3">
                            <img src={Square} width="264" height="264" alt="Image d'illustration"/>
                        </div>
                        <div className="d-flex justify-content-center mt-5">
                            <h3>Lorem ipsum dolor sit amet...</h3>
                        </div>
                        <div className="mt-3">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi at dignissimos, impedit molestiae natus nisi officiis quae rem sunt vero! Autem, dicta dolorem doloribus dolorum pariatur repudiandae similique ut voluptate?</p>
                        </div>

                    </div>
                </div>


            </div>

        </>
    )
}