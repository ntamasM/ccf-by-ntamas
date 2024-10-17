document.addEventListener("DOMContentLoaded", function () {
  const selectBox = document.querySelector(".custom-select");
  const selected = selectBox.querySelector(".selected");
  const optionsList = selectBox.querySelector(".options");
  const options = selectBox.querySelectorAll(".options li");
  const searchBox = selectBox.querySelector(".search-box");
  const searchInput = searchBox.querySelector("input");

  // Set the default value of the custom select element to the value of the hidden select element ntamas_cursor_icon but put and the icon and the text
  const defaultOption = document.querySelector("#ntamas_cursor_select").value;
  selected.innerHTML = `<i class="${defaultOption}"></i> ${defaultOption}`;

  // Toggle dropdown and search bar on click
  selected.addEventListener("click", function () {
    optionsList.style.display =
      optionsList.style.display === "block" ? "none" : "block";
    searchBox.style.display =
      searchBox.style.display === "block" ? "none" : "block";
    searchInput.value = ""; // Clear the search input
    filterOptions(""); // Reset the options to all visible
  });

  // Update the selected option
  options.forEach((option) => {
    option.addEventListener("click", function () {
      const icon = this.querySelector("i").outerHTML;
      const text = this.textContent.trim();
      selected.innerHTML = `${icon} ${text}`;
      // after selecting, change the value of the hidden select element ntamas_cursor_icon to the selected option
      document.querySelector("#ntamas_cursor_select").value = text;
      optionsList.style.display = "none"; // Close dropdown after selecting
      searchBox.style.display = "none"; // Hide search box after selection
    });
  });

  searchInput.addEventListener("keyup", function () {
    const filter = this.value.toLowerCase();
    filterOptions(filter);
  });

  function filterOptions(filter) {
    options.forEach((option) => {
      const text = option.textContent.toLowerCase();
      if (text.includes(filter)) {
        option.style.display = "flex";
      } else {
        option.style.display = "none";
      }
    });
  }

  // Close the dropdown if clicked outside
  document.addEventListener("click", function (e) {
    if (!selectBox.contains(e.target)) {
      optionsList.style.display = "none";
      searchBox.style.display = "none";
    }
  });
});
