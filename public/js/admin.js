let select = document.getElementById('user_classes');
let hiddenInput = document.getElementById('courses');

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
    hiddenInput.innerHTML = inputContentIntoArray.join(',');


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
        let array = hiddenInput.textContent.split(',');
        let parent = event.target.parentNode;
        let parentDataId = parent.getAttribute('data-id');
        let newContentForArray = array.splice(array.indexOf(parentDataId) + 1, 1);
        hiddenInput.textContent = newContentForArray.join(',');
        li.parentNode.remove();

    })

    div.append(li);
    div.append(btn)
    displayClassesInUl.append(div);
}