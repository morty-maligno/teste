<template>
    <div class="container w-100 m-auto text-center mt-3">
        <shopping-lists v-on:showlist="showList" />
        <h1 class="text-danger">{{ selectedList ? `Lista de Compras - ${selectedList.name}` : "Nenhumha lista selecionada"
        }}
        </h1>
        <add-item-form v-on:reloadlist="getItems" @removeitem="deleteItem" @itemchanged="updateItem" :selectedListId="selectedList ? selectedList.id : null"
            v-if="selectedList" />
        <list-view :items="items" v-on:reloadlist="getItems" v-if="selectedList" class="text-center" />
    </div>
</template>

<script>
import addItemForm from "./addItemForm";
import listView from "./listView";
import ShoppingLists from "./ShoppingLists";
export default {
    components: {
        ShoppingLists,
        addItemForm,
        listView,
    },

    data: function () {
        return {
            items: [],
            selectedList: null, // Variável para armazenar a lista selecionada
        };
    },
    methods: {
        getItems() {
            if (this.selectedList !== null) {
                fetch(`api/items/${this.selectedList.id}`)
                    .then((response) => response.json())
                    .then((data) => {
                        this.items = data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        showList(list) {
            // Carregue os itens da lista selecionada
            this.selectedList = list;
            this.getItems();
        },
        updateItem(updatedItem) {
            const index = this.items.findIndex(item => item.id === updatedItem.id);
            if (index !== -1) {
                this.items[index] = updatedItem;
            }
        },
        removeItem(removedItem) {
            this.items = this.items.filter(item => item.id !== removedItem.id);
        },
    },
    created() {
        this.getItems();
    },
};
</script>

<style scoped></style>
