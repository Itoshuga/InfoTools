window.onload = defilImg
    current_img = 0;
        arrImg = ['img/accueil/coding.jpg','img/accueil/water.jpg','img/accueil/japan.jpg'] //Création d'une liste d'argument avec le chemin qui mène aux images
                 
                 
    function defilImg() { //Création de la Fonction DefilImg
        if(current_img == arrImg.length)
            current_img = 0; 
            document.getElementById('image').src = arrImg[current_img++]; //Affichage des images uniquement si une balise contient l'id "image"
            window.setTimeout('defilImg()',5000); //Transition entre les images = 5 sec
        }   