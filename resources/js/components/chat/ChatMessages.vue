<template>
    <div>
        <li class="chat-item" v-for="message in messages">
            <div class="chat-content">
                <h6 class="font-medium">{{ message.username }}</h6>
                <div class="box bg-light-info">
                    {{ message.message }}
                </div>
            </div>
        </li>
    </div>
</template>

<script>
    export default {
        name: "ChatMessages",
        props: ['messages']
    }
</script>

<style scoped>

</style>
