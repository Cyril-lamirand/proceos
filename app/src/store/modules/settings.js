export default {
    namespaced: true,
    state: {
        ui: "light",
        lightThemeColor: "#EEEEEE",
        darkThemeColor: "#222831",
    },
    getters :{
        // Getters
    },
    actions :{
        // Do Some actions
    },
    mutations: {
        changeTheme: (state, value) => value ? (state.ui = value) : (state.ui = "light"),
    }
}