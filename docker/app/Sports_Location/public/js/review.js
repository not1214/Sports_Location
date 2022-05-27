const stars = document.querySelector(".scores").children;
const ratingValue = document.getElementById("rating-value");
let index;

for (let i = 0; i < stars.length; i++) {
	// console.log(stars.length)

  stars[i].addEventListener("mouseover", function() {
		for (let j = 0; j < stars.length; j++) {
			stars[j].classList.remove("fa-solid");
			stars[j].classList.add("fa-regular");
		}

    for (let j = 0; j <= i; j++) {
			stars[j].classList.remove("fa-regular");
			stars[j].classList.add("fa-solid");
		}
	})

  stars[i].addEventListener("click", function() {
		ratingValue.value = i + 1;
		index = i;
	})

  stars[i].addEventListener("mouseout", function() {
		for (let j = 0; j < stars.length; j++) {
			stars[j].classList.remove("fa-solid");
			stars[j].classList.add("fa-regular");
		}
		for (let j = 0; j <= index; j++) {
			stars[j].classList.remove("fa-regular");
			stars[j].classList.add("fa-solid");
		}
	})
}
