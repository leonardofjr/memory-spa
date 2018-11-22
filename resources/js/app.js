
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Bootstrap from './bootstrap.js';

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'
import Portfolio from './views/Portfolio'
import Skills from './views/Skills'
import Contact from './views/Contact'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/portfolio',
            name: 'portfolio',
            component: Portfolio
        },
        {
            path: '/skills',
            name: 'skills',
            component: Skills
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
