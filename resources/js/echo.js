import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
window.Echo.private('messenger.user.1')
  .listen('.new.message', (e) => console.log(e))
  .listen('.thread.archived', (e) => console.log(e))
  .listen('.message.archived', (e) => console.log(e))
  .listen('.knock.knock', (e) => console.log(e))
  .listen('.new.thread', (e) => console.log(e))
  .listen('.thread.approval', (e) => console.log(e))
  .listen('.thread.left', (e) => console.log(e))
  .listen('.incoming.call', (e) => console.log(e))
  .listen('.joined.call', (e) => console.log(e))
  .listen('.ignored.call', (e) => console.log(e))
  .listen('.left.call', (e) => console.log(e))
  .listen('.call.ended', (e) => console.log(e))
  .listen('.friend.request', (e) => console.log(e))
  .listen('.friend.approved', (e) => console.log(e))
  .listen('.friend.cancelled', (e) => console.log(e))
  .listen('.friend.removed', (e) => console.log(e))
  .listen('.promoted.admin', (e) => console.log(e))
  .listen('.demoted.admin', (e) => console.log(e))
  .listen('.permissions.updated', (e) => console.log(e))
  .listen('.friend.denied', (e) => console.log(e))
  .listen('.call.kicked', (e) => console.log(e))
  .listen('.thread.read', (e) => console.log(e))
  .listen('.reaction.added', (e) => console.log(e))
  .listen('.reaction.removed', (e) => console.log(e))