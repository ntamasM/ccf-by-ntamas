document.addEventListener("DOMContentLoaded", function () {
  const selectBox = document.querySelector(".custom-select");
  const selected = selectBox.querySelector(".selected");
  const optionsList = selectBox.querySelector(".options");
  const options = selectBox.querySelectorAll(".options li");

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
