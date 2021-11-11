<template>
    <div class="cart-main">
        <div class="panel-heading">
            <h2>Your cart list</h2>
        </div>
        <div class="panel-body">
            <div class="table table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in selectedItems" :key="index">
                        <td><img src="https://via.placeholder.com/100x100/B0C4DE" alt="100x50" class="img-cart"></td>
                        <td><strong>{{ item.name }}</strong>
                            <p>Weight: {{ item.weight}}</p></td>
                        <td>
                            <div class="form-inline">
                                <input class="form-control" type="number"
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                       maxlength="5" min="1" v-model="item.quantity">
                                <button @click="removeItemFromCart(item)" class="trash">
                                    <font-awesome-icon icon="trash"/>
                                </button>
                            </div>
                        </td>
                        <td>€{{ item.price }}</td>
                        <td>€{{ item.price * item.quantity }},<p>{{ item.weight * item.quantity }} kg</p></td>
                    </tr>

                    <tr>
                        <td colspan="4" class="text-right">Total Price<p>Total Weight</p></td>
                        <td>€{{ total }}<p>{{totalWeight}}kg</p></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Total Shipping</td>
                        <td>€{{shipping}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td>€{{totalPrice}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <a @click="contShop" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Continue
            Shopping</a>
        <a @click="removeAllFromCart()" class="btn btn-danger">Clear cart<span
            class="glyphicon glyphicon-arrow-left"></span></a>
        <a class="btn btn-primary right">Next<span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</template>

<script>
import listView from "./listView";

export default {
    name: "cartView",
    data: function () {
        return {
            selectedItems: [],
            badge: '0',
        }
    },
    computed: {
        total: function () {
            let tot = 0;
            this.selectedItems.forEach(function (item) {
                tot += item.price * item.quantity;
            })

            return tot;
        },
        totalWeight: function () {
            let tot = 0;
            this.selectedItems.forEach(function (item) {
                tot += item.weight * item.quantity;
            })

            return tot;
        },
        shipping: function () {
            let shipPrice = 0;
            if (this.total <= 0) {
                shipPrice = 0;
            }
            else if(this.totalWeight <= 10){
                shipPrice = 5;
            } else if(this.totalWeight <= 20){
               shipPrice = 10;
            } else {
                shipPrice = 30;
            }
            return shipPrice;
        },
        totalPrice: function (){
            let totalPrice = 0;
            if(this.total >0){
                totalPrice = this.total + this.shipping;
            }
            return totalPrice;

        }
    },
    watch: {
        selectedItems: {
            deep: true,
            handler(newValue) {
                localStorage.setItem('selectedItems', JSON.stringify(newValue));
                this.$root.$emit('SelectedItemsChanged');
            }
        }
    },
    methods: {
        contShop: function () {
            this.$router.push({
                name: 'listView'
            })
        },
        removeItemFromCart(item) {
            const index = this.selectedItems.indexOf(item);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            }
            localStorage.setItem('selectedItems', JSON.stringify(this.selectedItems));
            this.$root.$emit('DeletedFromCart');
        },
        removeAllFromCart() {
            this.selectedItems.splice(this.selectedItems);
            localStorage.setItem('selectedItems', JSON.stringify(this.selectedItems));
        }
    },
    mounted() {
        if (localStorage.getItem("selectedItems")) {
            this.selectedItems = JSON.parse(localStorage.getItem("selectedItems"));
        }
    },
}
</script>

<style scoped>
.cart-main {
    max-width: 60%;
    border-radius: 20px;
    background-color: #f7fafc;
    padding: 20px;
    margin: 25px auto;
}

.img-cart {
    max-width: 100%;
}

h2 {
    color: #755139FF;
    font-weight: bold;
    letter-spacing: 2px;
}

table tr td {
    border: 2px solid #755139FF;
}

thead {
    border: 3px solid #755139FF;
    align-items: center;
}

.trash {
    border: none;
    color: darkred;
    outline: none;
    background: #f7fafc;
}

.pencil {
    border: none;
    color: darkgreen;
    outline: none;
    background: #f7fafc;
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

.right {
    float: right;
}

</style>
