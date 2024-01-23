let offset = 0; ////Зміщення від лівого краю
const sliderLine = document.querySelector(".slider_line");

document.querySelector(".slider_next").addEventListener("click", function () {
  offset = offset + 450; //
  if (offset > 2250) {
    offset = 0;
  }
  sliderLine.style.left = -offset + "px";
});
document.querySelector(".slider_prev").addEventListener("click", function () {
  offset = offset - 450; //
  if (offset < 0) {
    offset = 2250;
  }
  sliderLine.style.left = -offset + "px";
});
