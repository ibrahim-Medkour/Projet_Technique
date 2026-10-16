const API_URL = "../backend/api/Api_genres.php";

const genreForm = document.getElementById("genreForm");
const nomInput = document.getElementById("Genre");
const descriptionInput = document.getElementById("Description");

const genreTableBody = document.getElementById("genreTableBody");



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


    fetch(API_URL, {

        method: "POST",


        body: JSON.stringify(data)

    })

        .then(response => response.json())

        .then(result => {
               console.log(result);
               genreForm.reset();
                chargerGenres();
           
        })

      

});



chargerGenres();