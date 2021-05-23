import ApiConnection from './api';

export default  {
    storeCart() {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/v1/carts',{})
                .then((response)=>{
                    resolve(response.data);
                })
                .catch((error)=>{
                    reject(error);
                });
        })
    },

    addItem(cartId,item) {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/v1/carts/'+cartId+'/items',item)
                .then( (response) => {
                    resolve(response.data);
                })
                .catch((error)=>{
                    reject(error);
                });
        });
    },

    getCart(cartId) {
        return new Promise((resolve , reject) => {
            ApiConnection().get('/api/v1/carts/'+cartId)
                .then((response)=>{
                    resolve(response.data);
                })
                .catch((error)=> {
                    reject(error.response);
                });
        });
    },

    checkout(cartId,payload) {

        console.log(payload.payment.token);

        return new Promise((resolve,reject)=>{
            ApiConnection().post('/api/v1/carts/'+cartId+'/checkout',payload)
                .then(response=>{
                    resolve(response.data);
                })
                .catch(error =>{
                    reject(error.response);
                });
        });
    }
}
