import React, {useContext} from "react"
// Context
import {UserContext} from "../../contexts/UserContext"
// Assets
import logo from "../../logo.svg"
// Avatar
import Avatar from 'avataaars'


export default function Navbar() {

    const [user, setUser] = useContext(UserContext)

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
                        <form className="d-flex">
                            {user.email ?
                                <>
                                    <div className="d-flex">
                                        <div className="mr-2">
                                            <a className="text-light" href="/dashboard">Tableau de bord</a>
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


                        </form>
                    </div>
                </div>
            </nav>
        </>
    )
}