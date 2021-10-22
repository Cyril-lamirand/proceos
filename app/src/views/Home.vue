<template>
  <div class="global-home-view">

    <div class="text-center mt-3 mb-3">
      <img alt="Vue logo" src="../assets/logo.png">
    </div>

    <div class="text-center mt-5 mb-5">
      <h1>{{ $t("homepage.heading-1")}}</h1>
      <h1 class="pt-2">Heading H1</h1>
      <h2 class="pt-2">Heading H2</h2>
      <h3 class="pt-2">Heading H3</h3>
      <h4 class="pt-2">Heading H4</h4>
      <h5 class="pt-2">Heading H5</h5>
      <h6 class="pt-2">Heading H6</h6>
      <p class="pt-2">Paragraphe Text</p>
      <span>Span Text</span>
      <br>
      <label class="pt-3">Label Text</label>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Home',
  components: {},
}
</script>
