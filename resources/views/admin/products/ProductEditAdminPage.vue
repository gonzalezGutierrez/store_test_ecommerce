<template>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Update {{ product.name }}</h4>
                            <img :src="product.image_url" class="w-25 mb-3" alt=""> <br>
                            <router-link class="button button-account" :to="{name:'adminproducts'}">Products List</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Create a product</h3>
                        <form  class="row login_form"  id="register_form" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Product name" v-model="product.name">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email" name="price" placeholder="Product price" v-model="product.price">
                            </div>

                            <div class="col-md-12 form-group">
                                <textarea  class="form-control textarea-line" rows="4" placeholder="Product description" v-model="product.description"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="button button-register w-100"> <i class="fas fa-plus-circle"></i> Add product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>

import ProductService from '../../../services/product';

export default {
    name: "ProductEditAdminPage",
    data(){
        return {
           errors:null,
            product:{
                slug:'',
                id:'',
                name:'',
                price:'',
                description:'',
                image_url:''
            }
        }
    },
    mounted() {
        this.getProduct();
    },

    methods:{

        async  getProduct() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });

            let id   = this.$route.params.product_id;
            let slug = this.$route.params.slug;

            let response = await  ProductService.getProduct(id,slug);

            this.product = response.data;

            console.log(this.product);

            loader.hide();


        },

        async updateProduct() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });

            ProductService.updateProduct(this.product,this.product.id).then((response)=>{
                loader.hide();
                this.$swal('Great','Product updated successfully!', 'success').then(() => {
                    this.$router.push({ name: 'adminproducts'})
                });

            }).catch((error)=>{
                this.errors = error.response.data.errors;
                loader.hide();
            });

        }
    }
}
</script>

<style scoped>

</style>
