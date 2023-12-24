// Полифилл для метода forEach для NodeList
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (let i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}
document.addEventListener('DOMContentLoaded', function() {
    const confirmModal = document.getElementById('confirm-modal');
    const spanClose = confirmModal.querySelector('.close');
    const inputPublicCollection = document.querySelector('.publicCollection__input-hidden');
    let collectionPublicButtons = document.querySelectorAll('.public-collection');

    // Для каждого элемента назначаем обработчик событий
    collectionPublicButtons.forEach(function(button) {
        // При клике на блок "Добавить в коллекцию", открываем общее модальное окно
        button.onclick = function() {
            let collectionId = this.closest('.game-collection').querySelector('.img-game').getAttribute('alt');
            console.log(collectionId);
            inputPublicCollection.value = collectionId;
            console.log(inputPublicCollection.value);
            confirmModal.style.display = 'block';
        }
    });

    // При клике на крестик (закрыть), закрываем модальное окно
    spanClose.onclick = function() {
        confirmModal.style.display = 'none';
    }
    // При клике вне модального окна, закрываем его
    window.onclick = function(event) {
        if (event.target === confirmModal) {
            confirmModal.style.display = 'none';
        }
    }
});
