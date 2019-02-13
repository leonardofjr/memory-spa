<template>
  <div id="skills-and-offer" class="row">
    <div class="col-sm-12">
        <h2>Skills & Offer</h2>
        <div v-html="this.data.skills_and_offer"></div>
    </div>
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
            axios.get(this.web_url + '/home')
            .then(response => {
                if (!response.data['user']) {
                    this.data = response.data['guest'];
                    this.user = false;
                } else {
                    this.data = response.data['user'];
                    this.user = true;

                }
                    return this.data;
                // JSON responses are automatically parsed.
            })
            .catch(e => {
                 this.errors.push(e)
            })
        },
    }
</script>

