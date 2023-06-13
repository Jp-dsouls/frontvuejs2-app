<template>
  <div>
    <h3>Drag and Drop Demo</h3>
    <draggable
      v-model="list"
      :options="{ group: { name: 'people', pull: 'clone', put: false } }"
      class="dragArea"
    >
      <div v-for="(item, index) in list" :key="index">
        {{ item.name }}
      </div>
    </draggable>

    <draggable
      v-model="relations"
      :options="{ group: { name: 'people', pull: false, put: true } }"
      class="droppable"
    >
      <div v-for="(relation, index) in relations" :key="index" class="relation">
        {{ relation.from }} - {{ relation.to }}
      </div>
    </draggable>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  name: "Map",
  components: {
    draggable,
  },
  data() {
    return {
      list: [{ name: "A" }, { name: "B" }, { name: "C" }],
      relations: [
        { from: "A", to: "B" },
        { from: "B", to: "C" },
      ],
    };
  },
};
</script>

<style scoped>
.dragArea {
  padding: 10px;
  background-color: #f7f7f7;
}

.droppable {
  margin-top: 15px;
  padding: 10px;
  background-color: #e9e6e6;
  height: 200px;
}

.relation {
  border: 1px solid black;
}
</style>
