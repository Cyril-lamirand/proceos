<template>
  <div class="container mt-5 mb-5">
    <b-row>
      <b-col sm="12" lg="6">
        <h1 class="mt-3">Rejoignez Proceos&nbsp;!</h1>
        <p>Créez votre compte dès maintenant.</p>

        <b-form @submit="onSubmit">
          <b-form-group id="firstname" label="Prénom" label-for="firstname">
            <b-form-input
                id="firstname"
                v-model="form.firstname"
                type="text"
                placeholder="Jean-Michel"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group id="lastname" label="Nom" label-for="lastname">
            <b-form-input
                id="lastname"
                v-model="form.lastname"
                type="text"
                placeholder="Aulas"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group id="email" label="Email" label-for="email">
            <b-form-input
                id="email"
                v-model="form.email"
                type="email"
                placeholder="jeanmichel@ol.fr"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group
              id="password"
              label="Mot de passe"
              label-for="password"
              description="Votre mot de passe doit être composé d'au moins huit caractères."
          >
            <b-form-input
                id="password"
                v-model="form.password"
                type="password"
                placeholder="············"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group id="status" label="Vous êtes" label-for="status">
            <b-form-select
                id="status"
                v-model="form.status"
                :options="status"
                required
            ></b-form-select>
          </b-form-group>

          <b-form-group id="input-group-4" v-slot="{ ariaDescribedby }">
            <b-form-checkbox-group
                v-model="form.checked"
                id="checkboxes-4"
                :aria-describedby="ariaDescribedby"
                required
            >
              <b-form-checkbox :value=true
              >J'accepte les conditions d'utilisation</b-form-checkbox
              >
            </b-form-checkbox-group>
          </b-form-group>

          <b-button type="submit" block variant="primary"
          >Inscription</b-button
          >
        </b-form>
      </b-col>
      <b-col sm="12" lg="6">
        <div class="h-100 d-flex flex-column align-items-center justify-content-center">
          <h2>Lorem ipsum dolor sit.</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero temporibus tenetur aut quae rerum repellendus consequatur veniam exercitationem. Iure, quisquam! À CUSTOM AVEC PHRASE ACCROCHE / IMG ETC…</p>
        </div>
      </b-col>
    </b-row>
    <!-- to see JSON Result -->
    <!-- <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card> -->
  </div>
</template>

<script>
import axios from "../plugins/axios"

export default {
  name: "Register",
  data() {
    return {
      form: {
        email: "",
        firstname: "",
        lastname: "",
        status: null,
        checked: false,
      },
      status: [
        { text: "Veuillez choisir...", value: null },
        "Étudiant",
        "Intervenant",
        "Gérant d'une organisation",
      ]
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      axios.post(this.$store.state["settings/backendUrl"] + "/api/register", this.form)


      alert(JSON.stringify(this.form))
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.email = ""
      this.form.firstname = ""
      this.form.lastname = ""
      this.form.checked = ""
    },
  },
};
</script>