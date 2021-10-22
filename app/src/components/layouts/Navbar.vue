<template>
  <div>
    <b-navbar toggleable="lg" class="global-navbar-component" id="website-navbar">
      <b-navbar-brand href="#">
        <img alt="Vue logo" src="../../assets/logo.png" class="website-logo" />
      </b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-dropdown-item :href="url + ''">
            <span>Test</span>
          </b-dropdown-item>
          <b-dropdown-item :href="url + 'about'">
            <span>About</span>
          </b-dropdown-item>
        </b-navbar-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <div class="d-flex align-items-center">
            <b-form-checkbox v-model="checked" @change="setTheme" switch size="md">
              <CapitalizeFirstLetter v-bind:string="this.$store.state.settings.ui"/>
            </b-form-checkbox>
          </div>
          <b-nav-form class="ml-lg-3">
            <b-row>
              <b-col cols="9">
                <b-form-input size="sm" class="mr-sm-2" placeholder="Recherche..."></b-form-input>
              </b-col>
              <b-col cols="3">
                <b-button size="sm" type="submit">
                  <font-awesome-icon icon="search"/>
                </b-button>
              </b-col>
            </b-row>
          </b-nav-form>
          <b-nav-item-dropdown right>
            <template #button-content>
              <em>
                <span>
                  Langue
                </span>
              </em>
            </template>
            <b-dropdown-item href="/en">
              <span class="force-black">
                EN
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span class="force-black">
                ES
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span class="force-black">
                RU
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="/fr">
              <span class="force-black">
                FR
              </span>
            </b-dropdown-item>
          </b-nav-item-dropdown>
          <b-nav-item-dropdown right>
            <template #button-content>
              <em>
                <font-awesome-icon icon="user-circle"/>
              </em>
            </template>
            <b-dropdown-item href="#">
              <span class="force-black">Profil</span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span class="force-black">Deconnexion</span>
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
import CapitalizeFirstLetter from "../logics/CapitalizeFirstLetter"
export default {
  name: "Navbar",
  components: {CapitalizeFirstLetter},
  data() {
    return{
      val: this.$store.state.settings.ui,
      checked: this.$store.state.settings.ui !== "light",
      url: window.location.origin + "/" + this.$store.state.settings.lang + "/"
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

console.log(window.location)
</script>

<style scoped>

.website-logo{ width: 64px; height: 64px; }

.force-black{ color: black !important;}

</style>