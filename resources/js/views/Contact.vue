<template>
  <div class="page">
    <div class="row">
        <div class=" col-lg-4">
            <h3>EMAIL</h3>
            <a href="mail://hello@lfelipa.ca">hello@lfelipa.ca</a>
            <p><b>-or-</b></p>
            <h3>FIND ME HERE</h3>
            <i class="fab fa-twitter"></i> <a href="mail://hello@lfelipa.ca">hello@lfelipa.ca</a><br>
            <i class="fab fa-instagram"></i> <a href="mail://hello@lfelipa.ca">hello@lfelipa.ca</a><br>
            <i class="fab fa-facebook"></i> <a href="mail://hello@lfelipa.ca">hello@lfelipa.ca</a><br>
            <i class="fab fa-github"></i> <a href="mail://hello@lfelipa.ca">hello@lfelipa.ca</a>
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
