<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <b-col lg="8" class="d-none d-lg-flex flex-column justify-content-center pl-5">
          <h1>Lorem ipsum dolor sit.</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero temporibus tenetur aut quae rerum repellendus consequatur veniam exercitationem. Iure, quisquam! À CUSTOM AVEC PHRASE ACCROCHE / IMG ETC…</p>
      </b-col>
      <b-col lg="4" class="d-flex align-items-center auth-bg px-2 p-lg-5">
        <b-col sm="8" md="6" lg="12" class="px-xl-2 mx-auto">
          <h1 class="mt-3">Rejoingnez Proceos&nbsp;!</h1>
          <p>Créez votre compte dès maintenant.</p>

          <b-form @submit="onSubmit" @reset="onReset" v-if="show">
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
              >
                <b-form-checkbox value="me"
                  >J'accepte les conditions d'utilisation</b-form-checkbox
                >
              </b-form-checkbox-group>
            </b-form-group>

            <b-button type="submit" block variant="primary"
              >Inscription</b-button
            >
          </b-form>
        </b-col>
      </b-col>
      <!-- /Register-->
    </b-row>
    <!-- to see JSON Result -->
    <!-- <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card> -->
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      form: {
        email: "",
        name: "",
        status: null,
        checked: [],
      },
      status: [
        { text: "Select One", value: null },
        "Intervenant",
        "Étudiant",
        "Professeur",
      ],
      show: true,
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      alert(JSON.stringify(this.form));
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.name = "";
      this.form.food = null;
      this.form.checked = [];
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
  },
};
</script>