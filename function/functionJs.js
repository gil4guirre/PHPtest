function cepMask(text) {
    if(event.keyCode == 8 || event.keyCode == 13 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) return;
    let key = event.key

    let regex = new RegExp("\\d")
    if(!regex.test(key)){
        event.preventDefault()
        return;
    }

    let value = event.target.value
    let valueOnlyNumber = value.replace(/\D/gi,"")
    let stringSize = valueOnlyNumber.length

    let lastString = value.substr(-1)
    if(lastString == "-") return;

    if(stringSize == 5) event.target.value = event.target.value + "-"
}

function copyToClipboard(text){
    text.select();
    document.execCommand('copy');
    text.blur();
}