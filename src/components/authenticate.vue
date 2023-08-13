<script>
import { watch, ref} from 'vue'
import {useRouter} from 'vue-router'
import axios from 'axios';




export default {
  name: "authenticate",
  setup() {
    const router =useRouter()
    const firstName = ref("");
    const lastName = ref("")
    const email = ref("")
    const password = ref("123456");
    const checkPassword = ref("123456");
    const checkPasswordError = ref("");
    const passwordTooShort=ref("")
    const infor = ref("")

    watch([password, checkPassword, infor,], ([newPassword, newCheckPassword, newinfor]) => {
      infor.value = newinfor;
      if (newCheckPassword.length > 0 && newCheckPassword !== newPassword) {
        checkPasswordError.value = "Passwords do not match";
      } else {
        checkPasswordError.value = "";
      }
      if (newPassword.length>0&&newPassword.length<6){
        passwordTooShort.value="Introduce a password whith more then 5 characters"
      } else{
        passwordTooShort.value=""
    }
    });
    const submitForm = () => {
if(firstName.value.length==0){
  infor.value="Introduce your first name"
  return
}
if(lastName.value.length==0){
  infor.value="Introduce your last name"
  return
}
if(password.value.length <6){
infor.value="Your password is too short"
return
}

  
      if (checkPasswordError.value === "") {
        console.log(lastName.value, firstName.value, email.value, password.value)
        axios.post("http://localhost:8000/authenticate.php",
          {
            firstName: firstName.value,
            lastName: lastName.value,
            email: email.value,
            password: password.value
          }
        )
          .then(response => {
            console.log('Response from server:', response.data);
            if (response.data[1] === true) {
              
              router.push({ name: 'Profile', params: { email: email.value} })
            } else {
              infor.value = response.data[2]
              // Aici puteți face alte acțiuni specifice dacă message1 nu are valoarea true
            }

          })
          .catch(error => {
            console.error('Error from server:', error.message);

          });
      }
    
    };

    return {
      firstName,
      lastName,
      email,
      password,
      checkPassword,
      checkPasswordError,
      submitForm,
      infor,
      passwordTooShort
    };
  }
}
</script>


<template>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div>
        <div>
          <h3>Authenticate</h3>
          <hr />
        </div>
        <form @submit.prevent="submitForm">
          <div class="form-group">

            <label>First name: </label>
            <input id="firstName" v-model="firstName" class="form-control" type="text">
          </div>
          <div class="form-group"><label>Last Name: </label>
            <input id="Lastname" v-model="lastName" class="form-control" type="text">
          </div>
          <div class="form-group"><label>Email: </label>
            <input id="email" class="form-control" v-model="email" type="email">
          </div>
          <div class="form-group"> <label>Password: </label>
            <input id="password" v-model="password" class="form-control" type="password">
            <p>{{passwordTooShort}}</p>
          </div>
          <div class="form-group"> <label>Check password: </label>
            <input id="checkPassword" v-model="checkPassword" class="form-control" type="password">
            <p> {{ checkPasswordError }}</p>
          </div>
          <div class="my-3"><input type="submit" class="btn btn-primary" value="Submit">
          </div>
        </form>


      </div>
    </div>
    <div>
      <p>{{ infor }}</p>
    </div>
  </div>
</template>