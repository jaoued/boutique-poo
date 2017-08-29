$(function (){  


	
	$.ajax({  //  envoyé sous forme de JSON
		url:"http://localhost/Mike/php-object-webforce3/single/" + idItem,
		method: "POST"
	})
		


	.done(function(dataOk){
				
			var data = JSON.parse(dataOk)   ; // convertit un object JSON en un object javascript
			console.log (data.pictures[0].url);
		
				$('.single-img > .sp-wrap').html('');
			for(var i= 0; i < data.pictures.length; i++)
			{
				// console.log(data.pictures.[i]);
				 $('.single-img > .sp-wrap').append("<a href=" +  data.pictures[i].url + "><img src=" + data.pictures[i].url + ' alt=""></a>')
				
			}


		
			
	})
			
		

});
