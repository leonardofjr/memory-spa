<template>
  <div id="contact" class="row'">
        <div class="col-sm-12">
            <div class="page-title">
                <h2>Contact Me</h2>
            </div>
            <p>I am available for hire and open to any ideas of cooperation.</p>
            <dl class="dl dl-vertical">
                <!-- If email is not null -->
                <dt v-if="this.$parent.data.email">Email:</dt>
                <dd v-if="this.$parent.data.email" class="mb-5">
                <i class="fas fa-envelope"></i> <a :href="'mailto:' + this.$parent.data.email">{{this.$parent.data.email}}</a>
                </dd>
                <!-- If twitter_url is not null -->
                <dt v-if="this.$parent.data.twitter_url">Twitter:</dt>
                <dd v-if="this.$parent.data.twitter_url">
                    <i class="fab fa-twitter"></i> <a :href="this.$parent.data.twitter_url">{{this.$parent.data.twitter_url}}</a><br>
                </dd>
                <!-- If linkedin_url is not null -->
                <dt  v-if="this.$parent.data.linkedin_url">Linkedin:</dt>
                <dd v-if="this.$parent.data.linkedin_url">
                    <i class="fab fa-linkedin-in"></i> <a :href="this.$parent.data.linkedin_url">{{this.$parent.data.linkedin_url}}</a><br>
                </dd>
                <!-- If facebook_url is not null -->
                <dt  v-if="this.$parent.data.facebook_url">Facebook:</dt>
                <dd v-if="this.$parent.data.facebook_url"><i class="fab fa-facebook">
                    </i> <a :href="this.$parent.data.facebook_url">{{this.$parent.data.facebook_url}}</a><br>
                </dd>
                <!-- If github_url is not null -->
                <dt v-if="this.$parent.data.github_url">Github:</dt>
                <dd v-if="this.$parent.data.github_url">
                    <i class="fab fa-github"></i> <a :href="this.$parent.data.github_url">{{this.$parent.data.github_url}}</a>
                </dd>
            </dl>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        // Fetches posts when the component is created.
        created() {

        },

    }
</script>
