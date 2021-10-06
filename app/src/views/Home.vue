<template>
  <div class="global-home-view">
    <img alt="Vue logo" src="../assets/logo.png">
    <div class="text-center">
      <h2>{{ val }}</h2>
    </div>
    <button v-on:click="setString">
      <span>Click me !</span>
    </button>
  </div>
</template>

<script>

export default {
  name: 'Home',
  components: {},
  data() {
    return{
      val: this.$store.state.settings.ui
    }
  },
  methods:{
    changeValue() {
       return this.val = "dark"
    },
    setString() {
      this.changeValue()
      this.$store.commit("settings/changeTheme", this.val);
    },
  }
}
</script>
