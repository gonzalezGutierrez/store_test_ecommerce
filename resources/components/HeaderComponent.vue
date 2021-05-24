<template>
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <router-link class="navbar-brand logo_h" :to="{name:'index'}">
                        <img src="https://image.flaticon.com/icons/png/512/3209/3209711.png" style="width:45px;" alt="">
                        STORE
                    </router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                            <li class="nav-item active"><router-link :to="{name:'index'}" class="nav-link">Home</router-link></li>
                            <li class="nav-item submenu dropdown">
                                <router-link :to="{name:'products'}" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false">Shop</router-link>
                            </li>

                            <li class="nav-item" v-if="userIsGuest"><router-link  :to="{name:'login'}" class="nav-link">Login</router-link></li>
                            <li class="nav-item" v-if="userIsGuest"><router-link  :to="{name:'register'}" class="nav-link">Register</router-link></li>

                            <li class="nav-item"><router-link  :to="{name:'tracking'}" class="nav-link">Order Tracking</router-link></li>

                            <li class="nav-item submenu dropdown">
                                <a href="#" v-if="userIsAuth" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"  aria-expanded="false">
                                    <i class="ti ti-user"></i> {{ user.fullname }}
                                    <ul class="dropdown-menu">
                                        <li class="nav-item" v-if="userIsAdmin"><router-link :to="{name:'admin'}" class="nav-link" >Admin</router-link></li>
                                        <li class="nav-item">
                                            <router-link to="/orders" class="nav-link">My shopping</router-link>
                                        </li>
                                        <li class="nav-item"><a @click="logout" class="nav-link">Logout</a></li>
                                    </ul>
                                </a>
                            </li>

                        </ul>

                        <ul class="nav-shop">
                            <li class="nav-item"><router-link :to="{name:'cart'}"><button ><i class="ti-shopping-cart"></i><span class="nav-shop__circle"> {{ cartCount }} </span></button></router-link> </li>
                        </ul>


                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>

import { mapState } from 'vuex'
import { mapGetters } from 'vuex'

import AuthService from '../services/auth';

export default {
    name: "HeaderComponent",
    computed: {
        userIsAuth(){
            return this.$store.getters.isAuth;
        },

        userIsGuest() {
            return this.$store.getters.isGuest;
        },

        user(){
            return this.$store.getters.getUser;
        },

        userIsAdmin() {
            return this.$store.getters.isUserAdmin;
        },
        cartCount() {
            return this.$store.getters['cart/getItemsCount'];
        }
    },
    methods:{
        async logout() {


            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            try {

                let response = await AuthService.logout();

                this.$router.push({ name: "login" })
                this.$store.dispatch('deleteToken');

                this.$store.dispatch('cart/clearCart');

                this.$router.push({name:'index'});

                loader.hide();

            }catch (error) {
                console.log(error);
                loader.hide()
            }

        }
    }
}
</script>

<style scoped>

</style>
