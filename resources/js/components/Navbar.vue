<template>
    <nav class="navbar">
        <RouterLink class="navbar__brand" to="/">
            VueSplash
        </RouterLink>
        <div class="navbar__menu">
            <div class="navbar__item" v-if="isLogin">
                <button class="button" @click="showForm =! showForm">
                    <i class="icon ion-md-add"></i>
                    Submit a photo
                </button>
            </div>
            <span class="navbar__item" v-if="isLogin">
                {{ username }}
            </span>
            <div class="navbar__item" v-else>
                <RouterLink class="button button--like" to="/login">
                    Login / Register
                </RouterLink>
            </div>
        </div>
        <PhotoForm v-model="showForm" />
    </nav>
</template>

<script>
    import PhotoForm from './PhotoForm.vue'
    export default {
        computed:{
            isLogin(){
              return this.$store.getters['auth/check']
          },
            username(){
              return this.$store.getters['auth/username']
            }
        },
        name: "Navbar",
        components:{
            PhotoForm
        },
        data(){
            return{
                showForm:false
            }
        }
    }
</script>

<style scoped>

</style>