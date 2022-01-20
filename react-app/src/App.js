import React from "react"
import {BrowserRouter, Routes, Route} from "react-router-dom"
// Assets
import './App.css'
// Components
import Main from "./components/layouts/Main"
// Pages
import Homepage from "./pages/homepage/Homepage"
import Login from "./pages/login/Login"
import Register from "./pages/register/Register"
import Dashboard from "./pages/dashboard/Dashboard";
import CheckAuth from "./security/CheckAuth";

function App() {
  return (
    <>
      <BrowserRouter>
          <Main>
              <Routes>
                  <Route exact path="/" element={ <Homepage/> }/>
                  <Route exact path="/login" element={ <Login/> }/>
                  <Route exact path="/register" element={ <Register/> }/>
                  <Route exact path="/dashboard"
                    element={
                      <CheckAuth>
                        <Dashboard/>
                      </CheckAuth>
                    }
                  />
              </Routes>
          </Main>
      </BrowserRouter>
    </>
  )
}

export default App
