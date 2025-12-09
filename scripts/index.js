const decade = document.querySelector('.decade');
const comicCovers = document.getElementsByClassName('comic-covers');
const comics = comicCovers[0].getElementsByClassName('comic');
const expandedInfo = document.getElementsByClassName('expanded-info');

console.log(decade);

function removeExpandClass(el) {
  el.classList.remove('expanded');
};

function addContractClass(el) {
  el.classList.add('contracted');
};

function addHiddenClass(el) {
    el.classList.add('hidden');
};

function hideAll(els) {
  const total = els.length;

  for (let i = 0; i < total; i++) {
    addHiddenClass(els[i]);
  };
};

function onlyDisplayFirst(els) {
  const total = els.length;

  for (let i = 1; i < total; i++) {
    addHiddenClass(els[i]);
  };
};

/*
function toggleContent(e) {
};
*/

removeExpandClass(decade);
addContractClass(decade);
onlyDisplayFirst(comics);
hideAll(expandedInfo);
//decade.addEventListener('pointerdown', toggleContent(e));
