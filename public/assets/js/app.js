let btnResponse = document.getElementsByClassName('reply');
let form = document.getElementById('form_reply');

function insertAfter(el, referenceNode) {
    referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
}

Array.from(btnResponse).forEach(function(element) {
    element.addEventListener("click", function (e) {
        e.preventDefault();

        document.getElementById("reply_id").value = element.dataset.id;

        insertAfter(form, element.parentNode);

        form.style.display = "block";

    });
});