<template>
  <div class="global-navbar-component">
    <b-container fluid>
      <b-row>
        <b-col cols="8">

        </b-col>
        <b-col cols="2">

        </b-col>
        <b-col cols="2">

        </b-col>
      </b-row>
    </b-container>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
  </div>
</template>

<script>
export default {
  name: "Navbar"
}
</script>

<style scoped>

.global-navbar-component{
  background: red;
  height: 80px;
}

</style>