document.addEventListener("DOMContentLoaded", function () {
  const currentPage = window.location.pathname.split("/").pop();

  const allowedPage = ["edit-profile"];

  if (allowedPage.includes(currentPage)) {
    const toggleSwitch = document.getElementById("userTypeSwitch");
    const userType = document.getElementById("user-type");
    const userTypeLabel = document.getElementById("userTypeLabel");
    const initialUserType = document.getElementById("initial_user_type");

    const isEdit = !!document.getElementById("edit_profile");

    function applyState() {
      if (isEdit) {
        userType.value = toggleSwitch.checked
          ? "driver&passenger"
          : initialUserType.value;
        userTypeLabel.textContent = userType.value;
      } else {
        userType.value = toggleSwitch.checked ? "driver" : "passenger";
        userTypeLabel.textContent = userType.value;
      }
    }

    applyState(); // Ejecuta al cargar
    toggleSwitch.addEventListener("change", applyState); // Ejecuta al cambiar
  }
});
