let leftPanel = document.querySelector('.main-section__app__left');
let rightPanel = document.querySelector('.main-section__app__right');
// load file
fetch('getCharacterList.php', {
    method: 'get',
}).then(function(response) {
    if (response.status >= 200 && response.status < 300) {
        return response.text()
    }
    throw new Error(response.statusText)
}).then(function(response) {
    console.log(response)
    document.getElementById('character_list').innerHTML = response;
    getCaracterBoxId();
});
//

getCaracterBoxId()

function getCaracterBoxId (){
    let characterBox = document.querySelectorAll('.main-section__grid__box');
    characterBox.forEach(element => {
        element.addEventListener('click', function (event) {
            var characterId = this.dataset.characterid;

            // acitve content panels
            leftPanel.classList.add('main-section__app__left--active')
            rightPanel.classList.add('main-section__app__right--active')

            fetch('getCharacterContent.php?characterid='+characterId, {
                method: 'get',
            }).then(function(response) {
                if (response.status >= 200 && response.status < 300) {
                    return response.text()
                }
                throw new Error(response.statusText)
            }).then(function(response) {
                document.getElementById('characte_bio').innerHTML = response;
                closePanels();
            });
        })
    })
}

function closePanels()
{
    let closeRightPanel = document.getElementById('close');
    closeRightPanel.addEventListener('click', function (event) {
        // acitve content panels
        leftPanel.classList.remove('main-section__app__left--active')
        rightPanel.classList.remove('main-section__app__right--active')
    })
}
