const selectElement = document.querySelector("select");
selectElement.addEventListener("change", function () {
  const selectedOption = selectElement.options[selectElement.selectedIndex];
  const iconClass = selectedOption.dataset.icon;
  selectElement.style.backgroundImage = `url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/webfonts/${iconClass}.svg')`;
});
