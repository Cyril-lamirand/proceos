import React from "react"
import {useParams} from "react-router-dom";

export default function Module() {

    let { moduleId } = useParams();

    return(
        <>
            <div className="container mt-4 mb-4">
                <h2>Module #{moduleId}</h2>
                <hr/>
            </div>

        </>
    )
}