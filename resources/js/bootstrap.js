import axios from "axios";
window.axios = axios;

import toastr from "toastr";
import "toastr/build/toastr.min.css";

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
