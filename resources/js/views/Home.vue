<template>
        <div id="home" class=" row">
            <div class="home-background">

            </div>
            <div class="col-12">
                <h2><b>Hi!</b> I'm <span class="developer-name">{{this.$parent.data['fname']}}</span>,</h2>
  
                <h2 class="pb-5">a freelance web developer specialized<br><strong>in front-end and back-end web development</strong></h2>
                <div class="home-buttons">
                <router-link to="/portfolio"><button class="btn btn-secondary">PORTFOLIO</button></router-link><br>
                <router-link to="/skills-and-offer"><button class="btn btn-secondary">SKILLS & OFFER</button></router-link><br>
                </div>
                <!--
                <div class="form-inline">
                    <button class="create-dialog-box-btn btn btn-primary mb-2 col-12 col-lg-5" >Change Name</button>
                    <div class="col-lg-5 input-dialog-box form-group mb-2"></div>
                </div>
                -->
            </div>
        </div>
</template>

<script>
    export default {
        data() {
            return {
               
            };
        },
        mounted() {

        },
        
    }
</script>
