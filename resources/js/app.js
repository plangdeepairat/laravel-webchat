import './bootstrap';
import { createApp } from "vue/dist/vue.esm-bundler.js"
import ChatForm from './Components/ChatForm.vue';
import axios from 'axios'

const app = createApp({});
app.component('chat-template',ChatForm);
app.mount("#app")