import ApiConnection from './api';

export  default  {

    getOrders() {
        return new Promise((resolve , reject) => {
            ApiConnection().get('/api/v1/orders/')
                .then(response =>{
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response);
                });
        });
    },

    getOrder(orderKey) {
        return new Promise((resolve , reject) => {
            ApiConnection().get('/api/v1/orders/'+orderKey)
                .then(response =>{
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response);
                });
        });
    }

}
