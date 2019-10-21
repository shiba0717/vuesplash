<template>
    <footer class="footer">
        <button class="button button--link" @click="logout" v-if="isLogin">Logout</button>
        <RouterLink class="button button--link" to="/login" v-else>
            Login / Register
        </RouterLink>
    </footer>
</template>

<script>
    import { mapState, mapGetters } from 'vuex'
    export default {
        name: "Footer",
        methods:{
            async logout () {
                await this.$store.dispatch('auth/logout')

                if (this.apiStatus) {
                    this.$router.push('/login')
                }
            }
        },
        computed:{
            // isLogin(){
            //     return this.$store.getters['auth/check']
            // }
            ...mapState({
                apiStatus: state => state.auth.apiStatus
            }),
            ...mapGetters({
                isLogin: 'auth/check'
            })
        }
    }
</script>

<style scoped>

</style>