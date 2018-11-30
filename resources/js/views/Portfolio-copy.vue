<template>
    <div class="row page">
        
        <div  v-for="post of posts" class="">
                <h2>{{post.title}}</h2>
                <p>{{post.description}}</p>
                <div v-for="file of post.files" class="row">
                    <div class="  col-md-4">
                            <img v-bind:src="'storage/' + file['filename_1']" class="img-thumbnail">
                        </div>
                    <div class="  col-md-4">
                            <img v-bind:src="'storage/' + file['filename_2']" class="img-thumbnail">
                        </div>
                    <div class="  col-md-4">
                            <img v-bind:src="'storage/' + file['filename_3']" class="img-thumbnail">
                    </div>
                </div>
        </div>

             

    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
        posts: [],
        photos: [],
        errors: []
        }
    },
    // Fetches posts when the component is created.
    created() {
        axios.get(this.web_url + '/portfolio')
        .then(response => {
            console.log( response.data);
            return this.posts = response.data;
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
    }
}

</script>