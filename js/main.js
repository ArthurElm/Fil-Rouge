function getUsernameOnSubmit() {
    var form = document.querySelector('.formulaire');
    var url = window.location.pathname;

    function getUsername(event) {
        event.preventDefault();
        var usernameInput = document.querySelector(".formulaire input[name = 'username']");
        var username = usernameInput.value

        if(url=="/C:/laragon/www/fil_rouge_ft_js/index.html"){
            newElement = document.querySelector(".sondages div p:first-child");
            newElement.textContent = username;
        }else if (url =="/C:/laragon/www/fil_rouge_ft_js/classement.html"){
            newElement = document.querySelector(".moi .name .lesnoms p");
            newElement.textContent = username;
        }

    }
    form.addEventListener("submit", getUsername)
}

$(document).ready(function(){
    getUsernameOnSubmit();
});