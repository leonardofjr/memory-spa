<template>
  <div class="page">
    <div class="row">
        <div class="text-center col-lg-4">
            <div><a href="tel://012 345 6789"><i class="fa fa-5x fa-phone"></i>
                <p>Hire Me</p></a></div>
            <div><i class="fa fa-5x fa-map-marker"></i>
                <p>Address</p>
            </div>
        </div>

        <div class="col-lg-8">
            <h2 class="text-center px-3 py-2">Get in Touch</h2>
            <p class="text-center px-3 py-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem quibusdam ipsa libero voluptates pariatur quae repellendus vitae, eaque voluptatum doloribus cum magnam modi dolores excepturi minus iure enim soluta molestias.</p>
    <form method="POST" action="/contact" class="mr-auto ml-auto py-4 contact-form">
        <div class="form-group">
            <input class="form-control" type="text" name="contactFormName" placeholder="Name"/>
        </div>
       <div class="flash-message-contact-form-name alert alert-info d-none">
           <span></span>
        </div>  
        <div class="form-group">
            <input class="form-control" type="text" name="contactFormEmail" placeholder="Email Address"/>
        </div>
        <div class="flash-message-contact-form-email alert alert-info d-none">
            <span></span>
        </div>  
        <div class="form-group">
            <textarea class="form-control" type="text" name="contactFormMessage" placeholder="Leave Your Message"></textarea>
        </div>
        <div class="flash-message-contact-form-message alert alert-info d-none">
            <span></span>
        </div> 
        <button class="btn btn-primary" type="submit">Send It Now</button>
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
