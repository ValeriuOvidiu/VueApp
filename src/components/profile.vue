<script>
import { onMounted } from 'vue';
import { watch, ref} from 'vue'
import axios from 'axios';
import {useRoute} from "vue-router";

export default {
    name: "profile",
   setup() {
        const infor = ref("")
        const firstName=ref("")
        const lastName=ref("")
        const route = useRoute();
   const email = route.params.email;
      

   
    const getUser = () => {
        axios.post("http://localhost:8000/profile.php",{email:  email })
          .then(response => {
            console.log('Response from server:', response.data);
            if (response.data[1]) {
               firstName.value=response.data[0]
               lastName.value=response.data[1];
              
            } else {
              infor.value = "o eroare"
            }

          })
          .catch(error => {
            console.error('Error from server:', error.message);

          });
      
    
    };
    onMounted(() => getUser());

    return {
     
      getUser,
      infor,
      lastName,
      firstName,email
      
      
    };
  }
}
</script>

<template>
    <div>{{firstName}} {{lastName}}</div>
</template>
