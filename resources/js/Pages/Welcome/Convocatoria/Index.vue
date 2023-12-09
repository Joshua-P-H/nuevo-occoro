<template>
  <Dashboard>
    <h1>TODAS LAS CONVOCATORIAS</h1>
    <div v-for="(convocatoriaGroup, title) in listas" :key="title">
      <h2>{{ title }}</h2>
      <div class="table-container">
        <table class="custom-table">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Hora de Creación</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="convocatoria in convocatoriaGroup"
              :key="convocatoria.id"
            >
              <td>{{ convocatoria.content_convocatoria }}</td>
              <td>
                {{ new Date(convocatoria.created_at).toLocaleTimeString() }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </Dashboard>
</template>

<script setup>
import { ref, defineProps } from "vue";
import Dashboard from "@/Layouts/LayoutWelcome.vue";

const { listas } = defineProps(["listas"]);
</script>

<style scoped>
.table-container {
  margin-top: 20px;
}

.custom-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.custom-table th,
.custom-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.custom-table th {
  background-color: #f2f2f2;
}

.custom-table td {
  background-color: #fff;
}
</style>
