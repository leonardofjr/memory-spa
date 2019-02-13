<template>
        <div id="about" class=" row">
            <div class="col-sm-12">
                <h2>About</h2>
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
