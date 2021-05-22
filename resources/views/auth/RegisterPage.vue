<template>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Already have an account?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <router-link :to="{name:'login'}" class="button button-account">Login Now</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Create an account</h3>
                        <form class="row login_form" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name"  name="name" placeholder="Fullname" v-model="name">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" v-model="email" >
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" v-model="password">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" v-model="password_confirmation">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" @click="register" value="submit" class="button button-register w-100">Register</button>
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
    name: "RegisterPage",
    data() {
        return {
            email:'',
            password:'',
            password_confirmation:'',
            name:'',
        }
    },
    methods:{
        async register() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            try {

                let response = await AuthService.register({
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation,
                    name:this.name
                });

                this.$store.dispatch('saveToken',{
                    token:response.token
                });

                loader.hide();

                this.$router.push({name: 'index'});


            }catch (error) {

                loader.hide();

            }





        }
    }
}
</script>

<style scoped>

</style>
