const checkbox = document.getElementById("myonoffswitch");
checkbox.addEventListener('change', () => {
    // change le theme du site web
    document.body.classList.toggle('dark');
} )