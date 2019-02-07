<template>
  <div class="page">
        <div class=" row">
            <div class="col-sm-4 text-center">
                <img :src='"/storage/" + this.data.profile_image' alt="" class="img-fluid">
            </div>

            <div class="col-sm-8">
                <div v-html="this.data.bio"></div>
                <button class="btn btn-primary">VIEW RESUME</button>
            </div>
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
            axios.get(this.web_url + '/about')
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
