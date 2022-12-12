const modal_2 = document.querySelector("#modal_2");
const openModal_2 = document.querySelector(".open-button_2");
const closeModal_2 = document.querySelector(".close-button_2");

openModal_2.addEventListener("click", () => {
  modal_2.showModal();
});

closeModal_2.addEventListener("click", () => {
  modal_2.close();
});