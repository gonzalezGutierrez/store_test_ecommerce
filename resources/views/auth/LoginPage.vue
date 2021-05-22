<template>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="button button-account" href="register.html">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <form class="row login_form"  id="contactForm" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="email" placeholder="Email" v-model="email">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="name" name="password" placeholder="Password" v-model="password">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option2" name="selector">
                                    <label for="f-option2">Keep me logged in</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" @click="login"  class="button button-login w-100">Log In</button>
                                <a href="#">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

import AuthService from '../../services/auth';

export default {
    name: "LoginPage",
    data() {
        return {
            errors:{},
            email:null,
            password:null
        }
    },
    mounted() {

    },
    methods:{
        async login(){

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            try {

                let response = await AuthService.login({
                    email:this.email,
                    password:this.password
                });

                this.$store.dispatch('saveToken',{
                    token:response.token
                });

                this.$router.push({name: 'index'});

                loader.hide();

            }catch (error) {
                console.log(error);
                loader.hide();
            }

        }
    }
}
</script>

<style scoped>

</style>
