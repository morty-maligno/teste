<template>
    <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center w-100">
            <template v-if="!editing">
                <div class="item">
                    <span :class="[item.buyed ? 'completed' : '', 'item-text']">{{ item.name }}</span>
                </div>
                <div class="quantity">{{ item.quantity }}</div>
                <div class="price">R$ {{ item.unit_price }}</div>
                <div class="total-price">R$ {{ calculateTotalPrice(item.unit_price, item.quantity) }}</div>
                <div class="actions">
                    <button class="btn btn-danger ml-3" @click="removeItem()">X</button>
                    <button class="btn btn-primary ml-3" @click="editItem()">Editar</button>
                </div>
            </template>
            <template v-else>
                <edit-item-form :item="editedItem" @save="saveItem" @cancel="cancelEdit" />
            </template>
        </div>
    </li>
</template>
  
<script>
import EditItemForm from "./EditItemForm.vue";

export default {
    props: ["item"],
    data() {
        return {
            editing: false,
            editedItem: { ...this.item },
        };
    },
    methods: {
        updateCheck() {
            this.editedItem.buyed = !this.editedItem.buyed; // Inverte o status de compra
            this.saveItem();
        },
        removeItem() {
            fetch(`api/item/${this.item.id}`, {
                method: "DELETE",
            })
                .then(() => {
                    this.$emit("reloadlist");
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editItem() {
            this.editing = true;
        },
        saveItem() {
            fetch(`api/item/${this.editedItem.id}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ item: this.editedItem }),
            })
                .then(response => response.json())
                .then(data => {
                    this.$emit("reloadlist");
                    this.editing = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        cancelEdit() {
            this.editing = false;
        },
        calculateTotalPrice(unitPrice, quantity) {
            return (unitPrice * quantity).toFixed(2);
        },
    },
    components: {
        EditItemForm,
    },
};
</script>
  
<style scoped>
/* Estilos existentes ... */
.total-price {
    width: 120px;
}
</style>