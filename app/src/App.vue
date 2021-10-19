<template>
  <div id="app">
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
/* Light Theme */
.bg-light     {background-color: #42b983 !important;}
.heading-light{ color: #222222 !important;}
.text-light   { color: black !important;}

/* Dark Theme */
.bg-dark     {background-color: #2c3e50 !important;}
.heading-dark{ color: #CC7832 !important;}
.text-dark   { color: white !important;}
</style>

<script>
import Navbar from "./components/layouts/Navbar"
import Footer from "./components/layouts/Footer"

export default {
  components: {Footer, Navbar},
  data: function() {
    return{
      val: this.$store.commit("settings/changeTheme", this.$store.state.settings.ui)
    }
  },
  watch: {
    'val': function(value, oldValue) {
      const body = document.body
      const heading = ["h1", "h2", "h3", "h4", "h5", "h6"]
      const text = ["p", "span", "ul", "li", "label"]
      if(value === 'light') {
        console.log("New theme : " + value + " --- Old theme : " + oldValue)
        body.style.backgroundColor = this.$store.state.settings.darkThemeColor
        heading.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("heading-dark")
            item.classList.add("heading-light")
          }
        })
        text.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("text-light")
            item.classList.add("text-dark")
          }
        })
      } else {
        console.log("New theme : " + value + " --- Old theme : " + oldValue)
        body.style.backgroundColor = this.$store.state.settings.lightThemeColor
        heading.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("heading-light")
            item.classList.add("heading-dark")
          }
        })
        text.forEach((el) => {
          const tags = document.getElementsByTagName(el)
          for (var item of tags) {
            item.classList.remove("text-dark")
            item.classList.add("text-light")
          }
        })
      }
    }
  }
}
</script>