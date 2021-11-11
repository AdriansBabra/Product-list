<template>
    <div id="list-view">
        <h1 class="title">All Products</h1>
        <div class="card-deck">
            <div class="single-item" v-for="(item, index) in items" :key="index">
                <div class="card">
                    <list-item
                        :item="item"
                        class="item"
                        @itemChanged="getList"
                        @addedToCart="addToSelectedItems"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import listItem from "./listItem";
export default {
    name: 'listView',
    components: {
        listItem,
    },
    data: function () {
        return {
            items: [],
            selectedItems: [],
        }
    },
    computed: {},
    methods: {
        getList() {
            axios.get('api/items')
                .then(response => {
                    this.items = response.data
                })
                .catch(error => {
                    console.log(error);

                })
        },
        addToSelectedItems: function (selectedItem) {
            let foundItem = this.selectedItems.filter(function (e) {
                return e.id ? e.id === selectedItem.id : false
            })[0];
            if (foundItem) {
                this.selectedItems = this.selectedItems.map(function (item) {
                    if (item.id === foundItem.id) {
                        item.quantity += 1;
                    }
                    return item;
                })

                localStorage.setItem('selectedItems', JSON.stringify(this.selectedItems));
                this.$root.$emit('ChangedQty');
            } else {
                selectedItem.quantity = 1;
                this.selectedItems.push(selectedItem);

                localStorage.setItem('selectedItems', JSON.stringify(this.selectedItems));
                this.$root.$emit('ChangedQty');
            }
        }
    },
    created() {
        this.getList();
        if (localStorage.getItem('selectedItems')) {
            this.selectedItems = JSON.parse(localStorage.getItem('selectedItems') || '[]');
        }
    },

}
</script>
<style scoped>
#list-view {
    max-width: 960px;
    margin: 0 auto;
}

.title {
    text-align: center;
    color: #755139FF;
}

.card-deck {
    justify-content: center;
    grid-gap: -40px;
    display: grid;
    grid-template-columns: repeat(auto-fill, 240px );
}

.card {
    margin: 10px;
    width: 230px;
}

h1 {
    letter-spacing: 2px;
}

.single-item {
    margin: 0 auto;
}
</style>
