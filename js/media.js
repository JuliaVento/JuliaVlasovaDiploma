window.onload = function() {
	var descript = document.getElementById("med_blocks");
	var arr = descript.childNodes;
	var photo = document.getElementById("photogallery");
	var video = document.getElementById("thaiVideo");
	var audio = document.getElementById("thaiAudio");

	for(i = 1; i < arr.length; i+=2) {
		arr[i].onmouseover = function() {
			this.childNodes[2].childNodes[3].style.display = "block";
		}
		arr[i].onmouseout = function() {
			this.childNodes[2].childNodes[3].style.display = "none";
		}			
	}	

	arr[5].onclick = function() {
		photo.style.display = "block";
		video.style.display = "none";
		audio.style.display = "none";		
	}

	arr[1].onclick = function() {
		photo.style.display = "none";
		video.style.display = "block";
		audio.style.display = "none";
	}

	arr[3].onclick = function() {
		photo.style.display = "none";	
		video.style.display = "none";
		audio.style.display = "block";
	}	
		
	photogal_init();
};


