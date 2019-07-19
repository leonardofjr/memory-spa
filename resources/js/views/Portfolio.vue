<template>
    <div id="portfolio">
        <div class="page-title">
            <h2>Portfolio</h2>
        </div>
            <div v-for="post of data.portfolio" class="row portfolio-item" :key="post.id">
                <div class="col-12 col-md-5">
                        <h2 class="project-title"> <a :href="post.website_url">{{post.title}}</a></h2>
                        <p v-html="post.description"></p>
                       
                </div>
                <div class="col-12 col-md-7">
                       <img :src="'/storage/' + post.portfolio_entries.filename_1" class="img-fluid">
                </div>
            </div>
        </div>
</template>
<script>

import axios from 'axios';

export default {
    data() {
        return {
        data: [],
        photos: [],
        errors: [],
        user_skill_set: [],
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
    mounted() {
        axios.get(this.web_url + 'get-user-settings')
        .then(response => {
        if (!response.data['logged_in']) {
             this.data = response.data;
             this.user_skill_set = response.data.user_skill_set;
            this.user = false;
          } else {
             this.data = response.data;
             this.user_skill_set = response.data.user_skill_set;
            this.user = true;
          }

        // JSON responses are automatically parsed.
        })
        .catch(e => {
        this.errors.push(e)
      
        })
    }
}

</script>