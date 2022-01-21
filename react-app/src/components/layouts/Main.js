import React, {useState} from "react"
// Context
import {ThemeContext} from "../../contexts/ThemeContext"
// Layouts
import Header from "./Header"
import Footer from "./Footer"

export default function Main({children}) {

    const [theme, setTheme] = useState("light")

    return(
        <>
            <ThemeContext.Provider value={[theme, setTheme]}>
                <Header/>
                <main className="mt-5 pt-5">
                    <>{ children }</>
                </main>
                <Footer/>
            </ThemeContext.Provider>
        </>
    )
}