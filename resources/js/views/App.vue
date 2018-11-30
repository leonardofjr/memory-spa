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
                <main id="frontend" class="container">
                         <transition
                          name="fade"
                           :name="transitionName"
                            mode="out-in"
                            @beforeLeave="beforeLeave"
                            @enter="enter">
                        <router-view>
                        
                        </router-view>
                        
                    </transition>

                </main>
    </div>

</template>

<script>
const DEFAULT_TRANSITION = 'fade';

 export default {
   name: 'App',
   data() {
     return {
       prevHeight: 0,
      transitionName: DEFAULT_TRANSITION,
     };
   },
  created() {
    this.$router.beforeEach((to, from, next) => {
      let transitionName = to.meta.transitionName || from.meta.transitionName;

      if (transitionName === 'slide') {
        const toDepth = to.path.split('/').length;
        const fromDepth = from.path.split('/').length;
        transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left';
      }

      this.transitionName = transitionName || DEFAULT_TRANSITION;

      next();
    });
  },
 methods: {
    beforeLeave(element) {
      this.prevHeight = getComputedStyle(element).height;
    },
    enter(element) {
      const { height } = getComputedStyle(element);

      element.style.height = this.prevHeight;

      setTimeout(() => {
        element.style.height = height;
      });
    },
    afterEnter(element) {
      element.style.height = 'auto';
    },
 }
}
</script>

