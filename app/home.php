<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Products App
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
          integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
<div id="app">
    <div class="container">
        <div class="row justify-content-between pt-3 align-items-center">
            <h3 class="col-3">Product List </h3>
            <div class="col-3 d-flex justify-content-between align-items-center">
                <a href="add_product" class="btn btn-sm btn-primary">ADD </a>
                <button @click="deleteProducts" class="btn btn-sm btn-danger">MASS DELETE </button>
            </div>
        </div>
        <div class="row">
            <hr />
        </div>
        <div class="row justify-content-center">
            <div class="col-12 alert alert-success" v-show="success_message">
                {{success_message}}
            </div>
            <div class="col-12 alert alert-danger" v-show="error_message">
                {{error_message}}
            </div>

        </div>
        <div class="row align-items-start align-content-start p-3 justify-content-evenly"
             style="height: 80vh;gap:20px;overflow-y:scroll">
            <div class="border border-1 border-dark p-2 col-lg-2 col-4" v-for="product in products"
                 :key="product.id">
                <div>
                    <input type="checkbox" class="delete-checkbox" :value="product.id" v-model="checkedProducts">
                </div>

                <div class="row p-3 text-center">

                    <p>{{ product.sku }}</p>
                    <p>{{ product.name }}</p>
                    <p>{{ product.price }} $</p>
                    <p>{{ previewData(product.data) }} </p>

                </div>

            </div>
        </div>
        <div class="row">
            <hr />
        </div>
        <div class="row">
            <p class="text text-center">
                Scandiweb Test assignment
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

    var app =  new Vue({
        el: "#app",
        data: {
            products: [],
            checkedProducts: [],
            success_message: '',
            error_message: '',
        },
        methods: {
            deleteProducts: function (){
                if (this.checkedProducts.length < 1)
                {
                    this.success_message = '';
                    this.error_message = 'Please select products to be deleted!'
                } else {
                    axios({
                        method: 'post',
                        url: './mass_delete',
                        data: this.checkedProducts
                    }).then(response => {
                        this.error_message = '';
                        this.success_message = response.data;
                        this.checkedProducts = []
                        this.retrieveProducts()
                    }).catch(function(error) {
                        console.log(error)
                    });
                }
            },
            retrieveProducts: function (){
                axios({
                    method: 'get',
                    url: './list_products',
                }).then(response => {
                    this.products = response.data;
                }).catch(function(error) {});
            },
            previewData: function (data) {
                if (JSON.parse(data)) {
                    data = JSON.parse(data)
                    if (data.hasOwnProperty('size')) {
                        return data.size + 'MB';
                    } else if (data.hasOwnProperty('weight')) {
                        return data.weight + 'KG';
                    } else if (data.hasOwnProperty('height') && data.hasOwnProperty('width') && data.hasOwnProperty('length')) {
                        return 'Dimensions: ' + data.height + 'X' + data.width + 'X' + data.length;
                    } else {
                        return '';
                    }
                } else {
                    return '';
                }
            }
        },
        mounted() {
            this.retrieveProducts();
        },
    })
</script>
</body>

</html>