<template>
    <div id="add-item-form">
        <h1 class="h1">Edit selected product</h1>
<!--        <div v-show="errors_exist" class="alert alert-danger" role="alert">-->
<!--            Whoops! Something didn't work.-->
<!--            <ul>-->
<!--                <div v-for="error in errors">-->
<!--                    <li>{{ error[0] }}</li>-->
<!--                </div>-->
<!--            </ul>-->
<!--        </div>-->
        <div v-show="submitted" role="alert">
            <b-alert show dismissible variant="success" >
                {{successMessage}}
            </b-alert>
        </div>
        <div class="box">
        <form>
            <div class="form-group">
                <label>Product category:</label>
                <select v-model="itemData.category" class="form-control" aria-label="Default select example">
                    <option v-for="category in categories">{{ category }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Product name:</label>
                <input type="text" v-model="itemData.name" class="form-control" id="name" aria-describedby="nameHelp"
                       placeholder="Product name">
                <small id="nameHelp" class="form-text text-muted">Please write your product name.</small>
            </div>
            <div class="form-group">
                <label for="price">Product price:</label>
                <input type="text" v-model="itemData.price" class="form-control" id="price" aria-describedby="priceHelp"
                       placeholder="Product price">
                <!--                <small id="priceHelp" class="form-text text-muted">Please write your product name.</small>-->
            </div>
            <div class="form-group">
                <label>Product quantity:</label>
                <input class="form-control" type="number" placeholder="Product quantity"
                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                       maxlength="5" min="1" v-model="itemData.available">
<!--                <vue-numeric-input :mousewheel="true" v-model="itemData.available" id="available"-->
<!--                                   aria-describedby="quantityHelp" :min="1" :max="10000" :step="1"></vue-numeric-input>-->
                <!--                <small id="quantityHelp" class="form-text text-muted">Please write your product name.</small>-->
            </div>
            <div class="form-group">
                <label for="weight">Product weight:</label>
                <input type="text" v-model="itemData.weight" class="form-control" id="weight"
                       aria-describedby="weightHelp" placeholder="Product weight">
                <small id="weightHelp" class="form-text text-muted">Please write your product name.</small>
            </div>

            <div class="form-group-btn">
                <button v-on:click.prevent="clear()" style="margin-right: 53%" type="submit" class="btnMain reset">Reset</button>
                <button v-on:click.prevent="cancel()" type="submit" class="btnMain">Cancel</button>
            <button v-on:click.prevent="editItem()" type="submit" class="btnMain">Save</button>
            </div>
        </form>
    </div>
    </div>
</template>
<script>
export default {
    name: 'EditForm',
    data: function () {
        return {
            itemData: this.itemProp,
            categories: ['Fashion', 'Electronics & Media', 'Toys, Hobby', 'Furniture & Appliances', 'Food & Personal Care'],
            submitted: false,
            successMessage: 'Product was successfully edited!',
            // errors: {},
            // errors_exist: false,
        }
    },
    props: {
        itemProp: Object,
    },
    methods: {
        // Alert() {
        //     this.showAlert = true;
        //     setTimeout(() => {
        //         this.showAlert = false;
        //     }, 5000);
        // },
        editItem() {
            if (this.itemData.name === '') {
                return;
            }
            axios.put('api/item/edit/' + this.itemData.id, {
                item: this.itemProp
            })
                .then(response => {
                    if (response.status = 201) {
                        this.$emit('reloadlist');
                        this.submitted=true;
                        setTimeout(() => {
                            this.submitted = false;
                        }, 5000);
                        // this.errors_exist=false;
                    }
                })
                .catch(error => {
                    // this.errors_exist = true;
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
        clear() {
            this.itemData.category = '';
            this.itemData.name = '';
            this.itemData.price = '';
            this.itemData.weight = '';
            this.itemData.available = '';
            this.$emit('reloadlist');
            }
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

h1 {
    text-align: center;
    font-family: 'Quicksand', sans-serif;
    color: #755139FF;
    letter-spacing: 2px;
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
.reset {
    float: left;
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
    width: 94%;
}
</style>
