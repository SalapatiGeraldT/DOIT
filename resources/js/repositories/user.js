// Import necessary libraries and modules
import { ref } from "vue";
import axios from "axios";
import { useRouter } from 'vue-router';

// Set the base URL for API requests
axios.defaults.baseURL = "http://127.0.0.1:8000/api/user/";


export default function useUsers(){
    // Reactive references for errors, router, and message
    const errors = ref([]);
    const router = useRouter();
    const message = ref();

    /**
     * Store a new user by registering on the server.
     * @param {Object} data - The data representing the new user.
     * @throws {Error} If the request fails or validation errors occur.
     */
    const storeUser = async (data) => {
        errors.value = [];
        try {
            await axios.post("register", data);
            await router.push({name: "Login"});
        } catch (error) {
            if (error.response.status === 422) {
                // Handle validation errors
                errors.value = error.response.data.errors;
            }
        }
    };

    /**
     * Login a user with the provided credentials.
     * @param {Object} data - The login credentials.
     * @throws {Error} If the request fails or validation errors occur.
     */
    const loginUser = async (data) => {
        errors.value = []; 
        message.value = null; 
   
        try {
            // Send login request and handle the response accordingly
            await axios.post('login', data).then(res=>{
                if(res.data.success){
                    // Successful login, store token and user data in local storage
                    localStorage.setItem('token', res.data.data.token);
                    const userName = res.data.data.name;
                    const firstName = userName.trim().split(" ")[0];
                    localStorage.setItem('firstName', firstName);
                    window.location.reload();
                    
                }else{
                    // Unsuccessful login, display error message
                    message.value = res.data.message;
                }
            });
        } catch (error) {
            if (error.response && error.response.status === 422) {
                // Handle validation errors
                errors.value = error.response.data.errors;
            } else {
                // Handle other errors
                console.error(error);
            }
        }
    };

    // Return the public API for this hook
    return {
        storeUser,
        loginUser,
        errors,
        message
    };
}
