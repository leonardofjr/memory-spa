<template>
  <div class="page">
        <div class=" row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="text-center"><b>Hi!</b><br>I'm <span class="developer-name">Leo</span></h2>
                <div class="text-center">
                    <img src="imgs/leo-illustration.svg" class="mt-5 mb-2 img-fluid" style="max-width: 600px"  alt="">
                </div>
                <h2 class="pb-5 text-center">Web Developer</h2>
                <div class="form-inline">
                    <button class="create-dialog-box-btn btn btn-primary mb-2 col-12 col-lg-5" >Change Name</button>
                    <div class="col-lg-5 input-dialog-box form-group mb-2"></div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            let dialogbox = document.createElement('script');
            dialogbox.setAttribute('src',"/js/dialog-box.js");
            document.head.appendChild(dialogbox);
        },
    }
</script>
