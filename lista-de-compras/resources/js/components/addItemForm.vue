<template>
    <div>
        <form @submit.prevent="addItem" class="mb-4">
            <div class="form-group">
                <label for="itemText">Adicionar Item:</label>
                <input id="itemText" type="text" v-model="itemText" class="form-control" placeholder="Nome do item" />
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="itemQuantity">Quantidade:</label>
                    <input id="itemQuantity" type="number" v-model="itemQuantity" class="form-control"
                        placeholder="Quantidade" />
                </div>
                <div class="form-group col-md-4">
                    <label for="itemPrice">Preço Unitário:</label>
                    <input id="itemPrice" type="number" step="any" v-model="itemPrice" class="form-control"
                        placeholder="Preço unitário" />
                </div>
                <div class="form-group col-md-4">
                    <label>Total:</label>
                    <span>{{ calculateTotal() }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">Adicionar Item</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            itemText: "",
            itemQuantity: 1,
            itemPrice: 0,
        };
    },
    methods: {
        addItem() {
            if (this.selectedListId === null) {
                console.log("Nenhuma lista selecionada");
                return;
            }

            const newItem = {
                name: this.itemText,
                quantity: parseInt(this.itemQuantity),
                unit_price: parseFloat(this.itemPrice),
                shopping_list_id: this.selectedListId,
            };

            fetch("api/item/store", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ item: newItem }),
            })
                .then((response) => response.json())
                .then((data) => {
                    this.$emit("reloadlist");
                    this.itemText = "";
                    this.itemQuantity = 1;
                    this.itemPrice = 0;
                })
                .catch((error) => {
                    console.log(error);
                    console.log(error.response);
                });
        },
        calculateTotal() {
            return (this.itemQuantity * this.itemPrice).toFixed(2);
        },
    },
    props: {
        selectedListId: Number,
    },
};
</script>

<style scoped>
/* Personalize os estilos aqui, se necessário */
</style>