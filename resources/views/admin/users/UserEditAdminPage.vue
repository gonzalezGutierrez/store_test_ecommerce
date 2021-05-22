<template>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Update Account</h4>
                            <p>{{ user.fullname }} | {{ user.role }}</p>
                            <router-link :to="{name:'adminusers'}" class="button button-account">Users List</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Update an account</h3>
                        <form class="row login_form" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name"  name="name" placeholder="Fullname" v-model="user.fullname">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" v-model="user.email" >
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" @click="updateAccount" value="submit" class="button button-register w-100"> <i class="fas fa-edit"></i> Update</button>
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
    name: "UserEditAdminPage",
    data() {
        return {
            user:{
                id:'',
                email:'',
                fullname:'',
            }

        }
    },

    mounted() {
        this.getUser();
    },

    methods:{

        async getUser() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            let id = this.$route.params.id;
            let response = await UserService.getUser(id);
            this.user = response.data;

            loader.hide();
        },
        async updateAccount() {

            let  loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            try {
                let response = await UserService.updateUser({name:this.user.fullname,email:this.user.email},this.user.id);
                this.$swal('Great','User updated successfully!', 'success').then(() => {
                    this.$router.push({ name: 'adminusers'})
                });
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
