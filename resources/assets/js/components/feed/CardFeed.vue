<template>
    <div class="card-feed collapse row">
        <card v-for="card in feed" :key="card.id" :content="card"></card>
    </div>
</template>

<script>
    import Card from './Card';

    export default {
        name: 'CardFeed',
        props: ['feed'],
        components: {
            Card
        }
    }
</script>