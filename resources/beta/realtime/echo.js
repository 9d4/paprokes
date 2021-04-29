import Pusher from "pusher-js";
import Echo from 'laravel-echo';

const echo = new Echo({
    broadcaster: 'pusher',
    key: Laravel.pusherKey,
    cluster: Laravel.pusherCluster,
    // forceTLS: true,
});

export default echo;

