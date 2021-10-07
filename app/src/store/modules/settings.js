export default {
    namespaced: true,
    state: {
        ui: "light",
        lightThemeColor: "#EEEEEE",
        darkThemeColor: "#222831",
        headingLightColor: "",
        headingDarkColor: "",
        textLightColor: "",
        textDarkColor: ""
    },
    getters :{
        // Getters
    },
    actions :{

    },
    mutations: {
        changeTheme: (state, value) => value ? (state.ui = value) : (state.ui = "light")
    }
}