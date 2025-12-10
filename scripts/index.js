const decade = document.querySelector('.decade');
const comicCovers = document.getElementsByClassName('comic-covers');
const comics = comicCovers[0].getElementsByClassName('comic');
const expandedInfo = document.getElementsByClassName('expanded-info');
const expandContractToggles = document.getElementsByClassName('expand-contract-toggle');

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

function toggleVisibility(el) {
  el.classList.toggle('hidden');
};

function toggleContent(e) {
  if (e.target.textContent == 'See More' && expandedInfo[0].classList.contains('hidden')) {
    toggleVisibility(expandedInfo[0]);
    e.target.textContent = 'See Less';
  } else if (e.target.textContent == 'See Less' && !(expandedInfo[0].classList.contains('hidden'))) {
    toggleVisibility(expandedInfo[0]);
    e.target.textContent = 'See More';
  }
};

removeExpandClass(decade);
addContractClass(decade);
onlyDisplayFirst(comics);
hideAll(expandedInfo);

for (let toggle in expandContractToggles) {
  expandContractToggles[toggle].addEventListener('pointerdown', toggleContent);
}
