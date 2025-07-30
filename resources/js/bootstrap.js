import axios from "axios";
window.axios = axios;

import toastr from "toastr";
import "toastr/build/toastr.min.css";

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import Echo from "laravel-echo";

import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    enabledTransports: ["ws", "wss"], // Only use WebSocket transport
    authEndpoint: "/broadcasting/auth",
    auth: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content"),
        },
    },
});

// Add debugging for Echo connection
console.log("Echo configuration:", {
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    authEndpoint: "/broadcasting/auth",
});

// Add connection event listeners
window.Echo.connector.pusher.connection.bind("connected", () => {
    console.log("✅ Pusher connected successfully");
});

window.Echo.connector.pusher.connection.bind("error", (error) => {
    console.error("❌ Pusher connection error:", error);
});

window.Echo.connector.pusher.connection.bind("disconnected", () => {
    console.log("⚠️ Pusher disconnected");
});
