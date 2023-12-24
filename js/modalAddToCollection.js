let altId;
// Получаем все элементы с классом "add-to-collection"
const collectionButtons = document.querySelectorAll('.add-to-collection');
// Получаем общее модальное окно
const modal = document.getElementById('myModal');
// Получаем элемент закрытия модального окна
const span = modal.querySelector('.close');
// Для каждого элемента назначаем обработчик событий
collectionButtons.forEach(function(button) {
    // При клике на блок "Добавить в коллекцию", открываем общее модальное окно
    button.onclick = function() {
        altId = this.closest('.game').querySelector('.img-game').getAttribute('alt');
        console.log(altId);
        modal.style.display = 'block';
    }
});
// При клике на крестик (закрыть), закрываем модальное окно
span.onclick = function() {
    modal.style.display = 'none';
}
// При клике вне модального окна, закрываем его
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
export { altId };