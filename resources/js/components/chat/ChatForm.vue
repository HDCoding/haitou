<template>
    <div>
        <div class="card-body border-top">
            <div class="row">
                <div class="col-11">
                    <div class="input-field m-t-0 m-b-0">
                        <label for="message" style="display: none"></label>
                        <textarea id="message" name="message" placeholder="Digite e enter" class="form-control border-0" minlength="1" maxlength="5000" required v-model="newMessage" @keyup.enter="sendMessage">></textarea>
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn-circle btn-lg btn-cyan float-right text-white" @click="sendMessage">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatForm",
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },
        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });
                this.newMessage = ''
            }
        }
    }
</script>

<style scoped>

</style>
