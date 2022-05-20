import React from "react"
import Editor from "../../pages/editor/Editor"

export default function CreateCourseContent() {

    return(
        <>
            <div className="container">
                <div className="mt-5">
                    <h2>3 - Contenu du cours</h2>
                    <hr/>
                    <Editor/>
                </div>
            </div>
        </>
    )
}