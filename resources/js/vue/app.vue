<template>
    <div class="main">
        <app-header></app-header>
            <div class="content-wrap">
                <router-view></router-view>
            </div>
        <app-footer class="footer"></app-footer>
    </div>

</template>

<script>

import addItemForm from "./components/addItemForm";
import ListView from "./listView";
import listItem from "./listItem";
import header from "./header";
import footer from "./footer"
import editItemForm from "./components/editItemForm";
import cartView from "./cartView";
export default {
    components: {
        ListView,
        listItem,
        editItemForm,
        cartView,
        'add-item-form': addItemForm,
        'app-header': header,
        'app-footer': footer
    },
    data: function () {
        return {
            items: [],
        }
    },
    props: ['errors'],
    methods: {

    }
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap');
 body {
     height: 100%;
     position: relative;
 }
 .content-wrap {
     padding-bottom: 2.5rem;
 }
 .main {
     background-color: #F2EDD7FF;
     min-height: 100vh;
     display: block;
     position: relative;
     overflow: hidden;
     padding-bottom: 100px;
     font-family: 'Quicksand', sans-serif;

 }
 * {
     box-sizing: border-box;
 }

 footer {
     position: absolute;
     bottom: 0;
     width: 100%;
     height: 3.5rem;
 }
</style>
