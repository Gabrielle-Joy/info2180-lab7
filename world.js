// Gabrielle Higgins

document.addEventListener("DOMContentLoaded", ()=>{
    const button = document.querySelector("#lookup");
    let country;
    
    const divResult = document.querySelector("#result");
    
    button.addEventListener("click", () => {
        country = document.getElementById("country").value;
        $.get("world.php", 
        {
            query: country 
        }).done(function(response){ 
            let resp = response; 
            divResult.innerHTML= response;
        }).fail(()=>{
            alert("Something went wrong");
        });
    });
});
