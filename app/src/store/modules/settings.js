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
        defineBg: function(element) {
            const el = document.getElementsByClassName(element)
            if (this.$store.state.settings.ui === "light") {
                return el.classList.add("bg-light")
            } else {
                return el.classList.add("bg-dark")
            }
        },
        defineText: function(element) {
            const el = document.getElementsByClassName(element)
            if (this.$store.state.settings.ui === "light") {
                return el.classList.add("text-light")
            } else {
                return el.classList.add("text-light")
            }
        }

    },
    mutations: {
        changeTheme: (state, value) => value ? (state.ui = value) : (state.ui = "light")
    }
}