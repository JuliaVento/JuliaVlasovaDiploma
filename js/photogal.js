function photogal_init(){
	img1 = new Image();
	img1.src = '../images/photogallery/1.jpg';
	img2 = new Image();
	img2.src = '../images/photogallery/2.jpg';
	img3 = new Image();
	img3.src = '../images/photogallery/3.jpg';
	img4 = new Image();
	img4.src = '../images/photogallery/4.jpg';
	img5 = new Image();
	img5.src = '../images/photogallery/5.jpg';
	img6 = new Image();
	img6.src = '../images/photogallery/6.jpg';
		
	img1_min_color = new Image();
	img1_min_color.src = '../images/photogallery/1_min_color.jpg';
	img2_min_color = new Image();
	img2_min_color.src = '../images/photogallery/2_min_color.jpg';
	img3_min_color = new Image();
	img3_min_color.src = '../images/photogallery/3_min_color.jpg';
	img4_min_color = new Image();
	img4_min_color.src = '../images/photogallery/4_min_color.jpg';
	img5_min_color = new Image();
	img5_min_color.src = '../images/photogallery/5_min_color.jpg';
	img6_min_color = new Image();
	img6_min_color.src = '../images/photogallery/6_min_color.jpg';
			
	img1_min_blackwhite = new Image();
	img1_min_blackwhite.src = '../images/photogallery/1_min_blackwhite.jpg';
	img2_min_blackwhite = new Image();
	img2_min_blackwhite.src = '../images/photogallery/2_min_blackwhite.jpg';
	img3_min_blackwhite = new Image();
	img3_min_blackwhite.src = '../images/photogallery/3_min_blackwhite.jpg';
	img4_min_blackwhite = new Image();
	img4_min_blackwhite.src = '../images/photogallery/4_min_blackwhite.jpg';
	img5_min_blackwhite = new Image();
	img5_min_blackwhite.src = '../images/photogallery/5_min_blackwhite.jpg';
	img6_min_blackwhite = new Image();
	img6_min_blackwhite.src = '../images/photogallery/6_min_blackwhite.jpg';
	}

function change(im,ref) {
	im.src = ref.src;
}
		
		
function big(ref) {
	
	if(document.body.clientWidth > 600) {
		var d = document.createElement('div');
		d.className = "big_photo";
		
		document.body.appendChild(d);
		
		var close_img = document.createElement('img');
		close_img.src = "../images/cross-27156_640.png";
		close_img.className = "close_img";
		d.appendChild(close_img);
		
		close_img.onclick = function() {
			this.parentNode.style.display = "none";
		}
		

		var img = document.createElement('img');
		img.src = ref.src;
		img.className="bigF";
		d.style.textAlign = "center";
		d.appendChild(img);
		
	}
	
	
	
			
}
		
		