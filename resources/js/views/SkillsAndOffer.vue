<template>
  <div id="skills-and-offer">
    <div class="page-title">
        <h2>Skills & Offer</h2>
    </div>
        <div v-html="this.$parent.data.skills_and_offer"></div>
  </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        // Fetches posts when the component is created.
        created() {

        },
    }
</script>

