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
</style>
<script>
import Navbar from "./components/layouts/Navbar";
import Footer from "./components/layouts/Footer";
export default {
  components: {Footer, Navbar}
}
</script>