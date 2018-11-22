<template>
    <div>
        <section  v-for="post of posts">
            <h2>{{post.title}}</h2>
            <p>{{post.body}}}</p>
        </section>

    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
        posts: [],
        errors: []
        }
    },
    // Fetches posts when the component is created.
    created() {
        axios.get(`http://jsonplaceholder.typicode.com/posts`)
        .then(response => {
        // JSON responses are automatically parsed.
        this.posts = response.data
        console.log(this.posts);
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
    }
}

</script>