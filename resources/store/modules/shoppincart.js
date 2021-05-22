import CartService from '../../services/cart';
import cart from "../../services/cart";

const state = {
    counter: localStorage.getItem('cart_count') || 0,
    cartId: localStorage.getItem('cart_id') || null,
    userId:localStorage.getItem('user_assigment') || null
};

// getters
const getters = {

    haveShoppingCart (state) {
        return  state.cartId !== null;
    },

    haveUserAssigment(state) {
        return state.userId !== null;
    },

    getItemsCount(state) {
        return state.counter;
    },

    getCartId(state) {
        return state.cartId;
    }

};

//mutations
const  mutations = {

    setCartId(state,cartId) {
        state.cartId = cartId;
    },

    removeCart(state) {
        state.cartId = null;
        state.count = 0;
    },

    incrementsCounter(state,numItems) {
        state.counter = state.counter + numItems;
    },

    decrementCart(state, numItems) {
        state.counter = state.counter - numItems;
    }

};

const actions = {

    saveCartId(context , cartId) {
        context.commit('setCartId',cartId);
    },
    createCart(context) {
        return new Promise((resolve , reject)=>{
            CartService.storeCart()
                .then((response)=>{
                    const cartId = response.id;
                    localStorage.setItem('cart_id',cartId);
                    context.commit('setCartId',cartId);
                    resolve(response);
                })
                .catch((error)=>{
                    reject(error);
                })
        });
    },
    removeCart (context) {
        context.commit('removeCart');
    },
    incrementsCart(context,numItems) {
        context.commit('incrementsCounter',numItems);
    },
    decrementCart(context , numItems) {
        context.commit('decrementCart',numItems);
    }

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

