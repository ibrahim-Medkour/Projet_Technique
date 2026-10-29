
const API_URL = "../backend/api/genre-api.php";

const genreForm = document.getElementById("genreForm");
const nomInput = document.getElementById("Genre");
const descriptionInput = document.getElementById("Description");
const genreTableBody = document.getElementById("genreTableBody");

// 1. Charger les genres
function chargerGenres() {
    fetch(API_URL)
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }

            return response.json();
        })
        .then(result => {
            genreTableBody.innerHTML = "";

            result.forEach(genre => {
                const ligne = document.createElement("tr");

                ligne.innerHTML = `
                    <td>${genre.id}</td>
                    <td>${genre.nom}</td>
                    <td>${genre.description}</td>
                `;

                genreTableBody.appendChild(ligne);
            });
        })
        .catch(error => {
            console.error("Erreur lors du chargement :", error);
        });
}

// 2. Ajouter un genre
genreForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const data = {
        nom: nomInput.value.trim(),
        description: descriptionInput.value.trim()
    };

    fetch(API_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }

            return response.json();
        })
        .then(result => {
            console.log(result);

            genreForm.reset();
            chargerGenres();
        })
        .catch(error => {
            console.error("Erreur lors de l'ajout :", error);
        });
});

// 3. Charger les genres au démarrage
chargerGenres();
