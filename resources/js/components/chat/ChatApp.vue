<template>
    <div>
        <div class="left-part bg-white fixed-left-part">
            <!-- Mobile toggle button -->
            <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
            <!-- Mobile toggle button -->
            <div class="p-15">
                <h4>Chat</h4>
            </div>
            <div class="scrollable position-relative" style="height:100%;">
                <div class="p-15">
                    <h5 class="card-title">Pesquisar Contato</h5>
                    <form>
                        <label for="contact" style="display: none"></label>
                        <input class="form-control" name="contact" id="contact" type="text" placeholder="Pesquisar Contato">
                    </form>
                </div>
                <hr>
                <ul class="mailbox list-style-none">
                    <li>
                        <chat-rooms v-on:changechatroom="changeChatRoom" :currentchatroom="chatroom" :chatrooms="chatrooms"></chat-rooms>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Left Part  -->

        <!-- Right Part Mail Compose -->
        <div class="right-part">
            <div class="p-20">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chat Geral</h4>
                        <div class="chat-box scrollable" style="height:calc(100vh - 300px);">
                            <!--chat Row -->
                            <ul class="chat-list chatbox">
                                <!--chat Row -->
                                <chat-messages :messages="messages"></chat-messages>
                                <!--chat Row -->
                            </ul>
                        </div>
                    </div>
                    <chat-form v-on:messagesent="postMessage" :user="user"></chat-form>
                </div>
            </div>
        </div>
        <!-- End Page wrapper -->
    </div>
</template>

<script>
    import Chatrooms from "./Chatrooms";
    import ChatMessages from "./ChatMessages";
    import ChatForm from "./ChatForm";

    export default {
        name: "ChatApp",
        data: function () {
            return {
                messages: [],
                chatrooms: [],
                currentChatroom: this.chatroom
            }
        },
        props: {
            user: {
                type: Object,
                required: true
            },
            chatroom: {
                type: Object,
                required: true
            }
        },
        components: {Chatrooms, ChatMessages, ChatForm},
        mounted() {
            this.getChatRooms();
            this.getMessages();

            Echo.private('chatroom.' + this.currentChatroom.id).listen('MessageSent', (event) => {
                this.messages.push({
                    message: event.me.message,
                    user: event.user
                });
            });
        },
        methods: {
            getChatRooms() {
                axios.get('api/chatrooms')
                    .then(response => {
                        this.chatrooms = response.data;
                    })
            },
            changeChatRoom(chatroom) {
                Echo.leave('chatroom.' + this.currentChatroom.id);
                this.currentChatroom = chatroom;

                axios.post('api/change-chatroom', {
                    'chatroom': chatroom
                }).then(response => {
                    this.getMessages();
                    Echo.private('chatroom.' + chatroom.id).listen('MessageSend', (event) => {
                        this.messages.push({
                            message: event.message.message,
                            user: event.user
                        });
                    });
                });
            },
            getMessages() {
                axios.get('api/messages').then(response => {
                    this.messages = response.data;
                });
            },
            postMessage(message) {
                this.messages.push(message);

                axios.post('api/messages', message).then(response => {
                    console.log(response.data);
                });
            }
        }
    }
</script>

<style scoped>

</style>
