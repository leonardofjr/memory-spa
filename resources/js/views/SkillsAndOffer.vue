<template>
  <div id="skills-and-offer">
    <div class="page-title">
        <h2>Skills & Offer</h2>
    </div>
        <div v-html="this.data.skills_and_offer"></div>
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
            axios.get(this.web_url + 'get-user-settings')
            .then(response => {
                if (!response.data['logged_in']) {
                    this.data = response.data;
                    this.user = false;
                } else {
                    this.data = response.data;
                    this.user = true;

                }
                // JSON responses are automatically parsed.
            })
            .catch(e => {
                 this.errors.push(e)
            })
        },
    }
</script>

