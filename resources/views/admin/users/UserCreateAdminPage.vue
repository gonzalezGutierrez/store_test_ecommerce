<template>
    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Create an account</h4>
                            <router-link :to="{name:'adminusers'}" class="button button-account">Users List</router-link>
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
                                <button type="button" @click="createAccount" value="submit" class="button button-register w-100">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import UserService from '../../../services/user';
export default {
    name: "UserCreateAdminPage",

    data() {
        return {
            email:'',
            password:'',
            password_confirmation:'',
            name:'',
        }
    },

    methods:{
        async createAccount() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            try {

                let response = UserService.storeUser({
                    email:this.email,
                    password:this.password,
                    password_confirmation:this.password_confirmation,
                    name:this.name
                });

                /*this.$swal('Great','User Created successfully!', 'success').then(() => {
                    this.$router.push({ name: 'adminusers'})
                });*/

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
