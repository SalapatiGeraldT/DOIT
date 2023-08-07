// Import necessary libraries and modules
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

// Set the base URL for API requests
axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1/";


export default function useTasks() {
    // Reactive references for tasks, task, and errors
    const tasks = ref([]);
    const task = ref([]);
    const errors = ref([]);
    const router = useRouter();

    /**
     * Fetch all tasks from the server.
     * @throws {Error} If the request fails with status code 401 or other unhandled errors.
     */
    const getTasks = async () => {
        try {
            const response = await axios.get("tasks");
            tasks.value = response.data.data;
        } catch (error) {
            if (error.response.status === 401) {
                // Token invalid or expired, clear local storage data
                localStorage.removeItem("token");
                localStorage.removeItem("firstName");
                token.value = null;
                firstName.value = null;
            }

            if (error.response && error.response.status === 422) {
                // Handle validation errors
                errors.value = error.response.data.errors;
            } else {
                // Handle other errors
                console.error(error);
            }
        }
    };

    /**
     * Fetch a single task from the server.
     * @param {number} id - The ID of the task to fetch.
     * @throws {Error} If the request fails.
     */
    const getTask = async (id) => {
        const response = await axios.get("tasks/" + id);
        task.value = response.data.data;
    };

    /**
     * Create a new task and store it on the server.
     * @param {Object} data - The data representing the new task.
     * @throws {Error} If the request fails or validation errors occur.
     */
    const storeTask = async (data) => {
        errors.value = [];

        const accessToken = localStorage.getItem("token");
        try {
            await axios.post("tasks", data, {
                headers: {
                    Authorization: `Bearer ${accessToken}`,
                },
            });

            await router.push({ name: "Dashboard" });
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

    /**
     * Update an existing task on the server.
     * @param {number} id - The ID of the task to update.
     * @throws {Error} If the request fails or validation errors occur.
     */
    const updateTask = async (id) => {
        errors.value = [];

        const accessToken = localStorage.getItem("token");
        try {
            // await axios.put("posts/" + id, post.value);
            await axios.put("tasks/" + id, task.value, {
                headers: {
                    Authorization: `Bearer ${accessToken}`,
                },
            });

            await router.push({ name: "Dashboard" });
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

    /**
     * Delete a task from the server.
     * @param {number} id - The ID of the task to delete.
     * @throws {Error} If the request fails.
     */
    const destroyTask = async (id) => {
        if (!window.confirm("Are You Sure?")) {
            return;
        }

        const accessToken = localStorage.getItem("token");
        await axios.delete("tasks/" + id, {
            headers: {
                Authorization: `Bearer ${accessToken}`,
            },
        });
        await getTasks();
    };

    /**
     * Update the status of a task on the server.
     * @param {number} id - The ID of the task to update.
     * @param {string} status - The current status of the task.
     * @throws {Error} If the request fails.
     */
    const updateTaskStatus = async (id, status) => {
        let newStatus = '';
        if (status === "TODO") {
            newStatus = "DOING";
        } else if (status === "DOING") {
            newStatus = "DONE";
        } else if (status === "DONE") {
            newStatus = 'TODO';
        }
    
        const accessToken = localStorage.getItem("token");
        const response = await axios.post(
            "tasks/status/update/" + id + "/" + newStatus,
            {
                headers: {
                    Authorization: `Bearer ${accessToken}`,
                },
            }
        );
        await getTasks();
    };
    
    // Return the public API for this hook
    return {
        task,
        tasks,
        getTask,
        getTasks,
        storeTask,
        updateTask,
        destroyTask,
        updateTaskStatus,
        errors,
    };
}
