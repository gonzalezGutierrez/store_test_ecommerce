<template>
    <header class="l-header">
        <nav class="nav bd-grid">
            <div>
                <router-link to="/" class="nav__logo">BACKPACK SHOP</router-link>
            </div>
            <div class="nav__menu" :class="[showMenu ? 'show' : '']" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><router-link to="/" @click="toggleMenu" class="nav__link">Home</router-link></li>
                    <li class="nav__item"><a href="#feature" @click="toggleMenu" class="nav__link">Feature</a></li>
                    <li class="nav__item"><a href="#new" @click="toggleMenu" class="nav__link">New</a></li>
                    <li class="nav__item"><a href="#suscribed" @click="toggleMenu" class="nav__link">Suscribed</a></li>
                </ul>
            </div>

            <div>
                <i class="bx bx-cart nav__cart"></i>
                <i class="bx bx-menu nav__toggle" @click="toggleMenu" id="nav-toggle"></i>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",
    data() {
        return {
            showMenu:false
        }
    },
    methods:{
        toggleMenu(){
            this.showMenu = !this.showMenu;
        }
    }
}
</script>

<style scoped>

</style>
