const profile = document.querySelector(".profile")
const box = document.querySelector('.box')
const close = document.querySelector('.close')

profile.addEventListener('click', function() {
    box.classList.toggle('hidde')
})

close.addEventListener('click', function() {
    box.classList.add('hidde')
})