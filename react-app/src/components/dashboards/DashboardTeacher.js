import React from "react"
import { Link } from "react-router-dom"

export default function DashboardTeacher() {


    return(
        <>
            <div className="mt-5">
                <h2>Tableau de bord d'intervenant</h2>
                <Link to="/formulaire">
                    <button class="btn btn-primary">Créer un formulaire</button>
                </Link>
            </div>
        </>
    )
}