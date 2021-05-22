import ApiConnection from  './api';
export  default  {

    getUsers(currentPage) {
        return ApiConnection().get('/api/v1/users?page='+currentPage);
    },

    getUser(id) {
        return ApiConnection().get('/api/v1/users/'+id);
    },

    storeUser(data) {
        return ApiConnection().post('/api/v1/users',data);
    },

    updateUser(data,id) {
        return ApiConnection().put('/api/v1/users/'+id,data);
    },
    deleteUser(id) {
        return ApiConnection().delete('/api/v1/users/'+id);
    }

}
