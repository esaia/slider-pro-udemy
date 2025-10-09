import axios from "axios";

const ajaxAxios = axios.create({
  baseURL: sliderPro.ajax_url,
  withCredentials: true,
  headers: {
    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
  }
});

export default ajaxAxios;
