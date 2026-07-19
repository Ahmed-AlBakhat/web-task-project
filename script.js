document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".toggle-btn");

    buttons.forEach((button) => {
        button.addEventListener("click", async () => {
            const id = button.dataset.id;
            const statusElement = document.getElementById(`status-${id}`);

            button.disabled = true;
            button.textContent = "Updating...";

            try {
                const response = await fetch("toggle.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ id: Number(id) })
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.message || "Update failed.");
                }

                statusElement.textContent = result.status;
                statusElement.classList.remove("status-0", "status-1");
                statusElement.classList.add(`status-${result.status}`);
            } catch (error) {
                alert(error.message);
            } finally {
                button.disabled = false;
                button.textContent = "Toggle";
            }
        });
    });
});