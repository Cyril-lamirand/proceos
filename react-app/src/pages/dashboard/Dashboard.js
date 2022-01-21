import React, {useContext} from "react"
import {UserContext} from "../../contexts/UserContext";

export default function Dashboard() {

    const [user, setUser] = useContext(UserContext)

    return(
        <>
            <div className="container">
                <div className="row">
                    <div className="col-12 col-md-8 col-lg-10">
                        <div className="mt-5">
                            <h2>{user.firstname} {user.lastname}</h2>
                        </div>
                    </div>
                    <div className="col-12 col-md-4 col-lg-2">
                        <div className="mt-5">
                            <a className="btn btn-danger" href="/logout">Déconnexion</a>
                        </div>

                    </div>

                </div>

            </div>
        </>
    )
}