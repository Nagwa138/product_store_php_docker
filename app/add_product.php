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
                <h3 class="col-3">Product Add </h3>
                <div class="col-3 d-flex justify-content-between align-items-center">
                    <button @click="submitForm" class="btn btn-sm btn-primary">SAVE </button>
                    <a onclick="history.back()" class="btn btn-sm btn-danger">CANCEL</a>
                </div>
            </div>
            <div class="row">
                <hr />
            </div>
            <div class="row align-items-start align-content-start p-3 justify-content-evenly"
                style="height: 80vh;gap:20px;">
                <form onsubmit="return false;" class="container-fluid col-md-6 col-12" id="product_form">

                    <div class="row justify-content-center">
                        <div class="col-12 alert alert-success" v-show="success_message">
                            {{success_message}}
                        </div>
                        <div class="col-12 alert alert-danger" v-show="error_message">
                            {{error_message}}
                        </div>
                    </div>

                    <div class="row mb-2">

                        <div class="col-4">
                            SKU
                        </div>

                        <div class="col-8">
                            <input type="text" name="sku" id="sku" v-model="sku">
                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-4">
                            Name
                        </div>

                        <div class="col-8">
                            <input type="text" name="name" id="name" v-model="name">
                        </div>

                    </div>

                    <div class="row mb-2">

                        <div class="col-4">
                            Price ($)
                        </div>

                        <div class="col-8">
                            <input type="number" name="price" id="price" v-model="price">
                        </div>

                    </div>


                    <div class="row mb-2">

                        <div class="col-4">
                            Type Switcher
                        </div>

                        <select id="productType" v-model="type" class="col-8" >
                            <option id="DVD">
                                DVD
                            </option>
                            <option id="Furniture">
                                Furniture
                            </option>
                            <option id="Book">
                                Book
                            </option>
                        </select>

                    </div>


                    <!--------- This part will be dynamically change ------------>


                    <div class="row mb-2" v-if="type == 'DVD'">

                        <div class="col-4">
                            Size (MB)
                        </div>

                        <div class="col-8">
                            <input type="number" name="size" id="size" v-model="size">
                        </div>

                    </div>

                    <p  v-if="type == 'DVD'">
                        **Please provide DVD size in MB
                    </p>


                    <!------------Furniture---------->


                    <div class="row mb-2" v-if="type == 'Furniture'">

                        <div class="col-4">
                            Height (CM)
                        </div>
                        <div class="col-8">
                            <input type="text" name="height" id="height" v-model="height">

                        </div>
                    </div>



                    <div class="row mb-2" v-if="type == 'Furniture'">

                        <div class="col-4">
                            Width (CM)

                        </div>

                        <div class="col-8">
                            <input type="text" name="height" id="width" v-model="width">

                        </div>
                    </div>



                    <div class="row mb-2" v-if="type == 'Furniture'">

                        <div class="col-4">
                            Length (CM)

                        </div>

                        <div class="col-8">
                            <input type="text" name="length" id="length" v-model="length">

                        </div>
                    </div>

                    <p  v-if="type == 'Furniture'">
                        **Please provide the furniture dimensions HxWxL
                    </p>

                    <!---------------------->

                    <div class="row mb-2" v-if="type == 'Book'">

                        <div class="col-4">
                            Weight (KG)

                        </div>

                        <div class="col-8">
                            <input type="text" name="length" id="weight" v-model="weight">

                        </div>
                    </div>

                    <p  v-if="type == 'Book'">
                        **Please provide the book weight in KG
                    </p>
                    <!---------------------->


                </form>
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
            type: '',
            sku: '',
            name: '',
            size: 0,
            price: 0,
            height: 0,
            length: 0,
            width: 0,
            weight: 0,
            success_message: "",
            error_message: "",
        },
        methods: {
            submitForm() {
                let data = {
                    sku: this.sku,
                    name: this.name,
                    price: this.price,
                    type: this.type
                };

                if (this.type === 'DVD')
                {
                    data.attributes = {
                        size: this.size
                    }
                }

                if (this.type === 'Furniture')
                {
                    data.attributes = {
                        height: this.height,
                        width: this.width,
                        length: this.length,
                    }
                }

                if (this.type === 'Book')
                {
                    data.attributes = {
                        weight: this.weight,
                    }
                }

                axios({
                    method: 'post',
                    url: './add_product_back',
                    data: data
                }).then(response => {
                    if(!response.data.success)
                    {
                        this.success_message = '';
                        this.error_message = response.data.message;
                    } else {
                        this.error_message = '';
                        this.success_message = response.data.message;
                        window.location = document.referrer;
                    }
                    console.log(response.data)
                }).catch(function(error) {
                    this.error_message = 'Sorry, error occurred!';
                    this.success_message = '';
                });
            }
        },
    })
    </script>
</body>

</html>