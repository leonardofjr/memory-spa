<template>
  <div id="contact" class="page">
    <div class="row">
        <div class=" col-lg-4">
            <!-- If email is not null -->
           <div v-if="data.email">
            <h3>EMAIL</h3>
                <i class="fas fa-envelope"></i> <a :href="data.email">{{data.email}}</a>
                <p><b>-or-</b></p>
            </div>
            <h3>FIND ME HERE</h3>
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
            <div v-if="data.github_url">
                <i class="fab fa-github"></i> <a :href="data.github_url">{{data.github_url}}</a>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="/contact" class="mr-auto ml-auto py-4 contact-form">  
                <div class="form-group">
                    <input class="form-control" type="text" name="contactFormEmail" placeholder="EMAIL"/>
                </div>
                <div class="flash-message-contact-form-email alert alert-info d-none">
                    <span></span>
                </div>  
                 <div class="form-group">
                     <input class="form-control" type="text" name="contactSubject" placeholder="WHAT SHOULD WE TALK ABOUT?"/>
                </div>
                <div class="flash-message-contact-form-subject alert alert-info d-none">
                    <span></span>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="text" name="contactFormMessage" placeholder="TELL ME MORE!"></textarea>
                </div>
                <div class="flash-message-contact-form-message alert alert-info d-none">
                    <span></span>
                </div> 
                <button class="btn btn-primary" type="submit">SEND</button>
                <div class="flash-message-contact-form-success alert alert-info d-none">
                    <span>Your inquiry has been submitted</span>
                </div> 
            </form>
        </div>
    </div>
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
            axios.get(this.web_url + '/contact')
            .then(response => {
                this.data = response.data;
                console.log(this.data);
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
