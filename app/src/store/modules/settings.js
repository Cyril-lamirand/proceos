export default {
    namespaced: true,
    state: {
        backendUrl: "http://localhost:8000/",
        ui: "light",
        lightThemeColor: "#EEEEEE",
        darkThemeColor: "#222831",
        cookie: false,
        lang: "fr"
    },
    getters :{
        // Getters
    },
    actions :{
        // Do Some actions
    },
    mutations: {
        changeTheme: (state, value) => value ? (state.ui = value) : (state.ui = "light"),
        defineCookie: (state, value) => value ? (state.cookie = value) : (state.cookie = false)
    }
}