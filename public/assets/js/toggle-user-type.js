document.addEventListener("DOMContentLoaded", function () {
  const toggleSwitch = document.getElementById("userTypeSwitch");
  const hiddenInput = document.getElementById("userType");
  const userTypeLabel = document.getElementById("userTypeLabel");

  toggleSwitch.addEventListener("change", function () {
    if (toggleSwitch.checked) {
      hiddenInput.value = "Driver";
      userTypeLabel.textContent = "Driver";
    } else {
      hiddenInput.value = "Passenger";
      userTypeLabel.textContent = "Passenger";
    }
  });
});
