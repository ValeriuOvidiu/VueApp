import {createRouter, createWebHistory } from "vue-router";
import login from './components/login.vue'
import authenticate from './components/authenticate.vue'
import home from './components/home.vue'
import profile from './components/Profile.vue'

const routes =[{path: "/", component: home},
    {path: "/login", component: login},  
{path: "/authenticate", component: authenticate} ,
{path: "/profile/:email",   name: 'Profile', component: profile}            
]
const router = createRouter({
    history:createWebHistory(),
    routes

})
export default router;