
import AuthService from '../../services/auth';

const state = {
    token:localStorage.getItem('access_token') || null,
    user:{}
}

//getters
const getters = {

    isAuth() {
        return state.token !== null;
    },

    isGuest() {
        return state.token === null;
    },

    getUser() {
        return state.user;
    },

    isUserAdmin(state) {
        if (state.user) {
            if (state.user.role === 'admin') {
                return true;
            }
        }
        return false;
    }

};

//changes
const  mutations  = {

    setToken(state,token) {
        state.token = token;
    },

    setUser(state,user) {
        state.user = user;
    },

    logout(state){
        state.token = null;
        state.user = {};
    }

};

//actions
const actions = {
    saveToken (context , token) {
        context.commit('setToken',token);
    },

    deleteToken(context,token) {
        context.commit('logout');
    },

    freshProfile(context) {
        return new Promise((resolve , reject) => {
            AuthService.profile().
                then((response)=>{
                    const user = response.data;
                    context.commit('setUser',user);
                    resolve(response);
                }).catch((error)=>{
                    context.commit('logout')
                    reject(error)
                })
        });
    }
};

export default {
    namespace:true,
    state,
    getters,
    actions,
    mutations
}


