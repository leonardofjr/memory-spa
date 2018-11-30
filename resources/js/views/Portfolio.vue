<template>
    <div class="row page">
        
        <div  v-for="post of posts" class="col-md-4 m-2" style="max-height: 33.33%">
                                            <router-link v-bind:to="'details\/' + post.id"  exact>
                <div v-for="file of post.files" v-bind:style="'background-image: url(' + 'storage/' + file.filename_1 +');' + 'justify-content:center; align-items:center; display:flex; height: 100%;'">
                     <div style=" z-index: 2000">
                        <h2>{{post.title}}</h2>
                        <p>{{getPostBody(post.description)}}</p>
                    </div>

                </div>
                    </router-link>
            <div style="background-color: rgba(122, 0, 0, .8); position: absolute; left: 0; top: 0; width: 100%; height: 100%; z-index: 1000;">

                   
        </div>
    </div>

             

    </div>
</template>
<script>

import Details from './Details.vue';
import axios from 'axios';

export default {
    components: {Details},
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