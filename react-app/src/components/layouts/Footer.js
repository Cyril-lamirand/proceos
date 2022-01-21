import React from "react"

// Assets
import Logo from "../../logo.svg"

export default function Footer() {

    return(
        <>
            <footer>
                <div className="mt-5 pb-3">
                    <div className="container-fluid">
                        <hr/>
                        <div className="row">
                            <div className="col-12 col-md-3">
                                <img src={Logo} width="128" height="128" className="App-logo" alt="Logo de l'application"/>
                            </div>
                            <div className="col-12 col-md-6 h-100">
                                <div className="d-flex flex-column align-items-center justify-content-center pt-4">
                                    <div>
                                        <h6>Proceos</h6>
                                    </div>
                                    <div>
                                        <span>Open-Source Project 2021-2022</span>
                                    </div>
                                </div>

                            </div>
                            <div className="col-12 col-md-3 h-100 pt-3">
                                <div>
                                    <a href="/">Politique de confidentialité</a>
                                </div>
                                <div>
                                    <a href="/">Mentions légales</a>
                                </div>
                                <div>
                                    <a href="/">Conditions d'utilisation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </>
    )
}