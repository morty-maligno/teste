<template>
    <li class="list-group-item bg-secondary text-white">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="item">Item</div>
            <div class="quantity">Quantidade</div>
            <div class="price">Preço Unitário</div>
            <div class="total-price">Preço Total</div>
            <div class="actions">Ações</div>
        </div>
    </li>
</template>
  
<script>
export default {
    // Nenhum código JavaScript é necessário neste componente
};
</script>
  
<style scoped>
.list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    border: 1px solid #ccc;
    margin-bottom: 5px;
}

.list-group-item .item {
    flex: 2;
}

.list-group-item .quantity,
.list-group-item .price,
.list-group-item .total-price,
.list-group-item .actions {
    width: 100px;
    text-align: center;
}
</style>