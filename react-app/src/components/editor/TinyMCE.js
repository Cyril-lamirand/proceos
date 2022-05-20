import React, {useEffect, useRef, useState} from 'react'
import { Editor } from '@tinymce/tinymce-react'
import { Markup } from 'interweave'

export default function TinyMCE() {
    const editorRef = useRef(null)
    const [tinyValue, setTinyValue] = useState()

    const log = () => {
        if (editorRef.current) {
            console.log(editorRef.current.getContent())
        }
    }

    function handleChange(event) {


        setTinyValue({
            wysiwyg : editorRef.current.getContent()
        })
    }

    useEffect(() => {
        console.log(tinyValue)
    }, [tinyValue])

    return(
        <>
            <div className="container-fluid">
                <div className="row">
                    <div className="col-6">
                        <h2>Editeur de contenus</h2>
                        <hr/>
                        <Editor
                            onChange={handleChange}
                            apiKey='aro677hfkym6hvkj2n3lnfru8gsgp7pjdtvc5jn4mpjzeqdu'
                            onInit={(evt, editor) => editorRef.current = editor}
                            initialValue="<p>This is the initial content of the editor.</p>"
                            init={{
                                height: 500,
                                menubar: false,
                                plugins: [
                                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                                    'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
                                ],
                                toolbar: 'undo redo | blocks | ' +
                                    'bold italic forecolor | alignleft aligncenter ' +
                                    'alignright alignjustify | bullist numlist outdent indent |'
                                    + 'image | code | table | media | ' + 'removeformat | help',
                                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                            }}
                        />
                    </div>
                    <div className="col-6">
                        <h2>Rendu visuel</h2>
                        <hr/>
                        {tinyValue ?
                            <>
                                {tinyValue.wysiwyg ?
                                    <>
                                        <Markup content={tinyValue.wysiwyg} />
                                    </>
                                    :
                                    "Pas de wysiwyg"
                                }
                            </>
                            :
                            "Pas de rendu disponible..."
                        }
                    </div>

                </div>
                <hr/>
                <h2>Paramètres supplémentaires</h2>


            </div>

        </>
    )
}