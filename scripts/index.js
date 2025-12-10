const decades = document.getElementsByClassName('decade');
const comicCovers = document.getElementsByClassName('comic-covers');
const allExpandedInfo = document.getElementsByClassName('expanded-info');
const expandContractToggles = document.getElementsByClassName('expand-contract-toggle');

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
  const decade = e.target.parentElement;
  const expandedInfo = decade.querySelector('.expanded-info');

  if (e.target.textContent == 'See More' && expandedInfo.classList.contains('hidden')) {
    toggleVisibility(expandedInfo);
    e.target.textContent = 'See Less';
  } else if (e.target.textContent == 'See Less' && !(expandedInfo.classList.contains('hidden'))) {
    toggleVisibility(expandedInfo);
    e.target.textContent = 'See More';
  }
};

hideAll(allExpandedInfo);

for (let i = 0; i < comicCovers.length; i++) {
  const comics = comicCovers[i].getElementsByClassName('comic');

  removeExpandClass(decades[i]);
  addContractClass(decades[i]);
  onlyDisplayFirst(comics);
}

for (let i = 0; i < expandContractToggles.length; i++) {
  expandContractToggles[i].addEventListener('pointerdown', toggleContent);
}
