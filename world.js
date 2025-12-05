window.onload =function(){
    const countryBtn = document.getElementById("lookup")
    const resultD =document.getElementById("result")
    const citiesBtn = document.getElementById("lookup-cities")
    const countryInput = document.getElementById("country")


    countryBtn.addEventListener("click", function (){
         const country = countryInput.value.trim();
         
         fetch("world.php?country="+ encodeURIComponent(country))
            .then(response=> response.text())
            .then(data=> {
                resultD.innerHTML =data;
            })
            .catch(error => {
                resultD.innerHTML = "Error fetching Countries";
            })



    })

    citiesBtn.addEventListener("click", function (){
         const country = countryInput.value.trim();
         
         fetch("world.php?country="+ encodeURIComponent(country)+ "&lookup=cities")
            .then(response=> response.text())
            .then(data=> {
                resultD.innerHTML =data;
            })
            .catch(error => {
                resultD.innerHTML = "Error fetching Cities";
            })

    })


}