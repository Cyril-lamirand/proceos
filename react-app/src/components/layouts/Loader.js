import React from "react"

export default function Loader() {

    return(
        <>
            <div style={{
                position: "absolute",
                zIndex: "9998",
                background: "rgba(255,255,255,0.8)",
                width: "100vw",
                height: "100vh",
                top: 0,
                left: 0,
            }}>
            </div>
            <div style={{
                position: "absolute",
                zIndex: "9999",
                width: "100vw",
                height: "100vh",
                top: 0,
                left: 0,
            }}>
                <div className="h-100 d-flex justify-content-center align-items-center">
                    <div className="shadow" style={{width: "150px", height: "150px", background: "white", borderRadius: "8px"}}>
                        <div className="h-100 d-flex justify-content-center align-items-center">
                            <div className="spinner-border" role="status">
                                <span className="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>

    )
}