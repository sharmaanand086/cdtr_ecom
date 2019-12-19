$(function(){
	$(document).ready(function(){
		//alert('sdfsaf');
		$('.delcat').click(function(){
			var id = $(this).data('id');
			var text = $(this).data('text');
			$.ajax({
				type:'POST',
				url:surl+'Admin/deletecategory',
				data:{id:id,text:text},
				success:function(data){
					var ndata = JSON.parse(data);
					 
					if(ndata.return == true){
						$('.error').text(ndata.message);
						$('.ccat'+id).fadeOut();
					}else if(ndata.return ==  false){
					$('.error').text(ndata.message);
					}else{
					$('.error').text('something went wrong');
					}
					console.log(ndata);
				},
				error:function(){
				$('.error').text('something went wrong');
				}
			})
		});
		$('.delteprod').click(function(){
			var id = $(this).data('id');
			var text = $(this).data('text');
			$.ajax({
				type:'POST',
				url:surl+'Admin/deleteProduct',
				data:{id:id,text:text},
				success:function(data){
					var ndata = JSON.parse(data);
					 
					if(ndata.return == true){
						$('.error').text(ndata.message);
						$('.pdct'+id).fadeOut();
					}else if(ndata.return ==  false){
					$('.error').text(ndata.message);
					}else{
					$('.error').text('something went wrong');
					}
					console.log(ndata);
				},
				error:function(){
				$('.error').text('something went wrong');
				}
			})
		});
		$('.delmodel').click(function(){
			var id = $(this).data('id');
			var text = $(this).data('text');
			$.ajax({
				type:'POST',
				url:surl+'Admin/deletemodel',
				data:{id:id,text:text},
				success:function(data){
					var ndata = JSON.parse(data);
					 
					if(ndata.return == true){
						$('.error').text(ndata.message);
						$('.mdls'+id).fadeOut();
					}else if(ndata.return ==  false){
					$('.error').text(ndata.message);
					}else{
					$('.error').text('something went wrong');
					}
					console.log(ndata);
				},
				error:function(){
				$('.error').text('something went wrong');
				}
			})
		});


		$(function(){
			$('.add_spec').click(function(){

				var spc_count  = $('.spc_cn').length;
				//alert(spc_count);
				var itmes = "";
				itmes +="<div class='form-group constspec rmv"+spc_count+"'>";
				
				itmes +="<input type='text' name='spec_value[]'  class='form-control spc_cn'>";
				itmes +="<a href='javascript:void(0)' class='remve_spec' data-id="+spc_count+">-</a>"
				itmes +="</div>" 
				if(spc_count <= 10){
					$('.htmlitems').append(itmes);
				}
			})
		});

		$('body').on("click",".remve_spec",function(){

			var count =$(this).data('id');
			//alert(count);
			$('.rmv'+count).remove();
		}) ;
			
		 $('.specNow').click(function () {
            var id = $(this).data('id');
            var text = $(this).data('text');
            $.ajax({
                type : 'POST',
                url:surl+'Admin/deleteSpec',           
               data:{id:id,text:text},
                success:function (data) {
                    var ndata = JSON.parse(data);
                    if(ndata.return == true) {
                        $('.error').text(ndata.message);
                        $('.specsid'+id).fadeOut();
                    }
                    else if(ndata.return == false){
                        $('.error').text(ndata.message);
                    }
                    else{
                        $('.error').text('Something went wrong.');
                    }
                },
                error:function (data) {
                	console.log(data);
                    $('.error').text('Something went wrong 2.');
                }

            });
        });
	});//ready end here
});//main 