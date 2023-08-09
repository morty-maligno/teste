<template>
    <div>
        <form @submit.prevent="saveItem">
            <input type="text" v-model="editedItem.name" placeholder="Nome do Item" />
            <input type="number" v-model="editedItem.quantity" placeholder="Quantidade" />
            <input step="any" type="number" v-model="editedItem.price" placeholder="Preço Unitário" />
            <button type="submit">Salvar</button>
            <button type="button" @click="cancelEdit">Cancelar</button>
        </form>
    </div>
</template>

<script>
export default {
    props: ["item"],
    data() {
        return {
            editedItem: {
                id: this.item.id,
                name: this.item.name,
                quantity: this.item.quantity,
                unit_price: this.item.price,
                buyed: this.item.buyed
            }
        };
    },
    methods: {
        saveItem() {
            this.$emit("save", this.editedItem);
        },
        cancelEdit() {
            this.$emit("cancel");
        }
    }
};
</script>
