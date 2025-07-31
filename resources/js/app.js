import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.Echo.channel("chat").listen(".message.sent", (e) => {
    console.log("Message received:", e.message);
});
