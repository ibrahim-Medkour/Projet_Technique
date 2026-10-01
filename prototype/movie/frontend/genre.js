const API_URL = "../backend/api/genre-api.php";

const genreForm = document.getElementById("genreForm");
const nomInput = document.getElementById("nom");
const genreTableBody = document.getElementById("genreTableBody");


// ========================================
// GET : Afficher les genres
// ========================================

function chargerGenres() {

    fetch(API_URL)

        .then(response => response.json())

        .then(result => {

            genreTableBody.innerHTML = "";

            result.data.forEach(genre => {

                const ligne = document.createElement("tr");

                ligne.innerHTML = `
                    <td>${genre.id}</td>
                    <td>${genre.nom}</td>
                `;

                genreTableBody.appendChild(ligne);

            });

        })

        .catch(error => {
            console.error("Erreur :", error);
        });
}


// ========================================
// POST : Ajouter un genre
// ========================================

genreForm.addEventListener("submit", function(event) {

    event.preventDefault();


    const data = {
        nom: nomInput.value
    };


    fetch(API_URL, {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify(data)

    })

    .then(response => response.json())

    .then(result => {

        console.log(result);


        if (result.status === "success") {

            // Vider input
            nomInput.value = "";

            // Actualiser la liste
            chargerGenres();

        } else {

            alert(result.message);
        }

    })

    .catch(error => {

        console.error("Erreur :", error);

    });

});


// ========================================
// Charger les genres au démarrage
// ========================================

chargerGenres();