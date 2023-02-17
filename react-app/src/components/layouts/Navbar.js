import React, {useContext, useEffect, useState} from "react"
// Context
import {UserContext} from "../../contexts/UserContext"
// Assets
import logo from "../../assets/proceos.png"
// Avatar
import Avatar from 'avataaars'


export default function Navbar() {

    const [user, setUser] = useContext(UserContext)
    const [menu, setMenu] = useState(false)


    useEffect(() => {
        const selection = document.getElementById("responsive-menu")
        if (menu) {
            selection.style.display = "block"
        } else {
            selection.style.display = "none"
        }
        console.log(menu)
    }, [menu])

    return(
        <>
            <nav className="navbar navbar-expand-lg bg-dark text-light fixed-top">
                <div className="container-fluid">
                    <a className="navbar-brand" href="/">
                        <div className="d-flex h-100">
                            <div>
                                <img className="App-logo" src={logo} width="64" height="64"/>
                            </div>
                            <div className="d-flex align-items-center">
                                <h2 className="text-light pt-1">Proceos</h2>
                            </div>
                        </div>
                    </a>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"/>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            <li className="nav-item">
                                <a className="nav-link text-light" aria-current="page" href="/">Accueil</a>
                            </li>

                        </ul>
                        <div className="d-flex">
                            {user.email ?
                                <>
                                    <div className="d-flex">
                                        <div className="h-100 d-flex align-items-center">
                                            <a className="text-light" style={{marginRight: "10px"}} href="/dashboard">Tableau de bord</a>
                                        </div>
                                        <a href="/profil">
                                            <div>
                                                <div style={{
                                                    background: "white",
                                                    borderRadius:"4px",
                                                    paddingTop:"3px",
                                                    paddingBottom:"3px",
                                                    paddingLeft:"3px",
                                                    paddingRight:"3px"
                                                }}>
                                                    <Avatar
                                                        style={{ width: '50px', height: '50px' }}
                                                        topType={user.avatar['topType']}
                                                        avatarStyle="Transparent"
                                                        accessoriesType={user.avatar['accessoriesType']}
                                                        hairColor={user.avatar['hairColor']}
                                                        facialHairType={user.avatar['facialHairType']}
                                                        clotheType={user.avatar['clotheType']}
                                                        eyeType={user.avatar['eyeType']}
                                                        eyebrowType={user.avatar['eyebrowType']}
                                                        mouthType={user.avatar['mouthType']}
                                                        skinColor={user.avatar['skinColor']}
                                                    />
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </>
                                :
                                <>
                                    <div>
                                        <a className="text-light" href="/login">Connexion</a> <span>/</span> <a className="text-light" href="/register">S'enregistrer</a>
                                    </div>
                                </>
                            }
                        </div>
                    </div>
                </div>
            </nav>

            <div id="responsive-button" style={{position: "absolute", zIndex: "1999", top:"30px", right: "20px" }}>
                <button
                    onClick={() => setMenu(!menu)}
                >
                    {menu ? "Fermer" : "Ouvrir"}
                </button>
            </div>

            <div id="responsive-menu"  style={{position: "absolute", background: "rgba(0,0,0,0.9", zIndex: "999"}} className="w-100 h-100">
                <div className="text-center" style={{paddingTop: "80px"}}>
                    <a href="/">Homepage</a>
                    <hr/>
                    {user.email ?
                        <>
                            <a href="/dashboard">Tableau de bord</a>
                            <hr/>
                            <a href="/profil">Profil</a>
                            <hr/>
                            <a href="/logout">Déconnexion</a>
                        </>
                        :
                        <>
                            <a href="/login">Connexion</a>
                            <hr/>
                            <a href="/register">S'enregistrer</a>
                        </>

                    }
                </div>
            </div>
        </>
    )
}