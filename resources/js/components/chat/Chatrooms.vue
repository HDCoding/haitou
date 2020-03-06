<template>
    <div>
        <div class="message-center chat-scroll">
            <!-- Groups -->
            <a v-for="chatroom in chatrooms" href="#" class="message-item">
                <span class="user-img">
                    <img :src="chatroom.image" :alt="chatroom.name" class="img-rounded">
                    <span class="profile-status online pull-right"></span>
                </span>
                <div class="mail-contnet">
                    <h5 class="message-title">{{ chatroom.name }}</h5>
                    <span class="time">{{ chatroom.updated_at }}</span>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Chatrooms",

        props: {
            currentchatroom: {
                type: Object,
                required: true,
            },
            chatrooms: {
                type: Array,
            }
        },
        data: function () {
            return {
                currentChatroomValue: this.currentchatroom
            }
        },
        methods: {
            onChatroomChange() {
                this.$emit('changechatroom', this.currentChatroomValue)
            }
        }
    }
</script>

<style scoped>

</style>
