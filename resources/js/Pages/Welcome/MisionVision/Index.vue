<template>
  <div v-if="logos.length > 0">
    <LayoutWelcome :logo="logos[logos.length - 1]">
      <MisionVision
        v-for="mision in misiones"
        :key="mision.id"
        :mision="mision"
      />
      <footer>
        <div v-if="footers.length > 0">
          <FooterWelcome :footer="footers[footers.length - 1]" />
        </div>
      </footer>
    </LayoutWelcome>
  </div>
</template>

<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
import { Link } from "@inertiajs/vue3";
import FooterWelcome from "@/Pages/Welcome/Components/FooterWelcome.vue";

import MisionVision from "@/Pages/Welcome/Components/MisionVision.vue";
const { logos, footers, misiones } = defineProps([
  "logos",
  "footers",
  "misiones",
]);

// const { documentos } = defineProps(["documentos"]);
</script>
