<template>

    <section class="login_box_area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <div class="hover">
                            <h4>Create product</h4>
                            <p>Add one new product in the website</p>
                            <router-link class="button button-account" :to="{name:'adminproducts'}">Products List</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Create a product</h3>
                        <form @submit="productStore" enctype="multipart/form-data" class="row login_form"  id="register_form" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Product name" v-model="product.name">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email" name="price" placeholder="Product price" v-model="product.price">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="file" v-on:change="onImageChange" class="form-control" placeholder="Product image">
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="form-control textarea-line" rows="4" placeholder="Product description" v-model="product.description"></textarea>
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

    <!--<div class="small-container space-bottom">

        <h1 class="title">Product Create</h1>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h5>Create Form</h5>
                </div>
                <div class="card-body">
                    <form @submit="createProduct" enctype="multipart/form-data">

                        <div class="group" v-if="errors">
                            <div  class="alert alert-danger">
                                <div v-for="(v, k) in errors" :key="k">
                                    <p v-for="error in v" :key="error" class="text-sm">
                                        {{ error }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label for="">Product Name: </label>
                            <input type="text" v-model="product.name" placeholder="Product Name">
                        </div>

                        <div class="group">
                            <label for="">Product Image: </label>
                            <input v-on:change="onImageChange" type="file">
                        </div>

                        <div class="group">
                            <label for="">Product Price</label>
                            <input type="text" v-model="product.price" placeholder="Product Price">
                        </div>

                        <div class="group">
                            <label for="">Product Description</label>
                            <textarea name="" id="" cols="30" v-model="product.description" rows="10" placeholder="Product Description"></textarea>
                        </div>


                        <button type="submit" class="btn">
                            <i class="fas fa-edit"></i>
                            Update Product
                        </button>

                    </form>
                </div>
            </div>
        </div>


    </div>-->
</template>

<script>
import ProductService from "../../../services/product";

export default {
    name: "ProductCreateAdminPage",
    data(){
        return {
            errors:null,
            product:{
                name:'',
                price:'',
                description:'',
                image:''
            }
        }
    },

    methods: {

        onImageChange (e) {
            this.product.image = e.target.files[0];
        },

        async  productStore(e) {

            e.preventDefault();

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer,
                canCancel: false,
            });


            let formData = new FormData();

            formData.append('image', this.product.image);
            formData.append('name',this.product.name);
            formData.append('price',this.product.price);
            formData.append('description',this.product.description);

            try{

                await ProductService.storeProduct(formData);

                loader.hide();

                this.$swal('Great','Product crated successfully!', 'success').then(() => {
                    this.$router.push({ name: 'adminproducts'})
                });

            }catch(error){
                this.errors = error.response.data.errors;
                loader.hide();
            }


        }

    }
}
</script>

<style scoped>

</style>
