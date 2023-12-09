<template>
  <LayoutWelcome>
    <h1 style="font-size: 30px; text-align: center;">TODOS LOS DOCUEMENTOS</h1>

    <div class="contenedor-flex">
      <div class="contenedor-tabla">
        <table class="peti">
          <caption>
            Todos los documentos de PETI
          </caption>
          <thead>
            <tr>
              <th>Nombre del Documento</th>
              <th>Ver</th>
              <th>Descargar</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="documento in filteredDocuments('PETI')"
              :key="documento.id"
            >
              <td>{{ documento.name_documento }}</td>
              <td>
                <Link
                  href="#"
                  @click="mostrarPDF(documento)"
                  title="Ver Documento"
                >
                  <i class="bx bx-show"></i>
                </Link>
              </td>
              <td>
                <Link
                  href="#"
                  @click="descargarPDF(documento)"
                  title="Descargar"
                >
                  <i class="bx bx-download"></i>
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="contenedor-tabla">
        <table class="mof">
          <caption>
            Todos los documentos de MOF
          </caption>
          <thead>
            <tr>
              <th>Nombre del Documento</th>
              <th>Ver</th>
              <th>Descargar</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="documento in filteredDocuments('MOF')"
              :key="documento.id"
            >
              <td>{{ documento.name_documento }}</td>
              <td>
                <Link href="#" @click="mostrarPDF(documento)">
                  <i class="bx bx-show"></i>
                </Link>
              </td>
              <td>
                <Link href="#" @click="descargarPDF(documento)">
                  <i class="bx bx-download"></i>
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="contenedor-tabla">
        <table class="mof">
          <caption>
            Todos los documentos de ROF
          </caption>
          <thead>
            <tr>
              <th>Nombre del Documento</th>
              <th>Ver</th>
              <th>Descargar</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="documento in filteredDocuments('ROF')"
              :key="documento.id"
            >
              <td>{{ documento.name_documento }}</td>
              <td>
                <Link href="#" @click="mostrarPDF(documento)">
                  <i class="bx bx-show"></i>
                </Link>
              </td>
              <td>
                <Link href="#" @click="descargarPDF(documento)">
                  <i class="bx bx-download"></i>
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </LayoutWelcome>
</template>

<style scoped>
.contenedor-flex {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  margin: 0 auto; /* Añade margen automático para centrar el contenedor */
  max-width: 1200px;
}

.contenedor-tabla {
  overflow-x: auto;
  margin: 10px;
  flex: 0 0 48%;
}

table {
  width: 100%;
  max-width: 600px;
  border-collapse: separate; /* Cambia de collapse a separate */
  margin-bottom: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  align-items: center;
  border-radius: 20px; /* Añade el border-radius */
}

caption {
  text-align: left;
  font-weight: bold;
  padding-bottom: 10px;
  font-size: 1.2em;
}

th,
td {
  padding: 12px;
  text-align: center;
}

th {
  background-color: #990c0c;
  color: white; /* Añade color de texto para mayor contraste */
  border-radius: 20px; /* Añade el border-radius */
}

td {
  background-color: #178cc7;
  color: white; /* Añade color de texto para mayor contraste */
  border-radius: 20px; /* Añade el border-radius */
}

i {
  margin-left: 5px;
  cursor: pointer;
  font-size: 25px;
  color: #000000;
}

@media (max-width: 760px) {
  .contenedor-flex {
    flex-direction: column;
    align-items: center;
  }

  .contenedor-tabla {
    flex: 0 0 100%;
  }
}
</style>

<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
import { Link } from "@inertiajs/vue3";
const { documentos } = defineProps(["documentos"]);

const filteredDocuments = (keyword) => {
  const lowerCaseKeyword = keyword.toLowerCase();
  return documentos.filter((documento) =>
    documento.name_documento.toLowerCase().includes(lowerCaseKeyword)
  );
};

const mostrarPDF = (documento) => {
  const nombreArchivo = obtenerNombreArchivo(documento.pdf_documento);
  console.log("Mostrar PDF:", nombreArchivo);
  window.open(documento.pdf_documento, "_blank");
};

const descargarPDF = (documento) => {
  const nombreArchivo = obtenerNombreArchivo(documento.pdf_documento);
  console.log("Descargar PDF:", nombreArchivo);
  const link = document.createElement("a");
  link.href = documento.pdf_documento;
  link.target = "_blank";
  link.download = nombreArchivo;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
};

const obtenerNombreArchivo = (url) => {
  const partesURL = url.split("/");
  return partesURL[partesURL.length - 1];
};
</script>
