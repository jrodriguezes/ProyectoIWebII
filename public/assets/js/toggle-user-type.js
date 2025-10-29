document.addEventListener("DOMContentLoaded", function () {
  const toggleSwitch = document.getElementById("userTypeSwitch");
  const hiddenInput = document.getElementById("user-type");
  const userTypeLabel = document.getElementById("userTypeLabel");

  if (!toggleSwitch || !hiddenInput || !userTypeLabel) {
    return; 
  }

  toggleSwitch.addEventListener("change", function () {
    if (toggleSwitch.checked) {
      hiddenInput.value = "driver";
      userTypeLabel.textContent = "driver";
    } else {
      hiddenInput.value = "passenger";
      userTypeLabel.textContent = "passenger";
    }
  });
});
