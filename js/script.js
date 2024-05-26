document
  .getElementById("dropdownButton")
  .addEventListener("click", function () {
    document.getElementById("dropdownMenu").classList.toggle("hidden");
  });

document.addEventListener("click", function (event) {
  var isClickInside = document
    .getElementById("dropdownButton")
    .contains(event.target);
  if (!isClickInside) {
    document.getElementById("dropdownMenu").classList.add("hidden");
  }
});


const navActive = document.getElementById('active');

navActive.addEventListener('click', () => {
  navActive.classList.toggle('hidden');
});
