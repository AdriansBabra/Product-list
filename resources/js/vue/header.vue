<template>
    <div class="header">
        <div class="brand">
            <a href="/" class="logo">Products</a>
        </div>
        <router-link to="/">Home</router-link>
        <router-link to="/add">Add</router-link>
        <div class="cart">
            <router-link to="/cart">Cart<span class="badge badge-light"> {{ selectedItemCount }}</span></router-link>
        </div>
    </div>
</template>

<script>
import listView from "./listView";
import listItem from "./listItem";

export default {
    name: 'headers',
    components: {
        listItem,
        listView,
    },
    data: function () {
        return {
            selectedItems: [],
        }
    },
    methods: {},
    computed: {
        selectedItemCount: function () {
            let totalSelected = 0;

            if (this.selectedItems) {
                this.selectedItems.forEach(function (item) {
                    totalSelected += parseInt(item.quantity);
                });
            }

            return parseInt(totalSelected, 10);
        }
    },
    mounted() {
        if (localStorage.getItem("selectedItems")) {
            this.selectedItems = JSON.parse(localStorage.getItem("selectedItems"));
        }
    },
    created() {
        let callback = () => {
            this.selectedItems = JSON.parse(localStorage.getItem('selectedItems'))
        };
        this.$root.$on('ChangedQty', callback);
        this.$root.$on('DeletedFromCart', callback);
        this.$root.$on('SelectedItemsChanged', callback);
        this.$root.$on('ItemDeleted', callback);
    },
}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
}

body {
    background: #F2EDD7FF;
    font-family: "Montserrat", sans-serif;
}

.header {
    padding: 20px 10px;
    background-color: #F2EDD7FF;
    position: relative;
}

.brand {
    float: left;
}

.cart {
    float: right
}

.header a {
    text-align: center;
    /*padding: 20px;*/
    text-decoration: none;
    font-size: 18px;
    line-height: 20px;
    border-radius: 4px;
    padding: 20px;
    color: #755139FF;
}

.header .logo {
    font-size: 25px;
    font-weight: bold;
}

.header a:hover {
    color: #755139FF;
    font-weight: bolder;
    transition: all 0.5s ease;
    box-shadow: 0 5px 35px 0px rgba(0, 0, 0, .1);
    border-radius: 20px;
    letter-spacing: 2px;
    padding: 20px;
}

.header .active {
    font-weight: bolder;
    box-shadow: 0 5px 35px 5px rgba(0, 0, 0, .1);
    border-radius: 20px;
    letter-spacing: 2px;
    color: #755139FF;
}

.badge {
    padding: 5px;
    border-radius: 9px;
    background-color: #c67605;
}

</style>
