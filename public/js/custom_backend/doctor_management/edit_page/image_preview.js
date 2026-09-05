document.addEventListener('DOMContentLoaded',function(){
    const imageInput=document.getElementById('doctorImageInput');
    const imagePreview=document.getElementById('doctorPreviewImage');
    const imageName=document.getElementById('imageFileName');

    if(!imageInput||!imagePreview)return;

    const defaultImage=imagePreview.src;

    imageInput.addEventListener('change',function(){

        const file=this.files[0];

        if(!file){
            imagePreview.src=defaultImage;

            if(imageName){
                imageName.textContent='No new image selected';
            }

            return;
        }

        if(!file.type.startsWith('image/')){
            this.value='';
            imagePreview.src=defaultImage;

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
