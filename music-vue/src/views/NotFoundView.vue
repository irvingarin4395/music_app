<script setup lang="ts">
import danger from '/danger-triangle-svg.svg';
</script>

<template>
    <div id="page-not-found">
        <img style="max-width: 16em;" :src="danger" alt="" class="white-svg" />
        <h1>Page Not Found</h1>
    </div>
</template>

<style lang="scss">
#page-not-found {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #ffffff;
    img {
        animation: shake 0.5s;
        animation-iteration-count: infinite;
    }

    @keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
    50% { transform: translate(-1px, 2px) rotate(-1deg); }
    60% { transform: translate(-3px, 1px) rotate(0deg); }
    70% { transform: translate(3px, 1px) rotate(-1deg); }
    80% { transform: translate(-1px, -1px) rotate(1deg); }
    90% { transform: translate(1px, 2px) rotate(0deg); }
    100% { transform: translate(1px, -2px) rotate(-1deg); }
}
}
</style>