// CONFETTI START
const button = document.getElementById('btn-stop');
const canvas = document.querySelector('#confetti');

const jsConfetti = new JSConfetti();

button.addEventListener('click', () => {
    jsConfetti.addConfetti({
        emojis: ['🌈', '⚡️', '💥', '✨', '💫', '🌸'],
    }).then(() => jsConfetti.addConfetti())
})
// CONFETTI END

// doorprice select start
const itemSelect = document.getElementById('itemSelect');
const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');

// Function item sebelumnya
function selectPreviousItem() {
    const selectedIndex = itemSelect.selectedIndex;
    if (selectedIndex > 0) {
        itemSelect.selectedIndex = selectedIndex - 1;
    }
}

// Function item berikutnya
function selectNextItem() {
    const selectedIndex = itemSelect.selectedIndex;
    if (selectedIndex < itemSelect.options.length - 1) {
        itemSelect.selectedIndex = selectedIndex + 1;
    }
}

prevButton.addEventListener('click', selectPreviousItem);
nextButton.addEventListener('click', selectNextItem);

// Menggunakan keyboard untuk memilih item
document.addEventListener('keydown', function (event) {
    switch (event.key) {
        case 'ArrowLeft':
            selectPreviousItem();
            break;
        case 'ArrowRight':
            selectNextItem();
            break;
    }
});
// doorprice select start

