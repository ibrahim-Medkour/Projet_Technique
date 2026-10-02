const API_URL="../backend/api/api_genres.php"

const form_genre=document.getElementById('genreForm');
const InputNom=document.getElementById('nom');
const Inputdescription=document.getElementById('description');
const tableBody=document.getElementById('tableBody');

function Genre (){
fetch(API_URL)
.then(response => response.json())
.then(resultat =>{
 
    tableBody.innerHTML="";
 
    resultat.data.forEach(genre => {
    
        const ligne=document.createElement('tr');
        
        ligne.innerHTML=`
            <td>${genre.id}</td>
            <td>${genre.nom}</td>
            <td>${genre.description}</td>      
        `
    tableBody.appendChild(ligne);
    });
    
    
});
}

form_genre.addEventListener("submit",(event)=>{
  event.preventDefault();

    const data={
      nom :InputNom.value,
      description: Inputdescription.value
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
        Genre();

        form_genre.reset();
    });

    

});

Genre();





