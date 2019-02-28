<template>
    <div id="portfolio">
        <div class="page-title">
            <h2>Portfolio</h2>
        </div>
            <div v-for="post of data.portfolio" class="row portfolio-item" :key="post.id">
                <div class="col-md-8">
                        <h2 class="project-title"> <a :href="post.website_url">{{post.title}}</a></h2>
                        <p v-html="post.description"></p>
                        <div class='project-technologies'>
                            <div class="technologies-title">Project Technologies</div>
                            <ul class="technologies-tags list-unstyled">
                                <li class="d-inline-block"  v-for="technology in post.technologies" :key="technology.id">
                                    <template v-for="user_skill_item in user_skill_set" >
                                        <template v-if="user_skill_item.name == technology">
                                             <a class="technology-tag" v-html="technology" :href="user_skill_item.website" :key="user_skill_item.id">></a>
                                        </template>
                                    </template>
                                </li>
                            </ul>
                        </div>
                      
                </div>
                <div class="col-md-4">
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
        axios.get(this.web_url + '/home')
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