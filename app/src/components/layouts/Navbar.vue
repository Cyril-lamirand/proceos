<template>
  <div>
    <b-navbar
        toggleable="lg"
        v-bind:class="val === 'light' ? 'bg-light text-dark' : 'bg-dark text-light'"
        class="global-navbar-component"
    >
      <b-navbar-brand href="#">
        <img alt="Vue logo" src="../../assets/logo.png" class="website-logo" />
      </b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="/">
            <span v-bind:class="val === 'light' ? 'text-dark' : 'text-light'">Home</span>
          </b-nav-item>
          <b-nav-item href="/about">
            <span v-bind:class="val === 'light' ? 'text-dark' : 'text-light'">About</span>
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
                <span v-bind:class="val === 'light' ? 'text-dark' : 'text-light'">
                  Langue
                </span>
              </em>
            </template>
            <b-dropdown-item href="#">EN</b-dropdown-item>
            <b-dropdown-item href="#">ES</b-dropdown-item>
            <b-dropdown-item href="#">RU</b-dropdown-item>
            <b-dropdown-item href="#">FA</b-dropdown-item>
          </b-nav-item-dropdown>
          <b-nav-item-dropdown right>
            <template #button-content>
              <em>
                <font-awesome-icon
                    icon="user-circle"
                    v-bind:class="val === 'light' ? 'text-dark' : 'text-light'"
                />
              </em>
            </template>
            <b-dropdown-item href="#">Profil</b-dropdown-item>
            <b-dropdown-item href="#">Déconnexion</b-dropdown-item>
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