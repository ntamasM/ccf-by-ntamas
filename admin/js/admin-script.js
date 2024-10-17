document.addEventListener("DOMContentLoaded", function () {
  const selectBox = document.querySelector(".custom-select");
  const selected = selectBox.querySelector(".selected");
  const optionsList = selectBox.querySelector(".options");
  const options = selectBox.querySelectorAll(".options li");

  // Set the default value of the custom select element to the value of the hidden select element ntamas_cursor_icon but put and the icon and the text
  const defaultOption = document.querySelector("#ntamas_cursor_select").value;
  const defaultOptionIcon = document.querySelector("#ntamas_cursor_select")
    .dataset.icon;
  selected.innerHTML = `<i class="${defaultOptionIcon}"></i> ${defaultOption}`;

  // Toggle dropdown on click
  selected.addEventListener("click", function () {
    optionsList.style.display =
      optionsList.style.display === "block" ? "none" : "block";
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
    });
  });

  // Close the dropdown if clicked outside
  document.addEventListener("click", function (e) {
    if (!selectBox.contains(e.target)) {
      optionsList.style.display = "none";
    }
  });
});
