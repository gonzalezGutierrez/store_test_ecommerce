<template>
    <section class="checkout_area section-margin--small">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row">
                            <div class="col-md-6 form-group p_star">
                                <label for="">Name</label>
                                <input type="text" class="form-control" v-model="name" name="name">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" v-model="last_name" name="holder_name">
                                <span class="placeholder" data-placeholder="First name"></span>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="last" v-model="email" name="phone">
                                <span class="placeholder" data-placeholder="Last name"></span>
                            </div>


                            <div class="col-md-12 form-group p_star">
                                <label for="">Card Number</label>
                                <input type="text" class="form-control" v-model="card_number" name="card_number">
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="">Expiration Year</label>
                                <select name="expiration_year" v-model="expiration_year" id="" class="form-control">
                                    <option :value="year.value" v-for="year in items_year"> {{ year.text }} </option>
                                </select>
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="">Expiration Month</label>
                                <select name="expiration_year" v-model="expiration_month" class="form-control" >
                                    <option value="" selected>Expiration Month</option>
                                    <option :value="month.value" v-for="month in items_months"> {{ month.text }} </option>
                                </select>
                                <span class="placeholder" data-placeholder="Address line 01"></span>
                            </div>
                            <div class="col-md-4 form-group p_star">
                                <label for="">CVV</label>
                                <input type="text" class="form-control" v-model="cvv2" name="cvv">
                                <span class="placeholder" data-placeholder="Address line 02"></span>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control" v-model="address.address" cols="30" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="">Country</label>
                                <input type="text" class="form-control" v-model="address.country" name="country">
                                <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <label for="">State</label>
                                <input type="text" class="form-control" v-model="address.state" name="state">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <CartListCardComponent :cart="cart"></CartListCardComponent>
                            <div class="text-center">
                                <a class="button button-paypal" @click="createToken" href="#"> {{ buttonPaymentMessage }} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import CartService from "../../services/cart";
import CartListCardComponent from "../../components/carts/CartListCardComponent";

export default {
    name: "CheckoutPage",
    components:{
        CartListCardComponent
    },

    data() {
        return {
            // open pay keys
            openPayId:'m9zdcsf5bpnd6azrybqq',
            openPayKey:'pk_6d1666bfc2524ad0b5a0a0114115469b',
            openPaySanboxMode:true,
            deviceSessionId:'',

            //current cardId
            cartId:this.$store.getters['cart/getCartId'],

            // items carts
            cart : {},

            //customer data
            name:'',
            last_name:'',
            email:"",

            address:{
                address:'',
                state:'',
                country:''
            },

            //card information
            card_number:"4111111111111111",
            expiration_year:"21",
            expiration_month:"12",
            cvv2:"110",

            // payload payment
            payment:{
                deviceSessionId:this.deviceSessionId,
                token:''
            },

            payload:{
                customer:{},
                payment:{},
                address:{}
            },

            // expiration month and year
            items_months: [
                { text: "01 - Enero", value: "01" },
                { text: "02 - Febrero", value: "02" },
                { text: "03 - Marzo", value: "03" },
                { text: "04 - Abril", value: "04" },
                { text: "05 - Mayo", value: "05" },
                { text: "06 - Junio", value: "06" },
                { text: "07 - Julio", value: "07" },
                { text: "08 - Agosto", value: "08" },
                { text: "09 - Septiembre", value: "09" },
                { text: "10 - Octubre", value: "10" },
                { text: "11 - Noviembre", value: "11" },
                { text: "12 - Diciembre", value: "12" },
            ],
            items_year: [
                { text: "2021", value: "21" },
                { text: "2022", value: "22" },
                { text: "2023", value: "23" },
                { text: "2024", value: "24" },
                { text: "2025 ", value: "25" },
                { text: "2026", value: "26" },
                { text: "2027", value: "27" },
                { text: "2028", value: "28" },
                { text: "2029", value: "29" },
                { text: "2030", value: "30" },
            ],

            buttonPaymentMessage:'Proceed to pay',

            loading:null

        }
    },

    mounted() {

        this.getCart();

        this.initOpenPay();


    },
    methods:{

        // convert in a component cartCardCheckout
        getCart() {

            let loader = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            CartService.getCart(this.cartId)
                .then((response)=>{
                    this.cart = response;
                    loader.hide();
                }).
            catch((error)=>{
                console.log(error);
                loader.hide();
            });
        },

        initOpenPay() {
            OpenPay.setId(this.openPayId);
            OpenPay.setApiKey(this.openPayKey);
            OpenPay.setSandboxMode(this.openPaySanboxMode);
            this.payment.deviceSessionId = OpenPay.deviceData.setup();
        },

        async createToken() {

            this.buttonPaymentMessage = 'Processing payment...';

            this.loading = this.$loading.show({
                container: this.fullPage ? null : this.$refs.formContainer
            });

            OpenPay.token.create({
                "holder_name": this.name + ' ' + this.last_name,
                "card_number": this.card_number,
                "cvv2": this.cvv2,
                "expiration_month": this.expiration_month,
                "expiration_year": this.expiration_year
            },this.checkout);


        },

        checkout(response) {

            //build payment

            this.payload.customer = {
                name:this.name,
                last_name:this.last_name,
                email:this.email
            };

            this.payment.token    = response.data.id;

            this.payload.address  = this.address;
            this.payload.payment  = this.payment;

            CartService.checkout(this.cartId,this.payload)
                .then(response=>{

                    this.loading.hide();

                    this.$toast.open({
                        message:'Order successfully created',
                        position:'top-right',
                        type: 'success',
                        // all of other options may go here
                    });

                    this.$store.dispatch('cart/clearCart');

                    this.$router.push({name:'order',params:{order_key:response.order_key}});

                })
                .catch(error =>{

                    console.log(error);
                    this.$toast.open({
                        message:error.description,
                        position:'top-right',
                        type: 'warning',
                        // all of other options may go here
                    });
                    this.loading.hide();

                });
        },
    }
}
</script>

<style scoped>

</style>
