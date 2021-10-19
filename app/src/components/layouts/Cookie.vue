<template>
  <div class="cookie-global-component" id="cookie" v-if="cookie === false">
    <div class="cookie-blur">
    </div>
    <div class="cookie-container">
      <b-container>
        <div class="pt-3">
          <h4 v-bind:class="val === 'light' ? '' : 'text-theme-light'">
            Nous utilisons des cookies ! 🍪
          </h4>
        </div>
        <hr>
        <div>
          <p v-bind:class="val === 'light' ? '' : 'text-theme-light'">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aliquam aperiam architecto, blanditiis enim hic illo ipsum, maxime nemo odit possimus repellendus ut. Delectus ipsa necessitatibus quaerat totam! Dolores.
          </p>
        </div>
        <b-row>
          <b-col cols="12" md="6">
            <b-row>
              <b-col cols="10" md="11">
                <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                  <b>Publicité(s) personnalisée(s)</b>
                </span>
              </b-col>
              <b-col cols="2" md="1">
                <b-form-checkbox switch size="md" v-model="cookie1">
                </b-form-checkbox>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="10" md="11">
                <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                  <b>Tracking, Retargeting</b>
                </span>
              </b-col>
              <b-col cols="2" md="1">
                <b-form-checkbox switch size="md" v-model="cookie2">
                </b-form-checkbox>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="10" md="11">
                <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                  <b>On vend tes données à Google</b>
                </span>
              </b-col>
              <b-col cols="2" md="1">
                <b-form-checkbox switch size="md" v-model="cookie3">
                </b-form-checkbox>
              </b-col>
            </b-row>
          </b-col>
          <b-col cols="12" md="6">
            <b-row>
              <b-col cols="10" md="11">
                <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                  <b>Numéro de ta grosse daronne</b>
                </span>
              </b-col>
              <b-col cols="2" md="1">
                <b-form-checkbox switch size="md" v-model="cookie4">
                </b-form-checkbox>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="10" md="11">
                <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                  <b>Compte Instagram de ta soeur</b>
                </span>
              </b-col>
              <b-col cols="2" md="1">
                <b-form-checkbox switch size="md" v-model="cookie5">
                </b-form-checkbox>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="10" md="11">
                <span v-bind:class="val === 'light' ? '' : 'text-theme-light'">
                  <b>Laisse cocher tu crains rien</b>
                </span>
              </b-col>
              <b-col cols="2" md="1">
                <b-form-checkbox switch size="md" v-model="cookie6">
                </b-form-checkbox>
              </b-col>
            </b-row>
          </b-col>
        </b-row>
        <b-row class="pb-3">
          <b-col cols="12" md="6">
            <b-button block class="mt-2" variant="dark" v-on:click="hideCookie">
              <b>Non merci 🥺</b>
            </b-button>
          </b-col>
          <b-col cols="12" md="6" class="mt-2">
            <b-button block variant="primary" v-on:click="hideCookie">
              <b>Accepter 😃</b>
            </b-button>
          </b-col>
        </b-row>
      </b-container>
    </div>
  </div>
</template>

<script>
export default {
  name: "Cookie",
  data: function() {
    return{
      cookie: this.$store.state.settings.cookie,
      cookie1: true,
      cookie2: true,
      cookie3: true,
      cookie4: true,
      cookie5: true,
      cookie6: true
    }
  },
  methods: {
    hideCookie: function() {
      const element = document.getElementById("cookie")
      element.style.display = "none"
      this.cookie = true
      return this.$store.commit("settings/defineCookie", this.cookie)
    }
  }
}
</script>

<style scoped>

.cookie-global-component{ display: block; }

.cookie-blur{
  position: fixed;
  width: 100%;
  height: 100%;
  filter: blur(0px);
  z-index: 10;
  background-color: rgba(0,0,0,0.80);
}

.cookie-container{
  position: fixed;
  background-color: white;
  left:0;
  bottom: 0;
  width: 100%;
  height: auto;
  z-index: 11;

}

</style>