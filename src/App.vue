<script>
import navigationBar from "./components/navigationBar.vue"  

export default {
    name: 'App',
    components: {
        navigationBar,
        

    }

}

</script>

<template>
    <div>
        <navigationBar />  
    </div>
       
        <div class="container">
            <div class="raw">
                <div class="col-md-12">
                    <div>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    
</template>

<style scoped></style>
