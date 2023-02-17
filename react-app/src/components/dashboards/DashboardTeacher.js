import React, {useEffect, useState} from "react"
import { Link } from "react-router-dom"
import axios from "axios";
// Assets
import Square from "../../assets/fake/fake-square.jpg";

export default function DashboardTeacher() {

    const [modules, setModules] = useState(null)
    let userId = localStorage.getItem("userId");
    useEffect(() => {
        if (modules === null) {
            axios.get(`${process.env.REACT_APP_API_URL}/api/modules/intervenant/${userId}`)
                .then(function (response) {
                    setModules(response.data)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
        }
    }, [modules])

    useEffect( () => {
        if (modules) {
            console.log(modules)
        }
    }, [modules])

    return(
        <>
            <div className="mt-5">
                <h2>Tableau de bord d'intervenant</h2>
                <hr/>
                <div className="mt-4">
                    <h4>Liste des modules</h4>
                </div>
                <div className="mt-3 mb-4">
                    {modules ?
                        <>
                            {modules.map((mod, index) => {
                                return(
                                    <div key={index} className="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                        <div className="shadow pt-3 pb-3 pr-2 pl-2">
                                            <div>
                                                <img src={Square} className="card-img-top" height="64" alt="Illustration de l'image"/>
                                            </div>
                                            <div className="mt-3">
                                                <h5>#{mod.id} - {mod.name}</h5>
                                            </div>
                                            <hr/>
                                            <div className="text-center">
                                                <a href="" className="btn btn-primary">Voir le module</a>
                                            </div>
                                        </div>

                                    </div>
                                )
                            })}
                        </>
                        :
                        ""
                    }

                </div>
                <hr/>
                <Link to="/formulaire">
                    <button className="btn btn-primary">Créer un formulaire</button>
                </Link>
            </div>
        </>
    )
}