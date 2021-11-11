<template>
    <div class="card-group">
        <div class="card-body">
            <h5 class="card-title">{{ item.name}}
            <button @click="addToCart(item)" name="cart" class="cart-plus">
                <font-awesome-icon icon="cart-plus" />
            </button></h5>
            <p class="card-category">{{item.category}}</p>
            <img src="https://via.placeholder.com/194x228/B0C4DE" alt="194x228" class="card-img">
            <p class="price-container"><span>€{{item.price}}</span>
            <button @click="" name="info" class="info">
                <font-awesome-icon icon="info-circle" />
            </button></p>
            <p class="item-available">Available: <span>{{item.available}}</span></p>
            <p class="item-weight">Weight: <span>{{item.weight}}kg</span></p>
        </div>
        <div class="card-footer">
            <small class="text-muted">Added: {{ item.updated_at |formatDate}}</small>
            <div class="buttons">
                    <button @click="editItem(item)" name="edit" class="pencil">
                        <font-awesome-icon icon="edit" />
                    </button>
                    <button @click="removeItem()" class="trashcan">
                        <font-awesome-icon icon="trash" />
                    </button>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'listItem',
    data: function () {
        return {
            items: [],
        }
    },
    props: ['item'],
    methods: {
        updateCheck() {
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
            .then(response =>{
                if(response.status==200) {
                    this.$emit('itemChanged');
                }
            })
            .catch(error =>{
            console.log(error);
            })
        },
        removeItem() {
            this.$confirm("Are you sure to delete this?", "Confirmation", "warning", "").then(() => {
            axios.delete('/api/item/' + this.item.id)
            .then(response => {
                if(response.status==200) {
                    this.$emit('itemChanged');
                    localStorage.removeItem('selectedItems');
                    this.$root.$emit('ItemDeleted');
                }
            })
            .catch(error=> {
                console.log(error);
            })
        })
        },
        editItem: function (editItem) {
            this.$router.push({
                name: 'EditForm',
                params: {
                    itemProp: editItem
                }
            })
        },
        addToCart: function () {
            this.$emit("addedToCart", this.item);
        },

    }
}
</script>

<style scoped>
.overflow-hidden {
    overflow: hidden;
}
.buttons {
    margin-left: auto;
}
.cart-plus, .info {
    border: none;
    color: deepskyblue;
    outline: none;
    background: white;
    float: right;
}
.trashcan {
    border: none;
    color: darkred;
    outline: none;
    background: #f7fafc;
    margin-left: -10px;
}
.pencil {
    border: none;
    color: darkgreen;
    outline: none;
    background: #f7fafc;
}
.card-body {
    border: 20px;
}
.card-title {
    text-align: left;
}
.card-category {
    font-size: x-small;
}
.card-img {
    margin-top: -15px;
}
.price-container {
    color: black;
    font-size: medium;
    font-weight: bold;
}
.item-available {
    margin-top: -20px;
    font-size: x-small;
    color: grey;
}
.item-weight {
    font-size: x-small;
    color: grey;
    margin-top: -20px;
    margin-bottom: -10px;
}
.card-footer {
    width: 100%;
    background: #f7fafc;
    display: flex;
}
.text-muted {
    align-self: center;
    font-size: x-small;
}
</style>
