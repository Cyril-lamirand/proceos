export default {
    namespaced: true,
    state: {
        ui: "light",
        lightThemeColor: "#EEEEEE",
        darkThemeColor: "#222831",
        cookie: false,
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