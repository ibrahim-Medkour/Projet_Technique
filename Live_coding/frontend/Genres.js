const API_URL = "../backend/Controllers/GenreController.php";
const genreForm = document.getElementById("genreForm");
const nomInput = document.getElementById("Genre");
const descriptionInput = document.getElementById("Description");

const genreTableBody = document.getElementById("genreTableBody");

const btnSubmit = document.getElementById('btnSubmit');

function setLoadingState(isLoading) {
    btnSubmit.disabled = isLoading;

    if (isLoading) {
        btnSubmit.textContent = 'Enregistrement...';
    } else {
        btnSubmit.textContent = 'Enregistrer';
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

function chargerGenres() {

    fetch(API_URL)

        .then(response => response.json())

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


}



genreForm.addEventListener("submit", function (event) {

    event.preventDefault();


    const data = {
        nome: nomInput.value,
        description: descriptionInput.value
    };

    // if (!data.nome || !data.description) {
    //     showToast(
    //         "Erreur lors de l'enregistrement",
    //         "error"
    //     );
    //     return;
    // }

    // 1. Afficher le chargement
    setLoadingState(true);


    fetch(API_URL, {

        method: "POST",


        body: JSON.stringify(data)

    })

        .then((response) => {
            return new Promise((resolve) => {
                setTimeout(() => resolve(response), 1000);
            });
        })

        .then(response => response.json())

        .then(result => {
            if (!result.success) {
        showToast(result.message, "error");
        return;
    }

    showToast(result.message, "success");
            genreForm.reset();
            chargerGenres();

        })
        .catch(error => {
    console.error("Erreur :", error);
    showToast("Une erreur est survenue", "error");
})

        // 7. Toujours terminer le chargement
        .finally(() => {
            setLoadingState(false);
        });

});




chargerGenres();