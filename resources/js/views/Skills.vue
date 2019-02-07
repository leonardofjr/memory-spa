<template>
  <div class="page">
    <h2>Skills</h2>
    <div v-html="this.data.bio"></div>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                data: [],
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        // Fetches posts when the component is created.
        created() {
            axios.get(this.web_url + '/skills')
            .then(response => {
                this.data = response.data;
                console.log(this.data);
                return this.data;
            // JSON responses are automatically parsed.
            })
            .catch(e => {
                 this.errors.push(e)
            })
        },
    }
</script>

