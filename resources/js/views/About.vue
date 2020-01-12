<template>
        <div id="about">
            <div class="page-title">
                <h2>About Me</h2>
            </div>
            <div>
                <div v-html="this.$parent.data.bio"></div>
                <!--<button class="btn btn-primary">VIEW RESUME</button>-->
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
