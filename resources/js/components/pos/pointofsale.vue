<template>
  
  <div>

  <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
           

           

            
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
         <a class="btn btn-sm btn-info"><font color="#ffffff">Add Customer</font></a>         
                  
                </div>
                


 
                
                <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for = "cart in carts" :key = cart.id>
                        <td><a href="#">{{ cart.pro_name }}</a></td>
                        <td><input type = "text"  style = "width: 15px;" :value = "cart.pro_quantity">
                        <button @click.prevent ="increment(cart.id)" class = "btn btn-sm btn-success">+</button>

                         <button @click.prevent ="decrement(cart.id)" class = "btn btn-sm btn-danger" v-if = "cart.pro_quantity >= 2">-</button>

                         <button class = "btn btn-sm btn-danger" v-else = "" disabled=""></button>


                        </td>
                        <td> {{ cart.product_price }} </td>
                        <td>{{  cart.sub_total }}</td>
                        <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary text-white">X</a></td>
                      </tr>
                       
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
            <ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
  <strong>{{ qty }}</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
  <strong> {{ subtotal }} $</strong>
   </li>

     <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
  <strong>{{ vats.vat }} %</strong>
   </li>
     <li class="list-group-item d-flex justify-content-between align-items-center">Total :
  <strong>{{  subtotal*vats.vat/100 + subtotal }} $</strong>
   </li> 
              
            </ul>   
            <br> 

        <form @submit.prevent = "orderdone">
          <label>Customer Name</label>
          <select class="form-control" v-model="customer_id">
                 <option :value = "customer.id" v-for = "customer in customers">  {{ customer.name }} </option>
           </select>

           <label>Pay</label>
           <input type="text" class="form-control" required="" v-model="pay">

           <label>Due</label>
           <input type="text" class="form-control" required="" v-model="due">

          <label>Pay By</label>
          <select class="form-control" v-model="payby">
                 <option value="HandCash">Hand Cash </option>
                 <option value="Cheaque">Cheaque </option>
                 <option value="GiftCard">Gift Card </option>
           </select>

           <br>
           <button type="submit" class="btn btn-success">Submit</button>

        </form>    



                </div>
             






              </div>
            </div>
            <!-- Pie Chart -->



            <div class="col-xl-7 col-lg-7 col-sm-6 col-6">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  
                 
                  </div>


                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                    </li>
                    <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subproduct(category.id)">{{ category.category_name }}</a>
                    </li>
                   
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <input type="text" v-model="searchTerm" class="form-control" style="width: 500px;" placeholder="Search Here">
                         <div class="card-body">

                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                      <button class = "btn btn-sm" @click.prevent = "AddToCart(product.id)">
                      <div class="card" style="width: 8.5rem;">
                        <img :src="product.image" id = "em_photo" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ product.product_name }}
                          <span class="badge badge-success" v-if = "product.product_quantity >= 1"> Available {{ product.product_quantity }} </span>
                          <span class="badge badge-danger" v-else = ""> Out Of Stock </span>
                          </h5>

                         
                        </div>
                      </div>
                    </button>
                    </div>
                  </div>
                 
                </div>


                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        
                         <input type="text" v-model="searchProduct" class="form-control" style="width: 500px;" placeholder="Search Here">
                         <div class="card-body">

                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getProduct in getFilterSearch" :key="getProduct.id">
                      <button class = "btn btn-sm" @click.prevent = "AddToCart(getProduct.id)">
                      <div class="card" style="width: 8.5rem;">
                        <img :src="getProduct.image" id = "em_photo" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ getProduct.product_name }}
                          <span class="badge badge-success" v-if = "getProduct.product_quantity >= 1"> Available {{ getProduct.product_quantity }} </span>
                          <span class="badge badge-danger" v-else = ""> Out Of Stock </span>
                          </h5>

                         
                        </div>
                      </div>
                    </button>
                    </div>
                  </div>
                 
                </div>


                      </div>
                    </div>

                

               
                
              </div>
            </div>
            <!-- Invoice Example -->
           
            <!-- Message From Customer-->
            
          </div>
          <!--Row-->

         

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

    created(){
    this.allProduct();
    this.allCategory();
    this.allCustomer();
    this.CartProduct();
    this.vat();
    Reload.$on('AfterAdd',() => {
      this.CartProduct();
    })
  }, 

    data(){
      return{
        customer_id:'',
        pay:'',
        due:'',
        payby:'',
        products:[],
        categories:'',
        getProducts:[],
        searchTerm:'',
        searchProduct:'',
        customers:'',
        carts:[],
        vats: ''
      }
    },
    computed:{
      filtersearch(){
      return this.products.filter(product => {
         return product.product_name.match(this.searchTerm)
      }) 
      },
      getFilterSearch(){
        return this.getProducts.filter(getProduct => {
         return getProduct.product_name.match(this.searchProduct)
      }) 
      },
      qty(){
        let sum = 0;
        for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity));
        }
        return sum;
      },
      subtotal(){
        let sum = 0;
        for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].product_price));
        }
        return sum;
      }
    },
 
  methods:{
    AddToCart(id){
      axios.get('/api/addtocart/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.cart_success()
      })
      .catch()
    },
    removeItem(id){
      axios.get('/api/delete/cart/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.cart_delete()
      })
      .catch()
    },
    increment(id){

       axios.get('/api/increment/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.success()
      })
      .catch()

    },
    decrement(id){

       axios.get('/api/decrement/'+id)
      .then(() => {
        Reload.$emit('AfterAdd');
        Notification.success()
      })
      .catch()

    },
    CartProduct(){
      axios.get('/api/cart/product')
      .then(({data}) => (this.carts = data))
      .catch()
    },
    vat(){
       axios.get('/api/vats/')
      .then(({data}) => (this.vats = data))
      .catch()
    },
    orderdone(){

      let total = this.subtotal*this.vats.vat/100 + this.subtotal;
      let data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, payby:this.payby, pay:this.pay, vat:this.vats.vat, due:this.due, total:total}

       axios.post('/api/orderdone',data)
       .then(() => {
        Notification.success()
         this.$router.push({ name: 'home'})
       })
       .catch(error =>this.errors = error.response.data.errors)

    },
    allProduct(){
      axios.get('/api/product/')
      .then(({data}) => (this.products = data))
      .catch()
    },
    allCategory(){
      axios.get('/api/category/')
      .then(({data}) => (this.categories = data))
      .catch()
    },
    allCustomer(){
      axios.get('/api/customer/')
      .then(({data}) => (this.customers = data))
      .catch()
    },
    subproduct(id){
      axios.get('/api/getting/product/'+id)
      .then(({data}) => (this.getProducts = data))
      .catch()
    },

  },
  
  
  } 
</script>


<style type="text/css" scoped>
  #em_photo{
    height: 100px;
    width: 135px;
  }
</style>