let btnResponse = document.getElementsByClassName('reply');

Array.from(btnResponse).forEach(function(element) {
    element.addEventListener("click", function (e) {
        e.preventDefault();
        console.log('coucou');
    });
});


