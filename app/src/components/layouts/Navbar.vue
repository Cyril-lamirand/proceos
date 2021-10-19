<template>
  <div>
    <b-navbar toggleable="lg" class="global-navbar-component" id="website-navbar">
      <b-navbar-brand href="#">
        <img alt="Vue logo" src="../../assets/logo.png" class="website-logo" />
      </b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="/">
            <span>Home</span>
          </b-nav-item>
          <b-nav-item href="/about">
            <span>About</span>
          </b-nav-item>
        </b-navbar-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <div class="d-flex align-items-center">
            <b-form-checkbox v-model="checked" @change="setTheme" switch size="md">
              <CapitalizeFirstLetter v-bind:string="this.$store.state.settings.ui"/>
            </b-form-checkbox>
          </div>
          <b-nav-form class="ml-3">
            <b-form-input size="sm" class="mr-sm-2" placeholder="Recherche..."></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">
              <font-awesome-icon icon="search"/>
            </b-button>
          </b-nav-form>
          <b-nav-item-dropdown right>
            <template #button-content>
              <em>
                <span>
                  Langue
                </span>
              </em>
            </template>
            <b-dropdown-item href="#">
              <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                EN
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                ES
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                RU
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
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
              <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                Profil
              </span>
            </b-dropdown-item>
            <b-dropdown-item href="#">
              <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                Déconnexion
              </span>
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
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
  height: 80px;
}
.website-logo{ width: 64px; height: 64px; }

</style>