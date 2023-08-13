<script>
import { watch, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios';

export default {
  name: "login",
  setup() {
    const router = useRouter()
    const email = ref("")
    const password = ref("");
    const checkPasswordError = ref("");
    const infor = ref("")

    watch([infor,], ([newinfor]) => {
      infor.value = newinfor;
    });
    const submitForm = () => {


      if (password.value.length < 6) {
        infor.value = "Your password is too short"
        return
      }

      console.log( email.value, password.value)
      axios.post("http://localhost:8000/login.php",
        {
        
          email: email.value,
          password: password.value
        }
      )
        .then(response => {
          console.log('Response from server:', response.data);
          if (response.data[1] === true) {
            router.push({ name: 'Profile', params: { email: email.value } })
          } else {
            infor.value = response.data[2]
          }

        })
        .catch(error => {
          console.error('Error from server:', error.message);

        });


    };

    return {
      email,
      password,
      checkPasswordError,
      submitForm,
      infor,
      
    };
  }
}
</script>
<template>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div>
        <div>
          <h3>Login</h3>
          <hr />
        </div>
        <form @submit.prevent="submitForm">
          <div class="form-group"><label>Email: </label>
            <input id="email" class="form-control" v-model="email" type="email" name="email">
          </div>
          <div class="form-group"> <label>password: </label>
            <input id="password" v-model="password" class="form-control" type="password" name="name">
          </div>
          <div class="my-3"><input type="submit" class="btn btn-primary" value="Submit">
          </div>
          {{ infor }}
        </form>
      </div>
    </div>
  </div>
</template>
