const itemContainer = document.querySelector('#items-container');
const deleteBtns = document.querySelectorAll('.delete-btn');
deleteBtns.forEach(btn =>{
    const itemId = btn.dataset.id;
    btn.addEventListener('click', e =>{
        fetch('http://localhost/journey-app/register/delete/' + itemId)
            .then(res => res.text())
            .then(res => {
                console.log(res);
                if(res == 'deleted'){
                    itemContainer.removeChild(document.querySelector('#item-' + itemId));
                } else{
                    console.log('error');
                }
            });
    })
})
