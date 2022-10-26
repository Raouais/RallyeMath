let e = document.getElementById('civility')
    
let input = document.createElement('input')
input.name = "others"
input.type = "text"

let value
let text 
let div = document.getElementById('others')

e.addEventListener('click', _ => {
    value = e.options[e.selectedIndex].value;
    text = e.options[e.selectedIndex].text;
    if(value == "others"){
        div.appendChild(input)
    } else {
        if(div.hasChildNodes(input)){
            div.removeChild(input)
        }
    }
})
