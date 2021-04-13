const bigimg = document.querySelector('img[id="bigimg"]');
const imga = document.querySelector('img[id="imga"]');
const imgb = document.querySelector('img[id="imgb"]');
function switcha(){
    imgb.classList.remove('active');
    imga.classList.add('active');
    bigimg.src=imga.src;
}
function switchb(){
    imga.classList.remove('active');
    imgb.classList.add('active');
    bigimg.src=imgb.src;
}
imga.addEventListener('click',switcha);
imgb.addEventListener('click',switchb);