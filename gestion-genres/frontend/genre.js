const API_URL = "../backend/api/genre-api.php";

const genreForm = document.getElementById("genreForm");

const nomInput = document.getElementById("Genre");
const descriptionInput = document.getElementById("Description");

const genreTableBody = document.getElementById("genreTableBody");

const btnSubmit = document.getElementById("btn-submit-form");


function setLoadingState(isLoading) {
    btnSubmit.disabled = isLoading;
    if (isLoading) {
        btnSubmit.textContent = "Enregistrement...";
    } else {
        btnSubmit.textContent = "Enregistrer";
    }
}



function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');

    const colors = type === 'success'
        ? 'bg-green-100 text-green-800 border-green-500'
        : 'bg-red-100 text-red-800 border-red-500';

    toast.className = `
        ${colors}
        border-l-4
        p-4
        mb-3
        rounded-lg
        shadow-md
        text-sm
        font-medium
    `;
    toast.textContent = message;
    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// 1. Charger les genres
function chargerGenres() {
    fetch(API_URL)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }

            return response.json();
        })
        .then((genres) => {
            genreTableBody.innerHTML = "";

            genres.forEach((genre) => {
                const ligne = document.createElement("tr");

                ligne.innerHTML = `
                    <td>${genre.id}</td>
                    <td>${genre.nom}</td>
                    <td>${genre.description}</td>
                `;

                genreTableBody.appendChild(ligne);
            });
        })
        .catch((error) => {
            console.error("Erreur lors du chargement des genres :", error);
        });
}

// 2. Ajouter un genre
genreForm.addEventListener("submit", function (event) {
    event.preventDefault();



    const data = {
        nom: nomInput.value.trim(),
        description: descriptionInput.value.trim(),
    };


    if (!data.nom || !data.description) {
        showToast('Veuillez remplir tous les champs', 'error');
        return;
    }
    setLoadingState(true);
    fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })

        .then((response) => {
            return new Promise((resolve) => {
                setTimeout(() => resolve(response), 1000);
            });
        })
        .then((response) => {

            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }

            return response.json();
        })
        .then((result) => {
            showToast(
                "Catégorie enregistrée avec succès !",
                "success"

            );
            console.log(result);

            if (result.success) {
                genreForm.reset();
                chargerGenres();
            } else {
                alert(result.message || "Erreur lors de l'ajout.");
            }
        })
        .catch((error) => {
            showToast(
                "Erreur lors de l'enregistrement",
                "error"
            );
            console.error("Erreur lors de l'ajout du genre :", error);
        })

        // 7. Toujours terminer le chargement
        .finally(() => {
            setLoadingState(false);
        });
});

// 3. Charger les genres au démarrage
chargerGenres();
