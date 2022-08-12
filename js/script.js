if (typeof toglePass !== 'undefined') {
    toglePass.onclick = () => {
        if (password.getAttribute('type') == 'password') {
            password.setAttribute('type', 'text');
            toglePass.innerHTML = '<i class="fa-solid fa-eye-slash fa-fw"></i>';
        } else {
            password.setAttribute('type', 'password');
            toglePass.innerHTML = '<i class="fa-solid fa-eye fa-fw"></i>';
        }
    }
}