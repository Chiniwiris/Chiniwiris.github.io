getHomeCategoriesAJAX();
const categoriesContainer = document.querySelector('.carousel__list');
const addBtn = document.querySelector('.addBtn');
addBtn.addEventListener('click', async e =>{
    const background = document.createElement('div');
    const panel = document.createElement('div');
    const titlebar = document.createElement('div');
    const closeButton = document.createElement('a');
    const ajaxcontent = document.createElement('div');
    const titleBarH3 = document.createElement('H3');
    
    titleBarH3.innerHTML = 'insert new task!';

    background.setAttribute('class', 'background-container');
    panel.setAttribute('class', 'panel-container');
    titlebar.setAttribute('class', 'title-bar-container');
    closeButton.setAttribute('id', 'exit-btn');
    //closeButton.setAttribute('href', '#');
    ajaxcontent.setAttribute('class', 'ajax-content');
    closeButton.innerHTML = 'X';
    
    background.appendChild(panel);
    panel.appendChild(titlebar);
    titlebar.appendChild(titleBarH3);
    panel.appendChild(ajaxcontent);
    panel.appendChild(closeButton);
    document.querySelector('.new-task-container').appendChild(background);

    closeButton.addEventListener('click', e =>{
        background.remove();
    });

    const html = await getContent();
    ajaxcontent.innerHTML = html;

    async function getContent(){
        const html = await fetch('http://localhost/journey-app/home/create').then(res => res.text());
        console.log(html);
        return html;
    }
})

async function getHomeCategoriesAJAX(){
    let data = await fetch('http://localhost/journey-app/home/getThisMonthUserJourney')
        .then(res => res.json())
        .then(res => res);
    
    if(data.length == 0){
        data = await fetch('http://localhost/journey-app/home/getThisMonthUserJourney')
        .then(res => res.json())
        .then(res => res);
        if(data.length == 0) return `<div class="carousel__element">
        <h3 class="carousel__element__category__name">Nothing already</h3>
        <p class="carousel__element__category__hours">0hrs</p>
        </div>`;
    }
    const documentFragment = document.createDocumentFragment();
    
    for(let i = 0; i < data.length; i++){
        const newDiv = document.createElement('DIV');
        const newH3 = document.createElement('H3');
        const newP = document.createElement('P');
        const textNode = document.createTextNode(`${data[i].hours}`);
        
        newDiv.setAttribute('class', 'carousel__element');
        newH3.setAttribute('class', 'carousel__element__category__name');
        newP.setAttribute('class', 'carousel__element__category__hours');

        newH3.style.color = `${data[i].color}`;        
        newH3.innerHTML = `${data[i].name}`;
        newP.innerHTML = `${data[i].hours} hrs`;

        newDiv.appendChild(newH3);
        newDiv.appendChild(newP)

        documentFragment.appendChild(newDiv);
    }
    console.log(documentFragment);
    categoriesContainer.appendChild(documentFragment);
}


