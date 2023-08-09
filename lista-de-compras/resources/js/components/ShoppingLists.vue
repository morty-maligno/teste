<template>
    <div class="shopping-lists">
        <h2>Minhas Listas de Compras</h2>
        <div class="new-list">
            <label>Nova Lista:</label>
            <input v-model="newListName" @keyup.enter="createList" />
            <button @click="createList">Criar</button>
        </div>
        <div class="available-lists">
            <h3>Listas Disponíveis:</h3>
            <ul>
                <li v-for="list in shoppingLists" :key="list.id">
                    <button @click="selectList(list)">{{ list.name }}</button>
                    <button class="btn-delete" @click="deleteList(list.id)">Excluir</button>
                    <button class="btn-update" @click="updateListName(list.id)">Atualizar Nome</button>
                </li>
            </ul>
        </div>
    </div>
</template>
  
<script>
export default {
    created() {
        this.fetchShoppingLists();
    },
    data() {
        return {
            newListName: "",
            shoppingLists: [],
        };
    },
    methods: {
        fetchShoppingLists() {
            fetch('api/shopping-lists')
                .then(response => response.json())
                .then(data => {
                    this.shoppingLists = data;
                })
                .catch(error => {
                    console.log(error);
                    console.log(error.response);
                });
        },
        createList() {
            if (this.newListName.trim() !== "") {
                const newList = {
                    name: this.newListName,
                };

                fetch('api/shopping-list/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(newList),
                })
                    .then(response => response.json())
                    .then(data => {
                        // Atualize shoppingLists com a nova lista criada
                        this.shoppingLists.push(data);

                        // Limpe o campo de entrada
                        this.newListName = '';
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response); // Verifique a resposta do erro aqui
                    });
            }
        },
        selectList(list) {
            this.$emit('showlist', list);
        },
        deleteList(id) {
            fetch(`api/shopping-list/${id}`, {
                method: 'DELETE',
            })
                .then(response => {
                    if (response.ok) {
                        this.shoppingLists = this.shoppingLists.filter(list => list.id !== id);
                    }
                })
                .catch(error => {
                    console.log(error);
                    console.log(error.response);
                });
        },
        updateListName(id) {
            const newName = prompt('Novo nome da lista:');
            if (newName !== null) {
                fetch(`api/shopping-list/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ name: newName }),
                })
                    .then(response => response.json())
                    .then(data => {
                        const updatedList = this.shoppingLists.find(list => list.id === id);
                        if (updatedList) {
                            updatedList.name = data.name;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response);
                    });
            }
        },
    },
};
</script>
  
<style scoped>
.shopping-lists {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.new-list {
    margin-bottom: 15px;
}

.available-lists ul {
    list-style-type: none;
    padding: 0;
}

.available-lists li {
    margin-bottom: 5px;
}

button {
    padding: 5px 10px;
    margin-right: 5px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

input {
    padding: 5px;
    border: 1px solid #ccc;
}

.btn-delete {
    background-color: red;
    color: white;
}

.btn-update {
    background-color: grey;
    color: white;
}
</style>