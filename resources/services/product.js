import ApiConnection from "./api";

export default  {

    getProducts(currentPage) {
        return ApiConnection().get('/api/v1/products?page='+currentPage);
    },

    getProductsLink(link) {
        return ApiConnection().get(link);
    },

    searchProducts(filter,value) {
        return ApiConnection().get('/api/v1/products/search?filter['+filter+']='+value);
    },

    getProduct(id,slug) {
        return ApiConnection().get('/api/v1/products/'+id+'/'+slug);
    },

    storeProduct(product) {
        return ApiConnection().post('/api/v1/products',product);
    },

    updateProduct(product,id) {
        return ApiConnection().put('/api/v1/products/'+id,product);
    },

    deleteProduct(id) {
        return ApiConnection().delete('/api/v1/products/'+id);
    }

}
