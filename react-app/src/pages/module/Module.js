import React from "react"
import {useParams} from "react-router-dom";

export default function Module() {

    let { moduleId } = useParams();

    return(
        <>
            <div className="container mt-4 mb-4">
                <h2>Module #{moduleId}</h2>
                <hr/>
                <div className="row">
                    <div className="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <iframe
                            width="100%"
                            height="315"
                            src="https://www.youtube.com/embed/-ERWlp828kY"
                            title="YouTube video player" frameBorder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowFullScreen
                        />
                    </div>
                    <div className="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div className="text-center mb-4">
                            <h2>Votre première REACT-APP !</h2>
                        </div>
                        <div>
                            <p>Ce module vous apprendra à créer votre première application React JS pour le Web.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam distinctio porro vero. Beatae culpa deserunt dicta ex facere inventore iure laudantium, mollitia natus numquam quaerat repellat sapiente soluta tempora vitae?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, at consequatur cumque distinctio est explicabo fuga fugiat illum iste iure mollitia odit officiis porro provident ratione reprehenderit similique unde vero?</p>
                        </div>
                    </div>
                </div>
                <div className="col-12 mt-5 mb-5">
                    <div className="text-center">
                        <button className="btn btn-primary">
                           Questionnaire (obligatoire)
                        </button>
                    </div>
                </div>
                <div className="col-12 text-center mt-5 mb-5">
                    <h3>Le module s'adapte à votre niveau !</h3>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div className="shadow pb-3" style={{ paddingLeft: "10px", paddingRight: "10px"}}>
                            <div className="text-center pt-4 pb-1">
                                <h3>Débutant</h3>
                            </div>
                            <hr/>
                            <p>Module "React" pour les étudiants qui n'ont jamais pratiqué ce Framework.</p>
                            <ul>
                                <li>Lorem ipsum...</li>
                                <li>Lorem ipsum...</li>
                                <li>Lorem ipsum...</li>
                            </ul>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto at autem cum dignissimos distinctio dolor ea facilis fuga labore laborum minima nam, non quisquam quo, reprehenderit suscipit vero vitae! Amet?
                            </p>
                            <div className="text-center mt-4 mb-3">
                                <button className="btn btn-primary">
                                    Démarrer le module !
                                </button>
                            </div>
                        </div>
                    </div>
                    <div className="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div className="shadow pb-3" style={{ paddingLeft: "10px", paddingRight: "10px"}}>
                            <div className="text-center pt-4 pb-1">
                                <h3>Intermédiaire</h3>
                            </div>
                            <hr/>
                            <p>Module "React" pour les étudiants ayant déjà des notions.</p>
                            <ul>
                                <li>Lorem ipsum...</li>
                                <li>Lorem ipsum...</li>
                                <li>Lorem ipsum...</li>
                            </ul>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto at autem cum dignissimos distinctio dolor ea facilis fuga labore laborum minima nam, non quisquam quo, reprehenderit suscipit vero vitae! Amet?
                            </p>
                            <div className="text-center mt-4 mb-3">
                                <button className="btn btn-primary">
                                    Démarrer le module !
                                </button>
                            </div>
                        </div>
                    </div>
                    <div className="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div className="shadow pb-3" style={{ paddingLeft: "10px", paddingRight: "10px"}}>
                            <div className="text-center pt-4 pb-1">
                                <h3>Expert</h3>
                            </div>
                            <hr/>
                            <p>Module "React" pour les étudiants à l'aise avec le Framework.</p>
                            <ul>
                                <li>Lorem ipsum...</li>
                                <li>Lorem ipsum...</li>
                                <li>Lorem ipsum...</li>
                            </ul>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto at autem cum dignissimos distinctio dolor ea facilis fuga labore laborum minima nam, non quisquam quo, reprehenderit suscipit vero vitae! Amet?
                            </p>
                            <div className="text-center mt-4 mb-3">
                                <button className="btn btn-primary">
                                    Démarrer le module !
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </>
    )
}