<template>
   <div class="row">
       <div class="col-8">
           <div class="card card-default">
               <div class="card-header">Messages</div>
               <div class="card-body p-0">
                   <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                       <li class="p-2" v-for="(message, index) in messages" :key="index" >
                           <strong>{{ message.user.name }}</strong>
                           {{ message.message }}
                       </li>
                   </ul>
               </div>
                <div class="input-group">
                    <input
                        @keydown="sendTypingEvent"
                        @keyup.enter="sendMessage"
                        v-model="newMessage"
                        type="text"
                        name="message"
                        placeholder="Enter your message..."
                        class="form-control"
                        aria-label="Message"
                        aria-describedby="message"
                    >
                    <div class="input-group-append">
                        <button
                            type="button"
                            class="btn btn-outline-success" :class="[newMessage ? null : 'disabled']"
                            @click="sendMessage"
                        >
                            Send
                        </button>

                    </div>
                </div>
           </div>
            <span class="text-muted" v-if="activeUser" >{{ activeUser.name }} is typing...</span>
       </div>
        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{ user.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                messages: [],
                newMessage: '',
                users:[],
                activeUser: false,
                typingTimer: false,
            }
        },
        created() {
            this.fetchMessages();
            this.startListening();
        },
        methods: {
            startListening() {
                var self = this;
                Echo.join(`chat`)
                    .here(user => {
                        self.users = user;
                    })
                    .joining(user => {
                        self.users.push(user);
                    })
                    .leaving(user => {
                        self.users = self.users.filter(u => u.id != user.id);
                    })
                    .listen('ChatSent', (event) => {
                        self.messages.push(event.chat);
                    })
                    .listenForWhisper('typing', user => {
                        self.activeUser = user;
                        if(self.typingTimer) {
                            clearTimeout(self.typingTimer);
                        }
                        self.typingTimer = setTimeout(() => {
                            self.activeUser = false;
                        }, 500);
                    });
            },
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('messages', {message: this.newMessage});
                this.newMessage = '';
            },
            sendTypingEvent() {
                Echo.join('chat')
                    .whisper('typing', this.user);
            }
        }
    }
</script>
