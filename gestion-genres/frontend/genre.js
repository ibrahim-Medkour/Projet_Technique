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
    setLoadingState(true);


    const data = {
        nom: nomInput.value.trim(),
        description: descriptionInput.value.trim(),
    };

    // Vérifier les champs
    if (data.nom === "" || data.description === "") {
        alert("3afak 3emmer les champs kamlin.");
        return;
    }
    
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
            console.log(result);

            if (result.success) {
                genreForm.reset();
                chargerGenres();
            } else {
                alert(result.message || "Erreur lors de l'ajout.");
            }
        })
        .catch((error) => {
            console.error("Erreur lors de l'ajout du genre :", error);
        })

        // 7. Toujours terminer le chargement
        .finally(() => {
            setLoadingState(false);
        });
});

// 3. Charger les genres au démarrage
chargerGenres();
