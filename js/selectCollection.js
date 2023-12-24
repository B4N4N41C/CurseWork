// Полифилл для метода forEach для NodeList
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (let i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}

import { altId } from './modalAddToCollection.js';
document.querySelectorAll('.modal').forEach(function (modal) {
    let collectionListItems = modal.querySelectorAll('.select-collection');
    let collectionInput = modal.querySelector('.collection__input-hidden');
    let gameInput = modal.querySelector('.game__input-hidden');
    collectionListItems.forEach(function (listItem){
        listItem.addEventListener('click', function (e){
            e.stopPropagation();
            gameInput.value = altId;
            collectionInput.value = this.dataset.value;
        })
    })
})
