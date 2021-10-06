export default {
    namespaced: true,
    state: {
        ui: "light"
    },
    getters :{
        // Getters
    },
    actions :{
        // Setters
    },
    mutations: {
        changeTheme: (state, value) => value ? (state.ui = value) : (state.ui = "light")
    }
}