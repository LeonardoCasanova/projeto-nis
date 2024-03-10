// public/js/script.js
document.getElementById('cadastro-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var nome = document.getElementById('nome').value;

    fetch('/cidadao/cadastrar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'nome=' + encodeURIComponent(nome)
    })
    .then(function(response) {
        return response.text();
    })
    .then(function(data) {
        document.getElementById('mensagem').innerText = data;
    })
    .catch(function(error) {
        console.error('Erro:', error);
    });
});
