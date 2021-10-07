<template>
  <div>
    <span>{{ this.capitalizeFirstLetter(this.$store.state.settings.ui) }}</span>
  </div>
</template>

<script>
export default {
  name: "CapitalizeFirstLetter",
  methods: {
    capitalizeFirstLetter(value) {
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  }
}
</script>