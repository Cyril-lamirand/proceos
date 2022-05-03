import React from "react"

export default function UserRoleString({props}) {

    function DefineRole(props) {
        // eslint-disable-next-line default-case
        switch (props) {
            case "ROLE_ORGA_ADMIN":
                return "Administrateur d'organisation"

            case "ROLE_STUDENT":
                return "Étudiant"

            case "ROLE_INTERVENANT":
                return "Intervenant"
        }
    }

    return(
        <>
            <span>{ DefineRole(props) }</span>
        </>
    )
}