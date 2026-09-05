document.addEventListener('DOMContentLoaded',function(){

    const imageInput=document.getElementById('doctorImageInput');
    const imagePreview=document.getElementById('doctorImagePreview');
    const imageName=document.getElementById('doctorImageName');

    if(!imageInput||!imagePreview)return;

    imageInput.addEventListener('change',function(){

        const file=this.files[0];

        if(!file){
            imagePreview.src='/uploads/images/default.jpg';

            if(imageName){
                imageName.textContent='No image selected';
            }

            return;
        }

        if(!file.type.startsWith('image/')){
            this.value='';
            imagePreview.src='/uploads/images/default.jpg';

            if(imageName){
                imageName.textContent='Please select a valid image';
            }

            return;
        }

        const reader=new FileReader();

        reader.onload=function(event){
            imagePreview.src=event.target.result;
        };

        reader.readAsDataURL(file);

        if(imageName){
            imageName.textContent=file.name;
        }
    });

});

