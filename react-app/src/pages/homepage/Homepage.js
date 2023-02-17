import React from "react"

export default function Homepage() {

    return(
        <>
            <div className="container">
                <div className="col-12">
                    <div className="text-center mt-5">
                        <h2>Bienvenue sur l'application Proceos !</h2>
                    </div>
                </div>
                <div className="col-12 mt-5">
                    <div>
                        <h4>C'est quoi Proceos ?</h4>
                    </div>
                    <div className="mt-4">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, esse exercitationem nemo nesciunt odio possimus quisquam! Eius expedita minus quibusdam ratione sint. Aliquam autem consequatur nobis placeat. Cumque, quis, totam.</p>
                    </div>
                </div>
                <div className="col-12 mt-5">
                    <div>
                        <h4>Qui peut l'utiliser ?</h4>
                    </div>
                    <div className="mt-4">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, esse exercitationem nemo nesciunt odio possimus quisquam! Eius expedita minus quibusdam ratione sint. Aliquam autem consequatur nobis placeat. Cumque, quis, totam.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, esse exercitationem nemo nesciunt odio possimus quisquam! Eius expedita minus quibusdam ratione sint. Aliquam autem consequatur nobis placeat. Cumque, quis, totam.</p>
                    </div>
                </div>
                <div className="row mt-5">
                    <div className="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <iframe
                            width="100%" height="315" src="https://www.youtube.com/embed/Gngu2xp3exU"
                            title="YouTube video player" frameBorder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowFullScreen
                        />
                    </div>
                    <div className="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <h4>Projet Open-Source</h4>
                        <p className="mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur consequatur consequuntur cum cupiditate deserunt, eum facilis illum nam odit perspiciatis possimus praesentium quis quod sit suscipit ullam ut velit.</p>
                        <p className="mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dolore, eligendi, eveniet ipsam laboriosam libero magnam nisi quam, quibusdam ratione tempore voluptates. Animi distinctio fuga possimus suscipit ut. Ad, id?</p>
                    </div>
                </div>
                <div className="row mt-5">
                    <div className="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div className="shadow pt-3 pb-3" style={{paddingRight: "10px", paddingLeft: "10px"}}>
                            <div className="col-12 text-center">
                                <h4>Espace Étudiant</h4>
                                <hr/>
                            </div>
                            <p className="mt-3">Liste des fonctionnalités :</p>
                            <ul className="mt-2">
                                <li>Lorem ipsum dolor...</li>
                                <li>Lorem ipsum dolor...</li>
                                <li>Lorem ipsum dolor...</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus amet deserunt eligendi, impedit ipsam laborum maiores nisi nulla quaerat, qui, quia quisquam voluptas. Ab asperiores beatae consectetur est, sequi ullam?</p>
                        </div>
                    </div>
                    <div className="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div className="shadow pt-3 pb-3" style={{paddingRight: "10px", paddingLeft: "10px"}}>
                            <div className="col-12 text-center">
                                <h4>Pour les enseignants</h4>
                                <hr/>
                            </div>
                            <p className="mt-3">Liste des fonctionnalités :</p>
                            <ul className="mt-2">
                                <li>Lorem ipsum dolor...</li>
                                <li>Lorem ipsum dolor...</li>
                                <li>Lorem ipsum dolor...</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus amet deserunt eligendi, impedit ipsam laborum maiores nisi nulla quaerat, qui, quia quisquam voluptas. Ab asperiores beatae consectetur est, sequi ullam?</p>
                        </div>
                    </div>
                    <div className="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div className="shadow pt-3 pb-3" style={{paddingRight: "10px", paddingLeft: "10px"}}>
                            <div className="col-12 text-center">
                                <h4>Espace d'administration</h4>
                                <hr/>
                            </div>
                            <p className="mt-3">Liste des fonctionnalités :</p>
                            <ul className="mt-2">
                                <li>Lorem ipsum dolor...</li>
                                <li>Lorem ipsum dolor...</li>
                                <li>Lorem ipsum dolor...</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus amet deserunt eligendi, impedit ipsam laborum maiores nisi nulla quaerat, qui, quia quisquam voluptas. Ab asperiores beatae consectetur est, sequi ullam?</p>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}