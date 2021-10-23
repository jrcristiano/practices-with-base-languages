const reallyRemove = document.querySelector('#really-remove')

reallyRemove.addEventListener('click', (event) => {
    if (!confirm('Deseja mesmo remover?')) {
        return event.preventDefault()
    }

    return true
})