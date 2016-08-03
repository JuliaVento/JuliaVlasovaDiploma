window.onload = function() {
	var bigImg = document.getElementById("big_img");
	var thumbGal = document.getElementById("thumb_gal");
	
	
	
	thumbGal.onclick = function(e) {  // Кликаем по ul
      var target = e.target; // узел, в котором произошло событие

      while (target != this) {   // пока target != currentTarget  (с таким же успехом можно написать while (true))

        if (target.nodeName == "A") {  //Только большие буквы - названия тегов
          showThumbnail(target.href, target.title); //увеличить миниатюру, на которую кликнули
          return false; // чтобы не переходило по ссылке
        }

        target = target.parentNode;
      }

    }

    function showThumbnail(href, title) {
      bigImg.src = href;
	  bigImg.alt = title;
	 
    }


    /* предзагрузка картинок */
    var images = thumbGal.getElementsByTagName("img");
    for (var i = 0; i < images.length; i++) {
      var url = images[i].parentNode.href;   // href узла-анкора, которому принадлежит изображение
      var img = document.createElement("img"); // создается элемент <img>
      img.src = url;  // элементу <img> передается src = href узла-анкора, которому принадлежит изображение
    }
	
}