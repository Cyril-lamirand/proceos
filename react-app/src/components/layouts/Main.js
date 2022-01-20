import React from "react"
import Header from "./Header"
import Footer from "./Footer"

export default function Main({children}) {

    return(
        <>
            <Header/>
            <main>
                <>{ children }</>
            </main>
            <Footer/>
        </>
    )
}