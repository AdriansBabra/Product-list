<template>

    <div id="add-item-form">
        <h1 class="h1">Add a new Product</h1>
        <div v-show="errors_exist" class="alert alert-danger" role="alert">
            Whoops! Something didn't work.
            <ul>
                <div v-for="error in errors">
                    <li>{{ error[0] }}</li>
                </div>
            </ul>
        </div>
        <div v-show="submitted" role="alert">
            <b-alert show dismissible variant="success" >
                {{successMessage}}
            </b-alert>
        </div>
        <div class="box">
            <form method="post">
            <div class="form-group">
                <label>Product category:</label>
                <select v-model="item.category" class="form-control" aria-label="Default select example">
                    <option v-for="category in categories">{{category}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Product name:</label>
                <input type="text" v-model="item.name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Product name" required>
                <small id="nameHelp" class="form-text text-muted">Please write your product name.</small>
            </div>
            <div class="form-group">
                <label for="price" >Product price: </label>
                <input type="text" v-model="item.price" class="form-control" id="price" aria-describedby="priceHelp" placeholder="Product price">
                <small id="priceHelp" class="form-text text-muted">Price in Euros.</small>
            </div>
            <div class="form-group">
                <label>Product quantity:</label>
                <input class="form-control" type="number" placeholder="Product quantity"
                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                       maxlength="5" min="1" v-model="item.available">
<!--                <vue-numeric-input :mousewheel="true" v-model="item.available" id="available" aria-describedby="quantityHelp" :min="1" :max="10000" :step="1"></vue-numeric-input>-->
<!--                <small id="quantityHelp" class="form-text text-muted">Please write your product name.</small>-->
            </div>
            <div class="form-group">
                <label for="weight">Product weight:</label>
                <input type="text" v-model="item.weight" class="form-control" id="weight" aria-describedby="weightHelp" placeholder="Product weight">
                <small id="weightHelp" class="form-text text-muted">Weight measurement in kg.</small>
            </div>
                <div class="form-group-btn">
                    <button v-on:click.prevent="cancel()" style="margin-right: 57%" type="submit" class="btnMain">Cancel</button>
            <button v-on:click.prevent="addItem()" type="submit" class="btnMain">Add product</button>
                </div>
        </form>
        </div>
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            item: {
                name: "",
                price: "",
                available: "",
                weight: "",
                category: "",
                updated_at: "",
            },
            categories:['Fashion','Electronics & Media','Toys, Hobby', 'Furniture & Appliances', 'Food & Personal Care'],
            submitted: false,
            successMessage: 'Product was successfully added!',
            errors: {},
            errors_exist: false,
        }
    },
    // props: {
    //     errors: Array,
    // },
    methods: {
        addItem() {
            if (this.item === '') {
                return;
            }
            axios.post('api/item/store', {
                item: this.item
            })
                .then(response => {
                    if (response.status == 201) {
                        this.item.categories = '';
                        this.item.name = '';
                        this.item.price = '';
                        this.item.weight = '';
                        this.item.available = '';
                        this.$emit('reloadlist');
                        this.submitted=true;
                        setTimeout(() => {
                            this.submitted = false;
                        }, 5000);
                        this.errors_exist=false;
                    }
                })

                .catch(error => {
                    this.errors_exist = true;
                    this.submitted = false;
                    if(error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                }
                    console.log('Error')
                })
        },
        cancel: function (cancel) {
            this.$router.push({
                name: 'listView'
            })
        },
    }
}
</script>

<style scoped>
#add-item-form {
    margin: 0px auto;
    max-width: 600px;
    border-radius: 20px;
    border: #1a202c;
}
.form-group {
    margin: auto;
    padding: 5px;
    width: 90%;
}
.box {
    max-width: 600px;
    justify-content: center;
    position: relative;
    background: #f7fafc;
    margin: 0 auto;
    border-radius: 15px;
    border: 2px #1a202c;
    padding-top: 20px;
    padding-bottom: 20px;
}
h1 {
    text-align: center;
    font-family: 'Quicksand', sans-serif;
    color: #755139FF;
    letter-spacing: 2px;
}
input {
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.form-control {
    background: #F2EDD7FF;
}
.form-control:focus {
    background: #f2edd7;
    border-color: #1a202c;
    box-shadow: 0 1px 1px #755139FF inset, 0 0 10px #755139FF;
    outline: 0 none;
}

.btnMain {
   align-items: center;
   background-color: #f2edd7;
   border-radius: 15px;
   color: #755139FF;
   height: 40px;
   justify-content: center;
   max-width: 100%;
   padding: 5px 15px;
   text-align: center;
   width: auto;
}

.btnMain:hover {
    box-shadow: 0 5px 35px 5px rgba(0,0,0,.1);
    transform: translateY(-3px);
    filter: brightness(1.2);
    font-weight: bold;
}
.form-group-btn {
    justify-content:flex-end;
    display:flex;
    max-width: 600px;
    padding:0;
    margin-right: 35px;
}
</style>

