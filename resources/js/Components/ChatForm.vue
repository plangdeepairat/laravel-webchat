<template>
        <div class="relative w-full p-6 overflow-y-auto h-[30rem]">
                <ul class="space-y-2 scrollable"  ref="hasScrolledToBottom">
                  <template v-for="message in messages">
                  <li class="flex justify-start" v-if="user.id != message.user.id">
                    <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow">
                      <span class="block"> {{ message.user.name }} : {{ message.message }}</span>
                    </div>
                  </li>
                  <li class="flex justify-end " v-else>
                    <div class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow">
                      <span class="block ">
                      {{ message.message }} : {{ message.user.name }}
                    </span>
                    </div>
                  </li>
                </template>
                </ul>
          </div>
            <div class="flex items-center justify-between w-full p-3 border-t border-gray-300">
              <button>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </button>
              <input type="text" placeholder="Message"
                class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                name="message" v-model="newMessage" @keyup.enter="addMessage" required />
              <button type="button" id="btn-chat" @click="addMessage">
                <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
              </button>
            </div>
</template>
<script>
import {ref, onMounted,onUpdated } from 'vue';
import axios from 'axios';
export default {
  props: ["user"],
  setup(props){
	    	let messages = ref([])
	    	let newMessage = ref('')
	    	let hasScrolledToBottom = ref('')
	    	onMounted(() =>{
	    		fetchMessages()
	    	})
	    	onUpdated(() => {
	    		scrollBottom()
	    	})
	    	Echo.private('pusher')
	          .listen('MessageSent', (e) => {
	            messages.value.push({
                message: e.message.message,
                user: e.user
	            });
	        })
	    	const fetchMessages = async()=> {
	            axios.get('/messages').then(response => {
	                messages.value = response.data;
	            });
	        }
	        const addMessage = async()=> {
	        	let user_message = {
                    user: props.user,
                    message: newMessage.value
                };
	            messages.value.push(user_message);
	            axios.post('/messages', user_message).then(response => {
	              console.log(response.data);
	            });
                newMessage.value = ''
	        }
	        const scrollBottom = () =>{
	        	if(messages.value.length > 1){
		        	let el = hasScrolledToBottom.value;
	      			el.scrollTop = el.scrollHeight;
	        	}
	        }
	        return {
	        	messages,
	        	newMessage,
	        	addMessage,
	        	fetchMessages,
	        	hasScrolledToBottom
	        }
	    }
};
</script>
