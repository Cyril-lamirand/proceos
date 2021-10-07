<template>
  <div class="global-navbar-component">
    <b-container fluid class="h-100">
      <b-row class="h-100">
        <b-col cols="8">
          <b-row class="h-100">
            <b-col cols="4">
              <div class="h-100 d-flex align-items-center">
                <img alt="Vue logo" src="../../assets/logo.png" class="w-25" />
              </div>

            </b-col>
            <b-col cols="8" class="d-flex align-items-center justify-content-around">
              <div>
                <router-link to="/">Home</router-link>
              </div>
              <div>
                <router-link to="/about">About</router-link>
              </div>
              <div>
                <router-link to="/about">About</router-link>
              </div>
            </b-col>
          </b-row>
        </b-col>
        <b-col cols="2" class="d-flex align-items-center justify-content-center">
          <b-form-checkbox v-model="checked" @change="setTheme" switch size="lg">
            <CapitalizeFirstLetter v-bind:string="this.$store.state.settings.ui"/>
          </b-form-checkbox>
        </b-col>
        <b-col cols="2" class="d-flex align-items-center justify-content-center">
          <font-awesome-icon icon="user-circle"/>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import CapitalizeFirstLetter from "../logics/CapitalizeFirstLetter";
export default {
  name: "Navbar",
  components: {CapitalizeFirstLetter},
  data() {
    return{
      val: this.$store.state.settings.ui,
      checked: this.$store.state.settings.ui !== "light"
    }
  },
  methods:{
    changeValue() { if (this.checked) { return this.val = "dark" } else { return this.val = "light" } },
    setTheme() {
      this.changeValue()
      return this.$store.commit("settings/changeTheme", this.val)
    },
  }
}
</script>

<style scoped>

.global-navbar-component{
  background: red;
  height: 80px;
}

</style>