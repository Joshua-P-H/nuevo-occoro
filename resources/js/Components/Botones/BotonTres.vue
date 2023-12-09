<template>
    <button class="warning-button">
        <slot>Warning Button</slot>
    </button>
</template>
  
<style>
.warning-button {
    padding: 10px 20px;
    background-color: #f39c12;
    /* Color de advertencia */
    color: #000000;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-right: 10px;
    /* Espacio entre botones */
    box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.719);

}

.warning-button:hover {
    transform: scale(1.05);
    box-shadow: 0 7px 7px 0 rgba(0, 0, 0, 0.719);

}
</style>
  