import React from "react"
import { useNavigate } from 'react-router-dom'
import axios from 'axios'

export default function CheckAuth({ children }) {
    const navigate = useNavigate()
    axios.interceptors.response.use(
        function (response) {
            return response
        },
        function (error) {
            console.log(error)
            if (error.response.status === 403) {
                navigate('/login')
            }
            return Promise.reject(error)
        },
    )
    return (
        <>{children}</>
    )
}
