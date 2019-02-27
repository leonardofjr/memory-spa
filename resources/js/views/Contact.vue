<template>
  <div id="contact" class="row'">
        <div class="col-sm-12">
            <div class="page-title">
                <h2>Contact Me</h2>
            </div>
            <p>I am available for hire and open to any ideas of cooperation.</p>
            <dl class="dl dl-vertical">
                <!-- If email is not null -->
                <dt v-if="data.email">Email:</dt>
                <dd v-if="data.email" class="mb-5">
                <i class="fas fa-envelope"></i> <a :href="'mailto:' + data.email">{{data.email}}</a>
                </dd>
                <!-- If twitter_url is not null -->
                <dt v-if="data.twitter_url">Twitter:</dt>
                <dd v-if="data.twitter_url">
                    <i class="fab fa-twitter"></i> <a :href="data.twitter_url">{{data.twitter_url}}</a><br>
                </dd>
                <!-- If linkedin_url is not null -->
                <dt  v-if="data.linkedin_url">Linkedin:</dt>
                <dd v-if="data.linkedin_url">
                    <i class="fab fa-linkedin-in"></i> <a :href="data.linkedin_url">{{data.linkedin_url}}</a><br>
                </dd>
                <!-- If facebook_url is not null -->
                <dt  v-if="data.facebook_url">Facebook:</dt>
                <dd v-if="data.facebook_url"><i class="fab fa-facebook">
                    </i> <a :href="data.facebook_url">{{data.facebook_url}}</a><br>
                </dd>
                <!-- If github_url is not null -->
                <dt v-if="data.github_url">Github:</dt>
                <dd v-if="data.github_url">
                    <i class="fab fa-github"></i> <a :href="data.github_url">{{data.github_url}}</a>
                </dd>
            </dl>
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
            // JSON responses are automatically parsed.
            })
            .catch(e => {
                 this.errors.push(e)
            })
        },

    }
</script>
