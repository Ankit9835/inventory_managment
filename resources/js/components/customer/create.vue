<template>
  
  <div>

 <div class="row">
  <router-link to="/customer" class="btn btn-primary">All Customer </router-link>
   
 </div>



    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Customer</h1>
                  </div>

      <form class="user" @submit.prevent="CustomerInsert" enctype="multipart/form-data">

        <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1"> Name</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Name" v-model="form.name">
       <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
            </div>


     <div class="col-md-6">
      <label for="exampleFormControlSelect1">Contact No</label>
         <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Phone No" v-model="form.phone">
         <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }} </small>
            </div>     
            
          </div>
        </div>
  

 <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Email</label>
         <input type="email" class="form-control" id="exampleInputFirstName"  v-model="form.email">
       <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
            </div>

         <div class="col-md-6">
              <label for="exampleFormControlSelect1">Address</label>
         <textarea class = "form-control" v-model="form.address"></textarea>
  <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
            </div>



          </div>
        </div>


         <div class="form-group">

          <div class="form-row">
            <div class="col-md-6">
   <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">

  <small class="text-danger" v-if="errors.image"> {{ errors.image[0] }} </small>
       <label class="custom-file-label" for="customFile">Choose file</label>
            </div>


     <div class="col-md-6">
        <img :src="form.image" style="height: 40px; width: 40px;">
            </div>     
            
          </div>
        </div>

 


        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
        
      </form>
                  <hr>
                  <div class="text-center">
  
  
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>



<script type="text/javascript">
  
  export default {
    created(){
      if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
    data(){
    return {
      form:{
        name: null,
        phone: null,
        email: null,
        address: null,
        image: null
        
      },
      errors:{},
     
    }
  },
  methods:{
    onFileSelected(event){
     let file = event.target.files[0];
     if (file.size > 1048770) {
      Notification.image_validation()
     }else{
      let reader = new FileReader();
      reader.onload = event =>{
        this.form.image = event.target.result
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
     }
    },
  CustomerInsert(){
       axios.post('/api/customer',this.form)
       .then(() => {
        this.$router.push({ name: 'customer'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  }
  /*created(){
    axios.get('/api/customer/')
    .then(({data}) => (this.customer = data))
    axios.get('/api/supplier/')
    .then(({data}) => (this.suppliers = data))
  } */
  }
   
</script>


<style type="text/css">
  
</style>