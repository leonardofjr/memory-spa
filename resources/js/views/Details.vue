<template>
<div class="page">
<h2>{{data.title}}</h2>
<p v-html="data.description"></p>
<button class="btn btn-primary" v-on:click="back()">back</button>
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

            axios.get(this.web_url + '/details/' + this.$route.params.id )
            .then(response => {
                this.data = response.data;
                console.log(this.data);
                return this.data;
            // JSON responses are automatically parsed.
            })
            .catch(e => {
            this.errors.push(e)
        
            })

            // async / await version (created() becomes async created())
            //
            // try {
            //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
            //   this.posts = response.data
            // } catch (e) {
            //   this.errors.push(e)
            // }
        },
        methods: {
                
            back() {
                window.history.back();
            }
        }

    }
</script>

