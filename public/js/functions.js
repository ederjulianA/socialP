$(document).ready(function(){

	//estados();
	data();

});


function data()
{
		$.getJSON("http://localhost:8000/api/v1/users",function(data){
				
				for( var i in data.users)
				{
				

					var datos = "<p>id: "+data.users[i].id+"---Email:"+data.users[i].email+"</p><br>";
						//console.log(data.users[i].email);
						$("#objetos").append(datos);


				}
				

					


				
				
			});
}
function estados()
{
		$.ajax({

			url : "estados",
			dataType: "json",
			type : "post",
			data : { },
			success : function(data){

				if(data){
					for( var i in data){
						var div = '<div>'+data[i].nombre+'</div>'
						$('#objetos').append(div);
					}
					console.log(data);

					

					
					
				}
				
				
			}


		});
}