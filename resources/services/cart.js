import ApiConnection from './api';

export default  {
    storeCart() {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/v1/cart',{})
                .then((response)=>{
                    resolve(response.data);
                })
                .catch((error)=>{
                    reject(error);
                });
        })
    },

    addItem(productId) {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/v1/carts/additem')
                .then( (response) => {
                    resolve(response.data);
                })
                .catch((error)=>{
                    reject(error);
                });
        });
    }
}
