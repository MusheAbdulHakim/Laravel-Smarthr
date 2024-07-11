let token = document.head.querySelector('meta[name="csrf-token"]');
window.Laravel = { csrfToken: token.content };

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error("CSRF token not found");
}

/**
 * Load dependencies used across this app
 * Autolinker makes text links clickable
 * Toastr is used for notification popups
 * Autosize allows textareas to grow dynamically
 * Validator is for BS3 and adds validation to forms using html5 attr
 */
import { v4 as uuidv4 } from "uuid";
import autolinker from "autolinker";
import toastr from "toastr";
import relativeTime from "dayjs/plugin/relativeTime";
import utc from "dayjs/plugin/utc";
import advancedFormat from "dayjs/plugin/advancedFormat";
import dayjs from "dayjs";
window.Autolinker = autolinker;
window.toastr = toastr;
dayjs.extend(relativeTime);
dayjs.extend(advancedFormat);
dayjs.extend(utc);
window.dayjs = dayjs;
window.uuid = uuidv4();

import "simplebar";

/**
 * Now we need to load in our global app controllers (Routers)
 * Messenger holds global methods and common data
 * PageListeners holds events and watchers to be called
 * on any page at any time
 */
import "./Messenger.js";
import "./managers/PageListeners.js";
import "./managers/InactivityManager.js";
import "./managers/CallManager.js";
import "./managers/NotifyManager.js";
import "./managers/FriendsManager.js";
import "./managers/ThreadManager.js";
import "./modules/ThreadBots.js";
import "./templates/ThreadTemplates.js";
import "./modules/MessengerSettings.js";
import "./modules/RecordAudio.js";
import "./modules/InviteJoin.js";
import "./modules/EmojiPicker.js";
