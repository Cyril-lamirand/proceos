import React from "react"

export default function Logout() {

    localStorage.clear()

    return(
        <>
            <div className="container">
                <div>
                    <h2 className="text-danger">Déconnexion réussie !</h2>
                </div>
                <div>
                    <p>Lien(s) disponible(s) : </p>
                    <ul>
                        <li><a href="/login">Connexion</a></li>
                        <li><a href="/">Page d'accueil</a></li>
                    </ul>
                </div>

            </div>
        </>
    )
}