<template>
    <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <router-link to="/" class="nav-item nav-link" exact>HOME</router-link>
                            <router-link to="/portfolio" class="nav-item nav-link" exact>PORTFOLIO</router-link>
                            <router-link to="/skills" class="nav-item nav-link">SKILLS</router-link>
                            <router-link to="/contact" class="nav-item nav-link">CONTACT</router-link>
                        </div>
                    </div>
                </nav>
                <main class="container">
                    <router-view></router-view>
                </main>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
      
        }
    }
</script>

