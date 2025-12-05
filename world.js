window.onload =function(){
    const lookupBtn = document.getElementById("lookup")
    const resultD =document.getElementById("result")

    lookupBtn.addEventListener("click", function (){
         const country = document.getElementById("country").value.trim();
         
         fetch("world.php?country="+ country)
            .then(response=> response.text())
            .then(data=> {
                resultD.innerHTML =data;
            })
            .catch(error => {
                resultD.innerHTML = "Error fecthing data";
            })
    })
}