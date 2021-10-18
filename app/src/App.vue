<template>
  <div id="app">
    <header>
      <Navbar/>
    </header>
    <main>
      <router-view/>
    </main>
    <footer>
      <Footer/>
    </footer>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}

.bg-light{background-color: #42b983;}

.bg-dark{background-color: #2c3e50;}

.text-light{ color: #2e3136 !important;}

.text-dark{ color: #C9C9C9 !important;}
</style>
<script>
import Navbar from "./components/layouts/Navbar";
import Footer from "./components/layouts/Footer";
export default {
  components: {Footer, Navbar},
  methods:{

  }
}
</script>