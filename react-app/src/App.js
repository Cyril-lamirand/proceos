import React, {useContext, useEffect, useState} from "react"
import {BrowserRouter, Routes, Route} from "react-router-dom"
// Assets
import './App.css'
import 'bootstrap/dist/css/bootstrap.min.css'
// Components
import Main from "./components/layouts/Main"
// Context
import {UserContext} from "./contexts/UserContext"
// Pages
import Homepage from "./pages/homepage/Homepage"
import Login from "./pages/login/Login"
import Register from "./pages/register/Register"
import Dashboard from "./pages/dashboard/Dashboard"
import CheckAuth from "./security/CheckAuth"
import Success from "./pages/messages/Success"
import Error from "./pages/messages/Error"
import Logout from "./pages/messages/Logout"
import Profil from "./pages/profil/Profil"
import Editor from "./pages/editor/Editor"

function App() {

    const [user, setUser] = useState({})

    useEffect(() => {
        if (localStorage.getItem('user')) {
            const values = JSON.parse(localStorage.getItem("user"))
            setUser({...user, ...values})
        } else {
            console.log("Not found")
        }
    }, [])

    return (
        <>
            <UserContext.Provider value={[user, setUser]}>
                <BrowserRouter>
                    <Main>
                        <Routes>
                            <Route exact path="/" element={ <Homepage/> }/>
                            <Route exact path="/login" element={ <Login/> }/>
                            <Route exact path="/register" element={ <Register/> }/>
                            <Route exact path="/dashboard" element={<CheckAuth> <Dashboard/> </CheckAuth>}/>
                            <Route exact path="/profil" element={<CheckAuth> <Profil/> </CheckAuth>}/>

                            <Route exact path="/success" element={ <Success/> }/>
                            <Route exact path="/error" element={ <Error/>}/>
                            <Route exact path="/logout" element={ <Logout/>}/>
                            <Route exact path="/editor" element={ <Editor/>}/>
                        </Routes>
                    </Main>
                </BrowserRouter>
            </UserContext.Provider>
        </>
    )
}

export default App
