;(function($){
	$(document).ready(function (){

		$('#place-order').click('submit', (e) => {
			e.preventDefault();

			fetch('/wp-admin/admin-ajax.php?action=order_form', {
			  method: 'POST',
			  headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			  },
			  body: $('#order-form').serialize()
			}).then(response => {
		
			  return response.json();
		
			}).then(jsonResponse => {
		
				console.log({jsonResponse});

				alert('Order Received!');
				$([document.documentElement, document.body]).animate({
					scrollTop: $("#order-form").offset()
				}, 2000);
				$('#order-form').trigger("reset");
		
			});
		
		  });	
	});
})(jQuery);