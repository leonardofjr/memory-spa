<template>
    <div class="page">
        <h2>Portfolio</h2>
            <div v-for="post of posts" class="row m-2 portfolio-item" :key="post.id">
                <div class="col-md-5" v-for="file of post.files" :key="file.id">
                       <img :src="'storage/' + file.filename_1" class="img-fluid">
                </div>
                <div class="col-md-7">
                        <h2>{{post.title}}</h2>
                        <p>{{post.description}}</p>
                        <a :href="post.website_url" class="btn btn-primary">Launch Website</a>
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
        errors: [],
        body: ''
        }
    },

        methods: {
            getPostBody (post) {
                this.body = this.stripTags(post);

                return this.body.length > 50 ? this.body.substring(0, 50) + '...' : this.body;           
            },

            stripTags (text) {
                return text.replace(/(<([^>]+)>)/ig, '');
            } 

    },

    // Fetches posts when the component is created.
    created() {
        axios.get(this.web_url + '/portfolio')
        .then(response => {
             this.posts = response.data;
             console.log(response);
             return this.posts;
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