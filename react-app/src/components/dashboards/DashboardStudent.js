import React from "react"

export default function DashboardStudent() {


    return(
        <>
            <div className="mt-5">
                <h2>Tableau de bord de l'étudiant</h2>
                <div class="card">
                    <h1>CSS Template Zone</h1>
                    <h1>Heading 1</h1>
                    <h2>Heading 2</h2>
                    <h3>Heading 3</h3>
                    <h4>Heading 3</h4>
                </div>
                <div className="card">
                    <input type="text" placeholder="Input text" className="mb-3"></input>
                    <textarea id="message" placeholder="Input textaera"></textarea>
                </div>
                <div className="card">
                    <table class="data">
                        <thead>
                            <th>Entry Header 1</th>
                            <th>Entry Header 2</th>
                            <th>Entry Header 3</th>
                            <th>Entry Header 4</th>
                        </thead>
                        <tr>
                            <td>Entry First Line 1</td>
                            <td>Entry First Line 2</td>
                            <td>Entry First Line 3</td>
                            <td>Entry First Line 4</td>
                        </tr>
                        <tr>
                            <td>Entry Line 1</td>
                            <td>Entry Line 2</td>
                            <td>Entry Line 3</td>
                            <td>Entry Line 4</td>
                        </tr>
                        <tr>
                            <td>Entry Last Line 1</td>
                            <td>Entry Last Line 2</td>
                            <td>Entry Last Line 3</td>
                            <td>Entry Last Line 4</td>
                        </tr>
                    </table>
                </div>
            </div>
            <button className="button-primary m-3">.button-primary</button>
            <button className="button-secondary m-3">.button-secondary</button>
            <button className="button-success m-3">.button-success</button>
            <button className="button-danger m-3">.button-danger</button>
            <button className="button-warning m-3">.button-warning</button>
        </>
    )
}
