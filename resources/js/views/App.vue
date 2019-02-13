<template>     
      <div class="row">
        <div class="col-sm-3 nav-bg">
          <ul v-if="!user" class="navbar-nav ml-4">
                  <!-- Authentication Links -->
                <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                    </li>
            </ul>
            <ul v-else  class="navbar-nav ml-4">
                <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                          {{data['name']}}<span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-bg" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/admin/settings">
                              Settings
                          </a>
                          <a class="dropdown-item" href="/logout"
                          onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                          <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" :value="csrf">
                          </form>
                      </div>
                  </li>
            </ul>
              <div class="d-flex justify-content-center">
                  <router-link to="/"  class="navbar-brand"  exact><img :src='"/storage/" + this.data.profile_image' alt="" class="img-fluid rounded-circle py-4"></router-link>
              </div>
              <div  class="d-flex justify-content-center">
                <router-link to="/"  class="navbar-brand"  exact>LEO FELIPA JR.</router-link>
              </div>
              <router-link to="/">
              <h2 class="text-center h5">Full Stack Web Developer</h2></router-link>
              <nav class="navbar navbar-expand-lg " style="z-index: 1000">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                      <div class="nav flex-column">
                          <router-link to="/about" class="nav-item nav-link" exact>ABOUT</router-link>
                          <router-link to="/portfolio" class="nav-item nav-link" exact>PORTFOLIO</router-link>
                          <router-link to="/skills-and-offer" class="nav-item nav-link">SKILLS AND OFFER</router-link>
                          <router-link to="/contact" class="nav-item nav-link">CONTACT ME</router-link>
                      </div>
                  </div>
              </nav>
            <p>Get In touch</p>
            <p>
              <!-- If email is not null -->
            <span v-if="data.email">
                  <a :href="'mailto:' + data.email">
                    <i class="fas fa-2x fa-envelope"></i>
                  </a>
              </span>
              <!-- If twitter_url is not null -->
              <span v-if="data.twitter_url">
                  <a :href="data.twitter_url">
                    <i class="fab fa-2x fa-twitter"></i>
                    </a>
              </span>
              <!-- If linkedin_url is not null -->
              <span v-if="data.linkedin_url">
                  <a :href="data.linkedin_url">
                    <i class="fab fa-2x fa-linkedin-in"></i> 
                  </a>
              </span>
              <!-- If facebook_url is not null -->
              <span v-if="data.facebook_url">
                <a :href="data.facebook_url">
                  <i class="fab fa-2x fa-facebook"></i>
                </a>
              </span>
              <!-- If github_url is not null -->
              <span v-if="data.github_url">
                  <a :href="data.github_url">
                    <i class="fab fa-2x fa-github"></i>
                  </a>
              </span>
            </p>            
          </div>

          <main id="frontend" class="col-sm-9">
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
        data: [],
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        user: false,
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




    axios.get(this.web_url + '/home')
        .then(response => {
          if (!response.data['user']) {
            this.data = response.data['guest'];
            this.user = false;
          } else {
            this.data = response.data['user'];
            this.user = true;

          }
            return this.data;
        // JSON responses are automatically parsed.
        })
        .catch(e => {
              this.errors.push(e)
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

