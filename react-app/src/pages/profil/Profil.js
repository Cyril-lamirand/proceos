import React, {useContext, useEffect, useState} from "react"
import {UserContext} from "../../contexts/UserContext"
import Avatar from 'avataaars'
import axios from "axios"

export default function Profil() {

    const [page, setPage] = useState("main")
    const [user, setUser] = useContext(UserContext)
    const [avatar, setAvatar] = useState({})

    const TopType = [
        { label: 'Cheveux longs droits 1', value: 'LongHairStraight' }, // 0
        { label: 'Chauve', value: 'NoHair' }, // 1
        { label: 'Borne', value: 'Eyepatch' }, // 2
        { label: 'Chapeau', value: 'Hat' }, // 3
        { label: 'Hijab', value: 'Hijab' }, // 4
        { label: 'Turban', value: 'Turban' }, // 5
        { label: "Chapeau d'hiver 1", value: 'WinterHat1' }, // 6
        { label: "Chapeau d'hiver 2", value: 'WinterHat2' }, // 7
        { label: "Chapeau d'hiver 3", value: 'WinterHat3' }, // 8
        { label: "Chapeau d'hiver 4", value: 'WinterHat4' }, // 9
        { label: 'Cheveux longs 1', value: 'LongHairBigHair' }, // 10
        { label: 'Cheveux longs 2', value: 'LongHairBob' }, // 11
        { label: 'Cheveux longs 3', value: 'LongHairBun' }, // 12
        { label: 'Cheveux longs bouclés', value: 'LongHairCurly' }, // 13
        { label: 'Cheveux longs Curvy', value: 'LongHairCurvy' }, // 14
        { label: 'Cheveux longs Dreads', value: 'LongHairDreads' }, // 15
        { label: 'Cheveux longs Frida', value: 'LongHairFrida' }, // 16
        { label: 'Cheveux longs Afro', value: 'LongHairFro' }, // 17
        { label: 'Cheveux longs Afro avec bande', value: 'LongHairFroBand' }, // 18
        { label: 'Cheveux mi-court', value: 'LongHairNotTooLong' }, // 19
        { label: 'Cheveux longs rasés côtés', value: 'LongHairShavedSides' }, // 20
        { label: 'Cheveux longs Mia Wallace', value: 'LongHairMiaWallace' }, // 21
        { label: 'Cheveux longs droits 2', value: 'LongHairStraight2' }, // 22
        { label: 'Cheveux longs droits 3', value: 'LongHairStraightStrand' }, // 23
        { label: 'Cheveux courts Dreads 1', value: 'ShortHairDreads01' }, // 24
        { label: 'Cheveux courts Dreads 2', value: 'ShortHairDreads02' }, // 25
        { label: 'Cheveux courts crête', value: 'ShortHairFrizzle' }, // 26
        { label: 'Cheveux courts Shaggy Mullet', value: 'ShortHairShaggyMullet' }, // 27
        { label: 'Cheveux courts bouclés', value: 'ShortHairShortCurly' }, // 28
        { label: 'Cheveux courts plats', value: 'ShortHairShortFlat' }, // 29
        { label: 'Cheveux courts arrondis', value: 'ShortHairShortRound' }, // 30
        { label: 'Cheveux courts avec mèche', value: 'ShortHairShortWaved' }, // 31
        { label: 'Cheveux sur le côté', value: 'ShortHairSides' }, // 32
        { label: 'Cheveux courts Caesar', value: 'ShortHairTheCaesar' }, // 33
        { label: 'Cheveux courts Caesar avec cicatrice', value: 'ShortHairTheCaesarSidePart'}, // 34
    ]

    const Skin = [
        { label: 'Clair', value: 'Light' }, // 0
        { label: 'Bronzée', value: 'Tanned' }, // 1
        { label: 'Jaune', value: 'Yellow' }, // 2
        { label: 'Pâle', value: 'Pale' }, // 3
        { label: 'Marron', value: 'Brown' }, // 4
        { label: 'Marron Foncé', value: 'DarkBrown' }, // 5
        { label: 'Foncée', value: 'Black' }, // 6
    ]

    const AccessoriesType = [
        { label: 'Aucun', value: 'Blank' }, // 0
        { label: 'Lunettes de vue 1', value: 'Prescription01' }, // 1
        { label: 'Lunettes de vue 2', value: 'Prescription02' }, // 2
        { label: 'Lunettes de vue arrondies', value: 'Round' }, // 3
        { label: 'Lunettes de soleil 1', value: 'Sunglasses' }, // 4
        { label: 'Lunettes de soleil 2', value: 'Wayfarers' }, // 5
        { label: 'Lunettes de soleil 3', value: 'Kurt' }, // 6
    ]

    const HairColor = [
        { label: 'Marron foncé', value: 'BrownDark' }, // 0
        { label: 'Marron', value: 'Brown' }, // 1
        { label: 'Auburn', value: 'Auburn' }, // 2
        { label: 'Noir', value: 'Black' }, // 3
        { label: 'Blond', value: 'Blonde' },
        { label: 'Blond doré', value: 'BlondeGolden' }, // 4
        { label: 'Rose', value: 'PastelPink' }, // 5
        { label: 'Bleu', value: 'Blue' }, // 6
        { label: 'Platine', value: 'Platinum' }, // 7
        { label: 'Rouge', value: 'Red' }, // 8
        { label: 'Argent', value: 'SilverGray' }, // 9
    ]

    const FacialHairType = [
        { label: 'Aucun', value: 'Blank' }, // 0
        { label: 'Barbe moyenne', value: 'BeardMedium' }, // 1
        { label: 'Barbe légère', value: 'BeardLight' }, // 2
        { label: 'Grande barbe', value: 'BeardMajestic' }, // 3
        { label: 'Moustache Fancy', value: 'MoustacheFancy' }, // 4
        { label: 'Moustache Magnum', value: 'MoustacheMagnum' }, // 5
    ]

    const ClotheType = [
        { label: 'Blazer 1', value: 'BlazerShirt' }, // 0
        { label: 'Blazer 2', value: 'BlazerSweater' }, // 1
        { label: 'Pull & Col', value: 'CollarSweater' }, // 2
        { label: 'T-Shirt', value: 'GraphicShirt' }, // 3
        { label: 'Hoodie', value: 'Hoodie' }, // 4
        { label: 'Overall', value: 'Overall' }, // 5
        { label: 'T-Shirt Neck', value: 'ShirtCrewNeck' }, // 6
        { label: 'T-Shirt Scoop', value: 'ShirtScoopNeck' }, // 7
        { label: 'T-Shirt Col V', value: 'ShirtVNeck' }, // 8
    ]

    const Eyes = [
        { label: 'Par défaut', value: 'Default' }, // 0
        { label: 'Fermé', value: 'Close' }, // 1
        { label: 'Pleurs', value: 'Cry' }, // 2
        { label: 'Étourdis', value: 'Dizzy' }, // 3
        { label: 'Roulement des yeux', value: 'EyeRoll' }, // 4
        { label: 'Heureux', value: 'Happy' }, // 5
        { label: 'Coeurs', value: 'Hearts' }, // 6
        { label: 'Sur le côté', value: 'Side' }, // 7
        { label: 'Strabisme', value: 'Squint' }, // 8
        { label: 'Surpris', value: 'Surprised' }, // 9
        { label: "Clin d'oeil", value: 'Wink' }, // 10
        { label: "Clin d'oeil loufoque", value: 'WinkWacky' }, // 11
    ]

    const Eyebrow = [
        { label: 'Par défaut', value: 'Default' }, // 0
        { label: 'En colère', value: 'Angry' }, // 1
        { label: 'En colère naturellement', value: 'AngryNatural' }, // 2
        { label: 'Au naturel', value: 'DefaultNatural' }, // 3
        { label: 'Plat', value: 'FlatNatural' }, // 4
        { label: 'Excité', value: 'RaisedExcited' }, // 5
        { label: 'Excité naturellement', value: 'RaisedExcitedNatural' }, // 6
        { label: 'Triste', value: 'SadConcerned' }, // 7
        { label: 'Triste et concerné', value: 'SadConcernedNatural' }, // 8
        { label: 'Monosourcil', value: 'UnibrowNatural' }, // 9
        { label: 'Haut bas', value: 'UpDown' }, // 10
        { label: 'Bas haut', value: 'UpDownNatural' }, // 11
    ]

    const Mouth = [
        { label: 'Par défaut', value: 'Default' }, // 0
        { label: 'Concerné', value: 'Concerned' }, // 1
        { label: 'Incrédule', value: 'Disbelief' }, // 2
        { label: 'Manger', value: 'Eating' }, // 3
        { label: 'Grimace', value: 'Grimace' }, // 4
        { label: 'Triste', value: 'Sad' }, // 5
        { label: 'Crie', value: 'ScreamOpen' }, // 6
        { label: 'Sérieuse', value: 'Serious' }, // 7
        { label: 'Sourire', value: 'Smile' }, // 8
        { label: 'Langue', value: 'Tongue' }, // 9
        { label: 'Scintillement', value: 'Twinkle' }, // 10
        { label: 'Vomir', value: 'Vomit' }, // 11
    ]

    function randomAvatar() {
        setAvatar({
            topType: TopType[Math.floor(Math.random() * TopType.length)].value,
            accessoriesType: AccessoriesType[Math.floor(Math.random() * AccessoriesType.length)].value,
            hairColor: HairColor[Math.floor(Math.random() * HairColor.length)].value,
            facialHairType: FacialHairType[Math.floor(Math.random() * FacialHairType.length)].value,
            clotheType: ClotheType[Math.floor(Math.random() * ClotheType.length)].value,
            eyeType: Eyes[Math.floor(Math.random() * Eyes.length)].value,
            eyebrowType: Eyebrow[Math.floor(Math.random() * Eyebrow.length)].value,
            mouthType: Mouth[Math.floor(Math.random() * Mouth.length)].value,
            skinColor: Skin[Math.floor(Math.random() * Skin.length)].value
        })
    }

    function handleChange(event) {
        const target = event.target
        const name = target.name
        const value = target.value

        setAvatar({
            ...avatar,
            [name]: value,
        })
    }

    function handleSubmit(e) {
        e.preventDefault()
        if (!avatar.topType) {
            avatar.topType = "LongHairStraight"
        }
        if (!avatar.accessoriesType) {
            avatar.accessoriesType = "Blank"
        }
        if (!avatar.hairColor) {
            avatar.hairColor = "BrownDark"
        }
        if (!avatar.facialHairType) {
            avatar.facialHairType = "Blank"
        }
        if (!avatar.clotheType) {
            avatar.clotheType = "BlazerShirt"
        }
        if (!avatar.eyeType) {
            avatar.eyeType = "Default"
        }
        if (!avatar.eyebrowType) {
            avatar.eyebrowType = "Default"
        }
        if (!avatar.mouthType) {
            avatar.mouthType = "Default"
        }
        if (!avatar.skinColor) {
            avatar.skinColor = "Light"
        }

        const cfg = {
            headers: { "Content-Type": "application/json" },
            method: "put"
        }

        const finalObject = {
            id: user.id,
            ...avatar
        }

        console.log(finalObject)

        try {
            axios
                .put("http://localhost:8000/api/save_avatar", finalObject, cfg)
                .then((r) => {
                    if (r.data.message === "Avatar enregistré !") {
                        setUser({...user, avatar: avatar})
                    } else {
                        // TODO : Show error message on the page !
                    }
                })
                .then(() => {
                    setPage("main")
                })
                .then(() => {
                    // TODO : Axios GET for the user
                })
        } catch (e) {
            console.log(e.message);
        }
    }

    useEffect(() => {
        if (user) {
            setAvatar({...user.avatar})
        }
    }, [user])

    // Todo : Remove DEV
    useEffect(() => {
        console.log(avatar)
    }, [avatar])

    useEffect(() => {
        console.log("// User")
        console.log(user)
    }, [user])


    return(
        <>
            {page === "main" &&
                <>
                    { user ?
                        <>
                            <div className="d-flex justify-content-center">
                                <Avatar
                                    style={{ width: '200px', height: '200px' }}
                                    topType={avatar['topType']}
                                    avatarStyle="Transparent"
                                    accessoriesType={avatar['accessoriesType']}
                                    hairColor={avatar['hairColor']}
                                    facialHairType={avatar['facialHairType']}
                                    clotheType={avatar['clotheType']}
                                    eyeType={avatar['eyeType']}
                                    eyebrowType={avatar['eyebrowType']}
                                    mouthType={avatar['mouthType']}
                                    skinColor={avatar['skinColor']}
                                />
                            </div>
                            <div className="text-center mt-5">
                                <div>
                                    <h2>{user.firstname} {user.lastname}</h2>
                                </div>
                                <div className="mt-3">
                                    <span>{user.email}</span>
                                </div>
                                <div className="mt-3">
                                    {user.organization ?
                                        <>
                                            <h3>{user.organization.label}</h3>
                                        </>
                                        :
                                        <>
                                            <h3>Pas d'organisation trouvée</h3>
                                        </>
                                    }
                                </div>
                            </div>
                        </>
                        :
                        <>
                            <h2>Pas d'utilisateur</h2>
                        </>
                    }
                    <div className="text-center mt-3">
                        <button className="btn btn-primary" onClick={() => setPage("edit")}>
                            <span>Modifier l'avatar</span>
                        </button>
                    </div>
                </>
            }
            { page === "edit" &&
                <>
                    <div className="text-center mt-3">
                        <button className="btn btn-secondary" onClick={() => setPage("main")}>
                            <span>Annuler la / les modification(s)</span>
                        </button>
                    </div>
                    <div className="d-flex justify-content-center">
                        <Avatar
                            style={{ width: '200px', height: '200px' }}
                            topType={avatar['topType']}
                            avatarStyle="Transparent"
                            accessoriesType={avatar['accessoriesType']}
                            hairColor={avatar['hairColor']}
                            facialHairType={avatar['facialHairType']}
                            clotheType={avatar['clotheType']}
                            eyeType={avatar['eyeType']}
                            eyebrowType={avatar['eyebrowType']}
                            mouthType={avatar['mouthType']}
                            skinColor={avatar['skinColor']}
                        />
                    </div>
                    <div className="container">
                        <hr/>
                        <form onSubmit={handleSubmit}>
                            <div className="row">
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Couleur de peau
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="skinColor"
                                        value={avatar['skinColor']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {Skin.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Cheveux / Couvre-chef
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="topType"
                                        value={avatar['topType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {TopType.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Couleur des cheveux
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="hairColor"
                                        value={avatar['hairColor']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {HairColor.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Lunettes
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="accessoriesType"
                                        value={avatar['accessoriesType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {AccessoriesType.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Pilosité
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="facialHairType"
                                        value={avatar['facialHairType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {FacialHairType.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Vêtement
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="clotheType"
                                        value={avatar['clotheType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {ClotheType.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Yeux
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="eyeType"
                                        value={avatar['eyeType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {Eyes.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Sourcils
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="eyebrowType"
                                        value={avatar['eyebrowType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {Eyebrow.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                                <div className="col-12 col-md-6 col-lg-4">
                                    <label className="label" htmlFor="select">
                                        Bouche
                                    </label>
                                    <select
                                        className="form-select"
                                        id="select"
                                        name="mouthType"
                                        value={avatar['mouthType']}
                                        onChange={handleChange}
                                    >
                                        <option value="" defaultValue disabled hidden>
                                            Selectionnez une option
                                        </option>
                                        {Mouth.map((element, index) => {
                                            return (
                                                <option key={index} value={element['value']}>
                                                    {element['label']}
                                                </option>
                                            )
                                        })}
                                    </select>
                                </div>
                            </div>
                            <hr />
                            <div className="col-12">
                                <div style={{ display: 'flex', justifyContent: 'center' }}>
                                    <button
                                        type="submit"
                                        className="btn btn-primary"
                                    >
                                        Confirmer l'avatar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </>
            }
        </>
    )
}