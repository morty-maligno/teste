<template>
  <div class="container mt-3">
    <ul class="list-group mt-3">
      <!-- Cabeçalho com as colunas do item -->
      <li class="list-group-item bg-secondary text-white">
        <div class="d-flex justify-content-between align-items-center w-100">
          <div class="item">Item</div>
          <div class="quantity">Quantidade</div>
          <div class="price">Preço Unitário</div>
          <div class="price">Preço Total</div>
          <div class="actions">Ações</div>
        </div>
      </li>
      <!-- Itens da lista -->
      <ListItem v-for="item in items" :key="item.id" :item="item" @reloadlist="loadItems" />
    </ul>
  </div>
</template>

<script>
import ListItem from './listItem.vue';

export default {
  props: ['items'],
  components: {
    ListItem,
  },
  methods: {
    loadItems() {
      this.$emit("reloadlist");
    }
  },
};
</script>

<style>
.container {
  max-width: 800px;
  margin: 0 auto;
}

h1 {
  text-align: center;
}

.list-group {
  width: 100%;
  padding: 0;
}

.list-group-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 15px;
  border: 1px solid #ccc;
  margin-bottom: 5px;
}

.list-group-item .item {
  flex: 1;
}

.list-group-item .quantity,
.list-group-item .price,
.list-group-item .actions {
  width: 100px;
  text-align: center;
}

.list-group-item .buttons {
  flex-shrink: 0;
}

/* Adicione os estilos personalizados aqui, se necessário */
</style>