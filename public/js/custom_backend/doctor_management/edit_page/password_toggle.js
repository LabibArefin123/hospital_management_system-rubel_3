document.addEventListener('DOMContentLoaded',function(){
    const toggleButtons=document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(function(button){

        button.addEventListener('click',function(){

            const targetId=this.dataset.target;
            const passwordInput=document.getElementById(targetId);
            const icon=this.querySelector('i');

            if(!passwordInput||!icon)return;

            const isPassword=passwordInput.type==='password';

            passwordInput.type=isPassword?'text':'password';

            icon.classList.toggle('fa-eye',!isPassword);
            icon.classList.toggle('fa-eye-slash',isPassword);

        });

    });

});

