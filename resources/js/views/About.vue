<template>
        <div id="about">
            <div class="page-title">
                <h2>About Me</h2>
            </div>
            <div class="col-sm-12">
                <div v-html="this.data.bio"></div>
                <button class="btn btn-primary">VIEW RESUME</button>
            </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: [],
                user: null,
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
