import React, {useContext} from "react"
import {UserContext} from "../../contexts/UserContext"
import DashboardOrganization from "../../components/dashboards/DashboardOrganization";
import DashboardStudent from "../../components/dashboards/DashboardStudent";
import DashboardTeacher from "../../components/dashboards/DashboardTeacher";

export default function Dashboard() {

    const [user, setUser] = useContext(UserContext)

    console.log(user)

    return(
        <>
            <div className="container">
                {user ?
                    <>
                        {user.roles ?
                            <>
                                {user.roles[0] === "ROLE_ORGA_ADMIN" ?
                                    <>
                                        <DashboardOrganization/>
                                    </>
                                    :
                                    <></>
                                }
                                {user.roles[0] === "ROLE_STUDENT" ?
                                    <>
                                        <DashboardStudent/>
                                    </>
                                    :
                                    <></>
                                }
                                {user.roles[0] === "ROLE_INTERVENANT" ?
                                    <>
                                        <DashboardTeacher/>
                                    </>
                                    :
                                    <></>
                                }
                            </>
                            :
                            <>
                            </>
                        }
                    </>
                    :
                    <>
                        <h2>Pas d'utilisateur.</h2>
                    </>
                }
            </div>
        </>
    )
}