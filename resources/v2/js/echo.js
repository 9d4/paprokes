import Pusher from "pusher-js";
import Echo from 'laravel-echo';

const echo = new Echo({
    broadcaster: 'pusher',
    key: app.pusherKey,
    cluster: app.pusherCluster,
    // forceTLS: true,
});

export default echo;

