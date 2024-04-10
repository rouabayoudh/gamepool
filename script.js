const bgAnimation = document.getElementById('bgAnimation');

const numberOfColorBoxes = 400;

for (let i = 0; i < numberOfColorBoxes; i++) {
    const colorBox = document.createElement('div');
    colorBox.classList.add('colorBox');
    bgAnimation.append(colorBox)
}

const pageMusic = document.getElementById("page-music");


// Play the music when the user interacts with the page
document.addEventListener("mousemove", () => {
  pageMusic.play();
});

// Stop the music when the page is not visible
document.addEventListener("visibilitychange", () => {
  if (document.hidden) {
    pageMusic.pause();
  } else {
    pageMusic.play();
  }
});


const audio = document.getElementById("bg-music");
audio.volume = 0.4; // set the volume to 40%
