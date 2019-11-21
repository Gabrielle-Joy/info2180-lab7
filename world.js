// Gabrielle Higgins

document.addEventListener("DOMContentLoaded", ()=>{
    const country_button = document.querySelector("#country-lookup");
    const cities_button = document.querySelector("#cities-lookup");
    let country;
    let city;
    
    const divResult = document.querySelector("#result");
    
    country_button.addEventListener("click", () => {
        country = document.getElementById("country").value;
        $.get("world.php", 
        {
            country: country 
        }).done(function(response){ 
            let resp = response; 
            divResult.innerHTML= response;
        }).fail(()=>{
            alert("Something went wrong");
        });
    });
    
    cities_button.addEventListener("click", () => {
        country = document.getElementById("country").value;
        $.get("world.php", 
        {
            country: country,
            context: 'cities'
        }).done(function(response){ 
            let resp = response; 
            divResult.innerHTML= response;
        }).fail(()=>{
            alert("Something went wrong");
        });
    });
});
