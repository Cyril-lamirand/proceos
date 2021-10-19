<template>
  <div id="app">
    <Cookie/>
    <header>
      <Navbar/>
    </header>
    <main>
      <router-view/>
      <span style="display: none">{{ val = this.$store.state.settings.ui }}</span>
    </main>
    <footer>
      <Footer/>
    </footer>
  </div>
</template>

<style>
/* Light Theme (Only use with JS) */
.navbar-theme-light { background-color: #42b983 !important;}
.heading-theme-light{ color: #222222 !important;}
.text-theme-light   { color: black;}

/* Dark Theme (Only use with JS) */
.navbar-theme-dark { background-color: #2c3e50 !important;}
.heading-theme-dark{ color: #CC7832 !important;}
.text-theme-dark   { color: white !important;}
</style>

<script>
import Navbar from "./components/layouts/Navbar"
import Footer from "./components/layouts/Footer"
import Cookie from "./components/layouts/Cookie"

export default {
  components: {Cookie, Footer, Navbar},
  data: function() {
    return{
      val: this.$store.commit("settings/changeTheme", this.$store.state.settings.ui)
    }
  },
  watch: {
    'val': function(value, oldValue) {
      // Selectors / HTML Tags
      const body = document.body
      const heading = ["h1", "h2", "h3", "h4", "h5", "h6"]
      const text = ["p", "span", "ul", "li", "label", "i", "icon", "a"]
      const navbar = document.getElementById("website-navbar")
      if(value === 'light') {
        console.log("New theme : " + value + " --- Old theme : " + oldValue)
        // Change Body
        body.style.backgroundColor = this.$store.state.settings.lightThemeColor
        // Change Navbar
        navbar.classList.remove("navbar-theme-dark")
        navbar.classList.add("navbar-theme-light")
        // Change ALL Headings
        heading.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("heading-theme-dark")
            item.classList.add("heading-theme-light")
          }
        })
        // Change ALL Texts
        text.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("text-theme-dark")
            item.classList.add("text-theme-light")
          }
        })
      } else {
        console.log("New theme : " + value + " --- Old theme : " + oldValue)
        body.style.backgroundColor = this.$store.state.settings.darkThemeColor
        // Exactly the same but for the Dark UI
        navbar.classList.remove("navbar-theme-light")
        navbar.classList.add("navbar-theme-dark")
        heading.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("heading-theme-light")
            item.classList.add("heading-theme-dark")
          }
        })
        text.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("text-theme-light")
            item.classList.add("text-theme-dark")
          }
        })
      }
    }
  }
}
</script>