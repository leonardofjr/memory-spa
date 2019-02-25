<template>     
      <div class="row">
        <aside class="col-lg-3 nav-bg">
          <!-- If user is null -->  
          <div  v-if="!user" class="mr-3 my-3 text-right">
            <a  class="ml-2" href="/login">Login</a> 
            <a  class="ml-2" href="/register">Register</a>
          </div>
            <!-- else if user data is returned -->
            <ul v-else  class="navbar-nav ml-4">
                <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                          {{data['fname']}}<span class="caret"></span>
                      </a>

                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/admin/settings">
                              Settings
                          </a>
                          <a class="dropdown-item" href="/logout"
                          onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                          <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            <!-- the value for the csrf value will be set to the hidden csrf value that is placed on the head -->
                            <input type="hidden" name="_token" :value="csrf">
                          </form>
                      </div>
                  </li>
            </ul>

              <!-- User -->
              <div class="user">
                <!-- User Avatar -->
                <div class="user-avatar d-flex justify-content-center">
                    <router-link to="/"  class="navbar-brand"  exact>
                      <img v-if="this.data.profile_image" :src='"/storage/" + this.data.profile_image' alt="" class="avatar img-fluid rounded-circle mt-4">
                      <img v-else src="/storage/logo.png" alt="" class="avatar img-fluid rounded-circle mt-4">
                    </router-link>
                </div>
                
                <!-- User Name -->
                <div  class="user-name d-flex justify-content-center">
                  <router-link to="/"  class="navbar-brand text-uppercase"  exact style="color: #fff; font-weight: 600;">{{data['fname']}} {{data['lname']}}</router-link>
                </div>
                
                <!-- User Job Title -->
                <div class="user-title">
                <router-link to="/">
                  <h2 class="user-title-style text-center h5 ">Web Developer</h2>
                  </router-link>
                </div>
              </div>
              <!-- Navigation Links -->
              <nav class="navbar navbar-expand-lg my-3 " style="z-index: 1000">            
                
                <div class="py-1 pl-3 social-icons d-block d-lg-none">
                  <!-- If email is not null -->
                  <span v-if="data.email" class="px-1">
                        <a :href="'mailto:' + data.email">
                          <i class="fas fa-2x fa-envelope"></i>
                        </a>
                    </span>
                    <!-- If twitter_url is not null -->
                    <span v-if="data.twitter_url" class="px-1">
                        <a :href="data.twitter_url">
                          <i class="fab fa-2x fa-twitter"></i>
                          </a>
                    </span>
                    <!-- If linkedin_url is not null -->
                    <span v-if="data.linkedin_url" class="px-1">
                        <a :href="data.linkedin_url" class="px-1">
                          <i class="fab fa-2x fa-linkedin-in"></i> 
                        </a>
                    </span>
                    <!-- If facebook_url is not null -->
                    <span v-if="data.facebook_url" class="px-1">
                      <a :href="data.facebook_url">
                        <i class="fab fa-2x fa-facebook"></i>
                      </a>
                    </span>
                    <!-- If github_url is not null -->
                    <span v-if="data.github_url" class="px-1">
                        <a :href="data.github_url">
                          <i class="fab fa-2x fa-github"></i>
                        </a>
                    </span>
                </div>            
                  <button class="navbar-toggler navbar-light ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                      <div class="primary-menu nav flex-column">
                          <router-link to="/about" class="nav-item nav-link" exact>ABOUT</router-link>
                          <router-link to="/portfolio" class="nav-item nav-link" exact>PORTFOLIO</router-link>
                          <router-link to="/skills-and-offer" class="nav-item nav-link">SKILLS AND OFFER</router-link>
                          <router-link to="/contact" class="nav-item nav-link">CONTACT ME</router-link>
                      </div>
                  </div>
              </nav>
              <div class="py-1 pl-3 social-icons d-none d-lg-block">
                  <!-- Contact link icons -->
                  <p class="pb-1 pl-0">Get In touch</p>
                  <!-- If email is not null -->
                  <span v-if="data.email" class="px-1">
                        <a :href="'mailto:' + data.email">
                          <i class="fas fa-2x fa-envelope"></i>
                        </a>
                    </span>
                    <!-- If twitter_url is not null -->
                    <span v-if="data.twitter_url" class="px-1">
                        <a :href="data.twitter_url">
                          <i class="fab fa-2x fa-twitter"></i>
                          </a>
                    </span>
                    <!-- If linkedin_url is not null -->
                    <span v-if="data.linkedin_url" class="px-1">
                        <a :href="data.linkedin_url" class="px-1">
                          <i class="fab fa-2x fa-linkedin-in"></i> 
                        </a>
                    </span>
                    <!-- If facebook_url is not null -->
                    <span v-if="data.facebook_url" class="px-1">
                      <a :href="data.facebook_url">
                        <i class="fab fa-2x fa-facebook"></i>
                      </a>
                    </span>
                    <!-- If github_url is not null -->
                    <span v-if="data.github_url" class="px-1">
                        <a :href="data.github_url">
                          <i class="fab fa-2x fa-github"></i>
                        </a>
                    </span>
                </div>        
          </aside>

          <main id="frontend" class="col-lg-9">
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

