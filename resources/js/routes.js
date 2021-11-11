import addItemForm from "./vue/components/addItemForm";
import listView from "./vue/listView";
import editItemForm from "./vue/components/editItemForm";
import cartView from "./vue/cartView";
export default [
    {path: '/', component:listView, name:'listView'},
    {path: '/add', component:addItemForm},
    {path: '/edit', component: editItemForm, props: true, name:'EditForm'},
    {path: '/cart', component: cartView, props: true, name:'cartView'},
]
