import React, {useState} from "react"
import Loader from "../../components/layouts/Loader"
import ChooseModule from "../../components/course/Module"
import ChooseCourseName from "../../components/course/CourseName"
import CreateCourseContent from "../../components/course/CourseContent"
import Resume from "../../components/course/Resume"
import {CourseContext} from "../../contexts/CourseContext";

export default function CreateCourse() {

    const [page, setPage] = useState("resume")
    const [course, setCourse] = ("")

    return(
        <>
            <div className="container">
                <div className="mt-5">
                    <h2>Création d'un cours</h2>
                    <hr/>
                </div>
            </div>
            <CourseContext.Provider value={[course, setCourse]}>
                {page ?
                    <>
                        {page === "module" ?
                            <>
                                <ChooseModule/>
                            </>
                            :
                            ""
                        }
                        {page === "courseName" ?
                            <>
                                <ChooseCourseName/>
                            </>
                            :
                            ""
                        }
                        {page === "courseContent" ?
                            <>
                                <CreateCourseContent/>
                            </>
                            :
                            ""
                        }
                        {page === "resume" ?
                            <>
                                <Resume/>
                            </>
                            :
                            ""
                        }
                    </>
                    :
                    <>
                        <Loader/>
                    </>
                }
            </CourseContext.Provider>

        </>
    )
}