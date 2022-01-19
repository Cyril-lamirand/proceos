<template>
  <div class="global-footer-component">
    <b-container fluid>
      <b-col cols="12">
        <hr/>
      </b-col>
    </b-container>
    <b-container fluid>
      <b-row>
        <b-col cols="12" lg="2">
          <div class="d-flex align-items-center justify-content-center">
            <img alt="Vue logo" src="../../assets/logo.png" class="w-25">
          </div>
        </b-col>
        <b-col cols="12" lg="10">
          <b-row>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Politique de confidentialité</span>
              </a>
            </b-col>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Qui-sommes nous ?</span>
              </a>
            </b-col>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Mentions légales</span>
              </a>
            </b-col>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Mentions illégales</span>
              </a>
            </b-col>
          </b-row>
          <b-row class="mt-lg-4">
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Répertoire Github</span>
              </a>
            </b-col>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Règles d'utilisations</span>
              </a>
            </b-col>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Utilisation des cookies</span>
              </a>
            </b-col>
            <b-col cols="12" lg="3" class="d-flex align-items-center justify-content-center">
              <a href="#">
                <span>Règles de gestion</span>
              </a>
            </b-col>
          </b-row>
        </b-col>
      </b-row>
      <b-col cols="12" class="d-flex justify-content-center mt-5">
        <h6>Proceos - Open-Source. 2021-2022.</h6>
      </b-col>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "Footer"
}
</script>

<style scoped>

.global-footer-component{}

</style>