import React from "react"
// Assets
import logo from "../../logo.svg"

export default function Navbar() {

    return(
        <>
            <nav className="navbar navbar-expand-lg bg-dark text-light fixed-top">
                <div className="container-fluid">
                    <a className="navbar-brand" href="/">
                        <div className="d-flex h-100">
                            <div>
                                <img className="App-logo" src={logo} width="64" height="64"/>
                            </div>
                            <div className="d-flex align-items-center">
                                <h2 className="text-light pt-1">Proceos</h2>
                            </div>
                        </div>
                    </a>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"/>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            <li className="nav-item">
                                <a className="nav-link text-light" aria-current="page" href="/">Accueil</a>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link text-light" href="/dashboard">Tableau de bord</a>
                            </li>
                        </ul>
                        <form className="d-flex">
                            <div>
                                <a className="text-light" href="/login">Connexion</a> <span>/</span> <a className="text-light" href="/register">S'enregistrer</a>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </>
    )
}