<template>
    <div>
        <header>
            <Navbar/>
        </header>
        <main>
            <div class="container">
                <Message/>
                <RouterView/>
            </div>
        </main>
        <Footer/>
    </div>
</template>

<script>
    import Navbar from "./components/Navbar";
    import Footer from "./components/Footer";
    import Message from './components/Message.vue'
    import { NOT_FOUND, UNAUTHORIZED, INTERNAL_SERVER_ERROR } from './utils'

    export default {
        name: "App",
        components: {
            Navbar,
            Footer,
            Message
        },
        computed:{
            errorCode(){
                return this.$store.state.error.code
            }
        },
        watch:{
            errorCode:{
                handler(val){
                    if (val === INTERNAL_SERVER_ERROR){
                        this.$router.push('/500')
                    }else if (val === UNAUTHORIZED) {
                        // トークンをリフレッシュ
                        axios.get('/api/refresh-token')
                        // ストアのuserをクリア
                        this.$store.commit('auth/setUser', null)
                        // ログイン画面へ
                        this.$router.push('/login')
                    }else if (val === NOT_FOUND) {
                        this.$router.push('/not-found')
                    }
                }
            },
            immediate:true
        },
        $route(){
            this.$store.commit('error/setCode', null)
        }

    }
</script>

<style scoped>

</style>