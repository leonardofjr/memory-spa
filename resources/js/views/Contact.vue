<template>
  <div id="contact" class="page">
            <h2>CONTACT ME</h2>
            <!-- If email is not null -->
            <dl class="dl dl-vertical">
                <dt>Email:</dt>
                <dd v-if="data.email">
                <i class="fas fa-envelope"></i> <a :href="'mailto:' + data.email">{{data.email}}</a>
                </dd>
                <!-- If twitter_url is not null -->
                <div v-if="data.twitter_url">
                    <i class="fab fa-twitter"></i> <a :href="data.twitter_url">{{data.twitter_url}}</a><br>
                </div>
                <!-- If linkedin_url is not null -->
                <div v-if="data.linkedin_url">
                    <i class="fab fa-linkedin-in"></i> <a :href="data.linkedin_url">{{data.linkedin_url}}</a><br>
                </div>
                <!-- If facebook_url is not null -->
                <div v-if="data.facebook_url"><i class="fab fa-facebook">
                    </i> <a :href="data.facebook_url">{{data.facebook_url}}</a><br>
                </div>
                <!-- If github_url is not null -->
                <dt>Github:</dt>
                <dd v-if="data.github_url">
                    <i class="fab fa-github"></i> <a :href="data.github_url">{{data.github_url}}</a>
                </dd>
            </dl>

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
        methods: {
                
            back() {
                window.history.back();
            }
        }

    }
</script>
