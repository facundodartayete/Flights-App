require('./bootstrap');

import {createApp} from 'vue'
import Flights from './components/Flights'

createApp({
    components:{
        Flights,
    }
}).mount('#app');