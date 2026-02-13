document.getElementById("testConnection").addEventListener("click", function(){

    let resultDiv = document.getElementById("testResult");
    resultDiv.innerHTML = "Testing connection...";

    fetch("settings.php?action=test")
    .then(res => res.json())
    .then(data => {
        if(data.success){
            resultDiv.innerHTML = "<span style='color:green'>Connected successfully</span>";
        } else {
            resultDiv.innerHTML = "<span style='color:red'>Connection failed</span>";
        }
    });
});
