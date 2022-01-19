let select = document.getElementById('user_classes');
let hiddenInput = document.getElementById('courses');
hiddenInput.setAttribute('value', "");

fetch(window.location.origin + '/admin/api/classes')
    .then(res => res.json())
    .then(response => {
        let i = 0;
        Object.values(response).forEach((e) => {
            let newOption = document.createElement('option');
            newOption.setAttribute('name', 'user[classes[' + i + ']]');
            newOption.setAttribute('id', 'user_classes_' + i);
            newOption.setAttribute('value', e.id);
            newOption.textContent = e.label;
            select.append(newOption);
            i++
        })
    })

select.addEventListener('change', () => {
    let inputContent = hiddenInput.textContent
    let inputContentIntoArray = inputContent.split(',');
    createLiForList(select.options[select.selectedIndex].text, select.value);
    inputContentIntoArray.push(select.value);
    if (hiddenInput.getAttribute('value') === "") {
        hiddenInput.setAttribute('value', inputContentIntoArray.join(','));
        hiddenInput.setAttribute('value', hiddenInput.getAttribute('value').substring(1));
    } else {
        hiddenInput.setAttribute('value', hiddenInput.getAttribute('value') + inputContentIntoArray.join(','));
    }

})


function createLiForList(text, id) {
    let displayClassesInUl = document.getElementById('listOfClasses');

    let div = document.createElement('div');
    div.style.display = "flex";
    div.style.alignItems = "center";
    div.style.marginTop = "10px";


    let li = document.createElement('li');
    li.textContent = text;
    li.style.marginRight = "10px";


    let btn = document.createElement('button');
    btn.innerHTML = '<i class="fas fa-trash"></i>';
    btn.setAttribute('class', 'btn btn-danger');
    btn.setAttribute('data-id', id);

    btn.addEventListener('click', (event) => {
        let str = hiddenInput.getAttribute('value');
        let parentDataId = event.target.parentNode.getAttribute('data-id');
        if (str.length !== 1) {
            let array = str.split(',');
            console.log(array);
            let res = array.filter(el => el !== parentDataId);
            console.log(res);
            res = res.join();
            console.log(res);
            hiddenInput.setAttribute('value', res);
        } else {
            hiddenInput.setAttribute('value', '');
        }

        li.parentNode.remove();
    })

    div.append(li);
    div.append(btn)
    displayClassesInUl.append(div);
}