function updateCard(t, id) {
    var elem = document.getElementById(id)
    var num = t.value
    if (id === 'visualNumber') {
        if (num.length > 16) return t.value = num.substr(0, 16)
        num = num.toString().match(/.{4}/g) ? num.toString().match(/.{4}/g).join(' ') : num;
    }
    elem.innerText = num
}

function protect(t, end) {
    var num = t.value
    t.value = num.substr(num.length - 4, num.length)
}