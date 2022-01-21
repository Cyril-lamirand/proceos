import React, {useContext, useEffect} from "react"
import { useNavigate } from 'react-router-dom'
import axios from 'axios'
import {UserContext} from "../contexts/UserContext"

export default function CheckAuth({ children }) {

    const [user, setUser] = useContext(UserContext)
    const navigate = useNavigate()

    useEffect(() => {
        if (Object.keys(user).length < 1) {
            console.log("Go")
        } else if (Object.keys(user).length > 1) {
            console.log("Ok")
        }
    }, [])

    return (
        <>{children}</>
    )
}
