<template>
    <section class="cart_area">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center" >
                <h4>Users Management</h4>
            </div>
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Fullname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody v-for="user in users">
                        <tr>
                            <td>
                                {{ user.fullname }}
                            </td>
                            <td>
                                <h5> {{ user.email }} </h5>
                            </td>
                            <td class="text-uppercase">
                                <span  :class="[user.role == 'admin' ? 'bg-primary' : 'bg-info', 'badge','text-white']">{{ user.role }}</span>
                            </td>
                            <td>
                                <router-link :to="{name:'adminusersedit', params:{id:user.id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></router-link>
                                <a href="#" class="btn btn-sm btn-danger" @click.prevent="userDelete(user.id)"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</template>

<script>

import UserService from '../../../services/user';
import ProductService from "../../../services/product";

export default {
    name: "UserListAdminPage",
    data() {
        return {
            users:{},
            currentPage:1
        }
    },
    mounted() {
        this.getUsers();
    },

    methods:{
        getUsers() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });

            UserService.getUsers(this.currentPage).then((response)=>{
                this.users = response.data.data;
                loader.hide();
            }).catch((error)=>{
                loader.hide();
            });

        },

        async userDelete(userId) {

            this.$swal({
                title: 'Remove User',
                text: "Are you sure you want to remove this user?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((desicion) => {

                if (desicion.value) {

                    this.$swal('Great', 'User deleted!', 'success')
                        .then(() => {

                            let loader = this.$loading.show({
                                container: this.fullPage ? null : this.$refs.formContainer
                            });

                            UserService.deleteUser(userId)
                                .then((response) => {
                                   this.getUsers();
                                    loader.hide();
                                }).catch((error => {
                                    console.log(error);
                                    loader.hide();
                                })
                            );
                        });
                }

            });
        }
    }
}
</script>

<style scoped>

</style>
