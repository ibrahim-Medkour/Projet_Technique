const API_URL = "../backend/ap/genre-api.php";

const genreForm = document.getElementById("genreForm");
const nomInput = document.getElementById("nom");
const genreTableBody = document.getElementById("genreTableBody");

const btnSubmit = document.getElementById('btn-submit-form');


function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');

    const toast = document.createElement('div');

    toast.className = `toast toast-${type}`;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

function setLoadingState(isLoading) {
    btnSubmit.disabled = isLoading;

    if (isLoading) {
        btnSubmit.textContent = 'Enregistrement...';
    } else {
        btnSubmit.textContent = 'Enregistrer';
    }
}


// GET : Afficher les genres

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


// POST : Ajouter un genre

genreForm.addEventListener("submit", function(event) {
    // 1. Afficher le chargement
    setLoadingState(true);

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

        showToast(
        "Catégorie enregistrée avec succès !",
        "success"
    );

    genreForm.reset();
    chargerGenres();

    })

    .catch(error => {

        showToast(
        "Erreur lors de l'enregistrement",
        "error"
    );

        console.error("Erreur :", error);

    })

 // 7. Toujours terminer le chargement
    .finally(() => {
        setLoadingState(false);
    });
  
});


// Charger les genres au démarrage

chargerGenres();