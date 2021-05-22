import ApiConnection from "./api";

export default {

    login(userCredentials) {
        return new Promise((resolve , reject)=> {
            ApiConnection().post('/api/v1/auth/login',{
                email:userCredentials.email,
                password:userCredentials.password
            }).then((response)=>{
                const dataToken = response.data.data_token;
                localStorage.setItem('access_token',dataToken.token);
                resolve(dataToken);
            }).catch((error)=>{
                reject(error);
            });
        });
    },

    register (data) {
        return new Promise((resolve , reject)=> {
            ApiConnection().post( '/api/v1/auth/register',data).then((response)=>{
                const token = response.data.data.token;
                localStorage.setItem('access_token',token);
                resolve(response);
            }).catch((error)=>{
                reject(error.response.errors);
            });
        });
    },

    profile() {
        return new Promise((resolve , reject)=>{
           ApiConnection().get('/api/v1/users/profile')
               .then((response)=>{
                   resolve(response);
               }).catch((error)=>{
                   localStorage.removeItem('access_token');
                   reject(error);
               });
        });
    },

    logout() {
        return new Promise((resolve, reject) => {
            ApiConnection().post('/api/v1/auth/logout')
                .then(response => {
                    localStorage.removeItem('access_token')
                    resolve(response)
                })
                .catch(error => {
                    localStorage.removeItem('access_token')
                    reject(error)
                })
        })
    }

}
